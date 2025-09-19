@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Galeri Fasilitas</h2>
        <a href="{{ route('dkm.manajemenFasilitas.galeri.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Galeri</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($galeris as $item)
            <div class="border rounded-lg overflow-hidden shadow-lg flex flex-col">
                {{-- Bagian Slider Gambar --}}
                @if(!empty($item->gambar))
                    <div class="relative w-full h-48" data-carousel-container>
                        {{-- Kontainer untuk semua gambar --}}
                        <div class="relative h-full w-full overflow-hidden">
                            @foreach($item->gambar as $index => $path)
                                {{-- PERUBAHAN DI SINI: tambahkan 'hidden' secara default --}}
                                <div class="w-full h-full duration-700 ease-in-out absolute top-0 left-0 hidden" data-carousel-item>
                                    <img src="{{ asset('storage/' . $path) }}" 
                                         class="block w-full h-full object-cover" 
                                         alt="Gambar {{ $item->judul }} {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>

                        {{-- Tombol Panah Navigasi (Hanya muncul jika > 1 gambar) --}}
                        @if(count($item->gambar) > 1)
                            <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                <span class="inline-flex items-center justify-8 w-8 h-8 rounded-full bg-black/30 group-hover:bg-black/50"> {{-- Warna diganti agar lebih kontras --}}
                                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/></svg>
                                </span>
                            </button>
                            <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-black/30 group-hover:bg-black/50"> {{-- Warna diganti --}}
                                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                                </span>
                            </button>
                        @endif
                    </div>
                @endif
                {{-- Akhir Bagian Slider --}}

                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="font-bold text-lg">{{ $item->judul }}</h3>
                    <p class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</p>
                    <p class="text-gray-700 text-sm mb-4 flex-grow">{{ Str::limit($item->deskripsi, 100) }}</p>
                    <div class="flex gap-2 justify-end mt-auto">
                        <a href="{{ route('dkm.manajemenFasilitas.galeri.edit', $item->id) }}" class="bg-blue-600 text-white px-3 py-1 text-sm rounded">Edit</a>
                        <form action="{{ route('dkm.manajemenFasilitas.galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 text-sm rounded">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">Belum ada data galeri.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $galeris->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const carouselContainers = document.querySelectorAll('[data-carousel-container]');

    carouselContainers.forEach(container => {
        const items = container.querySelectorAll('[data-carousel-item]'); 
        const prevButton = container.querySelector('[data-carousel-prev]');
        const nextButton = container.querySelector('[data-carousel-next]');
        let currentIndex = 0;

        function showItem(index) {
            items.forEach((item, i) => {
                // Sembunyikan semua item
                item.classList.add('hidden');
                // Hapus kelas 'active'
                item.classList.remove('z-10'); 
            });

            // Tampilkan item yang aktif
            if (items[index]) { 
                items[index].classList.remove('hidden');
                items[index].classList.add('z-10'); 
            }
        }

        // Hanya aktifkan tombol jika ada lebih dari 1 gambar
        if (items.length > 1) {
            nextButton.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % items.length;
                showItem(currentIndex);
            });

            prevButton.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + items.length) % items.length;
                showItem(currentIndex);
            });
        } else {
            // Jika hanya ada 1 gambar, sembunyikan tombol navigasi (walaupun sudah disembunyikan di Blade)
            if (prevButton) prevButton.classList.add('hidden');
            if (nextButton) nextButton.classList.add('hidden');
        }

        // Tampilkan gambar pertama saat halaman dimuat (jika ada gambar)
        if (items.length > 0) {
            showItem(0);
        }
    });
});
</script>
@endsection