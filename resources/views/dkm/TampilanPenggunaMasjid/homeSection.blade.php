@extends('layouts.dkm')

@section('title', 'Atur Tampilan Home')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Atur Carousel Gambar di Halaman Utama</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    {{-- Form untuk MENAMBAH gambar baru --}}
    <form action="{{ route('dkm.tampilanPenggunaMasjid.homeSection.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="carousel_images" class="block mb-2 text-sm font-medium text-gray-900">Upload Gambar Carousel Baru</label>
            <input type="file" name="carousel_images[]" id="carousel_images" multiple class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none">
            <p class="mt-1 text-sm text-gray-500">Anda bisa memilih lebih dari satu gambar untuk ditambahkan.</p>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Gambar</button>
    </form>

    <hr class="my-6">

    <h3 class="text-lg font-bold mb-4">Gambar Carousel Saat Ini</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse($images as $image)
            <div class="relative group">
                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Carousel Image" class="w-full h-40 object-cover rounded-lg">
                {{-- Tombol Hapus --}}
                <div class="absolute top-0 right-0 m-2">
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
@endsection