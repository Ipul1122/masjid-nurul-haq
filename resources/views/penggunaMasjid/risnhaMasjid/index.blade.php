@extends('layouts.risnhaMasjid.risnhaMasjid')

@section('title', 'Konten Terbaru RISNHA')

@section('content')

@php
    $homeSectionRisnhas = \App\Models\TampilanPenggunaMasjid\HomeSectionRisnha::all();
@endphp

@php
    // Pastikan variabel ini sudah ada dari controller, atau definisikan di sini
    $homeSectionRisnhas = \App\Models\TampilanPenggunaMasjid\HomeSectionRisnha::all();
@endphp

<div class="container mx-auto px-4 py-8 md:py-12 max-w-7xl ">

    {{-- CAROUSEL FLOWBITE --}}
    @if($homeSectionRisnhas->isNotEmpty())
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            
            {{-- 1. GAMBAR SLIDE --}}
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                @foreach($homeSectionRisnhas as $item)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('images/risnha_carousel/'.$item->gambar) }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Gambar Carousel Risnha">
                    </div>
                @endforeach
            </div>

            {{-- Hanya tampilkan tombol jika gambar lebih dari satu --}}
            @if($homeSectionRisnhas->count() > 1)
                {{-- 2. INDIKATOR (TITIK-TITIK) --}}
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    @foreach($homeSectionRisnhas as $key => $item)
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}" data-carousel-slide-to="{{ $key }}"></button>
                    @endforeach
                </div>

                {{-- 3. TOMBOL NAVIGASI KIRI & KANAN --}}
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            @endif
        </div>
    @else
        {{-- Tampilan jika tidak ada gambar sama sekali --}}
        <div class="text-center p-8 border rounded-lg bg-gray-50">
            <p class="text-gray-500">Belum ada gambar di carousel.</p>
        </div>
    @endif
</div>

    {{-- Header Section --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="w-1 h-8 bg-gradient-to-b from-emerald-500 to-emerald-600 rounded-full"></div>
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Konten Terbaru RISNHA</h2>
    </div>

    @if($kontenRisnha->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada konten yang dipublikasikan saat ini.
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kontenRisnha as $konten)
                @php
                    // Membuat pretty URL yang benar untuk kegiatan dan artikel
                    $route = $konten->type === 'kegiatan'
                        ? route('penggunaMasjid.risnhaMasjid.show', ['kegiatan' => $konten->id, 'slug' => $konten->slug])
                        : route('penggunaMasjid.risnhaMasjid.showArtikel', ['artikel' => $konten->id, 'slug' => $konten->slug]);
                @endphp

                <a href="{{ $route }}" class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative overflow-hidden">
                        @if($konten->gambar)
                            <img class="h-48 w-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ asset('storage/' . $konten->gambar) }}" alt="{{ $konten->judul }}">
                        @else
                             <img class="h-48 w-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://via.placeholder.com/400x300.png?text=Tanpa+Gambar" alt="Tanpa Gambar">
                        @endif
                        
                        <div class="absolute top-3 right-3">
                            @if($konten->type == 'artikel')
                                <span class="bg-emerald-500 text-white text-xs px-3 py-1 rounded-full font-semibold shadow-lg">Artikel</span>
                            @else
                                <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full font-semibold shadow-lg">Kegiatan</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-emerald-600 transition-colors">{{ $konten->judul }}</h3>
                        
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span>{{ $konten->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
@endsection