<form id="editBookingForm" method="POST" action="{{ route('admin.booking.update', $booking->id) }}">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-md-6">
            <h6 class="text-primary mb-3"><i class="fas fa-user me-2"></i>Informasi Pasien</h6>
            <div class="card border-0 bg-light mb-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Pasien</label>
                        <input type="text" class="form-control" value="{{ $booking->nama_pasien }}" readonly>
                        <small class="text-muted">
                            @if($booking->isPublic())
                                <i class="fas fa-globe me-1"></i>Pasien Publik
                            @else
                                <i class="fas fa-user me-1"></i>User Terdaftar
                            @endif
                        </small>
                    </div>
                    
                    @if(!$booking->isPublic() && $booking->user)
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" value="{{ $booking->user->email }}" readonly>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <h6 class="text-primary mb-3"><i class="fas fa-user-md me-2"></i>Informasi Dokter</h6>
            <div class="card border-0 bg-light mb-3">
                <div class="card-body">
                    @if($booking->schedule && $booking->schedule->doctor)
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Dokter</label>
                            <input type="text" class="form-control" value="{{ $booking->schedule->doctor->nama }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Spesialisasi</label>
                            <input type="text" class="form-control" value="{{ $booking->schedule->doctor->spesialis }}" readonly>
                        </div>
                    @else
                        <div class="alert alert-warning small">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Informasi dokter tidak tersedia
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <h6 class="text-primary mb-3"><i class="fas fa-calendar me-2"></i>Jadwal Konsultasi</h6>
            <div class="card border-0 bg-light mb-3">
                <div class="card-body">
                    @if($booking->schedule)
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jadwal</label>
                            <select name="schedule_id" class="form-select" required>
                                <option value="">Pilih jadwal baru...</option>
                                @foreach($availableSchedules ?? [] as $schedule)
                                    <option value="{{ $schedule->id }}" 
                                            {{ $booking->schedule_id == $schedule->id ? 'selected' : '' }}>
                                        {{ $schedule->doctor->nama }} - {{ $schedule->hari }} ({{ $schedule->jam_mulai }} - {{ $schedule->jam_selesai }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Jadwal saat ini: {{ $booking->schedule->hari }}, {{ $booking->schedule->jam_mulai }} - {{ $booking->schedule->jam_selesai }}</small>
                        </div>
                    @else
                        <div class="alert alert-warning small">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Jadwal tidak tersedia
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <h6 class="text-primary mb-3"><i class="fas fa-cog me-2"></i>Status Booking</h6>
            <div class="card border-0 bg-light mb-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>
                                Menunggu
                            </option>
                            <option value="diterima" {{ $booking->status === 'diterima' ? 'selected' : '' }}>
                                Diterima
                            </option>
                            <option value="ditolak" {{ $booking->status === 'ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>
                        </select>
                    </div>
                    
                    <div class="alert alert-info small">
                        <i class="fas fa-info-circle me-1"></i>
                        Status saat ini: 
                        @if($booking->status === 'pending')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @elseif($booking->status === 'diterima')
                            <span class="badge bg-success">Diterima</span>
                        @elseif($booking->status === 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <h6 class="text-primary mb-3"><i class="fas fa-notes-medical me-2"></i>Keluhan Pasien</h6>
            <div class="card border-0 bg-light mb-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keluhan</label>
                        <textarea name="keluhan" class="form-control" rows="4" required 
                                  placeholder="Masukkan keluhan pasien...">{{ $booking->keluhan }}</textarea>
                        <small class="text-muted">Minimal 10 karakter, maksimal 500 karakter</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <h6 class="text-primary mb-3"><i class="fas fa-comment me-2"></i>Catatan Admin</h6>
            <div class="card border-0 bg-light mb-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan (Opsional)</label>
                        <textarea name="admin_notes" class="form-control" rows="3" 
                                  placeholder="Tambahkan catatan untuk booking ini...">{{ $booking->admin_notes ?? '' }}</textarea>
                        <small class="text-muted">Catatan internal untuk admin</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i>Batal
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i>Simpan Perubahan
        </button>
    </div>
</form>

<style>
.card {
    border-radius: 12px;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.badge {
    border-radius: 20px;
    padding: 0.5rem 1rem;
}

.alert {
    border-radius: 8px;
    border: none;
}
</style>

<script>
// Form validation
document.getElementById('editBookingForm').addEventListener('submit', function(e) {
    const keluhan = document.querySelector('textarea[name="keluhan"]').value;
    
    if (keluhan.length < 10) {
        e.preventDefault();
        alert('Keluhan minimal 10 karakter!');
        return false;
    }
    
    if (keluhan.length > 500) {
        e.preventDefault();
        alert('Keluhan maksimal 500 karakter!');
        return false;
    }
    
    if (!confirm('Apakah Anda yakin ingin menyimpan perubahan?')) {
        e.preventDefault();
        return false;
    }
});
</script> 