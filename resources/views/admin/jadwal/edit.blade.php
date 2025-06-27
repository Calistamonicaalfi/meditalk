@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Jadwal Dokter</h3>
    <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-2">
            <label>Dokter</label>
            <select name="doctor_id" class="form-control">
                @foreach($dokter as $d)
                    <option value="{{ $d->id }}" {{ $jadwal->doctor_id == $d->id ? 'selected' : '' }}>
                        {{ $d->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label>Hari</label>
            <input type="text" name="hari" value="{{ $jadwal->hari }}" class="form-control">
        </div>
        <div class="mb-2">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" value="{{ $jadwal->jam_mulai }}" class="form-control">
        </div>
        <div class="mb-2">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" value="{{ $jadwal->jam_selesai }}" class="form-control">
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
