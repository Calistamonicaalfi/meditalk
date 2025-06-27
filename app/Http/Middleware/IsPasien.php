<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsPasien
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'pasien') {
            return $next($request);
        }
        return redirect('/login')->with('error', 'Akses pasien saja.');
    }
}
