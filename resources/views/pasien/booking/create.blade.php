@extends('layouts.pasien')

@section('title', 'Buat Booking Konsultasi')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1"><i class="fas fa-plus-circle me-2"></i>Buat Booking Konsultasi</h2>
                    <p class="text-muted mb-0">Pilih dokter dan jadwal untuk konsultasi Anda</p>
                </div>
                <a href="{{ route('pasien.booking.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-calendar-plus me-2"></i>Form Booking</h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('pasien.booking.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="schedule_id" class="form-label">
                                    <i class="fas fa-calendar-alt me-2"></i>Pilih Jadwal Konsultasi
                                </label>
                                <select name="schedule_id" id="schedule_id" class="form-select @error('schedule_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>-- Pilih Jadwal --</option>
                                    @foreach($jadwal as $j)
                                        <option value="{{ $j->id }}" {{ old('schedule_id') == $j->id ? 'selected' : '' }}>
                                            {{ $j->doctor->nama }} - {{ $j->hari }}, {{ $j->jam_mulai }}-{{ $j->jam_selesai }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('schedule_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Pilih jadwal yang tersedia untuk konsultasi
                                </small>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">
                                    <i class="fas fa-user-md me-2"></i>Dokter yang Dipilih
                                </label>
                                <div id="doctor-info" class="alert alert-info" style="display: none;">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-user-md text-primary" style="font-size: 1.5rem;"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold" id="doctor-name">-</div>
                                            <div class="text-muted" id="doctor-specialty">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="keluhan" class="form-label">
                                <i class="fas fa-comment-medical me-2"></i>Keluhan
                            </label>
                            <textarea name="keluhan" id="keluhan" class="form-control @error('keluhan') is-invalid @enderror" 
                                      rows="5" placeholder="Jelaskan keluhan atau gejala yang Anda alami..." required>{{ old('keluhan') }}</textarea>
                            @error('keluhan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Berikan detail keluhan Anda agar dokter dapat memberikan saran yang tepat
                            </small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-calendar-check me-2"></i>Buat Booking
                            </button>
                            <a href="{{ route('pasien.booking.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Booking</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6><i class="fas fa-clock text-primary me-2"></i>Proses Booking</h6>
                        <p class="text-muted small">Booking akan direview oleh admin dalam waktu 24 jam</p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-calendar-check text-success me-2"></i>Konfirmasi</h6>
                        <p class="text-muted small">Anda akan mendapat notifikasi setelah booking dikonfirmasi</p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-user-md text-info me-2"></i>Konsultasi</h6>
                        <p class="text-muted small">Datang sesuai jadwal yang telah ditentukan</p>
                    </div>
                </div>
            </div>

            <!-- Available Schedules -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Jadwal Tersedia</h5>
                </div>
                <div class="card-body">
                    @if(count($jadwal) > 0)
                        <div class="list-group list-group-flush">
                            @foreach($jadwal->take(5) as $j)
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-user-md text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold">{{ $j->doctor->nama }}</div>
                                            <div class="text-muted small">{{ $j->hari }}, {{ $j->jam_mulai }}-{{ $j->jam_selesai }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if(count($jadwal) > 5)
                            <div class="text-center mt-3">
                                <small class="text-muted">Dan {{ count($jadwal) - 5 }} jadwal lainnya</small>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-calendar-times text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2 mb-0">Tidak ada jadwal tersedia saat ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scheduleSelect = document.getElementById('schedule_id');
    const doctorInfo = document.getElementById('doctor-info');
    const doctorName = document.getElementById('doctor-name');
    const doctorSpecialty = document.getElementById('doctor-specialty');

    // Sample doctor data (you might want to pass this from controller)
    const schedules = @json($jadwal);

    scheduleSelect.addEventListener('change', function() {
        const selectedSchedule = schedules.find(s => s.id == this.value);
        if (selectedSchedule) {
            doctorName.textContent = selectedSchedule.doctor.nama;
            doctorSpecialty.textContent = selectedSchedule.doctor.spesialisasi;
            doctorInfo.style.display = 'block';
        } else {
            doctorInfo.style.display = 'none';
        }
    });
});
</script>
@endsection
