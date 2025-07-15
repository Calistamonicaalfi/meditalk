@extends('layouts.pasien')

@section('title', 'Detail Booking')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1"><i class="fas fa-calendar-check me-2"></i>Detail Booking Konsultasi</h2>
                    <p class="text-muted mb-0">Informasi lengkap booking konsultasi Anda</p>
                </div>
                <a href="{{ route('pasien.booking.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Main Booking Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Booking</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h6 class="text-primary mb-3"><i class="fas fa-user-md me-2"></i>Informasi Dokter</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-user-md text-white" style="font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">{{ $booking->schedule->doctor->nama }}</h6>
                                    <p class="text-muted mb-0">{{ $booking->schedule->doctor->spesialisasi }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-phone text-primary me-2" style="width: 20px;"></i>
                                        <span>{{ $booking->schedule->doctor->kontak }}</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-primary me-2" style="width: 20px;"></i>
                                        <span>{{ $booking->schedule->doctor->email ?? 'Tidak tersedia' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h6 class="text-primary mb-3"><i class="fas fa-calendar-alt me-2"></i>Informasi Jadwal</h6>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-calendar text-primary me-2" style="width: 20px;"></i>
                                        <span class="fw-semibold">{{ $booking->schedule->hari }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-clock text-primary me-2" style="width: 20px;"></i>
                                        <span class="fw-semibold">{{ $booking->schedule->jam_mulai }} - {{ $booking->schedule->jam_selesai }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-calendar-plus text-primary me-2" style="width: 20px;"></i>
                                        <span>Booking dibuat: {{ $booking->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                    @if($booking->updated_at != $booking->created_at)
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-edit text-primary me-2" style="width: 20px;"></i>
                                            <span>Terakhir diupdate: {{ $booking->updated_at->format('d M Y, H:i') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-comment-medical me-2"></i>Keluhan</h6>
                            <div class="alert alert-light border">
                                <p class="mb-0">{{ $booking->keluhan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Status Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Status Booking</h5>
                </div>
                <div class="card-body text-center">
                    @if($booking->status === 'pending')
                        <div class="mb-3">
                            <i class="fas fa-clock" style="font-size: 3rem; color: #ffc107;"></i>
                        </div>
                        <h5 class="text-warning mb-2">Menunggu Konfirmasi</h5>
                        <p class="text-muted mb-3">Admin akan meninjau booking Anda dalam waktu 24 jam</p>
                        <div class="alert alert-warning">
                            <small><i class="fas fa-info-circle me-1"></i>Booking Anda sedang dalam proses review</small>
                        </div>
                    @elseif($booking->status === 'diterima')
                        <div class="mb-3">
                            <i class="fas fa-check-circle" style="font-size: 3rem; color: #28a745;"></i>
                        </div>
                        <h5 class="text-success mb-2">Diterima</h5>
                        <p class="text-muted mb-3">Booking Anda telah dikonfirmasi</p>
                        <div class="alert alert-success">
                            <small><i class="fas fa-check-circle me-1"></i>Silakan datang sesuai jadwal yang telah ditentukan</small>
                        </div>
                    @elseif($booking->status === 'ditolak')
                        <div class="mb-3">
                            <i class="fas fa-times-circle" style="font-size: 3rem; color: #dc3545;"></i>
                        </div>
                        <h5 class="text-danger mb-2">Ditolak</h5>
                        <p class="text-muted mb-3">Booking Anda tidak dapat diproses</p>
                        <div class="alert alert-danger">
                            <small><i class="fas fa-exclamation-triangle me-1"></i>Silakan buat booking baru dengan jadwal yang berbeda</small>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Aksi</h5>
                </div>
                <div class="card-body">
                    @if($booking->status === 'pending')
                        <form action="{{ route('pasien.booking.destroy', $booking->id) }}" method="POST" class="mb-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger w-100" 
                                    onclick="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                <i class="fas fa-times me-2"></i>Batalkan Booking
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('pasien.booking.index') }}" class="btn btn-outline-secondary w-100 mb-2">
                        <i class="fas fa-list me-2"></i>Daftar Booking
                    </a>
                    
                    <a href="{{ route('pasien.booking.create') }}" class="btn btn-primary w-100">
                        <i class="fas fa-plus me-2"></i>Booking Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
