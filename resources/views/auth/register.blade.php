@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-plus fa-3x text-primary mb-3"></i>
                        <h2 class="fw-bold text-primary">Daftar MediTalk</h2>
                        <p class="text-muted">Buat akun baru untuk mengakses layanan konsultasi kami</p>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">
                                <i class="fas fa-user me-2"></i>Nama Lengkap
                            </label>
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-2"></i>Email
                            </label>
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">
                                <i class="fas fa-lock me-2"></i>Konfirmasi Password
                            </label>
                            <input type="password" class="form-control form-control-lg"
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label fw-semibold">
                                <i class="fas fa-users me-2"></i>Daftar Sebagai
                            </label>
                            <select class="form-select form-select-lg @error('role') is-invalid @enderror"
                                    id="role" name="role" required>
                                <option value="">Pilih peran</option>
                                <option value="pasien" {{ old('role') == 'pasien' ? 'selected' : '' }}>Pasien</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted mb-0">Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">
                                Login Sekarang
                            </a>
                        </p>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('home') }}" class="text-muted text-decoration-none">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control, .form-select {
    border-radius: 15px;
    border: 2px solid #e9ecef;
    padding: 12px 20px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-control-lg, .form-select-lg {
    font-size: 1.1rem;
}

.card {
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
}

.btn-lg {
    border-radius: 15px;
    padding: 12px 30px;
    font-weight: 600;
}
</style>
@endsection
