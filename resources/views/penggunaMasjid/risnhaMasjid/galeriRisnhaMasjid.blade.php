@extends('layouts.risnhaMasjid.risnhaMasjid')

@section('title', 'Galeri Risnha')

@section('content')
<div class="container mx-auto mt-16 p-4">
    <h1 class="text-3xl font-bold mb-4 text-center text-gray-800">Galeri Kegiatan Risnha</h1>
    <p class="text-center text-gray-500 mb-8">Dokumentasi visual dari berbagai kegiatan yang diselenggarakan oleh Remaja Islam Nurul Haq.</p>

    {{-- Filter Kategori --}}
    <div class="flex justify-center flex-wrap gap-2 mb-10">
        <a href="{{ route('penggunaMasjid.risnhaMasjid.galeriRisnhaMasjid') }}"
           class="px-4 py-2 text-sm font-medium rounded-full transition-colors duration-200
                  {{ !request('kategori') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Semua
        </a>
        @foreach($kategories as $kategori)
            <a href="{{ route('penggunaMasjid.risnhaMasjid.galeriRisnhaMasjid', ['kategori' => $kategori->nama_kategori]) }}"
               class="px-4 py-2 text-sm font-medium rounded-full transition-colors duration-200
                      {{ request('kategori') == $kategori->nama_kategori ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                {{ $kategori->nama_kategori }}
            </a>
        @endforeach
    </div>

    @if($galeries->isEmpty())
        <div class="text-center py-16">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1.586-1.586a2 2 0 00-2.828 0L6 14m6-6l.01.01" />
            </svg>
            <h3 class="mt-2 text-sm font-semibold text-gray-900">Galeri Tidak Ditemukan</h3>
            <p class="mt-1 text-sm text-gray-500">Tidak ada foto kegiatan untuk kategori yang dipilih.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            {{-- Loop untuk setiap item galeri --}}
            @foreach($galeries as $galeri)
                <div onclick="openModal('{{ asset('storage/' . $galeri->foto) }}', '{{ $galeri->judul }}', '{{ $galeri->deskripsi }}')"
                    class="group bg-white rounded-lg shadow-lg overflow-hidden cursor-pointer transform hover:-translate-y-2 transition-all duration-300 ease-in-out">
                    <div class="w-full h-52 overflow-hidden">
                        <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="p-4">
                        <h2 class="font-bold text-lg mb-2 text-gray-900 truncate group-hover:text-blue-600">{{ $galeri->judul }}</h2>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span class="inline-block bg-blue-100 text-blue-800 rounded-full px-3 py-1 font-semibold">
                                #{{ optional($galeri->kategori)->nama_kategori ?: 'Umum' }}
                            </span>
                             <span>{{ $galeri->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Tautan Pagination --}}
        <div class="mt-12">
            {{ $galeries->links() }}
        </div>
    @endif
</div>

<div id="modalWrapper" class="hidden">
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 p-4" onclick="closeModalOutside(event)">
        <div class="bg-white rounded-lg shadow-2xl max-w-3xl w-full relative transform transition-all duration-300 scale-95">
            <button onclick="closeModal()" class="absolute -top-4 -right-4 bg-white rounded-full p-2 text-gray-700 hover:bg-gray-200 z-10">
                 <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="p-4">
                <img id="modalImage" src="" alt="" class="w-full h-auto max-h-[70vh] object-contain rounded-md">
                <div class="mt-4">
                    <h3 id="modalTitle" class="text-2xl font-bold text-gray-900"></h3>
                    <p id="modalDescription" class="text-gray-600 mt-2"></p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript untuk fungsionalitas Modal --}}
<script>
    const modalWrapper = document.getElementById('modalWrapper');
    const modalContent = document.querySelector('#imageModal > div');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');

    function openModal(image, title, description) {
        modalImage.src = image;
        modalTitle.textContent = title;
        modalDescription.textContent = description;
        modalWrapper.classList.remove('hidden');
        setTimeout(() => modalContent.classList.remove('scale-95'), 50);
    }

    function closeModal() {
        modalContent.classList.add('scale-95');
        setTimeout(() => modalWrapper.classList.add('hidden'), 300);
    }

    function closeModalOutside(event) {
        if (event.target.id === 'imageModal') {
            closeModal();
        }
    }

    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modalWrapper.classList.contains('hidden')) {
            closeModal();
        }
    });
</script>
@endsection