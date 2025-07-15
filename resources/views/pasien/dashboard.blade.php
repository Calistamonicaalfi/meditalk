{{-- resources/views/pasien/dashboard.blade.php --}}
@extends('layouts.pasien')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-user-circle" style="font-size: 3rem; color: #667eea;"></i>
                    </div>
                    <h2 class="card-title mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
                    <p class="card-text text-muted">Kelola booking konsultasi Anda dengan mudah melalui dashboard ini.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-calendar-check" style="font-size: 2rem; color: #28a745;"></i>
                    </div>
                    <div>
                        <div class="stats-number">{{ isset($bookings) ? $bookings->where('status', 'diterima')->count() : 0 }}</div>
                        <div class="stats-label">Booking Diterima</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-clock" style="font-size: 2rem; color: #ffc107;"></i>
                    </div>
                    <div>
                        <div class="stats-number">{{ isset($bookings) ? $bookings->where('status', 'pending')->count() : 0 }}</div>
                        <div class="stats-label">Menunggu Konfirmasi</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-calendar-times" style="font-size: 2rem; color: #dc3545;"></i>
                    </div>
                    <div>
                        <div class="stats-number">{{ isset($bookings) ? $bookings->where('status', 'ditolak')->count() : 0 }}</div>
                        <div class="stats-label">Booking Ditolak</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-calendar-alt" style="font-size: 2rem; color: #667eea;"></i>
                    </div>
                    <div>
                        <div class="stats-number">{{ isset($bookings) ? $bookings->count() : 0 }}</div>
                        <div class="stats-label">Total Booking</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('pasien.booking.create') }}" class="btn btn-primary w-100 py-3">
                                <i class="fas fa-plus-circle me-2"></i>
                                <div>Booking Konsultasi Baru</div>
                                <small class="d-block opacity-75">Buat janji konsultasi dengan dokter</small>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('pasien.booking.index') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-list me-2"></i>
                                <div>Lihat Riwayat Booking</div>
                                <small class="d-block opacity-75">Kelola semua booking Anda</small>
                            </a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 py-3">
                                <i class="fas fa-home me-2"></i>
                                <div>Kembali ke Beranda</div>
                                <small class="d-block opacity-75">Lihat informasi dokter dan artikel</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Booking Konsultasi Terbaru</h5>
                    <a href="{{ route('pasien.booking.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    @if(isset($bookings) && count($bookings) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-user-md me-1"></i>Dokter</th>
                                        <th><i class="fas fa-calendar me-1"></i>Tanggal</th>
                                        <th><i class="fas fa-clock me-1"></i>Jam</th>
                                        <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                        <th><i class="fas fa-cogs me-1"></i>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings->take(5) as $booking)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <i class="fas fa-user-md text-primary"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">{{ $booking->schedule->doctor->nama }}</div>
                                                    <small class="text-muted">{{ $booking->schedule->doctor->spesialisasi }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $booking->schedule->hari }}</div>
                                            <small class="text-muted">{{ $booking->created_at->format('d M Y') }}</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $booking->schedule->jam_mulai }} - {{ $booking->schedule->jam_selesai }}</div>
                                        </td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fas fa-clock me-1"></i>Pending
                                                </span>
                                            @elseif($booking->status == 'diterima')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check me-1"></i>Diterima
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times me-1"></i>Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('pasien.booking.show', $booking->id) }}" 
                                               class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-eye me-1"></i>Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times" style="font-size: 3rem; color: #dee2e6;"></i>
                            <h5 class="mt-3 text-muted">Belum ada booking konsultasi</h5>
                            <p class="text-muted">Mulai dengan membuat booking konsultasi pertama Anda</p>
                            <a href="{{ route('pasien.booking.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Booking Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
