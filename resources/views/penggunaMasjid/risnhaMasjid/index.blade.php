@extends('layouts.risnhaMasjid.risnhaMasjid')

@section('title', 'Konten Terbaru RISNHA')

@section('content')
<div class="container mx-auto px-4 py-8 md:py-12 max-w-7xl mt-16">
    
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
@endsection