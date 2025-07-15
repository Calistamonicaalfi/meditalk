@if($bookings->count() > 0)
    <div class="row">
        @foreach($bookings as $booking)
            <div class="col-lg-6 col-xl-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-transparent border-bottom-0">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-user-md text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">{{ $booking->schedule->doctor->nama ?? '-' }}</h6>
                                    <small class="text-muted">{{ $booking->schedule->doctor->spesialisasi ?? '-' }}</small>
                                </div>
                            </div>
                            <span class="badge
                                @if($booking->status == 'pending') bg-warning text-dark
                                @elseif($booking->status == 'diterima') bg-success
                                @elseif($booking->status == 'ditolak') bg-danger
                                @endif
                                px-3 py-2">
                                @if($booking->status == 'pending')
                                    <i class="fas fa-clock me-1"></i>
                                @elseif($booking->status == 'diterima')
                                    <i class="fas fa-check me-1"></i>
                                @elseif($booking->status == 'ditolak')
                                    <i class="fas fa-times me-1"></i>
                                @endif
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar text-primary me-2" style="width: 16px;"></i>
                                    <small class="fw-semibold">{{ $booking->schedule->hari ?? '-' }}</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock text-primary me-2" style="width: 16px;"></i>
                                    <small class="fw-semibold">{{ $booking->schedule->jam_mulai ?? '-' }} - {{ $booking->schedule->jam_selesai ?? '-' }}</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar-plus text-primary me-2" style="width: 16px;"></i>
                                    <small class="text-muted">{{ $booking->created_at->format('d M Y') }}</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock text-primary me-2" style="width: 16px;"></i>
                                    <small class="text-muted">{{ $booking->created_at->format('H:i') }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted mb-2">
                                <i class="fas fa-comment-medical me-1"></i>Keluhan:
                            </label>
                            <div class="alert alert-light border py-2 mb-0">
                                <p class="mb-0 small">{{ Str::limit($booking->keluhan, 120) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-transparent border-top">
                        <div class="d-flex gap-2">
                            <a href="{{ route('pasien.booking.show', $booking->id) }}" 
                               class="btn btn-outline-primary btn-sm flex-fill">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>
                            @if($booking->status === 'pending')
                                <form action="{{ route('pasien.booking.destroy', $booking->id) }}" 
                                      method="POST" 
                                      class="flex-fill"
                                      onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                        <i class="fas fa-times me-1"></i>Batalkan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="fas fa-calendar-times" style="font-size: 4rem; color: #dee2e6;"></i>
        </div>
        <h4 class="text-muted mb-3">Belum ada booking konsultasi</h4>
        <p class="text-muted mb-4">Mulai dengan membuat booking konsultasi pertama Anda</p>
        <a href="{{ route('pasien.booking.create') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus me-2"></i>Buat Booking Pertama
        </a>
    </div>
@endif
