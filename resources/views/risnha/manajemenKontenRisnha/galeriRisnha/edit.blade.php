@extends('layouts.risnha')

@section('title', 'Edit Galeri Risnha')

@section('content')
<div class="container mt-4">
    <h4>Edit Galeri Risnha</h4>

    <form action="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Galeri</label>
            <input type="text" name="nama_galeri" class="form-control"
                   value="{{ old('nama_galeri', $galeri->nama_galeri) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k->id }}"
                        {{ $galeri->kategori_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto (max 2MB, jpg/png/jpeg)</label>
            <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png">
            @if ($galeri->foto)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $galeri->foto) }}" alt="Foto Galeri" width="150" class="rounded">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
