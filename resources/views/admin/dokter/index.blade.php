@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Dokter</h3>
    <a href="{{ route('dokter.create') }}" class="btn btn-primary mb-2">Tambah Dokter</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <th>Spesialis</th>
            <th>Kontak</th>
            <th>Aksi</th>
        </tr>
        @foreach($dokter as $d)
        <tr>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->spesialis }}</td>
            <td>{{ $d->kontak }}</td>
            <td>
                <a href="{{ route('dokter.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('dokter.destroy', $d->id) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
