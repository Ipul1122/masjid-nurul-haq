@extends('layouts.dkm')

@section('content')
<div class="bg-gray-50 p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Selamat datang, {{ session('dkm_username') }}
        </h1>
    </div>

    <h1>Konten</h1>

    {{-- Statistik Dashboard --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Card Jumlah Kegiatan --}}
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-mosque text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-500 text-sm font-medium">Jumlah Kegiatan Masjid</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $jumlahKegiatan }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}"
                   class="text-sm text-blue-600 hover:underline">
                   Lihat semua kegiatan →
                </a>
            </div>
        </div>

        {{-- Card Jumlah Artikel --}}
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-newspaper text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-500 text-sm font-medium">Jumlah Artikel</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $jumlahArtikel }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('dkm.manajemenKonten.artikel.index') }}"
                   class="text-sm text-blue-600 hover:underline">
                   Lihat semua artikel →
                </a>
            </div>
        </div>


        {{-- Card Jumlah Jadwal Imam --}}
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-newspaper text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-500 text-sm font-medium">Jumlah Jadwal Imam</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $jumlahJadwalImam }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('dkm.manajemenKonten.jadwalImam.index') }}"
                   class="text-sm text-blue-600 hover:underline">
                   Lihat semua Jadwal Imam →
                </a>
            </div>
        </div>

        {{-- Tempat card tambahan (Donasi, Pengguna, dll) --}}
    </div>

    <br>

    {{-- Info tambahan --}}
    <div class="bg-white p-6 rounded-lg shadow mt-6">
        <p class="text-gray-700">
            Ini adalah halaman Dashboard DKM. Nantinya di sini akan ada menu untuk manajemen kegiatan, berita, donasi, dsb.
        </p>
    </div>
</div>
@endsection
