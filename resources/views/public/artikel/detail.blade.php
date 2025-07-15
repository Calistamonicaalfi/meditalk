<!-- resources/views/public/artikel/detail.blade.php -->
@extends('layouts.app')

@section('title', $article->judul . ' - MediTalk')

@section('content')
<!-- Compact Header -->
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin-top: -30px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}" class="text-white-50">Artikel</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit($article->judul, 30) }}</li>
                    </ol>
                </nav>
                <h2 class="text-white mb-2 mt-2">{{ $article->judul }}</h2>
                <p class="text-white-50 mb-0">
                    <i class="fas fa-user-md me-1"></i>{{ $article->doctor->nama ?? 'Admin' }} • 
                    <i class="fas fa-calendar me-1"></i>{{ $article->created_at ? $article->created_at->format('d M Y') : '' }}
                </p>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-flex justify-content-end gap-2">
                    <span class="badge bg-white text-primary px-3 py-2">
                        <i class="fas fa-newspaper me-1"></i>Artikel Kesehatan
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <!-- Article Content -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- Article Header -->
                    <div class="text-center mb-4">
                        <div class="w-100 d-flex align-items-center justify-content-center mb-3" 
                             style="height: 200px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 12px;">
                            <i class="fas fa-newspaper text-white" style="font-size: 4rem;"></i>
                        </div>
                        <h1 class="h3 mb-2">{{ $article->judul }}</h1>
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" 
                                 style="width: 35px; height: 35px;">
                                <i class="fas fa-user-md text-white" style="font-size: 0.9rem;"></i>
                            </div>
                            <div class="text-muted">
                                <small>Oleh: {{ $article->doctor->nama ?? 'Admin' }}</small>
                                <br><small>{{ $article->created_at ? $article->created_at->format('d M Y H:i') : '' }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="article-content">
                        {!! $article->isi !!}
                    </div>

                    <!-- Article Footer -->
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            <i class="fas fa-tag me-1"></i>Artikel Kesehatan
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('artikel.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                            <button class="btn btn-outline-primary btn-sm" onclick="window.print()">
                                <i class="fas fa-print me-1"></i>Cetak
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Author Information -->
            @if($article->doctor)
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <h6 class="mb-0"><i class="fas fa-user-md me-2 text-primary"></i>Tentang Penulis</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-2" 
                                 style="width: 80px; height: 80px;">
                                <i class="fas fa-user-md text-white" style="font-size: 2rem;"></i>
                            </div>
                            <h6 class="mb-1">{{ $article->doctor->nama }}</h6>
                            <span class="badge bg-primary">{{ $article->doctor->spesialis }}</span>
                        </div>
                        
                        @if($article->doctor->deskripsi)
                            <p class="small text-muted mb-3">{{ Str::limit($article->doctor->deskripsi, 120) }}</p>
                        @endif

                        <div class="d-grid gap-2">
                            <a href="{{ route('dokter.detail', $article->doctor->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Lihat Profil
                            </a>
                            @if($article->doctor->schedules && count($article->doctor->schedules) > 0)
                                <a href="{{ route('booking') }}?doctor_id={{ $article->doctor->id }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-calendar-plus me-1"></i>Booking Konsultasi
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Related Articles -->
            @if(isset($relatedArticles) && $relatedArticles && count($relatedArticles) > 0)
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-transparent border-0 pb-0">
                        <h6 class="mb-0"><i class="fas fa-newspaper me-2 text-secondary"></i>Artikel Terkait</h6>
                    </div>
                    <div class="card-body">
                        @foreach($relatedArticles->take(3) as $related)
                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0 me-2">
                                    <div class="rounded" 
                                         style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea, #764ba2);">
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <i class="fas fa-newspaper text-white" style="font-size: 1rem;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 small">
                                        <a href="{{ route('artikel.detail', $related->id) }}" class="text-decoration-none">
                                            {{ Str::limit($related->judul, 50) }}
                                        </a>
                                    </h6>
                                    <small class="text-muted">
                                        {{ $related->created_at ? $related->created_at->format('d M Y') : '' }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quick Links -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h6 class="mb-0"><i class="fas fa-link me-2 text-info"></i>Menu Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('dokter.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-user-md me-2"></i>Daftar Dokter
                        </a>
                        <a href="{{ route('booking') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-calendar-plus me-2"></i>Booking Konsultasi
                        </a>
                        <a href="{{ route('artikel.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-newspaper me-2"></i>Artikel Lainnya
                        </a>
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

.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.5);
}

.breadcrumb-item a {
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

.article-content {
    line-height: 1.8;
    font-size: 1rem;
}

.article-content h1, .article-content h2, .article-content h3 {
    color: #333;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
}

.article-content p {
    margin-bottom: 1rem;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1rem 0;
}

@media print {
    .breadcrumb, .btn, .card-header, .col-lg-4 {
        display: none !important;
    }
    
    .col-lg-8 {
        width: 100% !important;
    }
}
</style>
@endsection