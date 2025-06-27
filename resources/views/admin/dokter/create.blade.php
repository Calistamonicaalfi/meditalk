@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Dokter</h3>
    <form action="{{ route('dokter.store') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control">
        </div>
        <div class="mb-2">
            <label>Spesialis</label>
            <input type="text" name="spesialis" class="form-control">
        </div>
        <div class="mb-2">
            <label>Kontak</label>
            <input type="text" name="kontak" class="form-control">
        </div>
        <div class="mb-2">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
