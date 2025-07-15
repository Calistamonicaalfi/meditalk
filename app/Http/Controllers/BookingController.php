<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('schedule.doctor')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();

        // Kelompokkan booking berdasarkan status
        $pendingBookings = $bookings->where('status', Booking::STATUS_PENDING);
        $diterimaBookings = $bookings->where('status', Booking::STATUS_DITERIMA);
        $ditolakBookings = $bookings->where('status', Booking::STATUS_DITOLAK);

        return view('pasien.booking.index', compact(
            'bookings',
            'pendingBookings',
            'diterimaBookings',
            'ditolakBookings'
        ));
    }

    public function create()
    {
        // Ambil jadwal yang tersedia (belum penuh)
        $jadwal = Schedule::with('doctor')
            ->whereDoesntHave('bookings', function($query) {
                $query->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_DITERIMA]);
            })
            ->get();

        return view('pasien.booking.create', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:calista_schedules,id',
            'keluhan' => 'required|string|min:10|max:500'
        ], [
            'schedule_id.required' => 'Pilih jadwal dokter terlebih dahulu.',
            'schedule_id.exists' => 'Jadwal yang dipilih tidak valid.',
            'keluhan.required' => 'Keluhan harus diisi.',
            'keluhan.min' => 'Keluhan minimal 10 karakter.',
            'keluhan.max' => 'Keluhan maksimal 500 karakter.'
        ]);

        // Cek apakah user sudah booking di jadwal yang sama
        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('schedule_id', $request->schedule_id)
            ->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_DITERIMA])
            ->first();

        if ($existingBooking) {
            return back()->withInput()->with('error', 'Anda sudah memiliki booking untuk jadwal ini.');
        }

        // Cek apakah jadwal masih tersedia
        $activeBookings = Booking::where('schedule_id', $request->schedule_id)
            ->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_DITERIMA])
            ->count();

        // Asumsikan maksimal 1 booking per jadwal
        if ($activeBookings >= 1) {
            return back()->withInput()->with('error', 'Maaf, jadwal ini sudah penuh.');
        }

        Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $request->schedule_id,
            'keluhan' => $request->keluhan,
            'status' => Booking::STATUS_PENDING
        ]);

        // Redirect ke daftar booking pasien setelah booking
        return redirect()->route('pasien.booking.index')
            ->with('success', 'Booking berhasil dikirim! Admin akan meninjau booking Anda.');
    }

    public function destroy($id)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);

        // Hanya bisa batalkan booking yang masih pending
        if ($booking->status !== Booking::STATUS_PENDING) {
            return redirect()->route('pasien.booking.index')
                ->with('error', 'Hanya booking yang masih pending yang dapat dibatalkan.');
        }

        $booking->delete();
        return redirect()->route('pasien.booking.index')
            ->with('success', 'Booking berhasil dibatalkan.');
    }

    // Method untuk melihat detail booking
    public function show($id)
    {
        $booking = Booking::with('schedule.doctor')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pasien.booking.show', compact('booking'));
    }
}
