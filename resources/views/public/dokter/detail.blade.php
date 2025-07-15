@extends('layouts.app')

@section('title', 'Detail Dokter - ' . $dokter->nama)

@section('content')
<!-- Simple Header -->
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dokter.index') }}" class="text-white-50">Dokter</a></li>
                        <li class="breadcrumb-item active text-white">{{ $dokter->nama }}</li>
                    </ol>
                </nav>
                <h2 class="text-white mb-1 mt-2">{{ $dokter->nama }}</h2>
                <p class="text-white-50 mb-0">{{ $dokter->spesialis }}</p>
            </div>
            <div class="col-md-4 text-end">
                <div class="rounded-circle bg-white d-flex align-items-center justify-content-center" 
                     style="width: 80px; height: 80px;">
                    <i class="fas fa-user-md text-purple" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8 mb-4">
            <!-- Doctor Information -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent border-0">
                    <h5 class="mb-0">Informasi Dokter</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted small">Nama</label>
                            <p class="mb-0">{{ $dokter->nama }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted small">Spesialisasi</label>
                            <p class="mb-0">
                                <span class="badge bg-purple">{{ $dokter->spesialis }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted small">Kontak</label>
                            <p class="mb-0">
                                <a href="tel:{{ $dokter->kontak }}" class="text-decoration-none">{{ $dokter->kontak }}</a>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted small">Status</label>
                            <p class="mb-0">
                                @if($dokter->schedules && count($dokter->schedules) > 0)
                                    <span class="badge bg-success">Tersedia Jadwal</span>
                                @else
                                    <span class="badge bg-secondary">Belum Ada Jadwal</span>
                                @endif
                            </p>
                        </div>
                        @if($dokter->deskripsi)
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold text-muted small">Deskripsi</label>
                                <p class="mb-0">{{ $dokter->deskripsi }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <a href="{{ route('dokter.index') }}" class="btn btn-outline-secondary w-100">
                                Kembali ke Daftar
                            </a>
                        </div>
                        <div class="col-md-6 mb-2">
                            @if($dokter->schedules && count($dokter->schedules) > 0)
                                <a href="{{ route('booking') }}?doctor_id={{ $dokter->id }}" class="btn btn-success w-100">
                                    Booking Konsultasi
                                </a>
                            @else
                                <button class="btn btn-secondary w-100" disabled>
                                    Jadwal Belum Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Schedule -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent border-0">
                    <h6 class="mb-0">Jadwal Praktik</h6>
                </div>
                <div class="card-body">
                    @if($dokter->schedules && count($dokter->schedules) > 0)
                        <div class="list-group list-group-flush">
                            @foreach($dokter->schedules as $jadwal)
                                <div class="list-group-item border-0 px-0 py-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="badge bg-purple">{{ $jadwal->hari }}</span>
                                        <small class="text-muted">{{ $jadwal->kapasitas }} slot</small>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-semibold small">
                                            {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                        </span>
                                    </div>
                                    <hr class="my-2">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-calendar-times text-muted mb-2" style="font-size: 2rem;"></i>
                            <h6 class="text-muted">Belum ada jadwal praktik</h6>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Contact -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent border-0">
                    <h6 class="mb-0">Kontak Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="tel:{{ $dokter->kontak }}" class="btn btn-outline-purple btn-sm">
                            Telepon
                        </a>
                        <a href="https://wa.me/{{ $dokter->kontak }}" target="_blank" class="btn btn-outline-success btn-sm">
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Related Doctors -->
            @if(isset($relatedDoctors) && $relatedDoctors && count($relatedDoctors) > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h6 class="mb-0">Dokter Serupa</h6>
                    </div>
                    <div class="card-body">
                        @foreach($relatedDoctors->take(3) as $related)
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-purple d-flex align-items-center justify-content-center me-2" 
                                     style="width: 35px; height: 35px;">
                                    <i class="fas fa-user-md text-white" style="font-size: 0.8rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 small">{{ $related->nama }}</h6>
                                    <small class="text-muted">{{ $related->spesialis }}</small>
                                </div>
                                <a href="{{ route('dokter.detail', $related->id) }}" class="btn btn-outline-purple btn-sm">
                                    Detail
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 8px;
}

.badge {
    border-radius: 6px;
    padding: 0.4rem 0.8rem;
}

.btn {
    border-radius: 6px;
    font-weight: 500;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.5);
}

.breadcrumb-item a {
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

/* Purple color classes */
.bg-purple {
    background-color: #6f42c1 !important;
}

.btn-outline-purple {
    color: #6f42c1;
    border-color: #6f42c1;
}

.btn-outline-purple:hover {
    background-color: #6f42c1;
    border-color: #6f42c1;
    color: white;
}

.text-purple {
    color: #6f42c1 !important;
}
</style>
@endsection
