<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    // Beranda
    public function home()
    {
        // Get statistics
        $totalDoctors = Doctor::count();
        $totalSchedules = Schedule::count();
        $totalArticles = Article::count();
        $totalBookings = Booking::count(); // Total semua booking
        
        // Get latest articles for preview
        $latestArticles = Article::with('doctor')->latest()->take(3)->get();

        return view('public.home', compact('totalDoctors', 'totalSchedules', 'totalArticles', 'totalBookings', 'latestArticles'));
    }

    // Halaman semua artikel
    public function artikel()
    {
        $articles = Article::with('doctor')->latest()->paginate(9);
        return view('public.artikel.index', compact('articles'));
    }

    // Halaman semua dokter dengan jadwal
    public function dokter(Request $request)
    {
        $query = Doctor::with('schedules');
        
        // Search by name
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        
        // Filter by specialization
        if ($request->filled('spesialis')) {
            $query->where('spesialis', $request->spesialis);
        }
        
        $dokter = $query->paginate(12);
        
        // Get statistics from all doctors (not paginated)
        $allDoctors = Doctor::with('schedules')->get();
        $totalDoctors = $allDoctors->count();
        $totalSpecializations = $allDoctors->pluck('spesialis')->unique()->filter()->count();
        $doctorsWithPhoto = $allDoctors->where('foto', '!=', null)->count();
        $doctorsWithSchedule = $allDoctors->filter(function($d) { return $d->schedules && $d->schedules->count() > 0; })->count();
        
        // Get unique specializations for filter dropdown
        $spesialisasi = Doctor::distinct()->pluck('spesialis')->sort()->filter();
        
        return view('public.dokter.index', compact('dokter', 'spesialisasi', 'totalDoctors', 'totalSpecializations', 'doctorsWithPhoto', 'doctorsWithSchedule'));
    }

    // Detail dokter
    public function showDokter($id)
    {
        $dokter = Doctor::with(['schedules' => function($query) {
            $query->whereDoesntHave('bookings', function($q) {
                $q->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_DITERIMA]);
            });
        }])->findOrFail($id);

        // Get related doctors (same specialization)
        $relatedDoctors = Doctor::with('schedules')
            ->where('id', '!=', $id)
            ->where('spesialis', $dokter->spesialis)
            ->take(3)
            ->get();

        return view('public.dokter.detail', compact('dokter', 'relatedDoctors'));
    }

    // Detail artikel
    public function showArtikel($id)
    {
        $article = Article::with('doctor')->findOrFail($id);
        $relatedArticles = Article::with('doctor')
            ->where('id', '!=', $id)
            ->where('doctor_id', $article->doctor_id)
            ->latest()
            ->take(3)
            ->get();

        return view('public.artikel.detail', compact('article', 'relatedArticles'));
    }

    // Form booking publik - cek login dan role
    public function bookingForm()
    {
        // Ambil jadwal yang tersedia
        $jadwal = Schedule::with('doctor')
            ->whereDoesntHave('bookings', function($query) {
                $query->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_DITERIMA]);
            })
            ->get();

        return view('public.booking', compact('jadwal'));
    }

    // Proses booking publik
    public function storeBooking(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'schedule_id' => 'required|exists:calista_schedules,id',
            'keluhan' => 'required|string|min:10|max:500',
            'agree' => 'required|accepted'
        ], [
            'nama.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'schedule_id.required' => 'Pilih jadwal dokter terlebih dahulu.',
            'schedule_id.exists' => 'Jadwal yang dipilih tidak valid.',
            'keluhan.required' => 'Keluhan harus diisi.',
            'keluhan.min' => 'Keluhan minimal 10 karakter.',
            'keluhan.max' => 'Keluhan maksimal 500 karakter.',
            'agree.required' => 'Anda harus menyetujui syarat dan ketentuan.',
            'agree.accepted' => 'Anda harus menyetujui syarat dan ketentuan.'
        ]);

        // Cek apakah jadwal masih tersedia
        $activeBookings = Booking::where('schedule_id', $request->schedule_id)
            ->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_DITERIMA])
            ->count();

        if ($activeBookings >= 1) {
            return back()->withInput()->with('error', 'Maaf, jadwal ini sudah penuh.');
        }

        // Buat booking tanpa user (untuk publik)
        Booking::create([
            'user_id' => null, // Akan diisi nanti jika user register
            'schedule_id' => $request->schedule_id,
            'keluhan' => $request->keluhan,
            'status' => Booking::STATUS_PENDING
        ]);

        return redirect()->route('home')
            ->with('success', 'Booking berhasil dikirim! Admin akan menghubungi Anda segera melalui email ' . $request->email);
    }
}
