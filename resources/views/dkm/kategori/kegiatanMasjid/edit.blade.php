@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Edit Kategori</h2>
    <form method="POST" action="{{ route('dkm.kategori.kegiatanMasjid.update', $kategori->id) }}">
        @csrf @method('PUT')

        {{-- Nama kategori --}}
        <div class="mb-4">
            <label class="block mb-1">Nama Kategori</label>
            <input type="text" name="nama"
                   value="{{ old('nama', $kategori->nama) }}"
                   class="w-full border px-3 py-2 rounded" required>
        </div>


        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('dkm.kategori.kegiatanMasjid.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
