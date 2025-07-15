@extends('layouts.app')

@section('title', 'Daftar Dokter - MediTalk')

@section('content')
<!-- Simple Header -->
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="text-white mb-1">Dokter Spesialis</h2>
                <p class="text-white-50 mb-0">Temukan dokter terbaik untuk konsultasi kesehatan Anda</p>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-flex justify-content-end gap-2">
                    <span class="badge bg-white text-purple">{{ $totalDoctors }} Dokter</span>
                    <span class="badge bg-white text-purple">{{ $totalSpecializations }} Spesialisasi</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- Simple Search -->
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto">
            <form method="GET" action="{{ route('dokter.index') }}" class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Cari nama dokter..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="spesialis" class="form-select">
                                <option value="">Semua Spesialisasi</option>
                                @if($spesialisasi && count($spesialisasi) > 0)
                                    @foreach($spesialisasi as $spesialis)
                                        <option value="{{ $spesialis }}" {{ request('spesialis') == $spesialis ? 'selected' : '' }}>
                                            {{ $spesialis }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-purple w-100">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Simple Statistics -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-3">
                    <h4 class="text-purple mb-1">{{ $totalDoctors }}</h4>
                    <small class="text-muted">Total Dokter</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-3">
                    <h4 class="text-purple mb-1">{{ $totalSpecializations }}</h4>
                    <small class="text-muted">Spesialisasi</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-3">
                    <h4 class="text-purple mb-1">{{ $totalDoctors - $doctorsWithSchedule }}</h4>
                    <small class="text-muted">Belum Ada Jadwal</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body p-3">
                    <h4 class="text-purple mb-1">{{ $doctorsWithSchedule }}</h4>
                    <small class="text-muted">Tersedia Jadwal</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Doctors List -->
    <div class="row">
        @forelse($dokter as $d)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <!-- Doctor Icon -->
                    <div class="position-relative">
                        <div class="w-100 d-flex align-items-center justify-content-center" 
                             style="height: 180px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="text-center">
                                <i class="fas fa-user-md text-white mb-2" style="font-size: 4rem;"></i>
                                <div class="text-white-50 small">Dokter Spesialis</div>
                            </div>
                        </div>
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-purple">
                                <i class="fas fa-stethoscope me-1"></i>{{ $d->spesialis }}
                            </span>
                        </div>
                        <div class="position-absolute top-0 start-0 m-2">
                            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center" 
                                 style="width: 40px; height: 40px;">
                                <i class="fas fa-stethoscope text-purple" style="font-size: 1.2rem;"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Doctor Info -->
                    <div class="card-body">
                        <h5 class="card-title mb-2">
                            <i class="fas fa-user-md text-purple me-2" style="font-size: 1.1rem;"></i>
                            {{ $d->nama }}
                        </h5>
                        
                        @if($d->deskripsi)
                            <p class="card-text text-muted small mb-3">
                                {{ Str::limit($d->deskripsi, 60) }}
                            </p>
                        @endif

                        <!-- Contact -->
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-phone me-1"></i>{{ $d->kontak }}
                            </small>
                        </div>

                        <!-- Schedule Status -->
                        <div class="mb-3">
                            @if($d->schedules && count($d->schedules) > 0)
                                <span class="badge bg-success">
                                    <i class="fas fa-calendar-check me-1"></i>{{ count($d->schedules) }} Jadwal
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="fas fa-calendar-times me-1"></i>Belum Ada Jadwal
                                </span>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="d-grid gap-2">
                            <a href="{{ route('dokter.detail', $d->id) }}" class="btn btn-outline-purple btn-sm">
                                Lihat Detail
                            </a>
                            @if($d->schedules && count($d->schedules) > 0)
                                <a href="{{ route('booking') }}?doctor_id={{ $d->id }}" class="btn btn-success btn-sm">
                                    Booking
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-user-md text-muted mb-3" style="font-size: 3rem;"></i>
                    <h5 class="text-muted">Belum ada data dokter</h5>
                    <p class="text-muted">Dokter akan segera ditambahkan ke sistem.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($dokter->hasPages())
        <div class="row">
            <div class="col-12">
                <nav aria-label="Doctor pagination" class="d-flex justify-content-center">
                    {{ $dokter->links() }}
                </nav>
            </div>
        </div>
    @endif
</div>

<style>
.card {
    border-radius: 8px;
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.badge {
    border-radius: 6px;
    padding: 0.4rem 0.8rem;
}

.btn {
    border-radius: 6px;
    font-weight: 500;
}

.form-control, .form-select {
    border-radius: 6px;
}

/* Purple color classes */
.bg-purple {
    background-color: #6f42c1 !important;
}

.btn-purple {
    background-color: #6f42c1;
    border-color: #6f42c1;
    color: white;
}

.btn-purple:hover {
    background-color: #5a32a3;
    border-color: #5a32a3;
    color: white;
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