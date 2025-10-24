@extends('layouts.penggunaMasjid')

@section('title', 'Masjid Nurul Haq - Beranda')
{{-- @section()<img src="{{ asset('images/logo-masjid-nur-haq.png') }}" alt="Logo Masjid Nurul Haq"> --}}

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50 to-slate-50 ">
    
 {{-- Hero Carousel --}}
@if(isset($homeSections) && $homeSections->isNotEmpty())
<div class="relative z-20">
    <div id="default-carousel" class="relative w-full" @if($homeSections->count() > 1) data-carousel="slide" @endif>
        {{-- Carousel Wrapper --}}
        <div class="relative h-64 overflow-hidden md:h-[32rem]">
            @foreach ($homeSections as $item)
                {{-- Item --}}
                <div class="{{ $loop->first ? '' : 'hidden' }} duration-700 ease-in-out" @if($homeSections->count() > 1) data-carousel-item @endif>
                    <div class="absolute inset-0 z-10 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <img src="{{ Storage::url($item->image_path) }}" class="absolute block object-cover w-full h-full" alt="Gambar Masjid Nurul Haq">
                </div>
            @endforeach
        </div>

        {{-- Tampilkan Indikator dan Tombol Navigasi HANYA JIKA gambar lebih dari 1 --}}
        @if($homeSections->count() > 1)
            {{-- Carousel Indicators --}}
            <div class="absolute z-20 flex space-x-2 -translate-x-1/2 bottom-6 left-1/2">
                @foreach($homeSections as $key => $item)
                <button type="button" class="w-2 h-2 transition-all rounded-full bg-white/60 hover:bg-white" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}" data-carousel-slide-to="{{ $key }}"></button>
                @endforeach
            </div>
            
            {{-- Navigation Buttons --}}
            <button type="button" class="absolute top-1/2 left-4 z-20 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 rounded-full p-3 transition-all group" data-carousel-prev>
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button type="button" class="absolute top-1/2 right-4 z-20 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 rounded-full p-3 transition-all group" data-carousel-next>
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        @endif
    </div>
</div>
@endif

    {{-- Running Text --}}
    @if(isset($runningText) && $runningText->content)
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 text-white py-3 shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                </svg>
                <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" class="font-medium">
                    {{ $runningText->content }}
                </marquee>
            </div>
        </div>
    </div>
    @endif

    {{-- Main Content Container --}}
    <div class="container mx-auto px-4 py-8 md:py-12 max-w-7xl mt-16">
        
        {{-- Konten Terbaru Section --}}
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1 h-8 bg-gradient-to-b from-emerald-500 to-emerald-600 rounded-full ml-8"></div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 ">Konten Terbaru</h2>
            </div>
            
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
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $konten->created_at->format('d M Y') }}</span>
                            </div>
                            
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span>{{ $konten->views ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Jadwal Imam Section --}}
        <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 z-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1 h-8 bg-gradient-to-b from-emerald-500 to-emerald-600 rounded-full"></div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Jadwal Imam</h2>
            </div>

            @if(isset($jadwalImam) && $jadwalImam->isNotEmpty())
                
                {{-- Carousel untuk data > 3 --}}
                @if($jadwalImam->count() > 3)
                <div class="relative">
                    <div id="jadwal-imam-container" class="overflow-hidden">
                        <div id="jadwal-imam-slider" class="flex transition-transform duration-500 ease-out">
                            @foreach($jadwalImam as $jadwal)
                            <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-2 md:px-3">
                                <div class="bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 rounded-xl p-6 flex flex-col items-center text-center shadow-sm hover:shadow-lg transition-all duration-300">
                                    <div class="relative mb-4">
                                        <div class="absolute inset-0 bg-emerald-400 rounded-full blur-xl opacity-20"></div>
                                        <img src="{{ $jadwal->gambar ? asset('storage/'.$jadwal->gambar) : 'https://ui-avatars.com/api/?name='.urlencode($jadwal->nama).'&background=10b981&color=fff' }}" class="relative w-24 h-24 object-cover rounded-full shadow-lg ring-4 ring-white" alt="{{ $jadwal->nama }}">
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $jadwal->nama }}</h3>
                                    <p class="text-emerald-600 font-medium">{{ $jadwal->waktu_sholat }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <button id="prev-btn" class="absolute top-1/2 -left-4 -translate-y-1/2 bg-white hover:bg-emerald-50 rounded-full p-3 shadow-lg transition-all opacity-50 cursor-not-allowed disabled:opacity-50">
                        <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    
                    <button id="next-btn" class="absolute top-1/2 -right-4 -translate-y-1/2 bg-white hover:bg-emerald-50 rounded-full p-3 shadow-lg transition-all">
                        <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>

                {{-- Grid untuk data <= 3 --}}
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($jadwalImam as $jadwal)
                    <div class="bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 rounded-xl p-6 flex flex-col items-center text-center shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="relative mb-4">
                            <div class="absolute inset-0 bg-emerald-400 rounded-full blur-xl opacity-20"></div>
                            <img src="{{ $jadwal->gambar ? asset('storage/'.$jadwal->gambar) : 'https://ui-avatars.com/api/?name='.urlencode($jadwal->nama).'&background=10b981&color=fff' }}" class="relative w-24 h-24 object-cover rounded-full shadow-lg ring-4 ring-white" alt="{{ $jadwal->nama }}">
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $jadwal->nama }}</h3>
                        <p class="text-emerald-600 font-medium">{{ $jadwal->waktu_sholat }}</p>
                    </div>
                    @endforeach
                </div>
                @endif

            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-500 font-medium">Belum ada jadwal imam yang ditambahkan.</p>
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
        const itemsPerPage = window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1);
        let maxIndex = totalItems - itemsPerPage;

        function updateSlider() {
            const percentage = 100 / itemsPerPage;
            slider.style.transform = `translateX(-${currentIndex * percentage}%)`;

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
            const newItemsPerPage = window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1);
            maxIndex = totalItems - newItemsPerPage;
            if (currentIndex > maxIndex) currentIndex = maxIndex;
            updateSlider();
        });

        updateSlider();
    });
</script>
@endif
@endsection