@extends('layouts.penggunaMasjid')

@section('title', $konten->judul)

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:p-8">
                <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-gray-800 mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Kembali ke Beranda
                </a>

                @if($konten->gambar)
                    <img class="h-80 w-full object-cover rounded-lg shadow-md mb-6" src="{{ asset('storage/' . $konten->gambar) }}" alt="{{ $konten->judul }}">
                @endif

                <div class="mb-4">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight">
                        {{ $konten->judul }}
                    </h1>
                    
                    {{-- Bagian yang diubah ada di sini --}}
                    <div class="flex items-center text-sm text-gray-500 mt-3">
                        {{-- Tanggal Terbit --}}
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Diterbitkan pada {{ $konten->created_at->translatedFormat('l, d F Y') }}</span>
                        
                        <span class="mx-2">•</span>
                        
                        {{-- Jumlah Dilihat --}}
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <span>Dilihat {{ $konten->views ?? 0 }} kali</span>
                    </div>
                </div>

                <hr class="my-6">

                <div class="prose max-w-none text-gray-800">
                    {!! $konten->deskripsi !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection