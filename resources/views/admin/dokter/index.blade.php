@extends('layouts.admin')

@section('title', 'Manajemen Dokter')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1" style="color: #1e293b; font-weight: 600;">
                        <i class="fas fa-user-md me-2 text-purple"></i>Manajemen Dokter
                    </h2>
                    <p class="mb-0" style="color: #64748b;">Kelola data dokter dan informasi spesialisasi</p>
                </div>
                <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Dokter
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="stats-grid mb-4">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="stat-number">{{ $dokter->count() }}</div>
                    <div class="stat-label">Total Dokter</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-user-md"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="stat-number">{{ $dokter->filter(function($d) { return $d->schedules && count($d->schedules) > 0; })->count() }}</div>
                    <div class="stat-label">Dengan Jadwal</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="stat-number">{{ $dokter->pluck('spesialis')->unique()->count() }}</div>
                    <div class="stat-label">Spesialisasi</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="stat-number">{{ $dokter->filter(function($d) { return !$d->schedules || count($d->schedules) == 0; })->count() }}</div>
                    <div class="stat-label">Perlu Jadwal</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Doctors List -->
    <div class="card">
        <div class="card-header bg-transparent border-0">
            <h5 class="mb-0" style="color: #1e293b; font-weight: 600;">
                <i class="fas fa-list me-2 text-purple"></i>Daftar Dokter
            </h5>
        </div>
        <div class="card-body">
            @if(count($dokter) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="color: #374151; font-weight: 600;">Nama Dokter</th>
                                <th style="color: #374151; font-weight: 600;">Spesialisasi</th>
                                <th style="color: #374151; font-weight: 600;">Kontak</th>
                                <th style="color: #374151; font-weight: 600;">Jadwal</th>
                                <th style="color: #374151; font-weight: 600;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokter as $d)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" 
                                                 style="width: 45px; height: 45px;">
                                                <i class="fas fa-user-md text-white" style="font-size: 0.875rem;"></i>
                                            </div>
                                            <div>
                                                <div style="font-weight: 600; color: #1e293b; font-size: 0.875rem;">{{ $d->nama }}</div>
                                                @if($d->deskripsi)
                                                    <small style="color: #64748b; font-size: 0.75rem;">{{ Str::limit($d->deskripsi, 50) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-purple">{{ $d->spesialis }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-phone text-purple me-2" style="font-size: 0.75rem;"></i>
                                            <span style="font-size: 0.875rem;">{{ $d->kontak }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($d->schedules && count($d->schedules) > 0)
                                            <span class="badge badge-approved">
                                                {{ count($d->schedules) }} Jadwal
                                            </span>
                                        @else
                                            <span class="badge badge-pending">
                                                Belum Ada Jadwal
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.dokter.edit', $d->id) }}" 
                                               class="btn btn-sm btn-outline-warning" 
                                               title="Edit Dokter"
                                               style="border-radius: 4px 0 0 4px;">
                                                <i class="fas fa-edit" style="font-size: 0.75rem;"></i>
                                            </a>
                                            <a href="{{ route('admin.dokter.show', $d->id) }}" 
                                               class="btn btn-sm btn-outline-info" 
                                               title="Lihat Detail"
                                               style="border-radius: 0;">
                                                <i class="fas fa-eye" style="font-size: 0.75rem;"></i>
                                            </a>
                                            <form action="{{ route('admin.dokter.destroy', $d->id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokter ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        title="Hapus Dokter"
                                                        style="border-radius: 0 4px 4px 0;">
                                                    <i class="fas fa-trash" style="font-size: 0.75rem;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-user-md" style="font-size: 3rem; color: #d1d5db;"></i>
                    </div>
                    <h4 style="color: #6b7280; font-weight: 500;">Belum ada data dokter</h4>
                    <p style="color: #9ca3af; margin-bottom: 1.5rem;">Mulai dengan menambahkan dokter pertama</p>
                    <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Dokter Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
