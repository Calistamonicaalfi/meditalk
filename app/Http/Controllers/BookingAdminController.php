<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingAdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'schedule.doctor'])
            ->latest()
            ->get();

        // Kelompokkan booking berdasarkan status
        $pendingBookings = $bookings->where('status', Booking::STATUS_PENDING);
        $diterimaBookings = $bookings->where('status', Booking::STATUS_DITERIMA);
        $ditolakBookings = $bookings->where('status', Booking::STATUS_DITOLAK);

        return view('admin.booking.index', compact(
            'bookings',
            'pendingBookings',
            'diterimaBookings',
            'ditolakBookings'
        ));
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'schedule.doctor'])->findOrFail($id);
        return view('admin.booking.show', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $status = $request->input('status');

        if (!in_array($status, [Booking::STATUS_PENDING, Booking::STATUS_DITERIMA, Booking::STATUS_DITOLAK])) {
            return back()->with('error', 'Status tidak valid.');
        }

        $booking->status = $status;
        $booking->save();

        $statusText = $booking->status_text;
        return back()->with('success', "Status booking berhasil diubah menjadi {$statusText}.");
    }

    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== Booking::STATUS_PENDING) {
            return back()->with('error', 'Hanya booking pending yang dapat dikonfirmasi.');
        }

        $booking->status = Booking::STATUS_DITERIMA;
        $booking->save();

        return back()->with('success', 'Booking berhasil dikonfirmasi.');
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        if (!in_array($booking->status, [Booking::STATUS_PENDING, Booking::STATUS_DITERIMA])) {
            return back()->with('error', 'Booking tidak dapat dibatalkan.');
        }

        $booking->status = Booking::STATUS_DITOLAK;
        $booking->save();

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }

    public function complete($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== Booking::STATUS_DITERIMA) {
            return back()->with('error', 'Hanya booking yang sudah dikonfirmasi yang dapat diselesaikan.');
        }

        $booking->status = Booking::STATUS_DITERIMA; // Tetap diterima karena tidak ada status completed
        $booking->save();

        return back()->with('success', 'Konsultasi berhasil diselesaikan.');
    }

    public function filterByStatus($status)
    {
        $validStatuses = [
            Booking::STATUS_PENDING,
            Booking::STATUS_DITERIMA,
            Booking::STATUS_DITOLAK
        ];

        if (!in_array($status, $validStatuses)) {
            return redirect()->route('admin.booking.index');
        }

        $bookings = Booking::with(['user', 'schedule.doctor'])
            ->where('status', $status)
            ->latest()
            ->get();

        // Tambahkan statistik booking untuk view
        $allBookings = Booking::with(['user', 'schedule.doctor'])->latest()->get();
        $pendingBookings = $allBookings->where('status', Booking::STATUS_PENDING);
        $diterimaBookings = $allBookings->where('status', Booking::STATUS_DITERIMA);
        $ditolakBookings = $allBookings->where('status', Booking::STATUS_DITOLAK);

        return view('admin.booking.index', compact(
            'bookings',
            'status',
            'pendingBookings',
            'diterimaBookings',
            'ditolakBookings'
        ));
    }
}
