@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Galeri Baru</h2>

    <form action="{{ route('dkm.manajemenFasilitas.galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="judul" class="block font-medium">Judul</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="w-full border rounded px-3 py-2 mt-1 @error('judul') border-red-500 @enderror" required>
                @error('judul') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="tanggal" class="block font-medium">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="w-full border rounded px-3 py-2 mt-1 @error('tanggal') border-red-500 @enderror" required>
                @error('tanggal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="deskripsi" class="block font-medium">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full border rounded px-3 py-2 mt-1 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="gambar" class="block font-medium">Gambar (Bisa lebih dari satu)</label>
                <input type="file" name="gambar[]" id="gambar" multiple class="w-full border rounded px-3 py-2 mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('gambar.*') border-red-500 @enderror" required>
                <p class="text-sm text-gray-500 mt-1">Format: PNG, JPG, JPEG. Maksimal 2MB per file.</p>
                @error('gambar') <span class="text-red-500 text-sm d-block">{{ $message }}</span> @enderror
                @error('gambar.*') <span class="text-red-500 text-sm d-block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-6 flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('dkm.manajemenFasilitas.galeri.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Batal</a>
        </div>
    </form>
</div>
@endsection