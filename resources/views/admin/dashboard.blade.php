@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1" style="color: #1e293b; font-weight: 600;">Selamat Datang, {{ Auth::user()->name }}!</h2>
                    <p class="mb-0" style="color: #64748b;">Kelola data aplikasi MediTalk dengan mudah dan efisien</p>
                </div>
                <div class="text-end">
                    <div style="color: #64748b; font-size: 0.875rem;">{{ now()->format('l, d F Y') }}</div>
                    <div style="color: #8b5cf6; font-weight: 500;">{{ now()->format('H:i') }} WIB</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="stat-number">{{ \App\Models\Doctor::count() }}</div>
                    <div class="stat-label">Total Dokter</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-user-md"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="stat-number">{{ \App\Models\Article::count() }}</div>
                    <div class="stat-label">Total Artikel</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="stat-number">{{ \App\Models\Booking::count() }}</div>
                    <div class="stat-label">Total Booking</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="stat-number">{{ \App\Models\User::where('role', 'pasien')->count() }}</div>
                    <div class="stat-label">Total Pasien</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Data -->
    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0" style="color: #1e293b; font-weight: 600;">
                        <i class="fas fa-bolt me-2 text-purple"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="{{ route('admin.dokter.create') }}" class="btn btn-outline-purple w-100">
                                <i class="fas fa-plus me-2"></i>Tambah Dokter
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('jadwal.create') }}" class="btn btn-outline-purple w-100">
                                <i class="fas fa-calendar-plus me-2"></i>Buat Jadwal
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('article.create') }}" class="btn btn-outline-purple w-100">
                                <i class="fas fa-edit me-2"></i>Tulis Artikel
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.booking.index') }}" class="btn btn-outline-purple w-100">
                                <i class="fas fa-list me-2"></i>Lihat Booking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Bookings -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="color: #1e293b; font-weight: 600;">
                        <i class="fas fa-clock me-2 text-purple"></i>Booking Terbaru
                    </h5>
                    <a href="{{ route('admin.booking.index') }}" class="btn btn-sm btn-outline-purple">Lihat Semua</a>
                </div>
                <div class="card-body">
                    @php
                        $recentBookings = \App\Models\Booking::with(['doctor', 'user'])->latest()->take(5)->get();
                    @endphp
                    
                    @if($recentBookings->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentBookings as $booking)
                                <div class="list-group-item border-0 px-0 py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div style="font-weight: 500; color: #1e293b; font-size: 0.875rem;">
                                                {{ $booking->user->name ?? 'Guest' }}
                                            </div>
                                            <div style="color: #64748b; font-size: 0.75rem;">
                                                Dr. {{ $booking->doctor->nama ?? 'Unknown' }}
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <div style="font-size: 0.75rem; color: #64748b;">
                                                {{ $booking->created_at->format('d/m/Y') }}
                                            </div>
                                            @if($booking->status == 'pending')
                                                <span class="badge badge-pending">Pending</span>
                                            @elseif($booking->status == 'diterima')
                                                <span class="badge badge-approved">Diterima</span>
                                            @else
                                                <span class="badge badge-rejected">Ditolak</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times text-muted mb-2" style="font-size: 2rem;"></i>
                            <p class="text-muted mb-0">Belum ada booking</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- System Status -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0" style="color: #1e293b; font-weight: 600;">
                        <i class="fas fa-chart-line me-2 text-purple"></i>Status Sistem
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-circle text-success" style="font-size: 0.5rem;"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 500; color: #1e293b;">Database</div>
                                    <small style="color: #64748b;">Connected</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-circle text-success" style="font-size: 0.5rem;"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 500; color: #1e293b;">Storage</div>
                                    <small style="color: #64748b;">Available</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-circle text-success" style="font-size: 0.5rem;"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 500; color: #1e293b;">Cache</div>
                                    <small style="color: #64748b;">Optimized</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-circle text-success" style="font-size: 0.5rem;"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 500; color: #1e293b;">Security</div>
                                    <small style="color: #64748b;">Protected</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection