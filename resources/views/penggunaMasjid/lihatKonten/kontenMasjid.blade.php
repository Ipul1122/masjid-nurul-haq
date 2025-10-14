@extends('layouts.penggunaMasjid')

@section('title', 'Konten Masjid')

@section('content')

{{-- Main Content Container --}}
<div class="container mx-auto px-4 py-8 md:py-12 max-w-7xl">

    {{-- Konten Terbaru Section --}}
    <div class="mb-12 mt-10">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            {{-- Judul Halaman --}}
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-gradient-to-b from-emerald-500 to-emerald-600 rounded-full"></div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Konten Masjid</h2>
            </div>

            {{-- Tombol Filter --}}
            <div class="flex items-center gap-2 bg-gray-100 p-1.5 rounded-xl">
                <a href="{{ route('penggunaMasjid.lihatKonten.kontenMasjid') }}" 
                   class="px-4 py-2 text-sm font-semibold rounded-lg transition-all {{ !request('filter') ? 'bg-white text-emerald-600 shadow' : 'text-gray-600 hover:bg-gray-200' }}">
                   Semua
                </a>
                <a href="{{ route('penggunaMasjid.lihatKonten.kontenMasjid', ['filter' => 'artikel']) }}" 
                   class="px-4 py-2 text-sm font-semibold rounded-lg transition-all {{ request('filter') == 'artikel' ? 'bg-white text-emerald-600 shadow' : 'text-gray-600 hover:bg-gray-200' }}">
                   Artikel
                </a>
                <a href="{{ route('penggunaMasjid.lihatKonten.kontenMasjid', ['filter' => 'kegiatan']) }}"
                   class="px-4 py-2 text-sm font-semibold rounded-lg transition-all {{ request('filter') == 'kegiatan' ? 'bg-white text-emerald-600 shadow' : 'text-gray-600 hover:bg-gray-200' }}">
                   Kegiatan
                </a>
            </div>
        </div>
        
        @if($kontenTerbaru->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($kontenTerbaru as $konten)
                <a href="{{ route('konten.show', ['type' => $konten->type, 'id' => $konten->id]) }}" class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative overflow-hidden">
                        <img class="h-48 w-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ asset('storage/' . $konten->gambar) }}" alt="{{ $konten->judul }}">
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
                                <span>{{ \Carbon\Carbon::parse($konten->created_at)->format('d M Y') }}</span>
                            </div>
                            
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <span>{{ $konten->views ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Link Paginasi --}}
            <div class="mt-12">
                {{ $kontenTerbaru->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-gray-50 rounded-lg">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <p class="text-gray-500 font-medium">Konten tidak ditemukan.</p>
            </div>
        @endif
    </div>

    {{-- Jadwal Imam Section --}}
    <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 z-10">
    {{-- ... (Kode untuk Jadwal Imam biarkan seperti semula) ... --}}
    </div>
</div>
@endsection