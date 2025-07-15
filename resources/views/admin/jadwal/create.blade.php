@extends('layouts.admin')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1"><i class="fas fa-calendar-plus me-2"></i>Tambah Jadwal Dokter</h2>
                    <p class="text-muted mb-0">Buat jadwal konsultasi baru untuk dokter</p>
                </div>
                <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Form Jadwal</h5>
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

                    <form action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="doctor_id" class="form-label">
                                    <i class="fas fa-user-md me-2"></i>Pilih Dokter
                                </label>
                                <select name="doctor_id" 
                                        id="doctor_id" 
                                        class="form-select @error('doctor_id') is-invalid @enderror" 
                                        required>
                                    <option value="" disabled selected>-- Pilih Dokter --</option>
                                    @foreach($dokter as $d)
                                        <option value="{{ $d->id }}" 
                                                data-foto="{{ $d->foto ? asset('storage/' . $d->foto) : '' }}"
                                                data-spesialis="{{ $d->spesialis }}"
                                                {{ old('doctor_id') == $d->id ? 'selected' : '' }}>
                                            {{ $d->nama }} - {{ $d->spesialis }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="hari" class="form-label">
                                    <i class="fas fa-calendar me-2"></i>Hari Praktik
                                </label>
                                <select name="hari" 
                                        id="hari" 
                                        class="form-select @error('hari') is-invalid @enderror" 
                                        required>
                                    <option value="" disabled selected>-- Pilih Hari --</option>
                                    <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                    <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                    <option value="Minggu" {{ old('hari') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                </select>
                                @error('hari')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jam_mulai" class="form-label">
                                    <i class="fas fa-clock me-2"></i>Jam Mulai
                                </label>
                                <input type="time" 
                                       name="jam_mulai" 
                                       id="jam_mulai" 
                                       class="form-control @error('jam_mulai') is-invalid @enderror" 
                                       value="{{ old('jam_mulai') }}" 
                                       required>
                                @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="jam_selesai" class="form-label">
                                    <i class="fas fa-clock me-2"></i>Jam Selesai
                                </label>
                                <input type="time" 
                                       name="jam_selesai" 
                                       id="jam_selesai" 
                                       class="form-control @error('jam_selesai') is-invalid @enderror" 
                                       value="{{ old('jam_selesai') }}" 
                                       required>
                                @error('jam_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="foto_jadwal" class="form-label">
                                <i class="fas fa-camera me-2"></i>Foto Jadwal (Opsional)
                            </label>
                            <input type="file" 
                                   name="foto_jadwal" 
                                   id="foto_jadwal" 
                                   class="form-control @error('foto_jadwal') is-invalid @enderror" 
                                   accept="image/*">
                            @error('foto_jadwal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Foto tambahan untuk jadwal (opsional)
                            </small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Jadwal
                            </button>
                            <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Doctor Preview Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user-md me-2"></i>Dokter yang Dipilih</h5>
                </div>
                <div class="card-body">
                    <div id="doctorPreview" class="text-center">
                        <div class="mb-3">
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto" 
                                 style="width: 120px; height: 120px;">
                                <i class="fas fa-user-md text-white" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                        <h6 id="doctorName" class="mb-1">Pilih Dokter</h6>
                        <span id="doctorSpecialty" class="badge bg-primary">-</span>
                    </div>
                </div>
            </div>

            <!-- Schedule Preview Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Preview Jadwal</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6><i class="fas fa-calendar text-primary me-2"></i>Hari</h6>
                        <p id="previewHari" class="mb-0 text-muted">-</p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-clock text-success me-2"></i>Jam Praktik</h6>
                        <p id="previewJam" class="mb-0 text-muted">-</p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-hourglass-half text-info me-2"></i>Durasi</h6>
                        <p id="previewDurasi" class="mb-0 text-muted">-</p>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6><i class="fas fa-user-md text-primary me-2"></i>Dokter</h6>
                        <p class="text-muted small">Pastikan dokter sudah terdaftar di sistem</p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-calendar-alt text-success me-2"></i>Jadwal</h6>
                        <p class="text-muted small">Hindari jadwal yang bertabrakan untuk dokter yang sama</p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-clock text-info me-2"></i>Waktu</h6>
                        <p class="text-muted small">Jam selesai harus lebih besar dari jam mulai</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const doctorSelect = document.getElementById('doctor_id');
    const hariSelect = document.getElementById('hari');
    const jamMulaiInput = document.getElementById('jam_mulai');
    const jamSelesaiInput = document.getElementById('jam_selesai');
    
    const doctorPreview = document.getElementById('doctorPreview');
    const doctorName = document.getElementById('doctorName');
    const doctorSpecialty = document.getElementById('doctorSpecialty');
    const previewHari = document.getElementById('previewHari');
    const previewJam = document.getElementById('previewJam');
    const previewDurasi = document.getElementById('previewDurasi');

    // Update doctor preview
    doctorSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            const foto = selectedOption.getAttribute('data-foto');
            const spesialis = selectedOption.getAttribute('data-spesialis');
            
            doctorName.textContent = selectedOption.text.split(' - ')[0];
            doctorSpecialty.textContent = spesialis;
            
            if (foto) {
                doctorPreview.querySelector('.rounded-circle').innerHTML = 
                    `<img src="${foto}" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">`;
            } else {
                doctorPreview.querySelector('.rounded-circle').innerHTML = 
                    '<i class="fas fa-user-md text-white" style="font-size: 3rem;"></i>';
            }
        } else {
            doctorName.textContent = 'Pilih Dokter';
            doctorSpecialty.textContent = '-';
            doctorPreview.querySelector('.rounded-circle').innerHTML = 
                '<i class="fas fa-user-md text-white" style="font-size: 3rem;"></i>';
        }
    });

    // Update schedule preview
    function updateSchedulePreview() {
        const hari = hariSelect.value;
        const jamMulai = jamMulaiInput.value;
        const jamSelesai = jamSelesaiInput.value;
        
        previewHari.textContent = hari || '-';
        previewJam.textContent = (jamMulai && jamSelesai) ? `${jamMulai} - ${jamSelesai}` : '-';
        
        if (jamMulai && jamSelesai) {
            const start = new Date(`2000-01-01T${jamMulai}`);
            const end = new Date(`2000-01-01T${jamSelesai}`);
            const diffMs = end - start;
            const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
            const diffMinutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
            
            if (diffHours > 0) {
                previewDurasi.textContent = `${diffHours} jam ${diffMinutes > 0 ? diffMinutes + ' menit' : ''}`;
            } else {
                previewDurasi.textContent = `${diffMinutes} menit`;
            }
        } else {
            previewDurasi.textContent = '-';
        }
    }

    hariSelect.addEventListener('change', updateSchedulePreview);
    jamMulaiInput.addEventListener('change', updateSchedulePreview);
    jamSelesaiInput.addEventListener('change', updateSchedulePreview);
});
</script>
@endsection
