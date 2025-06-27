@extends('layouts.app')

@section('content')
    <h2 class="mb-3">{{ $article->title }}</h2>
    <p class="text-muted">Dipublikasikan pada {{ $article->created_at->format('d M Y') }}</p>
    <div class="mb-5">
        {!! nl2br(e($article->content)) !!}
    </div>
    <a href="{{ route('home') }}" class="btn btn-secondary">← Kembali ke Beranda</a>
@endsection
