@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Artikel</h2>

    <form method="POST" action="{{ route('dkm.manajemenKonten.artikel.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="block mb-1">Judul</label>
            <input type="text" name="judul" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Gambar</label>
            <input type="file" name="gambar" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border px-3 py-2 rounded"></textarea>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
