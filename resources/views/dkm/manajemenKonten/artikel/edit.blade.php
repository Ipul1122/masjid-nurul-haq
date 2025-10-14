@extends('layouts.dkm')

@section('title', 'Edit Artikel')
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Edit Artikel</h2>

   <form method="POST" action="{{ route('dkm.manajemenKonten.artikel.update', ['artikel' => $artikel->id, 'page' => $page]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        @csrf @method('PUT')

    <input type="hidden" name="page" value="{{ $page }}">

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
            <label class="block mb-1" for="deskripsi">Deskripsi</label>
            <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi', $artikel->deskripsi) }}">
            <trix-editor input="deskripsi" class="w-full border px-3 py-2 rounded"></trix-editor>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Tanggal Rilis</label>
            <input type="date" name="tanggal_rilis" value="{{ $artikel->tanggal_rilis->format('Y-m-d') }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border px-3 py-2 rounded">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoriArtikels as $kat)
                    <option value="{{ $kat->id }}" 
                        {{ old('kategori_id', $kegiatanMasjid->kategori_id ?? '') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>


@endsection
{{-- Tambahan CSS untuk styling list di dalam editor --}}
@push('styles')
<style>
.trix-content ul {
    list-style-type: disc;
    margin-left: 1.25rem;
}
.trix-content ol {
    list-style-type: decimal;
    margin-left: 1.25rem;
}
</style>
@endpush
