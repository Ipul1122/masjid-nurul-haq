@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Kategori Galeri</h2>

    <form action="{{ route('dkm.kategori.galeri.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="block mb-1">Nama Kategori</label>
            <input type="text" name="nama" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('dkm.kategori.galeri.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
    </form>
</div>
@endsection
