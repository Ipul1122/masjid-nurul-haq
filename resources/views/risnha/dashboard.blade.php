@extends('layouts.risnha')

@section('title', 'Dashboard Risnha')

@section('content')
<div class="container ">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">
            Selamat datang, {{ session('risnha_username') }}
        </h1>
    </div>

    {{-- Baris untuk Konten Utama --}}
    <div class="row">
        {{-- Card untuk Artikel --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fa fa-newspaper fa-3x text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">Artikel</h5>
                            <p class="card-text fs-4 fw-bold">{{ $jumlahArtikel }}</p>
                        </div>
                    </div>
                    <div class="mt-auto pt-3">
                        <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.index') }}" class="btn btn-outline-primary w-100">
                            Kelola Artikel <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card untuk Galeri --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fa fa-images fa-3x text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">Galeri</h5>
                            <p class="card-text fs-4 fw-bold">{{ $jumlahGaleri }}</p>
                        </div>
                    </div>
                    <div class="mt-auto pt-3">
                         <a href="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.index') }}" class="btn btn-outline-success w-100">
                            Kelola Galeri <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card untuk Kegiatan --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fa fa-calendar-alt fa-3x text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">Kegiatan</h5>
                            <p class="card-text fs-4 fw-bold">{{ $jumlahKegiatan }}</p>
                        </div>
                    </div>
                    <div class="mt-auto pt-3">
                         <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.index') }}" class="btn btn-outline-warning w-100">
                            Kelola Kegiatan <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris untuk Kategori --}}
    <div class="row">
        {{-- Card untuk Kategori Artikel --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fa fa-tag fa-3x text-info"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">Kategori Artikel</h5>
                            <p class="card-text fs-4 fw-bold">{{ $jumlahKategoriArtikel }}</p>
                        </div>
                    </div>
                    <div class="mt-auto pt-3">
                        <a href="{{ route('risnha.kategori.artikelRisnha.index') }}" class="btn btn-outline-info w-100">
                            Kelola Kategori <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card untuk Kategori Galeri --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fa fa-tags fa-3x text-secondary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">Kategori Galeri</h5>
                            <p class="card-text fs-4 fw-bold">{{ $jumlahKategoriGaleri }}</p>
                        </div>
                    </div>
                    <div class="mt-auto pt-3">
                        <a href="{{ route('risnha.kategori.galeriRisnha.index') }}" class="btn btn-outline-secondary w-100">
                            Kelola Kategori <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card untuk Kategori Kegiatan --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fa fa-bookmark fa-3x text-danger"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">Kategori Kegiatan</h5>
                            <p class="card-text fs-4 fw-bold">{{ $jumlahKategoriKegiatan }}</p>
                        </div>
                    </div>
                    <div class="mt-auto pt-3">
                        <a href="{{ route('risnha.kategori.kegiatanRisnha.index') }}" class="btn btn-outline-danger w-100">
                            Kelola Kategori <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="mt-4">
        <h4>Selamat Datang di Halaman Administrator!</h4>
        <p>Gunakan menu navigasi untuk mengelola konten website Anda.</p>
    </div> --}}
</div>
@endsection
