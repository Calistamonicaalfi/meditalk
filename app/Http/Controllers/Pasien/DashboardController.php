<?php
// app/Http/Controllers/Pasien/DashboardController.php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::with('doctor')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('pasien.dashboard', compact('bookings'));
    }
}

