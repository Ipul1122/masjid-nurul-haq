@extends('layouts.dkm')

@section('title', 'Edit Kegiatan Masjid')
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Edit kegiatan Masjid</h2>

   <form method="POST" action="{{ route('dkm.manajemenKonten.kegiatanMasjid.update', ['kegiatanMasjid' => $kegiatanMasjid->id, 'page' => $page]) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $kegiatanMasjid->judul) }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Nama Ustadz</label>
            <input type="text" name="nama_ustadz" value="{{ old('nama_ustadz', $kegiatanMasjid->nama_ustadz) }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Jadwal</label>
            <input type="datetime-local" name="jadwal" 
                value="{{ old('jadwal', \Carbon\Carbon::parse($kegiatanMasjid->jadwal)->format('Y-m-d\TH:i')) }}" 
                class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Gambar</label>
            @if($kegiatanMasjid->gambar)
                <img src="{{ asset('storage/' . $kegiatanMasjid->gambar) }}" alt="Preview Gambar" class="h-20 mb-2">
            @endif
            <input type="file" name="gambar" class="w-full border px-3 py-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Catatan</label>
            <textarea name="catatan" class="w-full border px-3 py-2 rounded">{{ old('catatan', $kegiatanMasjid->catatan) }}</textarea>
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

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
