@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Daftar Dokter</h2>
    <div class="row">
        @foreach ($doctors as $doctor)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $doctor->nama }}</h5>
                        <p class="card-text">
                            Spesialis: {{ $doctor->spesialis }}<br>
                            No STR: {{ $doctor->no_str }}
                        </p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Lihat Jadwal</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
