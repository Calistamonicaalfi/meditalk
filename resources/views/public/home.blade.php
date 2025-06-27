@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Daftar Dokter</h2>
    <div class="row">
@forelse($dokter as $d)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $d->nama }}</h5>
                        <p class="card-text">{{ $d->spesialis }}</p>
                        <a href="{{ route('dokter.detail', $d->id) }}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada data dokter.</p>
        @endforelse
    </div>

    <hr class="my-5">

    <h2 class="mb-4">Artikel Kesehatan</h2>
    <div class="row">
        @forelse ($articles as $a)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $a->judul }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($a->isi, 100) }}</p>
                        <a href="{{ route('artikel.detail', $a->id) }}" class="btn btn-outline-success btn-sm">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada artikel.</p>
        @endforelse
    </div>
</div>
@endsection
