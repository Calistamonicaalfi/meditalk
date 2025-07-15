@extends('layouts.admin')

@section('title', 'Detail Artikel')

@section('content')
<div class="container mt-4">
    <h2>{{ $article->judul }}</h2>
    <p><strong>Penulis:</strong> {{ $article->doctor->nama ?? '-' }}</p>
    <div class="mb-3">
        {!! nl2br(e($article->isi)) !!}
    </div>
    <a href="{{ route('article.index') }}" class="btn btn-secondary">Kembali ke Daftar Artikel</a>
</div>
@endsection 