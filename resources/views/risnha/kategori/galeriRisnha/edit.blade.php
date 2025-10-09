@extends('layouts.risnha')

@section('title', 'Edit Kategori Galeri Risnha')

@section('content')
<div class="container mt-4">
    <h4>Edit Kategori Galeri</h4>
    <form action="{{ route('risnha.kategori.galeriRisnha.update', $kategori->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('risnha.kategori.galeriRisnha.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
