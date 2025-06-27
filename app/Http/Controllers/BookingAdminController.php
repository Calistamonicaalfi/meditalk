<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingAdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user', 'schedule.doctor')->latest()->get();
        return view('admin.booking.index', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->route('admin.booking.index')->with('success', 'Status berhasil diperbarui.');
    }
}
