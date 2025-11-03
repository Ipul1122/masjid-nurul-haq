@extends('layouts.penggunaMasjid')

@section('title', 'Struktur DKM')

{{-- Tambahkan style untuk menyembunyikan scrollbar --}}
@push('styles')
<style>
    /* Sembunyikan scrollbar untuk Chrome, Safari dan Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    /* Sembunyikan scrollbar untuk IE, Edge dan Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE dan Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>
@endpush

@section('content')

{{-- Bagian Header Halaman --}}
<div class="relative w-full h-48 sm:h-64 md:h-80 bg-cover bg-center" style="background-image: url('{{ asset('images/masjid_nurul_haq.jpeg') }}');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative container mx-auto px-4 h-full flex items-center justify-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white text-center leading-tight">
            Struktur Organisasi DKM
        </h1>
    </div>
</div>

{{-- Bagian Konten Utama --}}
<div class="container mx-auto px-4 py-8 sm:py-12">

    {{-- Judul Konten --}}
    <div class="text-center mb-8 sm:mb-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Dewan Kemakmuran Masjid Nurul Haq</h2>
        <p class="mt-2 text-gray-600 text-base sm:text-lg">Periode Masa Bakti Saat Ini</p>
    </div>

    {{-- === AWAL PERUBAHAN === --}}

    @if($strukturDkms->isEmpty())
        {{-- Pesan Jika Data Kosong (diletakkan di luar @if) --}}
        <div class="bg-gray-50 rounded-lg p-8 text-center">
            <i class="fas fa-users fa-3x text-gray-400 mb-3"></i>
            <p class="text-gray-500 text-lg">
                Data struktur DKM belum dipublikasikan.
            </p>
        </div>
    @else
        
        {{-- Tampilkan info "geser" jika item > 3 DAN di layar kecil (di bawah lg) --}}
        @if($strukturDkms->count() > 3)
            <div class="mb-4 text-center text-gray-500 italic lg:hidden">
                <i class="fas fa-arrows-alt-h mr-2" aria-hidden="true"></i>
                Silahkan geser untuk melihat info lainnya
            </div>
        @endif

        {{-- Container untuk horizontal scroll --}}
        <div class="overflow-x-auto pb-4 no-scrollbar">
            
            {{-- Ganti 'grid' dengan 'flex' dan 'space-x' --}}
            <div class="flex space-x-6 sm:space-x-8">
                
                @foreach ($strukturDkms as $item)
                    {{-- Kartu Anggota --}}
                    {{-- Beri lebar tetap (w-XX) dan flex-shrink-0 agar tidak menyusut --}}
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 w-64 sm:w-72 flex-shrink-0">
                        {{-- Foto Anggota --}}
                        <img src="{{ asset('images/struktur_dkm/' . $item->gambar) }}" 
                             alt="{{ $item->nama }}" 
                             class="w-full h-56 sm:h-64 object-cover object-top">
                        
                        {{-- Detail Teks --}}
                        <div class="p-4 sm:p-5 w-full">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-900 truncate" title="{{ $item->nama }}">
                                {{ $item->nama }}
                            </h3>
                            <p class="text-sm sm:text-base text-blue-600 font-medium mt-1">
                                {{ $item->divisi }}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div> {{-- Akhir Flex --}}
        </div> {{-- Akhir Overflow --}}
    
    @endif
    {{-- === AKHIR PERUBAHAN === --}}

</div>

@endsection