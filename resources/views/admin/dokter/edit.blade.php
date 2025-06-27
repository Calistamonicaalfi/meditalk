@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Dokter</h3>
    <form action="{{ route('dokter.update', $dokter->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $dokter->nama }}" class="form-control">
        </div>
        <div class="mb-2">
            <label>Spesialis</label>
            <input type="text" name="spesialis" value="{{ $dokter->spesialis }}" class="form-control">
        </div>
        <div class="mb-2">
            <label>Kontak</label>
            <input type="text" name="kontak" value="{{ $dokter->kontak }}" class="form-control">
        </div>
        <div class="mb-2">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $dokter->deskripsi }}</textarea>
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
