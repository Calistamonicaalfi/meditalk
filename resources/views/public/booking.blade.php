@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Form Booking Konsultasi</h2>

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_pasien" class="form-label">Nama Pasien</label>
            <input type="text" class="form-control" name="nama_pasien" required>
        </div>

        <div class="mb-3">
            <label for="dokter_id" class="form-label">Pilih Dokter</label>
            <select name="dokter_id" class="form-select" required>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->nama }} ({{ $doctor->spesialis }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jadwal_konsultasi" class="form-label">Jadwal Konsultasi</label>
            <input type="datetime-local" class="form-control" name="jadwal_konsultasi" required>
        </div>

        <button type="submit" class="btn btn-success">Kirim Booking</button>
    </form>
@endsection
