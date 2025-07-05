@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Selamat Datang, {{ Auth::user()->name }}</h1>
        <p>Ini adalah halaman dashboard untuk mengelola data aplikasi MediTalk.</p>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-bg-primary shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total Dokter</h5>
                        <p class="card-text fs-4">{{ \App\Models\Doctor::count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-success shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total Artikel</h5>
                        <p class="card-text fs-4">{{ \App\Models\Article::count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-warning shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total Booking</h5>
                        <p class="card-text fs-4">{{ \App\Models\Booking::count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-bg-info shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total Pasien</h5>
                        <p class="card-text fs-4">{{ \App\Models\User::where('role', 'pasien')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection