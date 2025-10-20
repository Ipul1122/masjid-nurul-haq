@extends('layouts.risnhaMasjid.risnhaMasjid')

@php
    // Variabel generik untuk menangani kedua tipe konten
    $isKegiatan = $item instanceof \App\Models\KegiatanRisnha;
    $nama = $item->nama;
    $gambar = $isKegiatan ? $item->gambar : $item->gambar;
    $deskripsi = $item->deskripsi;
@endphp

@section('title', 'Lihat Konten Risnha')

@section('content')
<div class="container py-5 mt-16">
    {{-- Konten detail di sini menggunakan variabel $nama, $gambar, $deskripsi, dan $item --}}
    <h1 class="fw-bolder mb-1">{{ $nama }}</h1>
    <div class="text-muted fst-italic mb-2">
        Diposting pada {{ $item->created_at->translatedFormat('d F Y') }}
    </div>
    @if($gambar)
    <figure class="mb-4">
        <img class="img-fluid rounded" src="{{ asset('storage/' . $gambar) }}" alt="{{ $nama }}" style="width: 100%; max-height: 400px; object-fit: cover;"/>
    </figure>
    @endif
    <section class="mb-5 fs-5">
        {!! $deskripsi !!}
    </section>
</div>
@endsection