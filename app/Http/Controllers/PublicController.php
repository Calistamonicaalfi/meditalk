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
        $dokter = Doctor::limit(6)->get();
        $articles = Article::orderBy('created_at', 'desc')->limit(6)->get();

        return view('public.home', compact('dokter', 'articles'));
    }

    // Halaman semua artikel
    public function artikel()
    {
        $artikel = Article::with('doctor')->latest()->get();
        return view('public.artikel.index', compact('artikel'));
    }

    // Halaman semua dokter dengan jadwal
    public function dokter()
    {
        $dokter = Doctor::with('schedules')->get();
        return view('public.dokter.index', compact('dokter'));
    }

    // Detail dokter
    public function showDokter($id)
    {
        $dokter = Doctor::with('schedules')->findOrFail($id);
        return view('public.dokter.detail', compact('dokter'));
    }

    // Detail artikel
    public function showArtikel($id)
    {
        $artikel = Article::with('doctor')->findOrFail($id);
        return view('public.artikel.detail', compact('artikel'));
    }

    // Form booking publik - cek login
    public function bookingForm()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melakukan booking.');
        }

        $jadwal = Schedule::with('doctor')->get();
        return view('public.booking', compact('jadwal'));
    }

    // Proses booking publik
    public function storeBooking(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'schedule_id' => 'required|exists:calista_schedules,id',
            'keluhan' => 'required|string'
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $request->schedule_id,
            'keluhan' => $request->keluhan,
            'status' => 'pending'
        ]);

        return redirect()->route('pasien.booking.index')->with('success', 'Booking berhasil dikirim!');
    }
}