@extends('layouts.risnhaMasjid.risnhaMasjid')

@section('title', $kegiatan->nama)

@section('content')
<div class="container py-5" style="margin-top: 70px;">
    <div class="row">
        <div class="col-lg-8">
            <article>
                <header class="mb-4">
                    <h1 class="fw-bolder mb-1">{{ $kegiatan->nama }}</h1>
                    <div class="text-muted fst-italic mb-2">
                        Diposting pada {{ $kegiatan->created_at->translatedFormat('d F Y') }}
                    </div>
                    @if($kegiatan->kategori)
                        <span class="badge bg-primary">{{ $kegiatan->kategori->nama_kategori }}</span>
                    @endif
                </header>
                @if($kegiatan->foto)
                <figure class="mb-4">
                    <img class="img-fluid rounded" src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->nama }}" style="width: 100%; max-height: 400px; object-fit: cover;"/>
                </figure>
                @endif
                <section class="mb-5 fs-5">
                    {!! $kegiatan->deskripsi !!}
                </section>
            </article>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Info Kegiatan</div>
                <div class="card-body">
                    <p>Ini adalah halaman detail untuk kegiatan Risnha. Anda dapat menambahkan informasi relevan lainnya di sisi kanan ini.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection