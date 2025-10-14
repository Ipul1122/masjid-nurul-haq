@extends('layouts.dkm')

@section('title', 'Preview Artikel')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">

    {{-- Gambar Utama --}}
    @if($artikel->gambar)
        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Gambar {{ $artikel->judul }}" class="w-full h-64 object-cover rounded-t-lg mb-6">
    @endif

    {{-- Judul dan Kategori --}}
    <div class="mb-4">
        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">{{ $artikel->kategori->nama ?? 'Tanpa Kategori' }}</span>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">{{ $artikel->judul }}</h1>
    </div>

    {{-- Detail Artikel --}}
    <div class="flex items-center text-gray-600 text-sm mb-6 border-b pb-4">
        <span>Tanggal Rilis: <strong>{{ \Carbon\Carbon::parse($artikel->tanggal_rilis)->translatedFormat('l, d F Y') }}</strong></span>
    </div>

    {{-- Deskripsi --}}
    <div class="prose max-w-none text-gray-700">
        {!! $artikel->deskripsi !!}
    </div>

    <hr class="my-8">

    {{-- Tombol Aksi --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('dkm.manajemenKonten.artikel.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
            &larr; Kembali ke Daftar
        </a>

        {{-- Form untuk Publikasi --}}
        @if($artikel->status == 'draft')
            <form action="{{ route('dkm.manajemenKonten.artikel.publish', $artikel->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mempublikasikan artikel ini?')">
                @csrf
                @method('PUT')
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Publish &rarr;
                </button>
            </form>
        @else
            <span class="px-4 py-2 bg-green-200 text-green-800 rounded-lg font-semibold">Sudah Dipublikasikan</span>
        @endif
    </div>

</div>
@endsection