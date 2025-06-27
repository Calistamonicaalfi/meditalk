@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Riwayat Booking Konsultasi</h3>
    <a href="{{ route('booking.create') }}" class="btn btn-primary mb-3">Booking Baru</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Dokter</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Keluhan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
            <tr>
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
                    <form action="{{ route('booking.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin batal?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Batalkan</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
