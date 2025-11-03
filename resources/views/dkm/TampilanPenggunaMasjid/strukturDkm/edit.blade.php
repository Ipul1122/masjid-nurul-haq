@extends('layouts.dkm')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Anggota Struktur DKM</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Data</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('dkm.tampilanPenggunaMasjid.strukturDkm.update', $strukturDkm->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $strukturDkm->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="divisi">Divisi / Jabatan</label>
                    <input type="text" class="form-control @error('divisi') is-invalid @enderror" id="divisi" name="divisi" value="{{ old('divisi', $strukturDkm->divisi) }}" required>
                    @error('divisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Gambar Saat Ini</label>
                    <div>
                        @if($strukturDkm->gambar)
                            <img id="img-preview" src="{{ asset('images/struktur_dkm/' . $strukturDkm->gambar) }}" alt="{{ $strukturDkm->nama }}" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px;">
                        @else
                            <img id="img-preview" src="{{ asset('images/person-icon.png') }}" alt="Placeholder" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px;">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="gambar">Ganti Gambar (Opsional)</label>
                    <input type="file" class="form-control-file @error('gambar') is-invalid @enderror" id="gambar" name="gambar" onchange="previewImage()">
                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti gambar. Format: JPG, PNG, GIF, SVG. Maks: 2MB</small>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('dkm.tampilanPenggunaMasjid.strukturDkm.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#gambar');
        const imgPreview = document.querySelector('#img-preview'); // Targetkan ID img-preview

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection