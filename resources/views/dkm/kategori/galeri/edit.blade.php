@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Kategori Galeri</h2>

    <form action="{{ route('dkm.kategori.galeri.update', $galeri->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="block mb-1">Nama Kategori</label>
            <input type="text" name="nama" value="{{ $galeri->nama }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('dkm.kategori.galeri.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
    </form>
</div>
@endsection
