@extends('layouts.penggunaMasjid')

@section('title', 'Masjid Nurul Haq - Beranda')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50 to-slate-50">
    
    {{-- Hero Carousel --}}
    @if(isset($homeSections) && $homeSections->isNotEmpty())
    <div class="relative z-20 ">
        <div id="default-carousel" class="relative w-full" @if($homeSections->count() > 1) data-carousel="slide" @endif>
            {{-- Carousel Wrapper --}}
            <div class="relative h-56 sm:h-64 md:h-80 lg:h-96 overflow-hidden">
                @foreach ($homeSections as $item)
                    <div class="{{ $loop->first ? '' : 'hidden' }} duration-700 ease-in-out" @if($homeSections->count() > 1) data-carousel-item @endif>
                        <div class="absolute inset-0 z-10 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        <img src="{{ Storage::url($item->image_path) }}" class="absolute block object-cover w-full h-full" alt="Gambar Masjid Nurul Haq">
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
                    <img src="{{ asset('images/logo-masjid-nur-haq.png') }}" alt="Logo Masjid Nurul Haq" class="w-12 h-12 sm:w-14 sm:h-14 flex-shrink-0">
                    <div>
                        <h3 class="font-bold text-gray-800 text-base sm:text-lg mb-1">Masjid Nurul Haq</h3>
                        <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">
                            Jl. Alamat Lengkap Masjid Nurul Haq, Kota, Provinsi
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
                        <a href="#" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white px-3 sm:px-5 py-1 sm:py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide transition-colors">
                            Sholeh Hidayat
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
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 text-white py-2.5 sm:py-3 shadow-lg mt-6 sm:mt-8">
        <div class="container mx-auto px-4">
            <div class="flex items-center gap-2 sm:gap-3">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 flex-shrink-0 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                </svg>
                <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" class="font-medium text-sm sm:text-base">
                    {{ $runningText->content }}
                </marquee>
            </div>
        </div>
    </div>
    @endif

    {{-- Welcome Section --}}
    <div class="relative w-full z-10 bg-cover bg-center py-8 sm:py-12 md:py-16 -mt-14 sm:-mt-20 md:-mt-24 lg:-mt-28" style="background-image: url('{{ asset('images/masjid-istiqlal.png') }}');">
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-black/40"></div>
        <div class="relative container mx-auto px-4 max-w-7xl">
            
            <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6 mt-16">
                <div class="w-1 h-6 sm:h-8 bg-gradient-to-b from-emerald-400 to-emerald-500 rounded-full"></div>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-white">Selamat Datang Di Website Masjid Nurul Haq</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 items-center">
                <div class="text-center order-2 md:order-1">
                    <img src="{{ asset('images/logo-masjid-nur-haq.png') }}" alt="Logo Masjid Nurul Haq" class="w-32 h-32 sm:w-48 sm:h-48 md:w-64 md:h-64 object-contain mx-auto transition-transform duration-300 hover:scale-110 drop-shadow-2xl">
                </div>
                
                <div class="order-1 md:order-2">
                    <ul class="space-y-3 sm:space-y-4 mb-4 sm:mb-6">
                        <li>
                            <a href="{{ route('penggunaMasjid.lihatKonten.kontenMasjid') }}" class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 bg-white/95 hover:bg-white rounded-lg sm:rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <span class="font-medium text-gray-800 text-sm sm:text-base">Lihat update konten kami yang terbaru</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('penggunaMasjid.keuanganMasjid.index') }}" class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 bg-white/95 hover:bg-white rounded-lg sm:rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <span class="font-medium text-gray-800 text-sm sm:text-base">Lihat Keuangan Transparansi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('penggunaMasjid.donasi.index') }}" class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 bg-white/95 hover:bg-white rounded-lg sm:rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                <span class="font-medium text-gray-800 text-sm sm:text-base">Yuk Donasi</span>
                            </a>
                        </li>
                    </ul>
                    <p class="text-gray-200 text-sm sm:text-base md:text-lg text-center md:text-left">
                        Pilih salah satu yang kamu ingin kunjungi
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container mx-auto px-4 py-8 sm:py-12 max-w-7xl">
        
        {{-- Divider --}}
        <div class="my-6 sm:my-8 md:my-12" aria-hidden="true">
            <svg class="w-full" height="8" viewBox="0 0 100 10" preserveAspectRatio="none">
              <path d="M0 5 Q 12.5 0, 25 5 T 50 5 T 75 5 T 100 5" stroke-width="2" stroke-linecap="round" class="stroke-current text-emerald-300" fill="none" />
            </svg>
        </div>

        {{-- Latest Content --}}
        <div> 
            <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6">
                <div class="w-1 h-6 sm:h-8 bg-gradient-to-b from-emerald-500 to-emerald-600 rounded-full"></div>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800">Konten Terbaru</h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @forelse($kontenTerbaru as $konten)
                <a href="{{ route('konten.show', ['type' => $konten->type, 'id' => $konten->id]) }}" class="group bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative overflow-hidden">
                        <img class="h-40 sm:h-48 w-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ asset('storage/' . $konten->gambar) }}" alt="{{ $konten->judul }}">
                        <div class="absolute top-2 sm:top-3 right-2 sm:right-3">
                            @if($konten->type == 'artikel')
                            <span class="bg-emerald-500 text-white text-xs px-2 sm:px-3 py-1 rounded-full font-semibold shadow-lg">Artikel</span>
                            @else
                            <span class="bg-blue-500 text-white text-xs px-2 sm:px-3 py-1 rounded-full font-semibold shadow-lg">Kegiatan</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-4 sm:p-5">
                        <h3 class="text-base sm:text-lg font-bold text-gray-800 mb-2 sm:mb-3 line-clamp-2 group-hover:text-emerald-600 transition-colors">{{ $konten->judul }}</h3>
                        
                        <div class="flex items-center gap-3 sm:gap-4 text-xs sm:text-sm text-gray-500">
                            <div class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $konten->created_at->format('d M Y') }}</span>
                            </div>
                            
                            <div class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span>{{ $konten->views ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-8 sm:py-12">
                    <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-gray-300 mb-3 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-gray-500 text-sm sm:text-base">Belum ada konten terbaru.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Divider --}}
        <div class="my-6 sm:my-8 md:my-12" aria-hidden="true">
            <svg class="w-full" height="8" viewBox="0 0 100 10" preserveAspectRatio="none">
              <path d="M0 5 Q 12.5 0, 25 5 T 50 5 T 75 5 T 100 5" stroke-width="2" stroke-linecap="round" class="stroke-current text-emerald-300" fill="none" />
            </svg>
        </div>

        {{-- Imam Schedule --}}
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-md p-4 sm:p-6 md:p-8">
            <div class="flex items-center gap-2 sm:gap-3 mb-4 sm:mb-6">
                <div class="w-1 h-6 sm:h-8 bg-gradient-to-b from-emerald-500 to-emerald-600 rounded-full"></div>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800">Jadwal Imam</h2>
            </div>

            @if(isset($jadwalImam) && $jadwalImam->isNotEmpty())
                
                {{-- Carousel for > 3 items --}}
                @if($jadwalImam->count() > 3)
                <div class="relative">
                    <div id="jadwal-imam-container" class="overflow-hidden">
                        <div id="jadwal-imam-slider" class="flex transition-transform duration-500 ease-out">
                            @foreach($jadwalImam as $jadwal)
                            <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-2 md:px-3">
                                <div class="bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 rounded-xl p-4 sm:p-6 flex flex-col items-center text-center shadow-sm hover:shadow-lg transition-all duration-300">
                                    <div class="relative mb-3 sm:mb-4">
                                        <div class="absolute inset-0 bg-emerald-400 rounded-full blur-xl opacity-20"></div>
                                        <img src="{{ $jadwal->gambar ? asset('storage/'.$jadwal->gambar) : 'https://ui-avatars.com/api/?name='.urlencode($jadwal->nama).'&background=10b981&color=fff' }}" class="relative w-20 h-20 sm:w-24 sm:h-24 object-cover rounded-full shadow-lg ring-4 ring-white" alt="{{ $jadwal->nama }}">
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-1">{{ $jadwal->nama }}</h3>
                                    <p class="text-emerald-600 font-medium text-sm sm:text-base">{{ $jadwal->waktu_sholat }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <button id="prev-btn" class="absolute top-1/2 -left-3 sm:-left-4 -translate-y-1/2 bg-white hover:bg-emerald-50 rounded-full p-2 sm:p-3 shadow-lg transition-all opacity-50 cursor-not-allowed disabled:opacity-50">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    
                    <button id="next-btn" class="absolute top-1/2 -right-3 sm:-right-4 -translate-y-1/2 bg-white hover:bg-emerald-50 rounded-full p-2 sm:p-3 shadow-lg transition-all">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>

                {{-- Grid for <= 3 items --}}
                @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @foreach($jadwalImam as $jadwal)
                    <div class="bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 rounded-xl p-4 sm:p-6 flex flex-col items-center text-center shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="relative mb-3 sm:mb-4">
                            <div class="absolute inset-0 bg-emerald-400 rounded-full blur-xl opacity-20"></div>
                            <img src="{{ $jadwal->gambar ? asset('storage/'.$jadwal->gambar) : 'https://ui-avatars.com/api/?name='.urlencode($jadwal->nama).'&background=10b981&color=fff' }}" class="relative w-20 h-20 sm:w-24 sm:h-24 object-cover rounded-full shadow-lg ring-4 ring-white" alt="{{ $jadwal->nama }}">
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-1">{{ $jadwal->nama }}</h3>
                        <p class="text-emerald-600 font-medium text-sm sm:text-base">{{ $jadwal->waktu_sholat }}</p>
                    </div>
                    @endforeach
                </div>
                @endif

            @else
                <div class="text-center py-8 sm:py-12">
                    <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-gray-300 mb-3 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-500 font-medium text-sm sm:text-base">Belum ada jadwal imam yang ditambahkan.</p>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>

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
@endsection