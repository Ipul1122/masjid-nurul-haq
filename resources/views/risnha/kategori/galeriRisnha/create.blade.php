@extends('layouts.risnha')

@section('title', 'Tambah Kategori Galeri Risnha')

@section('content')
<div class="container mt-4">
    <h4>Tambah Kategori Galeri</h4>
    <form action="{{ route('risnha.kategori.galeriRisnha.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="form-group mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" placeholder="Masukkan nama kategori" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('risnha.kategori.galeriRisnha.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
