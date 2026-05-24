@extends('layouts.penggunaMasjid')

@section('title', 'Masjid - Beranda')
@section('description', 'Selamat Datang di Website Resmi Masjid. Temukan informasi terbaru tentang kegiatan, artikel islami, laporan keuangan, dan aktivitas remaja masjid (RISNHA) di sini.')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-green-50 to-slate-50">
    
    {{-- Hero Carousel --}}
    @if(isset($homeSections) && $homeSections->isNotEmpty())
    <div class="relative z-20 ">
        <div id="default-carousel" class="relative w-full" @if($homeSections->count() > 1) data-carousel="slide" @endif>
            {{-- Carousel Wrapper --}}
            {{-- Wrapper 16:9 aspect ratio: padding-bottom 56.25% = 9/16 --}}
            <div class="relative w-full overflow-hidden" style="padding-bottom: 56.25%;">
                @foreach ($homeSections as $item)
                    <div class="{{ $loop->first ? '' : 'hidden' }} absolute inset-0 duration-700 ease-in-out" @if($homeSections->count() > 1) data-carousel-item @endif>
                        <div class="absolute inset-0 z-10 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        <img src="{{ Storage::url($item->image_path) }}"
                             class="absolute inset-0 block w-full h-full object-cover object-center"
                             alt="Gambar Masjid">
                    </div>
                @endforeach
            </div>

            {{-- Carousel Indicators & Navigation --}}
            @if($homeSections->count() > 1)
                <div class="absolute z-20 flex space-x-2 -translate-x-1/2 bottom-4 left-1/2">
                    @foreach($homeSections as $key => $item)
                    <button type="button" class="w-2 h-2 transition-all rounded-full bg-white/60 hover:bg-white" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}" data-carousel-slide-to="{{ $key }}"></button>
                    @endforeach
                </div>
                
                <button type="button" class="absolute top-1/2 left-2 sm:left-4 z-20 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 rounded-full p-2 sm:p-3 transition-all" data-carousel-prev>
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" class="absolute top-1/2 right-2 sm:right-4 z-20 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 rounded-full p-2 sm:p-3 transition-all" data-carousel-next>
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            @endif
        </div>
    </div>
    @endif

    {{-- Info Card --}}
    <div class="relative z-30 container mx-auto px-4 max-w-7xl -mt-10 ">
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-gray-100">
                
                {{-- Masjid Info --}}
                <div class="p-4 sm:p-6 flex items-center gap-3 sm:gap-4">
                    <img src="{{ asset('images/your-logo.png') }}" alt="Logo Masjid" class="w-12 h-12 sm:w-14 sm:h-14 flex-shrink-0">
                    <div>
                        <h3 class="font-bold text-gray-800 text-base sm:text-lg mb-1">Masjid</h3>
                        <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">
                            Jl. Alamat Lengkap Masjid, Kota, Provinsi
                        </p>
                    </div>
                </div>
                
                {{-- DKM Profile --}}
                <div class="p-4 sm:p-6 flex items-center gap-3 sm:gap-4">
                    <img class="w-12 h-12 sm:w-16 sm:h-16 rounded-full object-cover flex-shrink-0"
                        src="{{ asset('images/person-icon.png') }}"
                        alt="Foto DKM">
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm sm:text-base">Nama Ketua DKM</h3>
                        <p class="text-gray-600 text-xs sm:text-sm mb-2">Ketua DKM</p>
                        <a href="#" class="inline-block bg-green-600 hover:bg-green-700 text-white px-3 sm:px-5 py-1 sm:py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide transition-colors">
                            Bapak Ustadz .....
                        </a>
                    </div>
                </div>

                {{-- Contact Info --}}
                <div class="p-4 sm:p-6 flex items-start gap-3 sm:gap-4">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-gray-800 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm sm:text-base">Pusat Informasi</h3>
                        <p class="text-lg sm:text-xl font-semibold text-gray-900 mt-1">08xx-xxxx-xxxx</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Running Text --}}
    @if(isset($runningText) && $runningText->content)
    <div class="bg-gradient-to-r from-green-600 to-green-500 text-white py-2.5 sm:py-3 shadow-lg mt-6 sm:mt-8">
        <div class="container mx-auto px-4">
            <div class="flex items-center gap-2 sm:gap-3">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                </svg>
                <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" class="font-medium text-sm sm:text-base">
                    {!! $runningText->content !!}
                </marquee>
            </div>
        </div>
    </div>
    @endif

    {{-- Welcome Section --}}
    <div class="relative w-full z-10 py-16 sm:py-24 md:py-32 -mt-14 sm:-mt-20 md:-mt-24 lg:-mt-28 overflow-hidden rounded-b-[2rem] sm:rounded-b-[3rem] md:rounded-b-[4rem] shadow-2xl">
        
        <!-- Parallax Background Element -->
        <div id="welcome-parallax-bg" class="absolute inset-0 bg-cover bg-center transition-transform duration-100 ease-out scale-110" 
             style="background-image: url('{{ asset('images/masjid_nurul_haq.jpeg') }}'); height: 130%; top: -15%; will-change: transform;">
        </div>
        
        <!-- Premium Radial & Linear Overlay for text readability -->
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-900/60 to-green-950/85 backdrop-blur-[2px]"></div>
        
        <!-- Decorative Glow Spots -->
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-green-600/10 rounded-full blur-3xl pointer-events-none animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-green-300/15 rounded-full blur-3xl pointer-events-none animate-pulse" style="animation-delay: 2s;"></div>

        <div class="relative container mx-auto px-4 max-w-7xl z-20">
            <!-- Header Section with scroll animation class -->
            <div class="welcome-reveal opacity-0 transform translate-y-8 transition-all duration-1000 ease-out flex flex-col items-center md:items-start mb-10 sm:mb-12 mt-12 sm:mt-16 text-center md:text-left">
                <div class="flex items-center gap-2 sm:gap-3 mb-2 sm:mb-3">
                    <span class="px-3 py-1 text-xs font-semibold uppercase tracking-widest text-green-300 bg-green-600/20 border border-green-300/20 rounded-full">
                        Official Website
                    </span>
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-white mb-4 sm:mb-6">
                    Selamat Datang Di <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-300 via-green-400 to-green-600 drop-shadow-sm">Masjid</span>
                </h2>
                <p class="text-slate-300 text-sm sm:text-base md:text-lg max-w-2xl leading-relaxed">
                    Menjalin Ukhuwah, Membangun Ummah. Akses berbagai informasi kegiatan masjid, transparansi keuangan, artikel Islami, dan program remaja masjid kami di satu tempat.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 items-center">
                <!-- Left: Interactive Logo with Soft Glow -->
                <div class="col-span-1 md:col-span-5 order-2 md:order-1 text-center welcome-reveal opacity-0 transform translate-y-8 transition-all duration-1000 ease-out delay-200">
                    <div class="relative inline-block group">
                        <!-- Glowing Backplate -->
                        <div class="absolute inset-0 bg-green-600/20 rounded-full blur-2xl group-hover:bg-green-600/35 transition-all duration-700 scale-95 group-hover:scale-105 pointer-events-none"></div>
                        
                        <img src="{{ asset('images/your-logo.png') }}" 
                             alt="Logo Masjid" 
                             class="relative w-40 h-40 sm:w-56 sm:h-56 md:w-72 md:h-72 object-contain mx-auto transition-all duration-500 ease-out transform group-hover:scale-105 group-hover:rotate-3 filter drop-shadow-[0_15px_30px_rgba(0,0,0,0.5)]">
                    </div>
                </div>
                
                <!-- Right: Glassmorphic Link Cards -->
                <div class="col-span-1 md:col-span-7 order-1 md:order-2 welcome-reveal opacity-0 transform translate-y-8 transition-all duration-1000 ease-out delay-400">
                    <div class="space-y-4 sm:space-y-5 mb-6">
                        
                        <!-- Card 1: Update Konten -->
                        <a href="{{ route('penggunaMasjid.lihatKonten.kontenMasjid') }}" 
                           class="group relative flex items-center gap-4 p-4 sm:p-5 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-green-600/30 rounded-2xl transition-all duration-300 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] backdrop-blur-md overflow-hidden">
                            <!-- Glow Line Hover Effect -->
                            <div class="absolute inset-0 w-1 bg-gradient-to-b from-green-600 to-green-300 transform scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-center rounded-l-2xl"></div>
                            
                            <!-- Icon Wrapper -->
                            <div class="p-3 bg-green-600/10 border border-green-600/20 rounded-xl text-green-300 group-hover:bg-green-600 group-hover:text-white transition-all duration-300 group-hover:scale-110 shadow-lg">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 transition-transform duration-300 group-hover:rotate-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 4a2 2 0 00-2-2h-3m3 3l-3-3m3 3H9m12 4a2 2 0 01-2 2h-3m3-3l-3 3m3-3H9"/>
                                </svg>
                            </div>
                            
                            <div class="flex-grow">
                                <h3 class="font-bold text-white text-base sm:text-lg group-hover:text-green-300 transition-colors">
                                    Update Konten Terbaru
                                </h3>
                                <p class="text-slate-300 text-xs sm:text-sm mt-0.5 group-hover:text-white transition-colors">
                                    Jelajahi artikel Islami, pengumuman kegiatan, dan informasi remaja masjid terkini.
                                </p>
                            </div>
                            <div class="text-slate-400 group-hover:text-green-300 transition-colors transform group-hover:translate-x-1 duration-300">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </a>
                        
                        <!-- Card 2: Keuangan Transparansi -->
                        <a href="{{ route('penggunaMasjid.keuanganMasjid.index') }}" 
                           class="group relative flex items-center gap-4 p-4 sm:p-5 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-green-600/30 rounded-2xl transition-all duration-300 shadow-[0_8px_32px_0_rgba(0,0,0,0.2)] backdrop-blur-md overflow-hidden">
                            <div class="absolute inset-0 w-1 bg-gradient-to-b from-green-600 to-green-300 transform scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-center rounded-l-2xl"></div>
                            
                            <div class="p-3 bg-green-600/10 border border-green-600/20 rounded-xl text-green-300 group-hover:bg-green-600 group-hover:text-white transition-all duration-300 group-hover:scale-110 shadow-lg">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 transition-transform duration-300 group-hover:rotate-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            
                            <div class="flex-grow">
                                <h3 class="font-bold text-white text-base sm:text-lg group-hover:text-green-300 transition-colors">
                                    Laporan Keuangan Transparan
                                </h3>
                                <p class="text-slate-300 text-xs sm:text-sm mt-0.5 group-hover:text-white transition-colors">
                                    Bentuk transparansi kami berupa rincian pemasukan dan pengeluaran dana kas masjid secara realtime.
                                </p>
                            </div>
                            <div class="text-slate-400 group-hover:text-green-300 transition-colors transform group-hover:translate-x-1 duration-300">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </a>
                        
                        <!-- Card 3: Donasi -->
                        <a href="{{ route('penggunaMasjid.donasi.index') }}" 
                           class="group relative flex items-center gap-4 p-4 sm:p-5 bg-gradient-to-r from-green-600/20 to-green-300/20 hover:from-green-600/30 hover:to-green-300/30 border border-green-600/25 hover:border-green-300/35 rounded-2xl transition-all duration-300 shadow-[0_8px_32px_0_rgba(22,163,74,0.15)] backdrop-blur-md overflow-hidden">
                            <!-- Pulse light effect on hover -->
                            <div class="absolute inset-0 bg-gradient-to-r from-green-600/0 via-white/10 to-green-600/0 -translate-x-full group-hover:animate-[shimmer_1.5s_infinite] pointer-events-none"></div>
                            
                            <div class="p-3 bg-green-600/20 border border-green-300/30 rounded-xl text-green-300 group-hover:bg-green-600 group-hover:text-white transition-all duration-300 group-hover:scale-110 shadow-lg">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            
                            <div class="flex-grow">
                                <h3 class="font-bold text-white text-base sm:text-lg group-hover:text-green-300 transition-colors flex items-center gap-2">
                                    Salurkan Donasi Terbaik Anda
                                    <span class="inline-flex h-2 w-2 rounded-full bg-green-300 animate-ping"></span>
                                </h3>
                                <p class="text-slate-300 text-xs sm:text-sm mt-0.5 group-hover:text-white transition-colors">
                                    Bantu pembangunan dan kelancaran kegiatan dakwah serta pemeliharaan Masjid.
                                </p>
                            </div>
                            <div class="text-green-300 group-hover:text-green-300 transition-colors transform group-hover:translate-x-1 duration-300">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container mx-auto px-4 py-8 sm:py-12 max-w-7xl">

        {{-- Visi Misi & Profil Navigation Section --}}
        <div class="mb-12 sm:mb-16">
            <!-- Header -->
            <div class="flex items-center gap-2 sm:gap-3 mb-6 sm:mb-8 welcome-reveal opacity-0 transform translate-y-8 transition-all duration-1000 ease-out">
                <div class="w-1 h-6 sm:h-8 bg-gradient-to-b from-green-300 to-green-600 rounded-full"></div>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800 font-montserrat">Profil & Visi Misi Masjid</h2>
            </div>

            @if(isset($visiMisi) && $visiMisi)
            <!-- Visi & Misi Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 mb-8 sm:mb-12">
                <!-- Visi Card -->
                <div class="group relative bg-white rounded-2xl shadow-md border border-green-300/20 p-6 sm:p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 welcome-reveal opacity-0 transform translate-y-8 transition-all duration-1000 ease-out delay-100">
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-green-600 to-green-300 rounded-t-2xl"></div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2.5 bg-green-300/15 text-green-600 rounded-xl">
                            <i class="fas fa-eye text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 font-montserrat">Visi</h3>
                    </div>
                    <div class="text-gray-600 text-sm sm:text-base leading-relaxed line-clamp-4 prose max-w-none font-quicksand">
                        {!! strip_tags($visiMisi->visi, '<p><br><strong><b><i><em><ul><li><ol>') !!}
                    </div>
                </div>

                <!-- Misi Card -->
                <div class="group relative bg-white rounded-2xl shadow-md border border-green-300/20 p-6 sm:p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 welcome-reveal opacity-0 transform translate-y-8 transition-all duration-1000 ease-out delay-200">
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-green-300 to-green-600 rounded-t-2xl"></div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2.5 bg-green-300/15 text-green-600 rounded-xl">
                            <i class="fas fa-bullseye text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 font-montserrat">Misi</h3>
                    </div>
                    <div class="text-gray-600 text-sm sm:text-base leading-relaxed line-clamp-4 prose max-w-none font-quicksand">
                        {!! strip_tags($visiMisi->misi, '<p><br><strong><b><i><em><ul><li><ol>') !!}
                    </div>
                </div>
            </div>
            @endif

            <!-- Navigation Buttons -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 welcome-reveal opacity-0 transform translate-y-8 transition-all duration-1000 ease-out delay-300">
                <!-- Button 1: Visi Misi -->
                <a href="{{ route('penggunaMasjid.profile.visiMisiMasjid') }}" 
                   class="group flex items-center justify-between p-4 sm:p-5 bg-gradient-to-br from-white to-green-300/5 hover:to-green-300/15 border border-green-300/20 hover:border-green-600/30 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-green-300/15 text-green-600 rounded-xl group-hover:bg-green-600 group-hover:text-white transition-all duration-300 group-hover:scale-110">
                            <i class="fas fa-scroll text-lg"></i>
                        </div>
                        <div>
                            <span class="block font-bold text-gray-800 text-sm sm:text-base font-montserrat">Detail Visi & Misi</span>
                            <span class="block text-xs text-gray-500 font-quicksand mt-0.5">Lihat rincian visi & misi masjid</span>
                        </div>
                    </div>
                    <div class="text-gray-400 group-hover:text-green-600 transition-colors transform group-hover:translate-x-1 duration-300">
                        <i class="fas fa-arrow-right text-lg"></i>
                    </div>
                </a>

                <!-- Button 2: Sejarah -->
                <a href="{{ route('penggunaMasjid.profile.sejarahMasjid') }}" 
                   class="group flex items-center justify-between p-4 sm:p-5 bg-gradient-to-br from-white to-green-300/5 hover:to-green-300/15 border border-green-300/20 hover:border-green-600/30 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-green-300/15 text-green-600 rounded-xl group-hover:bg-green-600 group-hover:text-white transition-all duration-300 group-hover:scale-110">
                            <i class="fas fa-history text-lg"></i>
                        </div>
                        <div>
                            <span class="block font-bold text-gray-800 text-sm sm:text-base font-montserrat">Sejarah Masjid</span>
                            <span class="block text-xs text-gray-500 font-quicksand mt-0.5">Kisah perjalanan & pendirian masjid</span>
                        </div>
                    </div>
                    <div class="text-gray-400 group-hover:text-green-600 transition-colors transform group-hover:translate-x-1 duration-300">
                        <i class="fas fa-arrow-right text-lg"></i>
                    </div>
                </a>

                <!-- Button 3: Struktur DKM -->
                <a href="{{ route('penggunaMasjid.profile.strukturDkm') }}" 
                   class="group flex items-center justify-between p-4 sm:p-5 bg-gradient-to-br from-white to-green-300/5 hover:to-green-300/15 border border-green-300/20 hover:border-green-600/30 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-green-300/15 text-green-600 rounded-xl group-hover:bg-green-600 group-hover:text-white transition-all duration-300 group-hover:scale-110">
                            <i class="fas fa-sitemap text-lg"></i>
                        </div>
                        <div>
                            <span class="block font-bold text-gray-800 text-sm sm:text-base font-montserrat">Struktur DKM</span>
                            <span class="block text-xs text-gray-500 font-quicksand mt-0.5">Susunan kepengurusan dewan kemakmuran</span>
                        </div>
                    </div>
                    <div class="text-gray-400 group-hover:text-green-600 transition-colors transform group-hover:translate-x-1 duration-300">
                        <i class="fas fa-arrow-right text-lg"></i>
                    </div>
                </a>
            </div>
        </div>

        {{-- Divider --}}
        <div class="my-6 sm:my-8 md:my-12" aria-hidden="true">
            <svg class="w-full" height="8" viewBox="0 0 100 10" preserveAspectRatio="none">
              <path d="M0 5 Q 12.5 0, 25 5 T 50 5 T 75 5 T 100 5" stroke-width="2" stroke-linecap="round" class="stroke-current text-green-300" fill="none" />
            </svg>
        </div>

        {{-- Latest Content - Redesigned --}}
        <div class="relative rounded-3xl overflow-hidden py-12 sm:py-16 px-4 sm:px-8 md:px-12" style="background: linear-gradient(135deg, #f0fdf4 0%, #86efac 35%, #16a34a 100%);">
            {{-- Warm decorative elements --}}
            <div class="absolute top-0 right-0 w-72 h-72 bg-green-300/30 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-green-300/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-green-300/10 rounded-full blur-3xl pointer-events-none"></div>
            
            {{-- Subtle pattern overlay --}}
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23000000\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

            <div class="relative z-10">
                {{-- Section Header --}}
                <div class="flex items-center gap-3 mb-8 sm:mb-10">
                    <div class="w-1.5 h-8 sm:h-10 bg-gradient-to-b from-green-600 to-green-800 rounded-full"></div>
                    <div>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-900 tracking-tight font-montserrat">Konten Terbaru</h2>
                        <p class="text-green-900/80 text-sm sm:text-base mt-1 font-quicksand">Baca artikel terpopuler dan terbaru dari kami</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
                    
                    {{-- LEFT: Popular Article Carousel --}}
                    <div class="lg:col-span-7 xl:col-span-8">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"/>
                            </svg>
                            <h3 class="text-lg sm:text-xl font-bold text-green-900 font-montserrat">Populer Bulan Ini</h3>
                        </div>
                        
                        @if(isset($artikelPopuler) && $artikelPopuler->isNotEmpty())
                        <div class="relative group/carousel">
                            {{-- Carousel Container --}}
                            <div class="overflow-hidden rounded-2xl shadow-2xl">
                                <div id="populer-carousel" class="flex transition-transform duration-700 ease-in-out" style="will-change: transform;">
                                    @foreach($artikelPopuler as $idx => $populer)
                                    <div class="populer-slide w-full flex-shrink-0 relative" style="min-height: 360px;">
                                        {{-- Background Image --}}
                                        <img src="{{ asset('storage/' . $populer->gambar) }}" 
                                             alt="{{ $populer->judul }}"
                                             class="absolute inset-0 w-full h-full object-cover">
                                        
                                        {{-- Gradient Overlay --}}
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-black/10"></div>
                                        
                                        {{-- Content --}}
                                        <div class="relative z-10 flex flex-col justify-end h-full p-6 sm:p-8 md:p-10">
                                            {{-- Badge --}}
                                            <div class="flex items-center gap-2 mb-3">
                                                <span class="inline-flex items-center gap-1.5 bg-green-600/90 backdrop-blur-sm text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg font-quicksand">
                                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"/>
                                                    </svg>
                                                    #{{ $idx + 1 }} Populer
                                                </span>
                                                <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-medium px-3 py-1.5 rounded-full font-quicksand">
                                                    {{ $populer->created_at->translatedFormat('F Y') }}
                                                </span>
                                            </div>
                                            
                                            {{-- Title --}}
                                            <a href="{{ route('konten.show', ['type' => 'artikel', 'id' => $populer->id]) }}" class="group/link">
                                                <h4 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white mb-3 leading-tight group-hover/link:text-green-300 transition-colors duration-300 line-clamp-2 font-montserrat">
                                                    {{ $populer->judul }}
                                                </h4>
                                            </a>
                                            
                                            {{-- Meta --}}
                                            <div class="flex items-center gap-4 text-white/80 text-sm font-quicksand">
                                                <div class="flex items-center gap-1.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    <span>{{ $populer->created_at->format('d M Y') }}</span>
                                                </div>
                                                <div class="flex items-center gap-1.5">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    <span>{{ number_format($populer->views ?? 0) }} views</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Carousel Navigation Arrows --}}
                            @if($artikelPopuler->count() > 1)
                            <button id="populer-prev" class="absolute top-1/2 left-3 -translate-y-1/2 z-20 bg-white/90 hover:bg-white text-green-600 hover:text-green-700 rounded-full p-2.5 shadow-xl transition-all duration-300 opacity-0 group-hover/carousel:opacity-100 backdrop-blur-sm hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button id="populer-next" class="absolute top-1/2 right-3 -translate-y-1/2 z-20 bg-white/90 hover:bg-white text-green-600 hover:text-green-700 rounded-full p-2.5 shadow-xl transition-all duration-300 opacity-0 group-hover/carousel:opacity-100 backdrop-blur-sm hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                            @endif

                            {{-- Carousel Dots --}}
                            @if($artikelPopuler->count() > 1)
                            <div class="flex justify-center gap-2.5 mt-5">
                                @foreach($artikelPopuler as $idx => $populer)
                                <button class="populer-dot w-2.5 h-2.5 rounded-full transition-all duration-300 {{ $idx === 0 ? 'bg-green-600 w-8' : 'bg-green-600/30 hover:bg-green-600/50' }}" data-slide="{{ $idx }}"></button>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="bg-white/40 backdrop-blur-sm rounded-2xl p-8 sm:p-12 text-center border border-green-300/30">
                            <svg class="w-16 h-16 mx-auto text-green-300/80 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-green-900 font-medium font-quicksand">Belum ada artikel populer bulan ini.</p>
                        </div>
                        @endif
                    </div>

                    {{-- RIGHT: Latest Articles --}}
                    <div class="lg:col-span-5 xl:col-span-4">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="text-lg sm:text-xl font-bold text-green-900 font-montserrat">Artikel Terbaru</h3>
                        </div>

                        <div class="space-y-4">
                            @forelse($artikelTerbaru as $idx => $terbaru)
                            <a href="{{ route('konten.show', ['type' => 'artikel', 'id' => $terbaru->id]) }}" 
                               class="group flex gap-4 bg-white/60 hover:bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-4 border border-green-300/40 hover:border-green-600/55 shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                
                                {{-- Thumbnail --}}
                                <div class="relative flex-shrink-0 w-24 h-24 sm:w-28 sm:h-28 rounded-xl overflow-hidden">
                                    <img src="{{ asset('storage/' . $terbaru->gambar) }}" 
                                         alt="{{ $terbaru->judul }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                    {{-- Number Badge --}}
                                    <div class="absolute top-1.5 left-1.5 w-6 h-6 bg-green-600 text-white text-xs font-bold rounded-full flex items-center justify-center shadow-md">
                                        {{ $idx + 1 }}
                                    </div>
                                </div>
                                
                                {{-- Content --}}
                                <div class="flex-grow flex flex-col justify-center min-w-0">
                                    <span class="inline-flex items-center text-[10px] sm:text-xs font-semibold text-green-600 bg-green-300/20 px-2 py-0.5 rounded-full w-fit mb-1.5 font-quicksand">
                                        Artikel
                                    </span>
                                    <h4 class="text-sm sm:text-base font-bold text-gray-800 group-hover:text-green-600 transition-colors line-clamp-2 leading-snug mb-1.5 font-montserrat">
                                        {{ $terbaru->judul }}
                                    </h4>
                                    <div class="flex items-center gap-3 text-xs text-gray-500 font-quicksand">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span>{{ $terbaru->created_at->format('d M Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            <span>{{ $terbaru->views ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Arrow --}}
                                <div class="flex-shrink-0 self-center text-green-300 group-hover:text-green-600 transition-all transform group-hover:translate-x-1 duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </a>
                            @empty
                            <div class="bg-white/40 backdrop-blur-sm rounded-2xl p-8 text-center border border-green-300/30">
                                <svg class="w-12 h-12 mx-auto text-green-300/70 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-green-900 font-medium text-sm font-quicksand">Belum ada artikel terbaru.</p>
                            </div>
                            @endforelse
                        </div>

                        {{-- View All Button --}}
                        <a href="{{ route('penggunaMasjid.lihatKonten.kontenMasjid') }}" 
                           class="group flex items-center justify-center gap-2 mt-6 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                            <span class="font-montserrat">Lihat Semua Artikel</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="my-6 sm:my-8 md:my-12" aria-hidden="true">
            <svg class="w-full" height="8" viewBox="0 0 100 10" preserveAspectRatio="none">
              <path d="M0 5 Q 12.5 0, 25 5 T 50 5 T 75 5 T 100 5" stroke-width="2" stroke-linecap="round" class="stroke-current text-green-300" fill="none" />
            </svg>
        </div>

        {{-- ============================================= --}}
        {{-- 💰 KEUANGAN MASJID OVERVIEW SECTION          --}}
        {{-- ============================================= --}}
        <div class="relative rounded-3xl overflow-hidden py-12 sm:py-16 px-4 sm:px-8 md:px-12 mb-8 sm:mb-12" style="background: linear-gradient(135deg, #f0fdf4 0%, #86efac 35%, #16a34a 100%);">
            {{-- Decorative elements --}}
            <div class="absolute top-0 right-0 w-72 h-72 bg-green-300/30 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-green-300/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-green-300/10 rounded-full blur-3xl pointer-events-none"></div>

            {{-- Subtle pattern overlay --}}
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23000000\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M20 20.5c0-.276.224-.5.5-.5s.5.224.5.5-.224.5-.5.5-.5-.224-.5-.5zM0 0h40v40H0V0zm20 10a10 10 0 100 20 10 10 0 000-20z\'/%3E%3C/g%3E%3C/svg%3E');"></div>

            <div class="relative z-10">
                {{-- Section Header --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 sm:mb-10">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-8 sm:h-10 bg-gradient-to-b from-green-600 to-green-800 rounded-full"></div>
                        <div>
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-900 tracking-tight font-montserrat">Keuangan Masjid</h2>
                            <p class="text-green-800/80 text-sm sm:text-base mt-1 font-quicksand">Transparansi pemasukan & pengeluaran tahun {{ $tahunKeuangan }}</p>
                        </div>
                    </div>
                    <a href="{{ route('penggunaMasjid.keuanganMasjid.index') }}" 
                       class="group inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 self-start sm:self-auto">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="font-montserrat text-sm sm:text-base">Lihat Laporan Lengkap</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
                    
                    {{-- LEFT: Chart --}}
                    <div class="lg:col-span-8">
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-green-300/40 p-4 sm:p-6">
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                                </svg>
                                <h3 class="text-lg sm:text-xl font-bold text-green-900 font-montserrat">Grafik Keuangan {{ $tahunKeuangan }}</h3>
                            </div>
                            <div class="w-full overflow-x-auto">
                                <div style="min-width: 500px; height: 280px;">
                                    <canvas id="homeFinanceChart"></canvas>
                                </div>
                            </div>
                        </div>

                        {{-- Summary Cards --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4 sm:mt-6">
                            {{-- Pemasukan --}}
                            <div class="bg-white/70 backdrop-blur-sm rounded-xl border border-green-300/40 p-4 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="p-2 bg-green-300/20 rounded-lg">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-semibold text-green-700 font-quicksand uppercase tracking-wide">Pemasukan</span>
                                </div>
                                <p class="text-lg sm:text-xl font-bold text-green-900 font-montserrat">
                                    Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-green-600/70 font-quicksand mt-1">Bulan {{ Carbon\Carbon::now()->translatedFormat('F') }}</p>
                            </div>

                            {{-- Pengeluaran --}}
                            <div class="bg-white/70 backdrop-blur-sm rounded-xl border border-red-200/50 p-4 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="p-2 bg-red-100 rounded-lg">
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-semibold text-red-600 font-quicksand uppercase tracking-wide">Pengeluaran</span>
                                </div>
                                <p class="text-lg sm:text-xl font-bold text-red-700 font-montserrat">
                                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-red-500/70 font-quicksand mt-1">Bulan {{ Carbon\Carbon::now()->translatedFormat('F') }}</p>
                            </div>

                            {{-- Saldo --}}
                            <div class="bg-white/70 backdrop-blur-sm rounded-xl border border-blue-200/50 p-4 shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="p-2 bg-blue-100 rounded-lg">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-semibold text-blue-600 font-quicksand uppercase tracking-wide">Saldo</span>
                                </div>
                                <p class="text-lg sm:text-xl font-bold {{ $saldoAkhir >= 0 ? 'text-blue-700' : 'text-orange-600' }} font-montserrat">
                                    Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-blue-500/70 font-quicksand mt-1">Bulan {{ Carbon\Carbon::now()->translatedFormat('F') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT: Top 3 Donatur --}}
                    <div class="lg:col-span-4">
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-green-200/50 p-5 sm:p-6 h-full flex flex-col justify-between">
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-lg shadow-md">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </div>
                                    <h3 id="donatur-carousel-title" class="text-base sm:text-lg font-bold text-green-900 font-montserrat transition-all duration-300">Top Donatur</h3>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <button id="donatur-prev-btn" class="p-1.5 rounded-lg bg-green-300/10 hover:bg-green-300/25 text-green-600 hover:text-green-700 transition-colors border border-green-300/20 shadow-sm" aria-label="Sebelumnya">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                    </button>
                                    <button id="donatur-next-btn" class="p-1.5 rounded-lg bg-green-300/10 hover:bg-green-300/25 text-green-600 hover:text-green-700 transition-colors border border-green-300/20 shadow-sm" aria-label="Selanjutnya">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="overflow-hidden w-full flex-grow">
                                <div id="donatur-slider" class="flex transition-transform duration-500 ease-out w-full">
                                    
                                    {{-- Slide 1: Top Donatur (All Time) --}}
                                    <div class="w-full flex-shrink-0 flex flex-col justify-between">
                                        @if(isset($topDonatur) && $topDonatur->isNotEmpty())
                                        <div class="space-y-4">
                                            @foreach($topDonatur as $idx => $donatur)
                                            <div class="group relative flex items-center gap-4 p-3.5 sm:p-4 rounded-xl transition-all duration-300 hover:-translate-y-0.5
                                                {{ $idx === 0 ? 'bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-200/60 shadow-md hover:shadow-lg' : 'bg-green-300/5 border border-green-300/20 shadow-sm hover:shadow-md' }}">
                                                
                                                {{-- Rank Badge --}}
                                                <div class="flex-shrink-0 w-10 h-10 sm:w-11 sm:h-11 rounded-full flex items-center justify-center font-extrabold text-lg shadow-md
                                                    {{ $idx === 0 ? 'bg-gradient-to-br from-yellow-400 to-amber-500 text-white' : ($idx === 1 ? 'bg-gradient-to-br from-gray-300 to-gray-400 text-white' : 'bg-gradient-to-br from-amber-600 to-amber-700 text-white') }}">
                                                    {{ $idx + 1 }}
                                                </div>

                                                <div class="flex-grow min-w-0">
                                                    <p class="font-bold text-gray-800 text-sm sm:text-base truncate font-montserrat">{{ $donatur->nama_donatur }}</p>
                                                    <p class="text-green-600 font-semibold text-sm font-quicksand mt-0.5">
                                                        Rp {{ number_format($donatur->nominal, 0, ',', '.') }}
                                                    </p>
                                                    @if($donatur->pesan)
                                                    <p class="text-gray-500 text-xs font-quicksand mt-1 line-clamp-1 italic">"{{ $donatur->pesan }}"</p>
                                                    @endif
                                                </div>

                                                {{-- Medal icon for #1 --}}
                                                @if($idx === 0)
                                                <div class="flex-shrink-0 text-yellow-500">
                                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v14l3.5-2 3.5 2 3.5-2 3.5 2V4a2 2 0 00-2-2H5zm4.707 3.707a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L8.414 9H10a3 3 0 013 3v1a1 1 0 102 0v-1a5 5 0 00-5-5H8.414l1.293-1.293z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                        @else
                                        <div class="flex flex-col items-center justify-center text-center py-8">
                                            <div class="p-3 bg-green-300/20 rounded-full mb-3">
                                                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                            </div>
                                            <p class="text-green-800 font-medium text-sm font-quicksand">Belum ada data donatur.</p>
                                        </div>
                                        @endif
                                    </div>

                                    {{-- Slide 2: Top Donatur Bulan Ini --}}
                                    <div class="w-full flex-shrink-0 flex flex-col justify-between px-0.5">
                                        @if(isset($topDonaturBulanIni) && $topDonaturBulanIni->isNotEmpty())
                                        <div class="space-y-4">
                                            @foreach($topDonaturBulanIni as $idx => $donatur)
                                            <div class="group relative flex items-center gap-4 p-3.5 sm:p-4 rounded-xl transition-all duration-300 hover:-translate-y-0.5
                                                {{ $idx === 0 ? 'bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-200/60 shadow-md hover:shadow-lg' : 'bg-green-300/5 border border-green-300/20 shadow-sm hover:shadow-md' }}">
                                                
                                                {{-- Rank Badge --}}
                                                <div class="flex-shrink-0 w-10 h-10 sm:w-11 sm:h-11 rounded-full flex items-center justify-center font-extrabold text-lg shadow-md
                                                    {{ $idx === 0 ? 'bg-gradient-to-br from-yellow-400 to-amber-500 text-white' : ($idx === 1 ? 'bg-gradient-to-br from-gray-300 to-gray-400 text-white' : 'bg-gradient-to-br from-amber-600 to-amber-700 text-white') }}">
                                                    {{ $idx + 1 }}
                                                </div>

                                                <div class="flex-grow min-w-0">
                                                    <p class="font-bold text-gray-800 text-sm sm:text-base truncate font-montserrat">{{ $donatur->nama_donatur }}</p>
                                                    <p class="text-green-600 font-semibold text-sm font-quicksand mt-0.5">
                                                        Rp {{ number_format($donatur->nominal, 0, ',', '.') }}
                                                    </p>
                                                    @if($donatur->pesan)
                                                    <p class="text-gray-500 text-xs font-quicksand mt-1 line-clamp-1 italic">"{{ $donatur->pesan }}"</p>
                                                    @endif
                                                </div>

                                                {{-- Medal icon for #1 --}}
                                                @if($idx === 0)
                                                <div class="flex-shrink-0 text-yellow-500">
                                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v14l3.5-2 3.5 2 3.5-2 3.5 2V4a2 2 0 00-2-2H5zm4.707 3.707a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L8.414 9H10a3 3 0 013 3v1a1 1 0 102 0v-1a5 5 0 00-5-5H8.414l1.293-1.293z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                        @else
                                        <div class="flex flex-col items-center justify-center text-center py-8">
                                            <div class="p-3 bg-green-300/20 rounded-full mb-3">
                                                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                            </div>
                                            <p class="text-green-800 font-medium text-sm font-quicksand">Belum ada data donatur bulan ini.</p>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            {{-- Donasi CTA --}}
                            <a href="{{ route('penggunaMasjid.donasi.index') }}" 
                               class="group mt-5 flex items-center justify-center gap-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-3 px-5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 w-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="font-montserrat text-sm">Donasi Sekarang</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="my-6 sm:my-8 md:my-12" aria-hidden="true">
            <svg class="w-full" height="8" viewBox="0 0 100 10" preserveAspectRatio="none">
              <path d="M0 5 Q 12.5 0, 25 5 T 50 5 T 75 5 T 100 5" stroke-width="2" stroke-linecap="round" class="stroke-current text-green-300" fill="none" />
            </svg>
        </div>

        {{-- ============================================= --}}
        {{-- 🕌 IMAM SCHEDULE - REDESIGNED                --}}
        {{-- ============================================= --}}
        <div class="relative rounded-3xl overflow-hidden py-12 sm:py-16 px-4 sm:px-8 md:px-12" style="background: linear-gradient(135deg, #f0fdf4 0%, #86efac 40%, #16a34a 100%);">
            {{-- Decorative elements --}}
            <div class="absolute top-0 left-0 w-80 h-80 bg-green-300/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-green-300/15 rounded-full blur-3xl pointer-events-none"></div>
            
            {{-- Islamic pattern overlay --}}
            <div class="absolute inset-0 opacity-[0.04]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23166534\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

            <div class="relative z-10">
                {{-- Section Header --}}
                <div class="flex items-center gap-3 mb-8 sm:mb-10">
                    <div class="w-1.5 h-8 sm:h-10 bg-gradient-to-b from-green-600 to-green-800 rounded-full"></div>
                    <div>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-green-900 tracking-tight font-montserrat">Jadwal Imam</h2>
                        <p class="text-green-800/80 text-sm sm:text-base mt-1 font-quicksand">Informasi imam shalat berjamaah di masjid</p>
                    </div>
                </div>

                @if(isset($jadwalImam) && $jadwalImam->isNotEmpty())
                    
                    {{-- Carousel for > 3 items --}}
                    @if($jadwalImam->count() > 3)
                    <div class="relative group/imam-carousel">
                        <div id="jadwal-imam-container" class="overflow-hidden rounded-2xl">
                            <div id="jadwal-imam-slider" class="flex transition-transform duration-500 ease-out">
                                @foreach($jadwalImam as $jadwal)
                                <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-2 md:px-3">
                                    <div class="group bg-white/80 backdrop-blur-sm border border-green-300/40 rounded-2xl p-5 sm:p-6 flex flex-col items-center text-center shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1.5 hover:bg-white/95">
                                        {{-- Image with glow --}}
                                        <div class="relative mb-4 sm:mb-5">
                                            <div class="absolute inset-0 bg-green-300 rounded-full blur-2xl opacity-15 group-hover:opacity-25 transition-opacity duration-500"></div>
                                            <div class="relative">
                                                <img src="{{ $jadwal->gambar ? asset('storage/'.$jadwal->gambar) : 'https://ui-avatars.com/api/?name='.urlencode($jadwal->nama).'&background=16a34a&color=fff&bold=true' }}" 
                                                     class="relative w-24 h-24 sm:w-28 sm:h-28 object-cover rounded-full shadow-xl ring-4 ring-white group-hover:ring-green-300 transition-all duration-500 group-hover:scale-105" 
                                                     alt="{{ $jadwal->nama }}">
                                                {{-- Online indicator --}}
                                                <div class="absolute -bottom-1 -right-1 w-7 h-7 bg-gradient-to-br from-green-300 to-green-600 rounded-full border-3 border-white shadow-md flex items-center justify-center">
                                                    <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2 font-montserrat group-hover:text-green-700 transition-colors duration-300">{{ $jadwal->nama }}</h3>
                                        
                                        {{-- Prayer time badge --}}
                                        <div class="inline-flex items-center gap-1.5 bg-gradient-to-r from-green-300/25 to-green-300/5 border border-green-300/35 text-green-600 px-4 py-1.5 rounded-full shadow-sm">
                                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span class="font-semibold text-sm font-quicksand">{{ $jadwal->waktu_sholat }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <button id="prev-btn" class="absolute top-1/2 -left-2 sm:-left-4 -translate-y-1/2 z-20 bg-white/90 hover:bg-white text-green-600 hover:text-green-700 rounded-full p-2.5 sm:p-3 shadow-xl transition-all duration-300 opacity-0 group-hover/imam-carousel:opacity-100 backdrop-blur-sm hover:scale-110 disabled:opacity-30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        
                        <button id="next-btn" class="absolute top-1/2 -right-2 sm:-right-4 -translate-y-1/2 z-20 bg-white/90 hover:bg-white text-green-600 hover:text-green-700 rounded-full p-2.5 sm:p-3 shadow-xl transition-all duration-300 opacity-0 group-hover/imam-carousel:opacity-100 backdrop-blur-sm hover:scale-110 disabled:opacity-30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                    {{-- Grid for <= 3 items --}}
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                        @foreach($jadwalImam as $jadwal)
                        <div class="group bg-white/80 backdrop-blur-sm border border-green-300/40 rounded-2xl p-5 sm:p-6 flex flex-col items-center text-center shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1.5 hover:bg-white/95">
                            {{-- Image with glow --}}
                            <div class="relative mb-4 sm:mb-5">
                                <div class="absolute inset-0 bg-green-300 rounded-full blur-2xl opacity-15 group-hover:opacity-25 transition-opacity duration-500"></div>
                                <div class="relative">
                                    <img src="{{ $jadwal->gambar ? asset('storage/'.$jadwal->gambar) : 'https://ui-avatars.com/api/?name='.urlencode($jadwal->nama).'&background=16a34a&color=fff&bold=true' }}" 
                                         class="relative w-24 h-24 sm:w-28 sm:h-28 object-cover rounded-full shadow-xl ring-4 ring-white group-hover:ring-green-300 transition-all duration-500 group-hover:scale-105" 
                                         alt="{{ $jadwal->nama }}">
                                    {{-- Online indicator --}}
                                    <div class="absolute -bottom-1 -right-1 w-7 h-7 bg-gradient-to-br from-green-300 to-green-600 rounded-full border-3 border-white shadow-md flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2 font-montserrat group-hover:text-green-700 transition-colors duration-300">{{ $jadwal->nama }}</h3>
                            
                            {{-- Prayer time badge --}}
                            <div class="inline-flex items-center gap-1.5 bg-gradient-to-r from-green-300/25 to-green-300/5 border border-green-300/35 text-green-600 px-4 py-1.5 rounded-full shadow-sm">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-semibold text-sm font-quicksand">{{ $jadwal->waktu_sholat }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                @else
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-8 sm:p-12 text-center border border-green-300/30 shadow-md">
                        <div class="p-4 bg-green-300/20 rounded-full w-fit mx-auto mb-4">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-green-900 font-semibold text-base sm:text-lg font-montserrat">Belum ada jadwal imam</p>
                        <p class="text-green-600/70 font-medium text-sm font-quicksand mt-1">Jadwal imam shalat belum ditambahkan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<style>
    /* Global Typography Revisions */
    body, html, main, .font-quicksand, p, span, a, li, div, button, input, select, textarea {
        font-family: 'Quicksand', sans-serif !important;
    }
    
    h1, h2, h3, h4, h5, h6, .font-montserrat, .font-montserrat * {
        font-family: 'Montserrat', sans-serif !important;
    }

    @keyframes shimmer {
        100% {
            transform: translateX(100%);
        }
    }
    
    .welcome-reveal.revealed {
        opacity: 1 !important;
        transform: translateY(0) !important;
    }
</style>
<script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- WELCOME SECTION REVEAL ANIMATION ---
        const reveals = document.querySelectorAll('.welcome-reveal');
        
        const revealOnScroll = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.05,
            rootMargin: '0px 0px -30px 0px'
        });
        
        reveals.forEach(el => revealOnScroll.observe(el));
        
        // Fallback for older browsers or immediate display
        setTimeout(() => {
            reveals.forEach(el => {
                if (!el.classList.contains('revealed')) {
                    el.classList.add('revealed');
                }
            });
        }, 850);

        // --- WELCOME SECTION PARALLAX BACKGROUND ---
        const parallaxBg = document.getElementById('welcome-parallax-bg');
        if (parallaxBg) {
            const parent = parallaxBg.parentElement;
            
            function updateParallax() {
                const rect = parent.getBoundingClientRect();
                const viewHeight = window.innerHeight;
                
                if (rect.top < viewHeight && rect.bottom > 0) {
                    const totalScrollHeight = rect.height + viewHeight;
                    const scrolledDistance = viewHeight - rect.top;
                    const scrollFactor = scrolledDistance / totalScrollHeight;
                    
                    // Translate background vertically within the container limits (-15% to +15%)
                    const maxTranslateY = 15; // percentage
                    const translateYVal = (scrollFactor * 2 - 1) * maxTranslateY;
                    
                    parallaxBg.style.transform = `translateY(${translateYVal}%) scale(1.1)`;
                }
            }
            
            window.addEventListener('scroll', updateParallax, { passive: true });
            window.addEventListener('resize', updateParallax);
            updateParallax();
        }
    });
</script>

{{-- Popular Articles Carousel Script --}}
@if(isset($artikelPopuler) && $artikelPopuler->count() > 1)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.getElementById('populer-carousel');
        if (!carousel) return;

        const slides = carousel.querySelectorAll('.populer-slide');
        const dots = document.querySelectorAll('.populer-dot');
        const prevBtn = document.getElementById('populer-prev');
        const nextBtn = document.getElementById('populer-next');
        const totalSlides = slides.length;
        let currentSlide = 0;
        let autoPlayInterval;

        function goToSlide(index) {
            if (index < 0) index = totalSlides - 1;
            if (index >= totalSlides) index = 0;
            currentSlide = index;
            carousel.style.transform = `translateX(-${currentSlide * 100}%)`;

            // Update dots
            dots.forEach((dot, i) => {
                if (i === currentSlide) {
                    dot.classList.add('bg-green-600', 'w-8');
                    dot.classList.remove('bg-green-600/30', 'hover:bg-green-600/50', 'w-2.5');
                } else {
                    dot.classList.remove('bg-green-600', 'w-8');
                    dot.classList.add('bg-green-600/30', 'hover:bg-green-600/50', 'w-2.5');
                }
            });
        }

        function startAutoPlay() {
            stopAutoPlay();
            autoPlayInterval = setInterval(() => {
                goToSlide(currentSlide + 1);
            }, 5000);
        }

        function stopAutoPlay() {
            if (autoPlayInterval) clearInterval(autoPlayInterval);
        }

        // Navigation buttons
        if (prevBtn) prevBtn.addEventListener('click', () => { goToSlide(currentSlide - 1); startAutoPlay(); });
        if (nextBtn) nextBtn.addEventListener('click', () => { goToSlide(currentSlide + 1); startAutoPlay(); });

        // Dot navigation
        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const slideIndex = parseInt(dot.dataset.slide);
                goToSlide(slideIndex);
                startAutoPlay();
            });
        });

        // Pause on hover
        const carouselContainer = carousel.closest('.group\\/carousel');
        if (carouselContainer) {
            carouselContainer.addEventListener('mouseenter', stopAutoPlay);
            carouselContainer.addEventListener('mouseleave', startAutoPlay);
        }

        // Touch/swipe support
        let touchStartX = 0;
        let touchEndX = 0;
        carousel.addEventListener('touchstart', (e) => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
        carousel.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) goToSlide(currentSlide + 1);
                else goToSlide(currentSlide - 1);
                startAutoPlay();
            }
        }, { passive: true });

        startAutoPlay();
    });
