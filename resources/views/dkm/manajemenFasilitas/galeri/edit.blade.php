@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Galeri</h2>

    <form action="{{ route('dkm.manajemenFasilitas.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label for="judul" class="block font-medium">Judul</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $galeri->judul) }}" class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <div>
                <label for="tanggal" class="block font-medium">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $galeri->tanggal->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <div>
                <label for="deskripsi" class="block font-medium">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full border rounded px-3 py-2 mt-1">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
            </div>
            
            <div>
                <label class="block font-medium">Gambar Saat Ini</label>
                <div class="flex flex-wrap gap-4 mt-2 border p-4 rounded">
                    @forelse($galeri->gambar as $g)
                        <img src="{{ $g }}" class="h-24 w-24 object-cover rounded">
                    @empty
                        <p>Tidak ada gambar.</p>
                    @endforelse
                </div>
            </div>

            <div>
                <label for="gambar" class="block font-medium">Tambah Gambar Baru (Opsional)</label>
                <input type="file" name="gambar[]" id="gambar" multiple class="w-full border rounded px-3 py-2 mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-sm text-gray-500 mt-1">Gambar baru yang diunggah akan ditambahkan ke galeri yang sudah ada.</p>
                @error('gambar.*') <span class="text-red-500 text-sm d-block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-6 flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('dkm.manajemenFasilitas.galeri.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Batal</a>
        </div>
    </form>
</div>
@endsection