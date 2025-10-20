@extends('layouts.risnha')

@section('title', 'Tambah Kegiatan Risnha')
@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Tambah Kegiatan Risnha</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Kegiatan</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                    @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_kegiatan_risnha_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_kegiatan_risnha_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_kegiatan_risnha_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">gambar</label>
                    <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png">
                    <small class="text-muted">Maks 2MB (jpg, jpeg, png)</small>
                    @error('gambar') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="deskripsi">Deskripsi</label>
                    <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                    <trix-editor input="deskripsi" class="w-full border px-3 py-2 rounded"></trix-editor>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection