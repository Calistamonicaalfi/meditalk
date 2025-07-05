@extends('layouts.admin')

@section('title', 'Kelola Booking')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Kelola Booking Konsultasi</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Dokter</th>
                            <th>Jadwal</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                            <th>Tanggal Booking</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $index => $booking)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                <td>{{ $booking->schedule->doctor->nama ?? 'N/A' }}</td>
                                <td>
                                    @if($booking->schedule)
                                        {{ $booking->schedule->hari }}, {{ $booking->schedule->jam_mulai }} - {{ $booking->schedule->jam_selesai }}
                                    @else
                                        Jadwal tidak tersedia
                                    @endif
                                </td>
                                <td>{{ Str::limit($booking->keluhan, 50) }}</td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <span class="badge bg-warning">Menunggu</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="badge bg-success">Dikonfirmasi</span>
                                    @elseif($booking->status == 'cancelled')
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @elseif($booking->status == 'completed')
                                        <span class="badge bg-info">Selesai</span>
                                    @endif
                                </td>
                                <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-info" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#detailModal{{ $booking->id }}">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                        
                                        @if($booking->status == 'pending')
                                            <form action="{{ route('admin.booking.confirm', $booking->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" 
                                                        onclick="return confirm('Konfirmasi booking ini?')">
                                                    <i class="fas fa-check"></i> Konfirmasi
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('admin.booking.cancel', $booking->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Batalkan booking ini?')">
                                                    <i class="fas fa-times"></i> Batalkan
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Detail -->
                            <div class="modal fade" id="detailModal{{ $booking->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Booking</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Informasi Pasien</h6>
                                                    <p><strong>Nama:</strong> {{ $booking->user->name ?? 'N/A' }}</p>
                                                    <p><strong>Email:</strong> {{ $booking->user->email ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Informasi Dokter</h6>
                                                    <p><strong>Nama:</strong> {{ $booking->schedule->doctor->nama ?? 'N/A' }}</p>
                                                    <p><strong>Spesialis:</strong> {{ $booking->schedule->doctor->spesialis ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <h6>Jadwal Konsultasi</h6>
                                                    @if($booking->schedule)
                                                        <p><strong>Hari:</strong> {{ $booking->schedule->hari }}</p>
                                                        <p><strong>Waktu:</strong> {{ $booking->schedule->jam_mulai }} - {{ $booking->schedule->jam_selesai }}</p>
                                                    @else
                                                        <p>Jadwal tidak tersedia</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Status</h6>
                                                    <p><strong>Status:</strong> 
                                                        @if($booking->status == 'pending')
                                                            <span class="badge bg-warning">Menunggu</span>
                                                        @elseif($booking->status == 'confirmed')
                                                            <span class="badge bg-success">Dikonfirmasi</span>
                                                        @elseif($booking->status == 'cancelled')
                                                            <span class="badge bg-danger">Dibatalkan</span>
                                                        @elseif($booking->status == 'completed')
                                                            <span class="badge bg-info">Selesai</span>
                                                        @endif
                                                    </p>
                                                    <p><strong>Tanggal Booking:</strong> {{ $booking->created_at->format('d/m/Y H:i') }}</p>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <h6>Keluhan</h6>
                                                    <p>{{ $booking->keluhan }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data booking</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush
