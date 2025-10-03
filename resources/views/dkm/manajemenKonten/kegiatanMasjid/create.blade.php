@extends('layouts.dkm')

@section('title', 'Tambah Kegiatan Masjid')
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Kegiatan</h2>

    {{--  --}}
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc ml-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="{{ route('dkm.manajemenKonten.kegiatanMasjid.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Judul</label>
            <input type="text" name="judul" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Nama Ustadz</label>
            <input type="text" name="nama_ustadz" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Jadwal</label>
            <input type="datetime-local" name="jadwal" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Gambar</label>
            <input type="file" name="gambar" class="w-full border px-3 py-2 rounded">
            @error('gambar')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
                    <label class="block mb-1">Catatan</label>
                    <textarea name="catatan" class="w-full border px-3 py-2 rounded"></textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border px-3 py-2 rounded">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}" 
                        {{ old('kategori_id', $kegiatanMasjid->kategori_id ?? '') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @endforeach
            </select>
        </div>


        <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
