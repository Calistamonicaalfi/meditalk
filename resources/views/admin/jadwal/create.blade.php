@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Jadwal Dokter</h3>
    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label>Dokter</label>
            <select name="doctor_id" class="form-control" required>
                @foreach($dokter as $d)
                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2">
            <label>Hari</label>
            <input type="text" name="hari" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" required>
        </div>
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
