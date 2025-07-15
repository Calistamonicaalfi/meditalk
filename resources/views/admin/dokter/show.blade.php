@extends('layouts.admin')

@section('title', 'Detail Dokter')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1"><i class="fas fa-user-md me-2"></i>Detail Dokter</h2>
                    <p class="text-muted mb-0">Informasi lengkap dokter {{ $dokter->nama }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus dokter ini?')">
                            <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                    </form>
                </div>
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

    <!-- Doctor Information -->
    <div class="row">
        <!-- Doctor Profile Card -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-3" 
                         style="width: 150px; height: 150px;">
                        <i class="fas fa-user-md text-white" style="font-size: 3rem;"></i>
                    </div>
                    
                    <h4 class="card-title mb-2">{{ $dokter->nama }}</h4>
                    <span class="badge bg-primary fs-6 mb-3">{{ $dokter->spesialis }}</span>
                    
                    <div class="d-grid gap-2">
                        <a href="tel:{{ $dokter->kontak }}" class="btn btn-outline-primary">
                            <i class="fas fa-phone me-2"></i>{{ $dokter->kontak }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctor Details -->
        <div class="col-md-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Dokter</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted">Nama Lengkap</label>
                            <p class="form-control-plaintext">{{ $dokter->nama }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted">Spesialisasi</label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-primary">{{ $dokter->spesialis }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted">Nomor Kontak</label>
                            <p class="form-control-plaintext">
                                <i class="fas fa-phone text-primary me-2"></i>{{ $dokter->kontak }}
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold text-muted">Status Jadwal</label>
                            <p class="form-control-plaintext">
                                @if($dokter->schedules && count($dokter->schedules) > 0)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i>{{ count($dokter->schedules) }} Jadwal Tersedia
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Belum Ada Jadwal
                                    </span>
                                @endif
                            </p>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold text-muted">Deskripsi</label>
                            <p class="form-control-plaintext">
                                @if($dokter->deskripsi)
                                    {{ $dokter->deskripsi }}
                                @else
                                    <em class="text-muted">Tidak ada deskripsi</em>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedules Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Jadwal Praktik</h5>
                    <a href="{{ route('jadwal.create', ['doctor_id' => $dokter->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-2"></i>Tambah Jadwal
                    </a>
                </div>
                <div class="card-body">
                    @if($dokter->schedules && count($dokter->schedules) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-calendar me-1"></i>Hari</th>
                                        <th><i class="fas fa-clock me-1"></i>Jam Mulai</th>
                                        <th><i class="fas fa-clock me-1"></i>Jam Selesai</th>
                                        <th><i class="fas fa-users me-1"></i>Kapasitas</th>
                                        <th><i class="fas fa-cogs me-1"></i>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dokter->schedules as $schedule)
                                        <tr>
                                            <td>
                                                <span class="badge bg-info">{{ $schedule->hari }}</span>
                                            </td>
                                            <td>{{ $schedule->jam_mulai }}</td>
                                            <td>{{ $schedule->jam_selesai }}</td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $schedule->kapasitas }} Pasien</span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('jadwal.edit', $schedule->id) }}" 
                                                       class="btn btn-sm btn-outline-warning" 
                                                       title="Edit Jadwal">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('jadwal.destroy', $schedule->id) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-outline-danger" 
                                                                title="Hapus Jadwal">
                                                            <i class="fas fa-trash"></i>
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
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times" style="font-size: 3rem; color: #dee2e6;"></i>
                            <h5 class="mt-3 text-muted">Belum ada jadwal praktik</h5>
                            <p class="text-muted mb-3">Dokter ini belum memiliki jadwal praktik yang diatur</p>
                            <a href="{{ route('jadwal.create', ['doctor_id' => $dokter->id]) }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Tambah Jadwal Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 