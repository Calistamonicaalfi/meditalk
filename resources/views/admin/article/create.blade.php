@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Artikel</h3>

    <form action="{{ route('article.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Dokter (opsional)</label>
            <select name="doctor_id" class="form-control">
                <option value="">- Tanpa Dokter -</option>
                @foreach($dokter as $d)
                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Isi Artikel</label>
            <textarea name="isi" rows="6" class="form-control" required></textarea>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
