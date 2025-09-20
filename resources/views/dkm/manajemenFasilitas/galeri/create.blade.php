@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Galeri</h2>

    <form action="{{ route('dkm.manajemenFasilitas.galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="block mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Judul</label>
            <input type="text" name="judul" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Tanggal</label>
            <input type="date" name="tanggal" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Gambar</label>
            <input type="file" name="gambar[]" multiple accept="image/png,image/jpeg" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border px-3 py-2 rounded"></textarea>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('dkm.manajemenFasilitas.galeri.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
    </form>
</div>
@endsection
