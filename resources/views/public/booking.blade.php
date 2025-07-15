@extends('layouts.app')

@section('title', 'Booking Konsultasi - MediTalk')

@section('content')
<!-- Compact Header -->
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin-top: -30px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dokter.index') }}" class="text-white-50">Dokter</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Booking</li>
                    </ol>
                </nav>
                <h2 class="text-white mb-2 mt-2"><i class="fas fa-calendar-plus me-2"></i>Booking Konsultasi</h2>
                <p class="text-white-50 mb-0">Pilih jadwal dokter dan buat appointment konsultasi</p>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-flex justify-content-end gap-2">
                    <span class="badge bg-white text-primary px-3 py-2">
                        <i class="fas fa-calendar-check me-1"></i>{{ count($jadwal) }} Jadwal Tersedia
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Booking Form -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h5 class="mb-0"><i class="fas fa-calendar-plus me-2 text-primary"></i>Form Booking Konsultasi</h5>
                </div>
                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="alert alert-info small">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Informasi:</strong> Booking akan ditinjau oleh admin dalam waktu 24 jam.
                    </div>

                    <form method="POST" action="{{ route('booking.store') }}">
                        @csrf
                        
                        <!-- Personal Information -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">
                                    <i class="fas fa-user me-1"></i>Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                       value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">
                                    <i class="fas fa-envelope me-1"></i>Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" required placeholder="Masukkan email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Schedule Selection -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-calendar me-1"></i>Pilih Jadwal Dokter <span class="text-danger">*</span>
                            </label>
                            <select name="schedule_id" class="form-select @error('schedule_id') is-invalid @enderror" required>
                                <option value="">Pilih jadwal dokter...</option>
                                @foreach($jadwal as $j)
                                    <option value="{{ $j->id }}" {{ old('schedule_id') == $j->id ? 'selected' : '' }}>
                                        <strong>{{ $j->doctor->nama }}</strong> ({{ $j->doctor->spesialis }}) - 
                                        {{ $j->hari }} ({{ $j->jam_mulai }} - {{ $j->jam_selesai }})
                                    </option>
                                @endforeach
                            </select>
                            @error('schedule_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-lightbulb me-1"></i>Pilih jadwal yang sesuai dengan waktu luang Anda
                            </small>
                        </div>

                        <!-- Complaint -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                <i class="fas fa-notes-medical me-1"></i>Keluhan <span class="text-danger">*</span>
                            </label>
                            <textarea name="keluhan" class="form-control @error('keluhan') is-invalid @enderror"
                                      rows="4" required placeholder="Jelaskan keluhan Anda secara detail...">{{ old('keluhan') }}</textarea>
                            @error('keluhan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>Minimal 10 karakter, maksimal 500 karakter
                            </small>
                        </div>

                        <!-- Terms -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input @error('agree') is-invalid @enderror" type="checkbox" id="agree" name="agree" required>
                                <label class="form-check-label small" for="agree">
                                    Saya setuju dengan <a href="#" class="text-primary">syarat dan ketentuan</a> booking konsultasi
                                </label>
                                @error('agree')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('dokter.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Information Card -->
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h6 class="mb-0"><i class="fas fa-question-circle me-2 text-info"></i>Cara Booking</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary mb-2 small"><i class="fas fa-list-ol me-2"></i>Langkah Booking:</h6>
                            <ol class="mb-0 small">
                                <li>Pilih jadwal dokter yang sesuai</li>
                                <li>Isi data diri dan keluhan</li>
                                <li>Klik "Kirim Booking"</li>
                                <li>Tunggu konfirmasi admin</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success mb-2 small"><i class="fas fa-clock me-2"></i>Waktu Proses:</h6>
                            <ul class="mb-0 small">
                                <li>Review booking: 24 jam</li>
                                <li>Konfirmasi via email</li>
                                <li>Konsultasi sesuai jadwal</li>
                                <li>Follow-up jika diperlukan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Schedules Preview -->
            @if(count($jadwal) > 0)
                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <h6 class="mb-0"><i class="fas fa-calendar-check me-2 text-success"></i>Jadwal Tersedia</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($jadwal->take(6) as $j)
                                <div class="col-md-6 mb-2">
                                    <div class="border rounded p-2">
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" 
                                                 style="width: 25px; height: 25px;">
                                                <i class="fas fa-user-md text-white" style="font-size: 0.6rem;"></i>
                                            </div>
                                            <div>
                                                <strong class="small">{{ $j->doctor->nama }}</strong>
                                                <br><small class="text-muted">{{ $j->doctor->spesialis }}</small>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <span class="badge bg-primary small">{{ $j->hari }}</span>
                                            <br><small class="text-muted">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
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

.form-control, .form-select {
    border-radius: 8px;
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
</style>
@endsection
