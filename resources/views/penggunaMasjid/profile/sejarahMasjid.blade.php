@extends('layouts.penggunaMasjid')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8 mt-16">
    
    {{-- Container Utama --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        
        {{-- Header Card --}}
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Sejarah Masjid Nurul Haq</h2>
            <p class="text-sm text-gray-500 mt-1">Menelusuri jejak dan perkembangan Masjid Nurul Haq dari masa ke masa.</p>
        </div>

        {{-- Body Card - Timeline --}}
        <div class="p-6 sm:p-8 lg:p-12">
            
            @if ($sejarahs->isEmpty())
                {{-- Tampilan Jika Sejarah Kosong --}}
                <div class="text-center py-16">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <p class="font-semibold text-gray-700 text-lg">Belum ada data sejarah</p>
                    <p class="text-sm text-gray-500 mt-2">Saat ini data mengenai sejarah masjid belum tersedia.</p>
                </div>
            @else
                {{-- Container Timeline Interaktif --}}
                <div id="timeline-container" class="relative">

                    {{-- 1. Garis Tengah (Hanya Desktop) --}}
                    {{-- Ini adalah elemen kunci untuk progres --}}
                    <div class="hidden sm:block absolute left-1/2 top-0 bottom-0 w-1 -ml-0.5" aria-hidden="true">
                        {{-- Garis Latar Belakang (Track) --}}
                        <div class="absolute top-0 bottom-0 w-full bg-gray-200 rounded-full"></div>
                        {{-- Garis Progres (yang akan diisi oleh JS) --}}
                        <div id="timeline-progress" class="absolute top-0 w-full h-0 bg-blue-600 rounded-full transition-all duration-100"></div>
                    </div>

                    {{-- 2. Looping Item Sejarah --}}
                    @foreach ($sejarahs as $index => $sejarah)
                        <div class="timeline-item relative mb-12 sm:mb-16">
                            
                            {{-- Titik & Garis Tengah (Hanya Mobile) --}}
                            <div class="sm:hidden absolute left-0 top-1">
                                <div class="w-5 h-5 bg-blue-600 rounded-full border-4 border-white shadow-lg z-10"></div>
                                @if(!$loop->last)
                                <div class="w-1 h-full bg-blue-200 absolute top-5 left-1/2 -translate-x-1/2"></div>
                                @endif
                            </div>

                            {{-- Titik Tengah (Hanya Desktop) --}}
                            <div class="hidden sm:block absolute left-1/2 top-1 -translate-x-1/2 z-10">
                                {{-- Titik ini akan berubah warna saat aktif --}}
                                <div class="timeline-dot w-5 h-5 bg-gray-300 rounded-full border-4 border-white shadow-lg transition-all duration-300" data-index="{{ $index }}"></div>
                            </div>

                            {{-- Konten (Desktop - Grid Kiri/Kanan) --}}
                            <div class="hidden sm:grid grid-cols-2 gap-x-16">
                                {{-- KIRI (Odd index) --}}
                                @if($index % 2 == 0)
                                <div class="timeline-content text-right pr-8" data-index="{{ $index }}">
                                    <div class="bg-blue-50 rounded-lg p-5 shadow-md hover:shadow-xl transition-all duration-300 transform sm:hover:scale-105">
                                        <h3 class="text-lg font-bold text-gray-800 mb-3">{{ $sejarah->judul }}</h3>
                                        <div class="prose prose-sm max-w-full text-gray-600 text-left">{!! $sejarah->deskripsi !!}</div>
                                    </div>
                                </div>
                                <div></div> {{-- Kolom kanan kosong --}}
                                
                                {{-- KANAN (Even index) --}}
                                @else
                                <div></div> {{-- Kolom kiri kosong --}}
                                <div class="timeline-content pl-8" data-index="{{ $index }}">
                                    <div class="bg-green-50 rounded-lg p-5 shadow-md hover:shadow-xl transition-all duration-300 transform sm:hover:scale-105">
                                        <h3 class="text-lg font-bold text-gray-800 mb-3">{{ $sejarah->judul }}</h3>
                                        <div class="prose prose-sm max-w-full text-gray-600">{!! $sejarah->deskripsi !!}</div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            {{-- Konten (Mobile - Tampilan Stacked) --}}
                            <div class="sm:hidden pl-12 pt-0.5">
                                <div class="bg-white rounded-lg p-5 shadow-md border border-gray-100">
                                    <h3 class="text-lg font-bold text-gray-800 mb-3">{{ $sejarah->judul }}</h3>
                                    <div class="prose prose-sm max-w-full text-gray-600">{!! $sejarah->deskripsi !!}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Hanya jalankan skrip ini di layar desktop (sm: 640px)
        if (window.innerWidth < 640) return;

        const timelineContainer = document.getElementById('timeline-container');
        const timelineProgress = document.getElementById('timeline-progress');
        const dots = Array.from(document.querySelectorAll('.timeline-dot'));
        const contentBlocks = Array.from(document.querySelectorAll('.timeline-content'));

        // Jika tidak ada elemen, hentikan
        if (!timelineContainer || !timelineProgress || dots.length === 0) {
            return;
        }

        // --- 1. Fitur Menandai Titik Aktif ---
        // Gunakan IntersectionObserver untuk mendeteksi item mana yang ada di tengah layar
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                // Ambil index dari data-attribute
                const index = entry.target.getAttribute('data-index');
                const dot = document.querySelector(`.timeline-dot[data-index='${index}']`);

                if (entry.isIntersecting) {
                    // Jika item masuk ke tengah layar, ubah warna titiknya
                    dot.classList.add('bg-blue-600', 'scale-125');
                    dot.classList.remove('bg-gray-300');
                } else {
                    // Jika item keluar dari tengah layar, kembalikan warnanya
                    dot.classList.remove('bg-blue-600', 'scale-125');
                    dot.classList.add('bg-gray-300');
                }
            });
        }, { 
            // rootMargin: '-50% 0px -50% 0px' berarti "area pemicu" adalah garis horizontal di tengah layar
            rootMargin: '-50% 0px -50% 0px',
            threshold: 0 
        });

        // Amati setiap blok konten
        contentBlocks.forEach(block => observer.observe(block));

        // --- 2. Fitur Mengisi Garis Progres ---
        function updateProgressLine() {
            // Dapatkan posisi Y dari container utama
            const containerTop = timelineContainer.getBoundingClientRect().top + window.scrollY;
            
            // Dapatkan posisi Y dari titik pertama dan terakhir
            const firstDotTop = dots[0].getBoundingClientRect().top + window.scrollY - containerTop;
            const lastDotTop = dots[dots.length - 1].getBoundingClientRect().top + window.scrollY - containerTop;

            // Total tinggi "track" adalah jarak antara titik pertama dan terakhir
            const trackHeight = lastDotTop - firstDotTop;

            // Gunakan tengah layar sebagai penanda scroll
            const scrollMarker = window.scrollY + (window.innerHeight / 2);

            // Hitung jarak scroll dari awal track (titik pertama)
            const scrollDistance = scrollMarker - (containerTop + firstDotTop);

            // Hitung persentase scroll di dalam track
            let progressPercentage = (scrollDistance / trackHeight) * 100;
            
            // Batasi persentase antara 0% dan 100%
            progressPercentage = Math.max(0, Math.min(100, progressPercentage));

            // Terapkan tinggi progres ke elemen garis biru
            timelineProgress.style.height = progressPercentage + '%';
        }

        // Panggil fungsi update saat pengguna scroll
        window.addEventListener('scroll', updateProgressLine, { passive: true });
        
        // Panggil sekali saat load untuk mengatur posisi awal
        updateProgressLine();
    });
</script>
@endsection
