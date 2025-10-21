@extends('layouts.risnha')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Home Section Risnha</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('risnha.tampilanPenggunaMasjid.homeSectionRisnha.create') }}" class="btn btn-primary">Tambah Gambar</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($homeSectionRisnhas as $item)
                            <tr>
                                <td><img src="{{ asset('images/risnha_carousel/'.$item->gambar) }}" width="100"></td>
                                <td>
                                    <a href="{{ route('risnha.tampilanPenggunaMasjid.homeSectionRisnha.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('risnha.tampilanPenggunaMasjid.homeSectionRisnha.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection