@extends('layouts.dkm') {{-- nanti kita bikin layout dasar --}}
@section('content')
<div class="bg-gray-50 min-h-screen p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Selamat datang, {{ session('dkm_username') }}
        </h1>

        <!-- Tombol Logout -->
        {{-- <form method="POST" action="{{ route('dkm.logout') }}">
            @csrf
            <button type="submit"
                class="bg-red-600 text-black px-4 py-2 rounded-lg shadow hover:bg-red-700 transition">
                Logout
            </button>
        </form> --}}
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <p class="text-gray-700">
            Ini adalah halaman Dashboard DKM. Nantinya di sini akan ada menu untuk manajemen kegiatan, berita, donasi, dsb.
        </p>
    </div>

    <a href="{{ route('dkm.managePengguna.index') }}">Manage Pengguna</a>
    <br>
    <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}">Manage Konten</a>
    <br>
    <a href="{{ route('dkm.manajemenKonten.artikel.index') }}">Manage Artikel</a>
    <br>
    <a href="{{ route('dkm.kategori.index') }}">Manage kategori</a>
</div>
@endsection
