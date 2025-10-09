@extends('layouts.risnha')

@section('title', 'Kategori Galeri Risnha')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Daftar Kategori Galeri</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('risnha.kategori.galeriRisnha.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50">No</th>
                <th>Nama Kategori</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategori as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nama_kategori }}</td>
                    <td>
                        <a href="{{ route('risnha.kategori.galeriRisnha.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('risnha.kategori.galeriRisnha.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Belum ada data kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
