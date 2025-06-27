@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Artikel Kesehatan</h3>
    <a href="{{ route('article.create') }}" class="btn btn-primary mb-3">Tambah Artikel</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Dokter</th>
                <th>Isi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $a)
            <tr>
                <td>{{ $a->judul }}</td>
                <td>{{ $a->doctor->nama ?? '-' }}</td>
                <td>{{ Str::limit($a->isi, 100) }}</td>
                <td>
                    <a href="{{ route('article.edit', $a->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('article.destroy', $a->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus artikel ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
