@extends('layouts.app')

@section('title', 'Artikel Kesehatan')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Artikel Kesehatan</h2>
    <div class="row">
        @forelse($artikel as $a)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $a->judul }}</h5>
                        <p class="card-text">
                            {{ \Illuminate\Support\Str::limit(strip_tags($a->isi), 120) }}
                        </p>
                        <p class="text-muted small mb-2">
                            Oleh: {{ $a->doctor->nama ?? 'Admin' }}<br>
                            <span class="text-secondary">{{ $a->created_at ? $a->created_at->format('d M Y') : '' }}</span>
                        </p>
                        <a href="{{ route('artikel.show', $a->id) }}" class="btn btn-outline-primary mt-auto">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada artikel kesehatan.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection