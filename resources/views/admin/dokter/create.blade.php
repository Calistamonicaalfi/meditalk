@extends('layouts.admin')

@section('title', 'Tambah Dokter')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1"><i class="fas fa-user-plus me-2"></i>Tambah Dokter Baru</h2>
                    <p class="text-muted mb-0">Tambahkan data dokter baru ke sistem</p>
                </div>
                <a href="{{ route('admin.dokter.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user-md me-2"></i>Form Data Dokter</h5>
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

                                            <form action="{{ route('admin.dokter.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">
                                    <i class="fas fa-user me-2"></i>Nama Lengkap Dokter
                                </label>
                                <input type="text" 
                                       name="nama" 
                                       id="nama" 
                                       class="form-control @error('nama') is-invalid @enderror" 
                                       value="{{ old('nama') }}" 
                                       placeholder="Masukkan nama lengkap dokter" 
                                       required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="spesialis" class="form-label">
                                    <i class="fas fa-stethoscope me-2"></i>Spesialisasi
                                </label>
                                <select name="spesialis" 
                                        id="spesialis" 
                                        class="form-select @error('spesialis') is-invalid @enderror" 
                                        required>
                                    <option value="" disabled selected>-- Pilih Spesialisasi --</option>
                                    <option value="Dokter Umum" {{ old('spesialis') == 'Dokter Umum' ? 'selected' : '' }}>Dokter Umum</option>
                                    <option value="Dokter Gigi" {{ old('spesialis') == 'Dokter Gigi' ? 'selected' : '' }}>Dokter Gigi</option>
                                    <option value="Dokter Anak" {{ old('spesialis') == 'Dokter Anak' ? 'selected' : '' }}>Dokter Anak</option>
                                    <option value="Dokter Kandungan" {{ old('spesialis') == 'Dokter Kandungan' ? 'selected' : '' }}>Dokter Kandungan</option>
                                    <option value="Dokter Kulit" {{ old('spesialis') == 'Dokter Kulit' ? 'selected' : '' }}>Dokter Kulit</option>
                                    <option value="Dokter Mata" {{ old('spesialis') == 'Dokter Mata' ? 'selected' : '' }}>Dokter Mata</option>
                                    <option value="Dokter THT" {{ old('spesialis') == 'Dokter THT' ? 'selected' : '' }}>Dokter THT</option>
                                    <option value="Dokter Jantung" {{ old('spesialis') == 'Dokter Jantung' ? 'selected' : '' }}>Dokter Jantung</option>
                                    <option value="Dokter Saraf" {{ old('spesialis') == 'Dokter Saraf' ? 'selected' : '' }}>Dokter Saraf</option>
                                    <option value="Dokter Bedah" {{ old('spesialis') == 'Dokter Bedah' ? 'selected' : '' }}>Dokter Bedah</option>
                                    <option value="Psikiater" {{ old('spesialis') == 'Psikiater' ? 'selected' : '' }}>Psikiater</option>
                                    <option value="Lainnya" {{ old('spesialis') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('spesialis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kontak" class="form-label">
                                    <i class="fas fa-phone me-2"></i>Nomor Kontak
                                </label>
                                <input type="text" 
                                       name="kontak" 
                                       id="kontak" 
                                       class="form-control @error('kontak') is-invalid @enderror" 
                                       value="{{ old('kontak') }}" 
                                       placeholder="Contoh: 081234567890" 
                                       required>
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email (Opsional)
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" 
                                       placeholder="dokter@example.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">
                                <i class="fas fa-file-alt me-2"></i>Deskripsi & Pengalaman
                            </label>
                            <textarea name="deskripsi" 
                                      id="deskripsi" 
                                      class="form-control @error('deskripsi') is-invalid @enderror" 
                                      rows="4" 
                                      placeholder="Jelaskan pengalaman, keahlian khusus, atau informasi tambahan tentang dokter...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Informasi ini akan ditampilkan kepada pasien
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="foto" class="form-label">
                                <i class="fas fa-camera me-2"></i>Foto Dokter
                            </label>
                            <input type="file" 
                                   name="foto" 
                                   id="foto" 
                                   class="form-control @error('foto') is-invalid @enderror" 
                                   accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Format: JPG, PNG, GIF. Maksimal 2MB. Foto akan ditampilkan sebagai profil dokter.
                            </small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Dokter
                            </button>
                            <a href="{{ route('admin.dokter.index') }}" class="btn btn-outline-secondary">
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
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6><i class="fas fa-user-md text-primary me-2"></i>Data Dokter</h6>
                        <p class="text-muted small">Pastikan semua data dokter diisi dengan lengkap dan akurat</p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-camera text-success me-2"></i>Foto Profil</h6>
                        <p class="text-muted small">Foto akan ditampilkan di halaman publik dan dashboard</p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-calendar-alt text-info me-2"></i>Jadwal</h6>
                        <p class="text-muted small">Setelah dokter ditambahkan, Anda dapat mengatur jadwal konsultasi</p>
                    </div>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-eye me-2"></i>Preview</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div id="imagePreview" class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto" 
                             style="width: 120px; height: 120px;">
                            <i class="fas fa-user-md text-white" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                    <div class="text-center">
                        <h6 id="previewNama" class="mb-1">Nama Dokter</h6>
                        <span id="previewSpesialis" class="badge bg-primary">Spesialisasi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaInput = document.getElementById('nama');
    const spesialisSelect = document.getElementById('spesialis');
    const fotoInput = document.getElementById('foto');
    const imagePreview = document.getElementById('imagePreview');
    const previewNama = document.getElementById('previewNama');
    const previewSpesialis = document.getElementById('previewSpesialis');

    // Update preview nama
    namaInput.addEventListener('input', function() {
        previewNama.textContent = this.value || 'Nama Dokter';
    });

    // Update preview spesialisasi
    spesialisSelect.addEventListener('change', function() {
        previewSpesialis.textContent = this.value || 'Spesialisasi';
    });

    // Image preview
    fotoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">`;
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = '<i class="fas fa-user-md text-white" style="font-size: 3rem;"></i>';
        }
    });
});
</script>
@endsection
