<!-- resources/views/public/dokter/index.blade.php -->
@extends('layouts.app')

@section('title', 'Daftar Dokter')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Daftar Dokter</h2>
    <div class="row">
        @forelse($dokter as $d)
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $d->nama }}</h5>
                        <p class="card-text"><strong>Spesialis:</strong> {{ $d->spesialis }}</p>
                        <p class="card-text">{{ Str::limit($d->deskripsi, 100) }}</p>
                        <a href="{{ route('dokter.detail', $d->id) }}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">Belum ada data dokter.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection