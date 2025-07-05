@extends('layouts.app')

@section('title', 'Detail Dokter - ' . $dokter->nama)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">{{ $dokter->nama }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informasi Dokter</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama:</strong></td>
                                    <td>{{ $dokter->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Spesialis:</strong></td>
                                    <td>{{ $dokter->spesialis }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kontak:</strong></td>
                                    <td>{{ $dokter->kontak }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Deskripsi</h5>
                            <p>{{ $dokter->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Jadwal Praktek</h5>
                </div>
                <div class="card-body">
                    @if($dokter->schedules && count($dokter->schedules))
                        <ul class="list-group">
                            @foreach($dokter->schedules as $jadwal)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $jadwal->hari }}</span>
                                    <span>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Belum ada jadwal tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('booking') }}" class="btn btn-primary">Booking Konsultasi</a>
        <a href="{{ route('dokter') }}" class="btn btn-secondary">Kembali ke Daftar Dokter</a>
    </div>
</div>
@endsection

@section('title', 'Detail Dokter - ' . $dokter->nama)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">{{ $dokter->nama }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informasi Dokter</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama:</strong></td>
                                    <td>{{ $dokter->nama }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Spesialis:</strong></td>
                                    <td>{{ $dokter->spesialis }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kontak:</strong></td>
                                    <td>{{ $dokter->kontak }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Deskripsi</h5>
                            <p>{{ $dokter->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Jadwal Praktek</h5>
                </div>
                <div class="card-body">
                    @if($dokter->schedules && count($dokter->schedules))
                        <ul class="list-group">
                            @foreach($dokter->schedules as $jadwal)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $jadwal->hari }}</span>
                                    <span>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Belum ada jadwal tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('booking') }}" class="btn btn-primary">Booking Konsultasi</a>
        <a href="{{ route('dokter') }}" class="btn btn-secondary">Kembali ke Daftar Dokter</a>
    </div>
</div>
@endsection