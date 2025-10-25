@extends('layouts.risnhaMasjid.risnhaMasjid')
@section('title', 'Konten Risnha')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4 text-center">Konten Risnha</h1>
    <p class="text-center text-gray-600 mb-8">Jelajahi artikel dan kegiatan terbaru dari Risnha Masjid Nurul Haq.</p>

    <div class="flex justify-center space-x-2 mb-10">
        <a href="{{ route('penggunaMasjid.risnhaMasjid.kontenRisnha', ['filter' => 'semua']) }}"
           class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $filter === 'semua' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
            Semua
        </a>
        <a href="{{ route('penggunaMasjid.risnhaMasjid.kontenRisnha', ['filter' => 'artikel']) }}"
           class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $filter === 'artikel' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
            Artikel
        </a>
        <a href="{{ route('penggunaMasjid.risnhaMasjid.kontenRisnha', ['filter' => 'kegiatan']) }}"
           class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $filter === 'kegiatan' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
            Kegiatan
        </a>
    </div>

    {{-- Content Section --}}
<div class="container mx-auto px-4 py-8 md:py-12 max-w-7xl">
    {{-- Header with Animation --}}
    <div class="flex items-center gap-3 mb-8 md:mb-10">
        <div class="w-1.5 h-10 bg-gradient-to-b from-emerald-500 to-emerald-600 rounded-full animate-pulse"></div>
        <div>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-black">Konten Terbaru</h2>
            <p class="text-sm md:text-base text-gray-500 mt-1">Informasi dan kegiatan terkini RISNHA</p>
        </div>
    </div>

    @if($konten->isEmpty())
        <div class="flex flex-col items-center justify-center p-12 md:p-16 rounded-2xl bg-gradient-to-br from-emerald-50 to-blue-50 border border-emerald-100">
            <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Konten</h3>
            <p class="text-gray-600 text-center">Konten akan segera hadir. Silakan kembali lagi nanti.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @foreach($konten as $item)
                @php
                    $route = $item->type === 'kegiatan'
                        ? route('penggunaMasjid.risnhaMasjid.show', ['kegiatan' => $item->id, 'slug' => $item->slug])
                        : route('penggunaMasjid.risnhaMasjid.showArtikel', ['artikel' => $item->id, 'slug' => $item->slug]);
                @endphp

                <a href="{{ $route }}" 
                   class="group block bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 hover:border-emerald-200">
                    
                    {{-- Image Container --}}
                    <div class="relative overflow-hidden aspect-video bg-gray-100">
                        @if($item->gambar)
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                                 src="{{ asset('storage/' . $item->gambar) }}" 
                                 alt="{{ $item->judul }}"
                                 loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        
                        {{-- Badge --}}
                        <div class="absolute top-3 right-3">
                            @if($item->type == 'artikel')
                                <span class="inline-flex items-center gap-1.5 bg-emerald-500 text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg backdrop-blur-sm">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                    </svg>
                                    Artikel
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-blue-500 text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg backdrop-blur-sm">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    Kegiatan
                                </span>
                            @endif
                        </div>

                        {{-- Overlay on Hover --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    
                    {{-- Content --}}
                    <div class="p-5 md:p-6">
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-emerald-600 transition-colors leading-snug">
                            {{ $item->judul }}
                        </h3>
                        
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <div class="flex items-center gap-1.5 bg-gray-50 px-3 py-1.5 rounded-lg">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-medium">{{ $item->created_at->format('d M Y') }}</span>
                            </div>
                        </div>

                        {{-- Read More Indicator --}}
                        <div class="mt-4 flex items-center gap-2 text-emerald-600 font-semibold text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span>Baca Selengkapnya</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>

    <div class="mt-12">
        {{ $konten->links() }}
    </div>
</div>
@endsection