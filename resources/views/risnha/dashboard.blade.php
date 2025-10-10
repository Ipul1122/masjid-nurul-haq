{{-- resources/views/risnha/dashboard.blade.php --}}
@extends('layouts.risnha')

@section('title', 'Dashboard Risnha')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Dashboard</h3>

    <div class="row">
        {{-- Card untuk Artikel --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            {{-- Icon dari Font Awesome --}}
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

    {{-- Anda bisa menambahkan konten lain di bawahnya --}}
    <div class="mt-4">
        <h4>Selamat Datang di Halaman Administrator!</h4>
        <p>Gunakan menu navigasi untuk mengelola konten website Anda.</p>
    </div>
</div>
@endsection