@extends('layouts.admin')

@section('title', 'Kelola Booking - Admin')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1"><i class="fas fa-calendar-check me-2 text-primary"></i>Kelola Booking Konsultasi</h2>
                    <p class="text-muted mb-0">Kelola semua booking konsultasi dari pasien</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" onclick="exportData()">
                        <i class="fas fa-download me-1"></i>Export
                    </button>
                    <button class="btn btn-primary" onclick="refreshData()">
                        <i class="fas fa-sync-alt me-1"></i>Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>

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
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-calendar-check text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-1">{{ $bookings->count() }}</h4>
                            <p class="text-muted mb-0 small">Total Booking</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-hourglass-half text-warning" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-1">{{ $pendingBookings->count() }}</h4>
                            <p class="text-muted mb-0 small">Menunggu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-check-circle text-success" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-1">{{ $diterimaBookings->count() }}</h4>
                            <p class="text-muted mb-0 small">Diterima</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-times-circle text-danger" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-1">{{ $ditolakBookings->count() }}</h4>
                            <p class="text-muted mb-0 small">Ditolak</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Search -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h6 class="mb-2"><i class="fas fa-filter me-1"></i>Filter Status:</h6>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.booking.index') }}" class="btn btn-outline-primary {{ !isset($status) ? 'active' : '' }}">
                            Semua <span class="badge bg-primary ms-1">{{ $bookings->count() }}</span>
                        </a>
                        <a href="{{ route('admin.booking.filter', 'pending') }}" class="btn btn-outline-warning {{ (isset($status) && $status=='pending') ? 'active' : '' }}">
                            Menunggu <span class="badge bg-warning text-dark ms-1">{{ $pendingBookings->count() }}</span>
                        </a>
                        <a href="{{ route('admin.booking.filter', 'diterima') }}" class="btn btn-outline-success {{ (isset($status) && $status=='diterima') ? 'active' : '' }}">
                            Diterima <span class="badge bg-success ms-1">{{ $diterimaBookings->count() }}</span>
                        </a>
                        <a href="{{ route('admin.booking.filter', 'ditolak') }}" class="btn btn-outline-danger {{ (isset($status) && $status=='ditolak') ? 'active' : '' }}">
                            Ditolak <span class="badge bg-danger ms-1">{{ $ditolakBookings->count() }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Cari nama pasien, dokter, atau keluhan...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="bookingTable">
                    <thead class="table-light">
                        <tr>
                            <th class="px-3 py-3">No</th>
                            <th class="px-3 py-3">Pasien</th>
                            <th class="px-3 py-3">Dokter</th>
                            <th class="px-3 py-3">Jadwal</th>
                            <th class="px-3 py-3">Keluhan</th>
                            <th class="px-3 py-3">Status</th>
                            <th class="px-3 py-3">Tanggal</th>
                            <th class="px-3 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $index => $booking)
                            <tr>
                                <td class="px-3 py-3">{{ $index + 1 }}</td>
                                <td class="px-3 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            @if($booking->user && $booking->user->profile_photo_path)
                                                <img src="{{ asset('storage/' . $booking->user->profile_photo_path) }}" 
                                                     alt="Foto" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                                                     style="width: 32px; height: 32px;">
                                                    <i class="fas fa-user text-white" style="font-size: 0.8rem;"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <div class="fw-semibold">{{ $booking->nama_pasien }}</div>
                                            <small class="text-muted">
                                                @if($booking->isPublic())
                                                    <i class="fas fa-globe me-1"></i>Publik
                                                @else
                                                    <i class="fas fa-user me-1"></i>{{ $booking->user->email ?? 'N/A' }}
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-3">
                                    @if($booking->schedule && $booking->schedule->doctor)
                                        <div>
                                            <div class="fw-semibold">{{ $booking->schedule->doctor->nama }}</div>
                                            <small class="text-muted">{{ $booking->schedule->doctor->spesialis }}</small>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td class="px-3 py-3">
                                    @if($booking->schedule)
                                        <div>
                                            <div class="fw-semibold">{{ $booking->schedule->hari }}</div>
                                            <small class="text-muted">{{ $booking->schedule->jam_mulai }} - {{ $booking->schedule->jam_selesai }}</small>
                                        </div>
                                    @else
                                        <span class="text-muted">Jadwal tidak tersedia</span>
                                    @endif
                                </td>
                                <td class="px-3 py-3">
                                    <div class="text-truncate" style="max-width: 200px;" title="{{ $booking->keluhan }}">
                                        {{ Str::limit($booking->keluhan, 50) }}
                                    </div>
                                </td>
                                <td class="px-3 py-3">
                                    @if($booking->status === 'pending')
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i>Menunggu
                                        </span>
                                    @elseif($booking->status === 'diterima')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Diterima
                                        </span>
                                    @elseif($booking->status === 'ditolak')
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times me-1"></i>Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 py-3">
                                    <div>
                                        <div class="fw-semibold">{{ $booking->created_at->format('d/m/Y') }}</div>
                                        <small class="text-muted">{{ $booking->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <!-- View Button -->
                                        <button class="btn btn-sm btn-outline-info" onclick="viewBooking({{ $booking->id }})" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        <!-- Edit Button -->
                                        <button class="btn btn-sm btn-outline-primary" onclick="editBooking({{ $booking->id }})" title="Edit Booking">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        
                                        <!-- Status Actions -->
                                        @if($booking->status === 'pending')
                                            <button class="btn btn-sm btn-success" onclick="updateStatus({{ $booking->id }}, 'diterima')" title="Terima Booking">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="updateStatus({{ $booking->id }}, 'ditolak')" title="Tolak Booking">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                        
                                        <!-- Status Dropdown -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" title="Ubah Status">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $booking->id }}, 'pending')">
                                                    <i class="fas fa-clock me-2"></i>Set Menunggu
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $booking->id }}, 'diterima')">
                                                    <i class="fas fa-check me-2"></i>Set Diterima
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $booking->id }}, 'ditolak')">
                                                    <i class="fas fa-times me-2"></i>Set Ditolak
                                                </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-calendar-times mb-3" style="font-size: 3rem;"></i>
                                        <h5 class="mt-3">Tidak ada data booking</h5>
                                        <p>Belum ada booking konsultasi yang tersedia.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal View Booking -->
