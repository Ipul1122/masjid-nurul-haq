@extends('layouts.risnha')

@section('title', 'Edit Kegiatan Risnha')

@section('content')
<div class="container my-4">
    {{-- Gunakan h2 untuk judul halaman utama di konten --}}
    <h2 class="mb-4">Edit Kegiatan Risnha</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kegiatan</label>
                    <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $kegiatan->nama) }}" required>
                    @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select id="kategori" name="kategori_kegiatan_risnha_id" class="form-select" required>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_kegiatan_risnha_id', $kegiatan->kategori_kegiatan_risnha_id) == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_kegiatan_risnha_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    @if ($kegiatan->gambar)
                        {{-- Gunakan img-fluid agar responsif dan batasi lebarnya --}}
                        <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="gambar" 
                             class="img-fluid rounded mb-2" style="max-width: 150px;">
                    @else
                        <p class="text-muted">Belum ada gambar</p>
                    @endif
                    
                    <label for="gambar" class="form-label visually-hidden">Upload Gambar Baru</label>
                    <input type="file" id="gambar" name="gambar" class="form-control" accept=".jpg,.jpeg,.png">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                </div>

                {{-- Update layout tombol agar responsif --}}
                <div class="d-grid gap-2 d-md-flex justify-content-md-between">
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