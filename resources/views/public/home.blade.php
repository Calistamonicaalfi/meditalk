@extends('layouts.app')

@section('title', 'Welcome to MediTalk')

@section('content')
<!-- Hero Section -->
<div class="hero-section py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin-top: -30px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="text-white mb-3 display-4 fw-bold">
                    Konsultasi Kesehatan<br>
                    <span class="text-warning">Lebih Mudah</span>
                </h1>
                <p class="text-white-50 mb-4 lead">
                    Platform konsultasi kesehatan online yang menghubungkan Anda dengan dokter spesialis terpercaya.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('dokter.index') }}" class="btn btn-warning btn-lg px-4">
                        <i class="fas fa-user-md me-2"></i>Lihat Dokter
                    </a>
                    <a href="{{ route('booking') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-calendar-plus me-2"></i>Booking Sekarang
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="position-relative">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                         style="width: 250px; height: 250px; opacity: 0.1;">
                        <i class="fas fa-heartbeat text-primary" style="font-size: 6rem;"></i>
                    </div>
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <i class="fas fa-stethoscope text-white" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Welcome Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h2 class="fw-bold mb-3">Selamat Datang di <span class="text-primary">MediTalk</span></h2>
            <p class="lead text-muted mb-5">
                Platform konsultasi kesehatan terpercaya yang menghubungkan Anda dengan dokter spesialis berpengalaman.
            </p>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mb-5">
        <div class="col-12 text-center mb-4">
            <h3 class="fw-bold">Mengapa Memilih MediTalk?</h3>
            <p class="text-muted">Platform konsultasi kesehatan yang aman dan terpercaya</p>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="text-center">
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                     style="width: 80px; height: 80px;">
                    <i class="fas fa-user-md text-white" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold mb-3">Dokter Spesialis</h5>
                <p class="text-muted">Tim dokter spesialis berpengalaman yang siap memberikan konsultasi kesehatan terbaik.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="text-center">
                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                     style="width: 80px; height: 80px;">
                    <i class="fas fa-clock text-white" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold mb-3">Jadwal Fleksibel</h5>
                <p class="text-muted">Pilih jadwal konsultasi yang sesuai dengan waktu luang Anda.</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="text-center">
                <div class="bg-info rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                     style="width: 80px; height: 80px;">
                    <i class="fas fa-shield-alt text-white" style="font-size: 2rem;"></i>
                </div>
                <h5 class="fw-bold mb-3">Aman & Terpercaya</h5>
                <p class="text-muted">Data kesehatan Anda aman dan terjaga kerahasiaannya.</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold mb-2">Mulai Konsultasi Sekarang</h4>
                    <p class="text-muted mb-3">Pilih dokter spesialis dan jadwal yang sesuai untuk memulai konsultasi kesehatan Anda.</p>
                    <a href="{{ route('dokter.index') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-arrow-right me-2"></i>Mulai Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hero-section {
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    pointer-events: none;
}

.card {
    border-radius: 12px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

.display-4 {
    font-size: 2.5rem;
}

@media (max-width: 768px) {
    .display-4 {
        font-size: 2rem;
    }
}
</style>
@endsection