<div class="modal fade" id="viewBookingModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-eye me-2"></i>Detail Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewBookingContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Booking -->
<div class="modal fade" id="editBookingModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="editBookingContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Form untuk update status -->
<form id="updateStatusForm" method="POST" style="display: none;">
    @csrf
    @method('PATCH')
    <input type="hidden" name="status" id="statusInput">
</form>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const table = document.getElementById('bookingTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let row of rows) {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    }
});

// View booking details
function viewBooking(bookingId) {
    // Load booking details via AJAX
    fetch(`/admin/booking/${bookingId}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('viewBookingContent').innerHTML = html;
            new bootstrap.Modal(document.getElementById('viewBookingModal')).show();
        });
}

// Edit booking
function editBooking(bookingId) {
    // Load edit form via AJAX
    fetch(`/admin/booking/${bookingId}/edit`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('editBookingContent').innerHTML = html;
            new bootstrap.Modal(document.getElementById('editBookingModal')).show();
        });
}

// Update booking status
function updateStatus(bookingId, status) {
    const statusText = {
        'pending': 'Menunggu',
        'diterima': 'Diterima',
        'ditolak': 'Ditolak'
    };
    
    if (confirm(`Apakah Anda yakin ingin mengubah status booking menjadi "${statusText[status]}"?`)) {
        document.getElementById('statusInput').value = status;
        document.getElementById('updateStatusForm').action = `/admin/booking/${bookingId}/status`;
        document.getElementById('updateStatusForm').submit();
    }
}

// Export data
function exportData() {
    // Implementation for export functionality
    alert('Fitur export akan segera tersedia!');
}

// Refresh data
function refreshData() {
    location.reload();
}
</script>

<style>
.card {
    border-radius: 12px;
}

.btn {
    border-radius: 8px;
}

.badge {
    border-radius: 20px;
    padding: 0.5rem 1rem;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
}

.table td {
    vertical-align: middle;
}

.btn-group .btn {
    border-radius: 8px;
}

.dropdown-menu {
    border-radius: 8px;
    border: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.dropdown-item {
    border-radius: 4px;
    margin: 2px 8px;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}
</style>
@endsection







