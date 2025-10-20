@extends('layouts.risnha')

@section('title', 'Manajemen Kegiatan Risnha')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Manajemen Kegiatan Risnha</h3>
        <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.create') }}" class="btn btn-success">
            <i class="fa fa-plus me-1"></i> Tambah Kegiatan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kegiatanRisnha as $kegiatan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kegiatan->nama }}</td>
                                <td>{{ $kegiatan->kategori->nama_kategori ?? 'N/A' }}</td>
                                <td>
                                    @if($kegiatan->foto)
                                        <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="Foto" width="100" class="img-thumbnail">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($kegiatan->status == 'published')
                                        <span class="badge bg-success">Dipublikasikan</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Draf</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.preview', $kegiatan->id) }}" class="btn btn-info btn-sm" title="Pratinjau">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.edit', $kegiatan->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.destroy', $kegiatan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data kegiatan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection