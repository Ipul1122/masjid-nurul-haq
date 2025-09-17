@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-6">Halo admin, mau update kategori apa nih?</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Container Kategori Kegiatan Masjid --}}
        <a href="{{ route('dkm.kategori.kegiatanMasjid.index') }}"
           class="block p-6 rounded-lg shadow hover:shadow-lg transition bg-blue-50 border border-blue-200">
            <h3 class="text-lg font-semibold text-blue-700 mb-2">Kategori Kegiatan Masjid</h3>
            <p class="text-sm text-gray-600">Kelola kategori untuk jadwal kegiatan, kajian, pengajian, shalat Jumat, dll.</p>
        </a>

        {{-- Container Kategori Artikel --}}
        <a href="{{ route('dkm.kategori.artikel.index') }}"
           class="block p-6 rounded-lg shadow hover:shadow-lg transition bg-green-50 border border-green-200">
            <h3 class="text-lg font-semibold text-green-700 mb-2">Kategori Artikel</h3>
            <p class="text-sm text-gray-600">Kelola kategori untuk artikel, informasi, dan berita dari Masjid Nurul Haq.</p>
        </a>

        {{-- Container Kategori Pemasukkan --}}
        <a href="{{ route('dkm.kategori.pemasukkan.index') }}"
           class="block p-6 rounded-lg shadow hover:shadow-lg transition bg-green-50 border border-green-200">
            <h3 class="text-lg font-semibold text-green-700 mb-2">Kategori Pemasukkan</h3>
            <p class="text-sm text-gray-600">Kelola kategori untuk Pemasukkan, informasi, dan berita dari Masjid Nurul Haq.</p>
        </a>
    </div>
</div>
@endsection
