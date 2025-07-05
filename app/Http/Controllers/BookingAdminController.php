<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingAdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'schedule.doctor'])
                          ->orderBy('created_at', 'desc')
                          ->get();
        return view('admin.booking.index', compact('bookings'));
    }

    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'confirmed';
        $booking->save();

        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil dikonfirmasi.');
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil dibatalkan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('admin.booking.index')->with('success', 'Status berhasil diperbarui.');
    }
}