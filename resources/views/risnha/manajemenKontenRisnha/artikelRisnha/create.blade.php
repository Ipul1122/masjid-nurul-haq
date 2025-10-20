@extends('layouts.risnha')

@section('title', 'Tambah Artikel Risnha')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Tambah Artikel Risnha</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Artikel</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_artikel_risnha_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        {{-- Pastikan variabel loop sama dengan yang dikirim Controller --}}
                        @forelse ($kategoriArtikelRisnha as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_artikel_risnha_id') == $kat->id ? 'selected' : '' }}>
                                {{-- PERBAIKAN: Mengambil dari kolom 'nama' --}}
                                {{ $kat->nama }}
                            </option>
                        @empty
                            {{-- Tambahkan pesan ini jika tidak ada kategori sama sekali --}}
                            <option value="" disabled>Tidak ada kategori tersedia.</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="deskripsi">Deskripsi</label>
                    <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                    <trix-editor input="deskripsi" class="form-control"></trix-editor>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.index') }}" class="btn btn-secondary">
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