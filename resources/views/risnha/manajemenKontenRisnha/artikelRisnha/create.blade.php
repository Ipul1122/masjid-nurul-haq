@extends('layouts.risnha')

@section('title', 'Tambah Artikel Risnha')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Artikel Baru</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Nama Artikel -->
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Artikel</label>
                <input type="text" name="nama" id="nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror" value="{{ old('nama') }}" required>
                @error('nama')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori Artikel -->
            <div class="mb-4">
                <label for="kategori_artikel_risnha_id" class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                <select name="kategori_artikel_risnha_id" id="kategori_artikel_risnha_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kategori_artikel_risnha_id') border-red-500 @enderror" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}" {{ old('kategori_artikel_risnha_id') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_artikel_risnha_id')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Foto -->
            <div class="mb-4">
                <label for="foto" class="block text-gray-700 text-sm font-bold mb-2">Foto</label>
                <input type="file" name="foto" id="foto" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('foto') border-red-500 @enderror" accept=".jpg,.jpeg,.png">
                 <p class="text-gray-500 text-xs italic mt-2">Format: JPG, JPEG, PNG. Ukuran Maks: 2MB.</p>
                @error('foto')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan
                </button>
                <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
