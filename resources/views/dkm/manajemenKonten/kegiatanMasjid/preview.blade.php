@extends('layouts.dkm')

@section('title', 'Preview Kegiatan Masjid')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
    
    {{-- Gambar Utama --}}
    @if($kegiatan->gambar)
        <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="Gambar {{ $kegiatan->judul }}" class="w-full h-64 object-cover rounded-t-lg mb-6">
    @endif

    {{-- Judul dan Kategori --}}
    <div class="mb-4">
        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">{{ $kegiatan->kategori->nama ?? 'Tanpa Kategori' }}</span>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">{{ $kegiatan->judul }}</h1>
    </div>

    {{-- Detail Kegiatan --}}
    <div class="flex items-center text-gray-600 text-sm mb-6 border-b pb-4">
        <span>Oleh: <strong>{{ $kegiatan->nama_ustadz }}</strong></span>
        <span class="mx-2">|</span>
        <span>Jadwal: <strong>{{ \Carbon\Carbon::parse($kegiatan->jadwal)->translatedFormat('l, d F Y \p\u\k\u\l H:i') }} WIB</strong></span>
    </div>

    {{-- Deskripsi --}}
    <div class="prose max-w-none text-gray-700">
        {!! $kegiatan->deskripsi !!}
    </div>

    <hr class="my-8">

    {{-- Tombol Aksi --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
            &larr; Kembali ke Daftar
        </a>

        {{-- Form untuk Publikasi --}}
        @if($kegiatan->status == 'draft')
            <form action="{{ route('dkm.manajemenKonten.kegiatanMasjid.publish', $kegiatan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mempublikasikan kegiatan ini?')">
                @csrf
                @method('PUT') {{-- ✅ INI PERBAIKANNYA --}}
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Kirim ke Publik &rarr;
                </button>
            </form>
        @else
            <span class="px-4 py-2 bg-green-200 text-green-800 rounded-lg font-semibold">Sudah Dipublikasikan</span>
        @endif
    </div>

</div>
@endsection
