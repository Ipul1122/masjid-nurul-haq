@extends('layouts.risnha')

@section('title', 'kategori Kegiatan Risnha')
@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Daftar Kategori Kegiatan Risnha</h4>

    <a href="{{ route('risnha.kategori.kegiatanRisnha.create') }}" class="btn btn-primary mb-3">
        + Tambah Kategori
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama Kategori</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategori as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td>
                                <a href="{{ route('risnha.kategori.kegiatanRisnha.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('risnha.kategori.kegiatanRisnha.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada kategori</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
