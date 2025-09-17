@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-lg mx-auto">
    <h2 class="text-xl font-bold mb-4">Edit Kategori Pemasukkan</h2>

    <form method="POST" action="{{ route('dkm.kategori.pemasukkan.update', $pemasukkan->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="block mb-1">Nama Kategori</label>
            <input type="text" name="nama" value="{{ old('nama', $pemasukkan->nama) }}" class="w-full border px-3 py-2 rounded" required>
            @error('nama') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('dkm.kategori.pemasukkan.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
