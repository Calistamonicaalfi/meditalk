@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Form Booking Konsultasi</h3>

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Jadwal Konsultasi</label>
            <select name="schedule_id" class="form-control" required>
                <option disabled selected>Pilih Jadwal</option>
                @foreach($jadwal as $j)
                    <option value="{{ $j->id }}">
                        {{ $j->doctor->nama }} - {{ $j->hari }}, {{ $j->jam_mulai }}-{{ $j->jam_selesai }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Keluhan</label>
            <textarea name="keluhan" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Booking</button>
    </form>
</div>
@endsection