</script>
@endif

@if(isset($jadwalImam) && $jadwalImam->count() > 3)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slider = document.getElementById('jadwal-imam-slider');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');

        let currentIndex = 0;
        const totalItems = {{ $jadwalImam->count() }};
        let itemsPerPage = window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1);
        let maxIndex = Math.max(0, totalItems - itemsPerPage);

        function updateSlider() {
            itemsPerPage = window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1);
            maxIndex = Math.max(0, totalItems - itemsPerPage); 

            if (currentIndex > maxIndex) {
                currentIndex = maxIndex;
            }
            
            const itemWidthPercentage = 100 / itemsPerPage;
            slider.style.transform = `translateX(-${currentIndex * itemWidthPercentage}%)`;

            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= maxIndex;

            if (currentIndex === 0) {
                prevBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }

            if (currentIndex >= maxIndex) {
                nextBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        nextBtn.addEventListener('click', () => {
            if (currentIndex < maxIndex) {
                currentIndex++;
                updateSlider();
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        window.addEventListener('resize', () => {
            updateSlider(); 
        });

        updateSlider(); 
    });
</script>
@endif

{{-- Homepage Finance Chart --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('homeFinanceChart');
        if (!ctx) return;

        new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: @json($keuanganLabels),
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: @json($keuanganDataPemasukkan),
                        borderColor: '#16a34a',
                        backgroundColor: 'rgba(22, 163, 74, 0.08)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2.5,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                        pointBackgroundColor: '#16a34a',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($keuanganDataPengeluaran),
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.06)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2.5,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                        pointBackgroundColor: '#ef4444',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                    },
                    {
                        label: 'Saldo',
                        data: @json($keuanganDataSaldo),
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.06)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2.5,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end',
                        labels: {
                            font: { 
                                family: 'Quicksand, system-ui, sans-serif', 
                                size: 12,
                                weight: '600'
                            },
                            boxWidth: 12,
                            boxHeight: 12,
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.85)',
                        padding: 14,
                        borderColor: 'rgba(255, 255, 255, 0.1)',
                        borderWidth: 1,
                        cornerRadius: 12,
                        titleFont: {
                            family: 'Montserrat, sans-serif',
                            size: 13,
                            weight: 'bold'
                        },
                        bodyFont: {
                            family: 'Quicksand, sans-serif',
                            size: 12
                        },
                        callbacks: {
                            label: function(context) {
                                let value = context.raw || 0;
                                return context.dataset.label + ': Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Quicksand, sans-serif',
                                size: 11,
                                weight: '500'
                            },
                            color: '#16a34a'
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(22, 163, 74, 0.08)',
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID', {
                                    notation: 'compact',
                                    compactDisplay: 'short'
                                }).format(value);
                            },
                            font: {
                                family: 'Quicksand, sans-serif',
                                size: 11,
                                weight: '500'
                            },
                            color: '#16a34a'
                        }
                    }
                }
            }
        });

        // --- DONATUR SLIDER CAROUSEL ---
        const donaturSlider = document.getElementById('donatur-slider');
        const donaturTitle = document.getElementById('donatur-carousel-title');
        const donaturPrevBtn = document.getElementById('donatur-prev-btn');
        const donaturNextBtn = document.getElementById('donatur-next-btn');

        if (donaturSlider && donaturTitle && donaturPrevBtn && donaturNextBtn) {
            let donaturIndex = 0; // 0: Top Donatur, 1: Top Donatur Bulan Ini
            const donaturTitles = ['Top Donatur', 'Top Donatur Bulan Ini'];

            function updateDonaturSlider() {
                donaturSlider.style.transform = `translateX(-${donaturIndex * 100}%)`;
                donaturTitle.textContent = donaturTitles[donaturIndex];
            }

            donaturPrevBtn.addEventListener('click', function () {
                donaturIndex = (donaturIndex === 0) ? 1 : 0;
                updateDonaturSlider();
            });

            donaturNextBtn.addEventListener('click', function () {
                donaturIndex = (donaturIndex === 0) ? 1 : 0;
                updateDonaturSlider();
            });
        }
    });
</script>
@endsection