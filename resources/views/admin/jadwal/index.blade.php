@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Jadwal Konsultasi Dokter</h3>
    <a href="{{ route('jadwal.create') }}" class="btn btn-primary mb-3">Tambah Jadwal</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Dokter</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Aksi</th>
        </tr>
        @foreach($jadwal as $j)
        <tr>
            <td>{{ $j->doctor->nama }}</td>
            <td>{{ $j->hari }}</td>
            <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
            <td>
                <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
