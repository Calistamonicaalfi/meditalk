@extends('layouts.app')

@section('title', 'Artikel Kesehatan - MediTalk')

@section('content')
<!-- Compact Header -->
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin-top: -30px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="text-white mb-2"><i class="fas fa-newspaper me-2"></i>Artikel Kesehatan</h2>
                <p class="text-white-50 mb-0">Informasi kesehatan terpercaya dari dokter spesialis</p>
            </div>
            <div class="col-md-4 text-end">
                <div class="d-flex justify-content-end gap-2">
                    <span class="badge bg-white text-primary px-3 py-2">
                        <i class="fas fa-newspaper me-1"></i>{{ $articles->total() }} Artikel
                    </span>
                    <span class="badge bg-white text-success px-3 py-2">
                        <i class="fas fa-user-md me-1"></i>{{ $articles->pluck('doctor_id')->unique()->count() }} Dokter
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- Articles Grid -->
    <div class="row">
        @forelse($articles as $a)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 article-card-hover">
                    <div class="card-body p-0">
                        <!-- Article Image Header -->
                        <div class="position-relative">
                            <div class="w-100 d-flex align-items-center justify-content-center" 
                                 style="height: 180px; background: linear-gradient(135deg, #667eea, #764ba2);">
                                <i class="fas fa-newspaper text-white" style="font-size: 3rem;"></i>
                            </div>
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-white text-primary">
                                    <i class="fas fa-calendar me-1"></i>{{ $a->created_at ? $a->created_at->format('d M Y') : '' }}
                                </span>
                            </div>
                        </div>

                        <!-- Article Content -->
                        <div class="p-3">
                            <h5 class="card-title mb-2">{{ $a->judul }}</h5>
                            
                            <p class="card-text text-muted small mb-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($a->isi), 100) }}
                            </p>

                            <!-- Author Info -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" 
                                     style="width: 30px; height: 30px;">
                                    <i class="fas fa-user-md text-white" style="font-size: 0.8rem;"></i>
                                </div>
                                <div>
                                    <small class="text-muted">Oleh: {{ $a->doctor->nama ?? 'Admin' }}</small>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="d-grid">
                                <a href="{{ route('artikel.detail', $a->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-book-open me-1"></i>Baca Artikel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="text-muted mb-3">
                        <i class="fas fa-newspaper" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-muted">Belum ada artikel kesehatan</h5>
                    <p class="text-muted">Artikel akan segera ditambahkan oleh dokter spesialis.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
        <div class="row">
            <div class="col-12">
                <nav aria-label="Article pagination" class="d-flex justify-content-center">
                    {{ $articles->links() }}
                </nav>
            </div>
        </div>
    @endif
</div>

<style>
.article-card-hover {
    transition: all 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
}

.article-card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

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
</style>
@endsection