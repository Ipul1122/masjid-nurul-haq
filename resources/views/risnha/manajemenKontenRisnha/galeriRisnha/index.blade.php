@extends('layouts.risnha')

@section('title', 'Galeri Risnha')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Daftar Galeri Risnha</h4>
        <a href="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.create') }}" class="btn btn-primary"> + Tambah Galeri</a>
        <a href="{{ route('penggunaMasjid.risnhaMasjid.galeriRisnhaMasjid') }}" target="_blank" class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
        Lihat Halaman Publik
    </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Galeri</th>
                    <th>Kategori</th>
                    <th>Foto</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galeri as $index => $g)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $g->nama_galeri }}</td>
                        <td>{{ $g->kategori?->nama_kategori ?? '-' }}</td>
                        <td>
                            @if ($g->foto)
                                <img src="{{ asset('storage/' . $g->foto) }}" alt="Foto Galeri" width="100" class="rounded">
                            @else
                                <small class="text-muted">Tidak ada foto</small>
                            @endif
                        </td>
                        <td>{{ $g->deskripsi }}</td>
                        <td>
                            <a href="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.edit', $g->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.destroy', $g->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data galeri</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
