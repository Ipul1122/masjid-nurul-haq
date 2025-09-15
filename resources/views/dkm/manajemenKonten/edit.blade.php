@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Edit Kegiatan</h2>

    <form method="POST" action="{{ route('dkm.manajemenKonten.update', $kegiatan->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $kegiatan->judul) }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Nama Ustadz</label>
            <input type="text" name="nama_ustadz" value="{{ old('nama_ustadz', $kegiatan->nama_ustadz) }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Jadwal</label>
            <input type="datetime-local" name="jadwal" 
                value="{{ old('jadwal', \Carbon\Carbon::parse($kegiatan->jadwal)->format('Y-m-d\TH:i')) }}" 
                class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Gambar</label>
            @if($kegiatan->gambar)
                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="Preview Gambar" class="h-20 mb-2">
            @endif
            <input type="file" name="gambar" class="w-full border px-3 py-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block mb-1">Catatan</label>
            <textarea name="catatan" class="w-full border px-3 py-2 rounded">{{ old('catatan', $kegiatan->catatan) }}</textarea>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('dkm.manajemenKonten.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
