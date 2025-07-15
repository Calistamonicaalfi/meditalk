@extends('layouts.admin')

@section('title', 'Detail Booking')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Booking Konsultasi</h2>
        <a href="{{ route('admin.booking.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h6 class="text-primary mb-3"><i class="fas fa-user me-2"></i>Informasi Pasien</h6>
            <div class="card border-0 bg-light mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            @if($booking->user && $booking->user->profile_photo_path)
                                <img src="{{ asset('storage/' . $booking->user->profile_photo_path) }}" 
                                     alt="Foto" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-user text-white" style="font-size: 1.5rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">{{ $booking->nama_pasien }}</h5>
                            <p class="text-muted mb-0">
                                @if($booking->isPublic())
                                    <i class="fas fa-globe me-1"></i>Pasien Publik
                                @else
                                    <i class="fas fa-user me-1"></i>{{ $booking->user->email ?? 'N/A' }}
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    @if($booking->isPublic())
                        <div class="alert alert-info small">
                            <i class="fas fa-info-circle me-1"></i>
                            Booking ini dibuat oleh pasien publik tanpa akun.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <h6 class="text-primary mb-3"><i class="fas fa-user-md me-2"></i>Informasi Dokter</h6>
            <div class="card border-0 bg-light mb-3">
                <div class="card-body">
                    @if($booking->schedule && $booking->schedule->doctor)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px;">
                                    <i class="fas fa-user-md text-white" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">{{ $booking->schedule->doctor->nama }}</h5>
                                <span class="badge bg-primary">{{ $booking->schedule->doctor->spesialis }}</span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted">Kontak:</small>
                                <div class="fw-semibold">{{ $booking->schedule->doctor->kontak }}</div>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Jadwal:</small>
                                <div class="fw-semibold">{{ $booking->schedule->hari }}</div>
                                <div class="text-muted">{{ $booking->schedule->jam_mulai }} - {{ $booking->schedule->jam_selesai }}</div>
                            </div>
                        </div>
                    @else
                        <div class="text-center text-muted">
                            <i class="fas fa-exclamation-triangle mb-2" style="font-size: 2rem;"></i>
                            <p>Informasi dokter tidak tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h6 class="text-primary mb-3"><i class="fas fa-notes-medical me-2"></i>Detail Keluhan</h6>
            <div class="card border-0 bg-light mb-3">
                <div class="card-body">
                    <p class="mb-0">{{ $booking->keluhan }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h6 class="text-primary mb-3"><i class="fas fa-calendar me-2"></i>Informasi Booking</h6>
            <div class="card border-0 bg-light mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted">Status:</small>
                            <div class="mb-2">
                                @if($booking->status === 'pending')
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-clock me-1"></i>Menunggu
                                    </span>
                                @elseif($booking->status === 'diterima')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i>Diterima
                                    </span>
                                @elseif($booking->status === 'ditolak')
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times me-1"></i>Ditolak
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Tanggal Booking:</small>
                            <div class="fw-semibold">{{ $booking->created_at->format('d/m/Y') }}</div>
                            <div class="text-muted">{{ $booking->created_at->format('H:i') }}</div>
                        </div>
                    </div>
                    
                    @if($booking->updated_at != $booking->created_at)
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <small class="text-muted">Terakhir Diupdate:</small>
                                <div class="fw-semibold">{{ $booking->updated_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <h6 class="text-primary mb-3"><i class="fas fa-cog me-2"></i>Aksi</h6>
            <div class="card border-0 bg-light mb-3">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($booking->status === 'pending')
                            <button class="btn btn-success" onclick="updateStatus({{ $booking->id }}, 'diterima')">
                                <i class="fas fa-check me-2"></i>Terima Booking
                            </button>
                            <button class="btn btn-danger" onclick="updateStatus({{ $booking->id }}, 'ditolak')">
                                <i class="fas fa-times me-2"></i>Tolak Booking
                            </button>
                        @else
                            <div class="alert alert-info small">
                                <i class="fas fa-info-circle me-1"></i>
                                Status booking sudah {{ $booking->status_text }}. Gunakan dropdown di tabel untuk mengubah status.
                            </div>
                        @endif
                        
                        <button class="btn btn-outline-primary" onclick="editBooking({{ $booking->id }})">
                            <i class="fas fa-edit me-2"></i>Edit Booking
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 12px;
}

.badge {
    border-radius: 20px;
    padding: 0.5rem 1rem;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.alert {
    border-radius: 8px;
    border: none;
}
</style>
@endsection
