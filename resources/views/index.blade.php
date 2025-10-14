@extends('layouts.penggunaMasjid')

@section('title', 'Beranda')

@section('content')
@if(isset($homeSections) && $homeSections->isNotEmpty())
<div id="default-carousel" class="relative w-full z-10" data-carousel="slide">
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        @foreach($homeSections as $item)
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            {{-- Perubahan: Gunakan Storage::url() untuk mendapatkan URL yang benar --}}
            <img src="{{ Storage::url($item->image_path) }}" class="absolute block w-full h-full object-cover" alt="Gambar Masjid Nurul Haq">
        </div>
        @endforeach
    </div>
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        @foreach($homeSections as $key => $item)
        <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $key + 1 }}" data-carousel-slide-to="{{ $key }}"></button>
        @endforeach
    </div>
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
@endif

{{-- Running Text --}}
{{-- Data untuk view ini dikirim melalui AppServiceProvider --}}
@if(isset($runningText) && $runningText->content)
<div class="bg-emerald-600 relative z-20 text-white py-2 shadow-md">
    <div class="container mx-auto px-4">
        <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
            <span class="font-medium">{{ $runningText->content }}</span>
        </marquee>
    </div>
</div>
@endif

{{-- KONTEN --}}
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-semibold mb-4">Konten Terbaru</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kontenTerbaru as $konten)
                <a href="{{ route('konten.show', ['type' => $konten->type, 'id' => $konten->id]) }}" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img class="h-48 w-full object-cover" src="{{ asset('storage/' . $konten->gambar) }}" alt="{{ $konten->judul }}">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $konten->judul }}</h3>
                        
                        {{-- Bagian yang diubah ada di sini --}}
                        <div class="flex items-center text-sm text-gray-600 mb-4">
                            {{-- Tanggal --}}
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>{{ $konten->created_at->format('d M Y') }}</span>
                            
                            <span class="mx-2">•</span>
                            
                            {{-- Jumlah Dilihat --}}
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <span>{{ $konten->views ?? 0 }}</span>
                        </div>
                        
                        @if($konten->type == 'artikel')
                            <span class="inline-block bg-green-200 text-green-800 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">Artikel</span>
                        @else
                            <span class="inline-block bg-blue-200 text-blue-800 text-xs px-2 rounded-full uppercase font-semibold tracking-wide">Kegiatan Masjid</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

{{-- JADWAL IMAM --}}
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-semibold mb-4">Jadwal Imam</h2>

        @if(isset($jadwalImam) && $jadwalImam->isNotEmpty())

            {{-- Jika data LEBIH DARI 3, gunakan carousel --}}
            @if($jadwalImam->count() > 3)
                <div class="relative w-full">
                    <div id="jadwal-imam-container" class="overflow-hidden">
                        <div id="jadwal-imam-slider" class="flex transition-transform duration-500 ease-out">
                            @foreach($jadwalImam as $jadwal)
                                <div class="w-1/3 flex-shrink-0 px-2">
                                    <div class="bg-gray-50 border rounded-lg p-4 flex flex-col items-center text-center h-full">
                                        <img src="{{ $jadwal->gambar ? asset('storage/'.$jadwal->gambar) : 'https://ui-avatars.com/api/?name='.urlencode($jadwal->nama).'&background=random' }}" class="w-24 h-24 object-cover rounded-full shadow-md mb-4" alt="{{ $jadwal->nama }}">
                                        <h3 class="text-xl font-bold text-gray-800">{{ $jadwal->nama }}</h3>
                                        <p class="text-gray-600">{{ $jadwal->waktu_sholat }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button id="prev-btn" class="absolute top-1/2 left-0 -translate-y-1/2 -translate-x-4 bg-white/90 hover:bg-white rounded-full p-2 shadow-lg transition opacity-50 cursor-not-allowed">
                        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    
                    <button id="next-btn" class="absolute top-1/2 right-0 -translate-y-1/2 translate-x-4 bg-white/90 hover:bg-white rounded-full p-2 shadow-lg transition">
                         <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>

            {{-- Jika data 3 ATAU KURANG, tampilkan grid biasa --}}
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($jadwalImam as $jadwal)
                        <div class="bg-gray-50 border rounded-lg p-4 flex flex-col items-center text-center">
                            <img src="{{ $jadwal->gambar ? asset('storage/'.$jadwal->gambar) : 'https://ui-avatars.com/api/?name='.urlencode($jadwal->nama).'&background=random' }}" class="w-24 h-24 object-cover rounded-full shadow-md mb-4" alt="{{ $jadwal->nama }}">
                            <h3 class="text-xl font-bold text-gray-800">{{ $jadwal->nama }}</h3>
                            <p class="text-gray-600">{{ $jadwal->waktu_sholat }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

        @else
            {{-- Tampilan jika tidak ada data sama sekali --}}
            <div class="text-center py-10">
                <p class="text-gray-500">Belum ada jadwal imam yang ditambahkan.</p>
            </div>
        @endif
    </div>
</div>


<h1>TESTING ke 10000000</h1>

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
{{-- SCRIPT UNTUK CAROUSEL --}}
@if(isset($jadwalImam) && $jadwalImam->count() > 3)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slider = document.getElementById('jadwal-imam-slider');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');

        let currentIndex = 0;
        const totalItems = {{ $jadwalImam->count() }};
        const itemsPerPage = 3;
        const maxIndex = totalItems - itemsPerPage;

        function updateSlider() {
            // Geser slider sejauh `currentIndex` dikali lebar satu grup (33.33%)
            slider.style.transform = `translateX(-${currentIndex * (100 / itemsPerPage)}%)`;

            // Atur kondisi tombol prev
            if (currentIndex === 0) {
                prevBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }

            // Atur kondisi tombol next
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

        // Panggil sekali saat inisialisasi untuk set kondisi tombol awal
        updateSlider();
    });
</script>
@endif
@endsection