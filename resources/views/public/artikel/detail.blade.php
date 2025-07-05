<!-- resources/views/public/artikel/detail.blade.php -->
@extends('layouts.app')

@section('title', $artikel->judul)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title">{{ $artikel->judul }}</h2>
                    <p class="text-muted">
                        Oleh: {{ $artikel->doctor->nama ?? 'Admin' }} | 
                        {{ $artikel->created_at->format('d M Y H:i') }}
                    </p>
                    <hr>
                    <div class="article-content">
                        {!! nl2br(e($artikel->isi)) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Artikel Terkait</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('artikel') }}" class="btn btn-primary">Lihat Semua Artikel</a>
                    <hr>
                    <a href="{{ route('dokter') }}" class="btn btn-outline-secondary">Lihat Daftar Dokter</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('artikel') }}" class="btn btn-secondary">← Kembali ke Daftar Artikel</a>
        <a href="{{ route('home') }}" class="btn btn-outline-primary">← Kembali ke Beranda</a>
    </div>
</div>
@endsection