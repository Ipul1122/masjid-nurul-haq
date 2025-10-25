@extends('layouts.risnha')

@section('title', 'Dashboard Risnha')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">

    <!-- Header Selamat Datang -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Selamat datang, {{ session('risnha_username') }}
        </h1>
        <p class="mt-1 text-lg text-gray-600">Berikut adalah ringkasan data dari sistem Anda.</p>
    </div>

    <!-- Grid untuk Stat Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Card Artikel -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col h-full">
            <!-- Konten Utama Card -->
            <div class="p-6 flex-grow">
                <div class="flex items-center">
                    <!-- Icon -->
                    <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center bg-blue-100 text-blue-600">
                        <i class="fa fa-newspaper fa-lg"></i>
                    </div>
                    <!-- Teks Statistik -->
                    <div class="ml-4 flex-grow">
                        <p class="text-base font-medium text-gray-500">Artikel</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $jumlahArtikel }}</p>
                    </div>
                </div>
            </div>
            <!-- Footer Link -->
            <div class="bg-gray-50 p-4">
                <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.index') }}" class="inline-flex items-center justify-between w-full text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
                    <span>Kelola Artikel</span>
                    <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Card Galeri -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col h-full">
            <!-- Konten Utama Card -->
            <div class="p-6 flex-grow">
                <div class="flex items-center">
                    <!-- Icon -->
                    <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center bg-green-100 text-green-600">
                        <i class="fa fa-images fa-lg"></i>
                    </div>
                    <!-- Teks Statistik -->
                    <div class="ml-4 flex-grow">
                        <p class="text-base font-medium text-gray-500">Galeri</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $jumlahGaleri }}</p>
                    </div>
                </div>
            </div>
            <!-- Footer Link -->
            <div class="bg-gray-50 p-4">
                <a href="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.index') }}" class="inline-flex items-center justify-between w-full text-sm font-medium text-green-600 hover:text-green-800 transition-colors">
                    <span>Kelola Galeri</span>
                    <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Card Kegiatan -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col h-full">
            <!-- Konten Utama Card -->
            <div class="p-6 flex-grow">
                <div class="flex items-center">
                    <!-- Icon -->
                    <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center bg-amber-100 text-amber-600">
                        <i class="fa fa-calendar-alt fa-lg"></i>
                    </div>
                    <!-- Teks Statistik -->
                    <div class="ml-4 flex-grow">
                        <p class="text-base font-medium text-gray-500">Kegiatan</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $jumlahKegiatan }}</p>
                    </div>
                </div>
            </div>
            <!-- Footer Link -->
            <div class="bg-gray-50 p-4">
                <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.index') }}" class="inline-flex items-center justify-between w-full text-sm font-medium text-amber-600 hover:text-amber-800 transition-colors">
                    <span>Kelola Kegiatan</span>
                    <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Card Kategori Artikel -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col h-full">
            <!-- Konten Utama Card -->
            <div class="p-6 flex-grow">
                <div class="flex items-center">
                    <!-- Icon -->
                    <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center bg-indigo-100 text-indigo-600">
                        <i class="fa fa-tag fa-lg"></i>
                    </div>
                    <!-- Teks Statistik -->
                    <div class="ml-4 flex-grow">
                        <p class="text-base font-medium text-gray-500">Kategori Artikel</g>
                        <p class="text-3xl font-bold text-gray-900">{{ $jumlahKategoriArtikel }}</p>
                    </div>
                </div>
            </div>
            <!-- Footer Link -->
            <div class="bg-gray-50 p-4">
                <a href="{{ route('risnha.kategori.artikelRisnha.index') }}" class="inline-flex items-center justify-between w-full text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
                    <span>Kelola Kategori</span>
                    <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Card Kategori Galeri -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col h-full">
            <!-- Konten Utama Card -->
            <div class="p-6 flex-grow">
                <div class="flex items-center">
                    <!-- Icon -->
                    <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center bg-purple-100 text-purple-600">
                        <i class="fa fa-tags fa-lg"></i>
                    </div>
                    <!-- Teks Statistik -->
                    <div class="ml-4 flex-grow">
                        <p class="text-base font-medium text-gray-500">Kategori Galeri</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $jumlahKategoriGaleri }}</p>
                    </div>
                </div>
            </div>
            <!-- Footer Link -->
            <div class="bg-gray-50 p-4">
                <a href="{{ route('risnha.kategori.galeriRisnha.index') }}" class="inline-flex items-center justify-between w-full text-sm font-medium text-purple-600 hover:text-purple-800 transition-colors">
                    <span>Kelola Kategori</span>
                    <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Card Kategori Kegiatan -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden flex flex-col h-full">
            <!-- Konten Utama Card -->
            <div class="p-6 flex-grow">
                <div class="flex items-center">
                    <!-- Icon -->
                    <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center bg-red-100 text-red-600">
                        <i class="fa fa-bookmark fa-lg"></i>
                    </div>
                    <!-- Teks Statistik -->
                    <div class="ml-4 flex-grow">
                        <p class="text-base font-medium text-gray-500">Kategori Kegiatan</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $jumlahKategoriKegiatan }}</p>
                    </div>
                </div>
            </div>
            <!-- Footer Link -->
            <div class="bg-gray-50 p-4">
                <a href="{{ route('risnha.kategori.kegiatanRisnha.index') }}" class="inline-flex items-center justify-between w-full text-sm font-medium text-red-600 hover:text-red-800 transition-colors">
                    <span>Kelola Kategori</span>
                    <i class="fa fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

    </div> <!-- End Grid -->
</div>
@endsection