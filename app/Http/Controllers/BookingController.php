<?php

namespace App\Http\Controllers\Pasien;

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
                    ->latest()->get();

        return view('pasien.booking.index', compact('bookings'));
    }

    public function create()
    {
        $jadwal = Schedule::with('doctor')->get();
        return view('pasien.booking.create', compact('jadwal'));
    }

    public function store(Request $request)
    {
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

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dikirim.');
    }

    public function destroy($id)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking berhasil dibatalkan.');
    }
}
