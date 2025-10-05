@extends('layouts.risnha')

@section('title', 'Edit Artikel Risnha')
@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Edit Artikel Risnha</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Artikel</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $artikel->nama) }}" required>
                    @error('nama') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori_artikel_risnha_id" class="form-label">Kategori</label>
                    <select name="kategori_artikel_risnha_id" id="kategori_artikel_risnha_id" class="form-select @error('kategori_artikel_risnha_id') is-invalid @enderror" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_artikel_risnha_id', $artikel->kategori_artikel_risnha_id) == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_artikel_risnha_id') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Saat Ini</label><br>
                    @if ($artikel->foto)
                        <img src="{{ asset('storage/' . $artikel->foto) }}" alt="foto artikel" width="120" class="rounded mb-2 img-thumbnail">
                    @else
                        <p class="text-muted">Belum ada foto</p>
                    @endif
                    <label for="foto" class="form-label mt-2">Ubah Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept=".jpg,.jpeg,.png">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto. Maks 2MB.</small>
                     @error('foto') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $artikel->deskripsi) }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.index') }}" class="btn btn-secondary">
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

