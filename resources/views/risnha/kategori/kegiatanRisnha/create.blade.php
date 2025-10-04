@extends('layouts.risnha')

@section('title', 'Tambah Kategori Kegiatan Risnha')
@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Tambah Kategori Kegiatan Risnha</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('risnha.kategori.kegiatanRisnha.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
                    @error('nama_kategori')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('risnha.kategori.kegiatanRisnha.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
