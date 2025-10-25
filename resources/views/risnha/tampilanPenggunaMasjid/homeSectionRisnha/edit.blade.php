@extends('layouts.risnha')

@section('title', 'Edit Hero Section')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Gambar Carousel</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('risnha.tampilanPenggunaMasjid.homeSectionRisnha.update', $homeSectionRisnha->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mt-2 mb-2">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                    <img src="{{ asset('images/risnha_carousel/'.$homeSectionRisnha->gambar) }}" width="100" class="mt-2">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection