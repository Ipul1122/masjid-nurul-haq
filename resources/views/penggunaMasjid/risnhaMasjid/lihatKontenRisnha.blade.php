@extends('layouts.risnhaMasjid.risnhaMasjid')

@php
    // Variabel generik untuk menangani kedua tipe konten
    $isKegiatan = $konten instanceof \App\Models\KegiatanRisnha;
    $nama = $konten->nama;
    $gambar = $isKegiatan ? $konten->gambar : $konten->gambar;
    $deskripsi = $konten->deskripsi;
    // $kontenSebelumnya = $kontenSebelumnya ?? collect();
@endphp

@section('title', $nama)

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Back Button -->
        <div class="mb-6 mt-16">
            <a href="{{ route('penggunaMasjid.risnhaMasjid.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-gray-800">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Risnha Masjid
            </a>
        </div>

        <!-- 3 Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <!-- LEFT COLUMN: Social Media Icons -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                    <h3 class="text-sm font-bold text-gray-700 mb-4 uppercase tracking-wide">Ikuti Kami</h3>
                    
                    <div class="space-y-4">
                        <!-- Instagram -->
                        <a href="https://instagram.com/masjid_anda" target="_blank" rel="noopener noreferrer" 
                           class="flex items-center space-x-3 text-gray-600 hover:text-pink-600 transition-colors duration-200 group">
                            <div class="bg-gradient-to-br from-purple-600 via-pink-600 to-orange-500 p-2 rounded-lg group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Instagram</span>
                        </a>

                        <!-- TikTok -->
                        <a href="https://tiktok.com/@masjid_anda" target="_blank" rel="noopener noreferrer"
                           class="flex items-center space-x-3 text-gray-600 hover:text-gray-900 transition-colors duration-200 group">
                            <div class="bg-gray-900 p-2 rounded-lg group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium">TikTok</span>
                        </a>

                        <!-- Facebook -->
                        <a href="https://facebook.com/masjid.anda" target="_blank" rel="noopener noreferrer"
                           class="flex items-center space-x-3 text-gray-600 hover:text-blue-600 transition-colors duration-200 group">
                            <div class="bg-blue-600 p-2 rounded-lg group-hover:scale-110 transition-transform duration-200">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Facebook</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- MIDDLE COLUMN: Main Content -->
            <div class="lg:col-span-7">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                    <div class="p-6 sm:p-8">
                        
                        @if($gambar)
                            <img class="h-80 w-full object-cover rounded-lg shadow-md mb-6" src="{{ asset('storage/' . $gambar) }}" alt="{{ $nama }}">
                        @endif

                        <div class="mb-4">
                            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight break-words overflow-wrap-anywhere">
                                {{ $nama }}
                            </h1>                            
                            <div class="flex items-center text-sm text-gray-500 mt-3">
                                <!-- Tanggal Terbit -->
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>Diterbitkan pada {{ $konten->created_at->translatedFormat('l, d F Y') }}</span>
                                
                                @if(isset($konten->views))
                                <span class="mx-2">•</span>
                                
                                <!-- Jumlah Dilihat -->
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <span>Dilihat {{ $konten->views }} kali</span>
                                @endif
                            </div>
                        </div>

                        <hr class="my-6">

                        <div class="prose max-w-none text-gray-800">
                            {!! $deskripsi !!}
                        </div>
                    </div>
                </div>
            </div>

         <!-- RIGHT COLUMN: Konten Sebelumnya -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Konten Sebelumnya</h3>

                    @if(isset($kontenSebelumnya) && $kontenSebelumnya->count())
                        <div class="space-y-4">
                            @foreach($kontenSebelumnya as $konten)
                                @php
                                    $isArtikel = $konten instanceof \App\Models\ArtikelRisnha;
                                    $routeName = $isArtikel
                                        ? 'penggunaMasjid.risnhaMasjid.showArtikel'
                                        : 'penggunaMasjid.risnhaMasjid.show';
                                @endphp

                                <a href="{{ route($routeName, [$konten->id, $konten->slug]) }}"
                                class="block bg-gray-50 hover:bg-gray-100 p-3 rounded-lg transition">
                                    <div class="flex items-start space-x-3">
                                        @if($konten->gambar)
                                            <img src="{{ asset('storage/'.$konten->gambar) }}"
                                                alt="{{ $konten->nama }}"
                                                class="w-14 h-14 object-cover rounded-md flex-shrink-0">
                                        @endif

                                        <!-- penting: min-w-0 supaya text wrap di flexbox -->
                                        <div class="min-w-0">
                                            <h4 class="font-semibold text-sm text-gray-800 leading-snug break-words overflow-wrap-break-word whitespace-normal">
                                                {{ $konten->nama }}
                                            </h4>
                                            <p class="text-xs text-gray-500">{{ $konten->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Tidak ada konten sebelumnya.</p>
                    @endif
                </div>
            </div>


        </div>
    </div>
</div>
@endsection