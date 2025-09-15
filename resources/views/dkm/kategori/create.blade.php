@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>
    <form method="POST" action="{{ route('dkm.kategori.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Nama Kategori</label>
            <input type="text" name="nama" class="w-full border px-3 py-2 rounded" required>
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('dkm.kategori.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
