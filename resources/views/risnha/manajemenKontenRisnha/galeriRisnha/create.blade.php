@extends('layouts.risnha')

@section('title', 'Tambah Galeri Risnha')

@section('content')
<div class="container mt-4">
    <h4>Tambah Galeri</h4>
    <form action="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Galeri</label>
            <input type="text" name="nama_galeri" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_galeri_risnha_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Foto (jpg, jpeg, png max 2MB)</label>
            <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
