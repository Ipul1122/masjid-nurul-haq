@extends('layouts.dkm')

@section('title', 'Edit Kegiatan Masjid')
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Edit Kegiatan Masjid</h2>

    <form method="POST" action="{{ route('dkm.manajemenKonten.kegiatanMasjid.update', ['kegiatanMasjid' => $kegiatanMasjid->id, 'page' => $page]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="judul" class="block mb-1">Judul</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $kegiatanMasjid->judul) }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label for="nama_ustadz" class="block mb-1">Nama Ustadz</label>
            <input type="text" id="nama_ustadz" name="nama_ustadz" value="{{ old('nama_ustadz', $kegiatanMasjid->nama_ustadz) }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label for="jadwal" class="block mb-1">Jadwal</label>
            <input type="datetime-local" id="jadwal" name="jadwal" value="{{ old('jadwal', \Carbon\Carbon::parse($kegiatanMasjid->jadwal)->format('Y-m-d\TH:i')) }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label for="gambar" class="block mb-1">Gambar</label>
            @if($kegiatanMasjid->gambar)
                <img src="{{ asset('storage/' . $kegiatanMasjid->gambar) }}" alt="Preview Gambar" class="h-20 mb-2">
            @endif
            <input type="file" id="gambar" name="gambar" class="w-full border px-3 py-2 rounded">
        </div>
        
        {{-- INI BAGIAN KUNCINYA UNTUK EDIT --}}
        <div class="mb-3">
            <label class="block mb-1" for="deskripsi">Deskripsi</label>
            <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi', $kegiatanMasjid->deskripsi) }}">
            <trix-editor input="deskripsi" class="w-full border px-3 py-2 rounded"></trix-editor>
        </div>

        <div class="mb-4">
            <label for="kategori_id" class="block mb-1">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="w-full border px-3 py-2 rounded">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ old('kategori_id', $kegiatanMasjid->kategori_id) == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection