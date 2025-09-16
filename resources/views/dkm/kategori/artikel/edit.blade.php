@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Kategori Artikel</h2>

    <form method="POST" action="{{ route('dkm.kategori.artikel.update', $kategoriArtikel->id) }}">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Nama Kategori</label>
            <input type="text" name="nama" value="{{ old('nama', $kategoriArtikel->nama) }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('dkm.kategori.artikel.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
