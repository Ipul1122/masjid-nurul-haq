@extends('layouts.dkm')

@section('title', 'Edit Artikel')
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
            <label class="block mb-1" for="deskripsi">Deskripsi</label>
            <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
            <trix-editor input="deskripsi" class="w-full border px-3 py-2 rounded"></trix-editor>
        </div>


        <div class="mb-3">
            <label class="block mb-1">Tanggal Rilis</label>
            <input type="date" name="tanggal_rilis" value="{{ now()->format('Y-m-d') }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoriArtikels as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('dkm.manajemenKonten.artikel.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
