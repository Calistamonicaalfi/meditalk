@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Artikel</h3>

    <form action="{{ route('article.update', $article->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" value="{{ $article->judul }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Dokter (opsional)</label>
            <select name="doctor_id" class="form-control">
                <option value="">- Tanpa Dokter -</option>
                @foreach($dokter as $d)
                    <option value="{{ $d->id }}" {{ $article->doctor_id == $d->id ? 'selected' : '' }}>
                        {{ $d->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Isi Artikel</label>
            <textarea name="isi" rows="6" class="form-control" required>{{ $article->isi }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
