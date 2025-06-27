@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Kelola Booking Konsultasi</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Pasien</th>
            <th>Dokter</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Keluhan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @foreach($bookings as $b)
        <tr>
            <td>{{ $b->user->name }}</td>
            <td>{{ $b->schedule->doctor->nama }}</td>
            <td>{{ $b->schedule->hari }}</td>
            <td>{{ $b->schedule->jam_mulai }} - {{ $b->schedule->jam_selesai }}</td>
            <td>{{ $b->keluhan }}</td>
            <td>
                @if($b->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif($b->status == 'diterima')
                    <span class="badge bg-success">Diterima</span>
                @else
                    <span class="badge bg-danger">Ditolak</span>
                @endif
            </td>
            <td>
                <form action="{{ route('admin.booking.updateStatus', $b->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select form-select-sm d-inline w-auto">
                        <option {{ $b->status == 'pending' ? 'selected' : '' }}>pending</option>
                        <option {{ $b->status == 'diterima' ? 'selected' : '' }}>diterima</option>
                        <option {{ $b->status == 'ditolak' ? 'selected' : '' }}>ditolak</option>
                    </select>
                    <button class="btn btn-sm btn-primary">Update</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
