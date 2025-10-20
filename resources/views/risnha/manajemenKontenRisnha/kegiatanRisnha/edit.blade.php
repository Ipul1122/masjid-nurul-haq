@extends('layouts.dkm')

@section('title', 'Edit Kegiatan Risnha')
@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Edit Kegiatan Risnha</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                

                <div class="mb-3">
                    <label class="form-label">Nama Kegiatan</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $kegiatan->nama) }}" required>
                    @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_kegiatan_risnha_id" class="form-select" required>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_kegiatan_risnha_id', $kegiatan->kategori_kegiatan_risnha_id) == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_kegiatan_risnha_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">gambar Saat Ini</label><br>
                    @if ($kegiatan->gambar)
                        <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="gambar" width="120" class="rounded mb-2">
                    @else
                        <p class="text-muted">Belum ada gambar</p>
                    @endif
                    <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
