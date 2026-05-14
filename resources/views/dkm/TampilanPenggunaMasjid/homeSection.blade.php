@extends('layouts.dkm')

@section('title', 'Atur Tampilan Home')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Atur Carousel Gambar di Halaman Utama</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('dkm.tampilanPenggunaMasjid.homeSection.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="carousel_images" class="block mb-2 text-sm font-medium text-gray-900">Upload Gambar Carousel Baru</label>
            <input type="file" name="carousel_images[]" id="carousel_images" multiple accept="image/*"
                   class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none"
                   onchange="previewImages(event)">
            <p class="mt-1 text-sm text-gray-500">
                Disarankan menggunakan gambar dengan rasio <strong>16:9</strong> (contoh: 1920&times;1080 px) agar tampil optimal di semua perangkat.
            </p>
        </div>

        {{-- Live Preview 16:9 --}}
        <div id="preview-container" class="hidden mb-4">
            <p class="text-sm font-medium text-gray-700 mb-2">Preview Gambar (rasio 16:9):</p>
            <div id="preview-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3"></div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Gambar</button>
    </form>

    <hr class="my-6">

    <h3 class="text-lg font-bold mb-4">Gambar Carousel Saat Ini</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse($images as $image)
            <div class="relative group">
                {{-- Thumbnail 16:9 menggunakan padding-bottom trick --}}
                <div class="relative w-full overflow-hidden rounded-lg" style="padding-bottom: 56.25%;">
                    <img src="{{ Storage::url($image->image_path) }}"
                         alt="Carousel Image"
                         class="absolute inset-0 w-full h-full object-cover object-center">
                </div>{{-- end 16:9 wrapper --}}
                <div class="absolute top-0 right-0 m-2 z-10">
                    <form action="{{ route('dkm.tampilanPenggunaMasjid.homeSection.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white rounded-full p-2 w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-full">Belum ada gambar carousel.</p>
        @endforelse
    </div>
</div>

@section('scripts')
<script>
    function previewImages(event) {
        const files = event.target.files;
        const container = document.getElementById('preview-container');
        const grid = document.getElementById('preview-grid');

        grid.innerHTML = '';

        if (files.length === 0) {
            container.classList.add('hidden');
            return;
        }

        container.classList.remove('hidden');

        Array.from(files).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                // Wrapper 16:9
                const wrapper = document.createElement('div');
                wrapper.className = 'relative w-full overflow-hidden rounded-lg bg-gray-100';
                wrapper.style.paddingBottom = '56.25%';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'absolute inset-0 w-full h-full object-cover object-center';
                img.alt = file.name;

                // Badge nama file
                const badge = document.createElement('span');
                badge.className = 'absolute bottom-0 left-0 right-0 text-xs text-white bg-black/50 px-2 py-1 truncate';
                badge.textContent = file.name;

                wrapper.appendChild(img);
                wrapper.appendChild(badge);
                grid.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    }
</script>
@endsection
@endsection