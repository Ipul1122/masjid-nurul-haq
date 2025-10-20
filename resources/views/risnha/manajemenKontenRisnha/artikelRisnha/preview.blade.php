@extends('layouts.risnha')
@section('title', 'Pratinjau Artikel')
@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Pratinjau Artikel</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($artikel->gambar)
                <img src="{{ asset('storage/' . $artikel->gambar) }}" class="img-fluid rounded mb-3" alt="Gambar Artikel">
            @endif
            <h4 class="card-title">{{ $artikel->judul }}</h4>
            <hr>
            <div class="mb-3">
                <strong>Kategori:</strong> {{ $artikel->kategori->nama_kategori ?? 'N/A' }}
            </div>
            <div class="mb-3">
                <strong>Status:</strong>
                @if($artikel->status == 'published')
                    <span class="badge bg-success">Dipublikasikan</span>
                @else
                    <span class="badge bg-warning text-dark">Draf</span>
                @endif
            </div>
            <div class="card-text border p-3 rounded bg-light">
                {!! $artikel->isi !!}
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
        @if($artikel->status != 'published')
            <form action="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.publish', $artikel->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-paper-plane me-1"></i> Publikasikan
                </button>
            </form>
        @endif
    </div>
</div>
@endsection