@extends('layouts.risnha')

@section('title', 'Pratinjau Kegiatan Risnha')
@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Pratinjau Kegiatan Risnha</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($kegiatan->gambar)
                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="img-fluid rounded mb-3" style="max-height: 400px; object-fit: cover; width: 100%;" alt="gambar Kegiatan">
            @endif
            <h4 class="card-title">{{ $kegiatan->nama }}</h4>
            <hr>
            
            <div class="mb-3">
                <strong>Kategori:</strong> {{ $kegiatan->kategori->nama_kategori }}
            </div>

            <div class="mb-3">
                <strong>Status:</strong>
                @if($kegiatan->status == 'published')
                    <span class="badge bg-success">Dipublikasikan</span>
                @else
                    <span class="badge bg-warning text-dark">Draf</span>
                @endif
            </div>

            <div class="card-text border p-3 rounded bg-light">
                {!! $kegiatan->deskripsi !!}
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>

        @if($kegiatan->status != 'published')
            <form action="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.publish', $kegiatan->id) }}" method="POST">
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