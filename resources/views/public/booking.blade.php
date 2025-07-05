@extends('layouts.app')

@section('title', 'Booking Konsultasi')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Booking Konsultasi Dokter</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('booking.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Pilih Jadwal Dokter</label>
                            <select name="schedule_id" class="form-select @error('schedule_id') is-invalid @enderror" required>
                                <option value="">Pilih jadwal...</option>
                                @foreach($jadwal as $j)
                                    <option value="{{ $j->id }}">
                                        {{ $j->doctor->nama }} - {{ $j->hari }} ({{ $j->jam_mulai }} - {{ $j->jam_selesai }})
                                    </option>
                                @endforeach
                            </select>
                            @error('schedule_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Keluhan</label>
                            <textarea name="keluhan" class="form-control @error('keluhan') is-invalid @enderror" rows="4" required placeholder="Jelaskan keluhan Anda..."></textarea>
                            @error('keluhan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Kirim Booking</button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection