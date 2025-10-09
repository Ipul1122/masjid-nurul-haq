@extends('layouts.dkm')

@section('title', 'Tambah Kegiatan Masjid')
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Kegiatan</h2>

    <form method="POST" action="{{ route('dkm.manajemenKonten.kegiatanMasjid.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Nama Ustadz</label>
            <input type="text" name="nama_ustadz" value="{{ old('nama_ustadz') }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Jadwal</label>
            <input type="datetime-local" name="jadwal" value="{{ old('jadwal') }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Gambar</label>
            <input type="file" name="gambar" class="w-full border px-3 py-2 rounded">
        </div>
        
        {{-- INI BAGIAN KUNCINYA UNTUK CREATE --}}
        <div class="mb-3">
            <label class="block mb-1" for="deskripsi">Deskripsi</label>
            <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
            <trix-editor input="deskripsi" class="w-full border px-3 py-2 rounded"></trix-editor>
        </div>
        
        <div class="mb-4">
            <label class="block mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border px-3 py-2 rounded">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection