@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Edit Artikel</h2>

    <form method="POST" action="{{ route('dkm.manajemenKonten.artikel.update', $artikel->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="block mb-1">Judul</label>
            <input type="text" name="judul" value="{{ $artikel->judul }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Gambar</label>
            @if($artikel->gambar)
                <img src="{{ asset('storage/' . $artikel->gambar) }}" class="w-20 h-20 object-cover rounded mb-2">
            @endif
            <input type="file" name="gambar" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border px-3 py-2 rounded">{{ $artikel->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Tanggal Rilis</label>
            <input type="date" name="tanggal_rilis" value="{{ $artikel->tanggal_rilis->format('Y-m-d') }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
