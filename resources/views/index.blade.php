@extends('layouts.penggunaMasjid')

@section('title', 'Beranda')

@section('content')
{{-- CAROUSEL --}}
@php
    $carouselImages = \App\Models\TampilanHomeSection::orderBy('order')->get();
@endphp

@if($carouselImages->isNotEmpty())
<div class="relative w-full" data-carousel="slide">
    <div class="relative h-56 overflow-hidden md:h-96">
        @foreach($carouselImages as $image)
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('storage/' . $image->image_path) }}" class="absolute block w-full h-full object-cover" alt="Carousel Image">
        </div>
        @endforeach
    </div>
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        @foreach($carouselImages as $index => $image)
        <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
        @endforeach
    </div>
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
@endif


<h1>TESTING ke 2</h1>

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-semibold mb-4">Selamat Datang!</h2>
        <p>
            Ini adalah halaman utama untuk para jamaah Masjid Nurul Haq. Silakan gunakan menu di navigasi untuk melihat informasi lainnya.
        </p>
    </div>
</div>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-semibold mb-4">Selamat Datang!</h2>
        <p>
            Ini adalah halaman utama untuk para jamaah Masjid Nurul Haq. Silakan gunakan menu di navigasi untuk melihat informasi lainnya.
        </p>
    </div>
</div>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-semibold mb-4">Selamat Datang!</h2>
        <p>
            Ini adalah halaman utama untuk para jamaah Masjid Nurul Haq. Silakan gunakan menu di navigasi untuk melihat informasi lainnya.
        </p>
    </div>
</div>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-semibold mb-4">Selamat Datang!</h2>
        <p>
            Ini adalah halaman utama untuk para jamaah Masjid Nurul Haq. Silakan gunakan menu di navigasi untuk melihat informasi lainnya.
        </p>
    </div>
</div>



{{-- Tambahkan script untuk carousel --}}
<script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
@endsection