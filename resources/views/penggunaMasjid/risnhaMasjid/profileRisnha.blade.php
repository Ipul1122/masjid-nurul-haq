@extends('layouts.risnhaMasjid.risnhaMasjid')

@section('title', 'Profile Risnha')

@section('content')
<div class="bg-gradient-to-br from-blue-50 via-white to-blue-50 py-12 mt-16 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header Section --}}
        <div class="text-center mb-16 animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-600 mb-3 tracking-tight">
                Tentang <span class="text-blue-600">Risnha</span>
            </h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-4 rounded-full"></div>
            <p class="text-base md:text-lg text-gray-600 max-w-2xl mx-auto">
                Arah, Tujuan, dan Struktur Organisasi Remaja Islam Masjid Nurul Haq
            </p>
        </div>

        {{-- Visi & Misi --}}
        <div class="grid md:grid-cols-2 gap-6 md:gap-8 mb-16">
            {{-- Visi Card --}}
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 backdrop-blur-sm p-3 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold text-white">Visi</h2>
                    </div>
                </div>
                <div class="p-6 md:p-8">
                    <div class="text-gray-700 text-base md:text-lg leading-relaxed prose max-w-none">
                        {!! nl2br(e($profile->visi)) !!}
                    </div>
                </div>
            </div>

            {{-- Misi Card --}}
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                <div class="bg-gradient-to-r from-blue-700 to-blue-800 p-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 backdrop-blur-sm p-3 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold text-white">Misi</h2>
                    </div>
                </div>
                <div class="p-6 md:p-8">
                    <div class="text-gray-700 text-base md:text-lg leading-relaxed prose max-w-none">
                        {!! nl2br(e($profile->misi)) !!}
                    </div>
                </div>
            </div>
        </div>

        {{-- Struktur Organisasi Slider --}}
        @if($organisasis->isNotEmpty())
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 md:p-8">
                <div class="flex items-center justify-center space-x-3">
                    <div class="bg-white/20 backdrop-blur-sm p-3 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-white">Struktur Organisasi</h2>
                </div>
            </div>

            <div class="p-6 md:p-12">
                <div id="organisasi-slider" class="relative max-w-5xl mx-auto">
                    {{-- Container untuk slides --}}
                    <div class="relative overflow-hidden bg-center rounded-xl bg-gray-50" style="min-height: 400px;">
                        @foreach($organisasis as $index => $item)
                            {{-- Slide Item --}}
                            {{-- 
                            TAMBAHKAN KELAS INI: 
                            flex flex-col items-center justify-center p-4 
                            --}}
                            <div class="slider-item absolute inset-0 transition-all duration-700 ease-in-out {{ $index == 0 ? 'opacity-100 scale-100' : 'opacity-0 scale-95' }} flex flex-col items-center justify-center p-4" data-index="{{ $index }}">
                                
                                <img src="{{ asset('images/organisasi_risnha/' . $item->gambar_organisasi) }}" 
                                    alt="Struktur Organisasi {{ $index + 1 }}" 
                                    class="w-54 h-auto object-contain rounded-xl">
                                @if($item->deskripsi)
                                    <p class="text-center text-gray-600 mt-6 text-base md:text-lg px-4">{{ $item->deskripsi }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{-- Tombol Prev --}}
                    <button id="prev-btn" class="absolute top-1/2 -left-4 md:-left-16 transform -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white rounded-full p-3 md:p-4 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-300 hover:scale-110 z-10">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    {{-- Tombol Next --}}
                    <button id="next-btn" class="absolute top-1/2 -right-4 md:-right-16 transform -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white rounded-full p-3 md:p-4 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-300 hover:scale-110 z-10">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    {{-- Indicator Dots --}}
                    @if(count($organisasis) > 1)
                    <div class="flex justify-center space-x-2 mt-6">
                        @foreach($organisasis as $index => $item)
                            <button class="indicator-dot w-3 h-3 rounded-full transition-all duration-300 focus:outline-none {{ $index == 0 ? 'bg-blue-600 w-8' : 'bg-gray-300 hover:bg-gray-400' }}" 
                                    data-index="{{ $index }}"></button>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.8s ease-out;
    }

    .prose {
        line-height: 1.8;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slider = document.getElementById('organisasi-slider');
        if (slider) {
            const slides = slider.querySelectorAll('.slider-item');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const dots = slider.querySelectorAll('.indicator-dot');
            let currentSlide = 0;
            const totalSlides = slides.length;

            if (totalSlides <= 1) {
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';
                return;
            }

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    if (i === index) {
                        slide.classList.remove('opacity-0', 'scale-95');
                        slide.classList.add('opacity-100', 'scale-100');
                    } else {
                        slide.classList.remove('opacity-100', 'scale-100');
                        slide.classList.add('opacity-0', 'scale-95');
                    }
                });

                // Update dots
                dots.forEach((dot, i) => {
                    if (i === index) {
                        dot.classList.remove('bg-gray-300', 'w-3');
                        dot.classList.add('bg-blue-600', 'w-8');
                    } else {
                        dot.classList.remove('bg-blue-600', 'w-8');
                        dot.classList.add('bg-gray-300', 'w-3');
                    }
                });
            }

            prevBtn.addEventListener('click', function () {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                showSlide(currentSlide);
            });

            nextBtn.addEventListener('click', function () {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            });

            // Dot navigation
            dots.forEach((dot, index) => {
                dot.addEventListener('click', function () {
                    currentSlide = index;
                    showSlide(currentSlide);
                });
            });

            showSlide(currentSlide);
        }
    });
</script>
@endsection