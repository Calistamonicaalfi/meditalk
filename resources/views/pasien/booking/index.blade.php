@extends('layouts.pasien')

@section('title', 'Riwayat Booking Konsultasi')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1"><i class="fas fa-calendar-check me-2"></i>Riwayat Booking Konsultasi</h2>
                    <p class="text-muted mb-0">Kelola semua booking konsultasi Anda</p>
                </div>
                <a href="{{ route('pasien.booking.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Booking Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
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

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-calendar-check" style="font-size: 2rem; color: #28a745;"></i>
                    </div>
                    <div>
                        <div class="stats-number">{{ $bookings->where('status', 'diterima')->count() }}</div>
                        <div class="stats-label">Diterima</div>
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
                        <div class="stats-number">{{ $bookings->where('status', 'pending')->count() }}</div>
                        <div class="stats-label">Pending</div>
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
                        <div class="stats-number">{{ $bookings->where('status', 'ditolak')->count() }}</div>
                        <div class="stats-label">Ditolak</div>
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
                        <div class="stats-number">{{ $bookings->count() }}</div>
                        <div class="stats-label">Total</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking List -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Booking</h5>
                </div>
                <div class="card-body">
                    @if(count($bookings) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-user-md me-1"></i>Dokter</th>
                                        <th><i class="fas fa-calendar me-1"></i>Tanggal</th>
                                        <th><i class="fas fa-clock me-1"></i>Jam</th>
                                        <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                        <th><i class="fas fa-calendar-plus me-1"></i>Tanggal Booking</th>
                                        <th><i class="fas fa-cogs me-1"></i>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" 
                                                             style="width: 40px; height: 40px;">
                                                            <i class="fas fa-user-md text-white"></i>
                                                        </div>
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
                                                <div class="fw-semibold">{{ $booking->created_at->format('d M Y') }}</div>
                                                <small class="text-muted">{{ $booking->created_at->format('H:i') }}</small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('pasien.booking.show', $booking->id) }}" 
                                                       class="btn btn-sm btn-outline-info" 
                                                       title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($booking->status == 'pending')
                                                        <form action="{{ route('pasien.booking.destroy', $booking->id) }}" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" 
                                                                    class="btn btn-sm btn-outline-danger" 
                                                                    title="Batalkan Booking">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times" style="font-size: 4rem; color: #dee2e6;"></i>
                            <h4 class="mt-3 text-muted">Belum ada booking konsultasi</h4>
                            <p class="text-muted mb-4">Mulai dengan membuat booking konsultasi pertama Anda</p>
                            <a href="{{ route('pasien.booking.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i>Buat Booking Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
