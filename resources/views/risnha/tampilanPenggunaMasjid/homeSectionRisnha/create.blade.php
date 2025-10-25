@extends('layouts.risnha')

@section('title', 'Tambah Hero Section')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Gambar Carousel</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('risnha.tampilanPenggunaMasjid.homeSectionRisnha.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-5">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection