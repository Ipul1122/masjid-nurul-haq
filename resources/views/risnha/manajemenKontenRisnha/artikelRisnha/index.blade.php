@extends('layouts.risnha')

@section('title', 'Manajemen Artikel Risnha')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Manajemen Artikel Risnha</h3>
        <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.create') }}" class="btn btn-success">
            <i class="fa fa-plus me-1"></i> Tambah Artikel
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th>Nama Artikel</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($artikel as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    {{ $item->kategori->nama ?? 'N/A' }}
                                </td>
                                <td>
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" 
                                             alt="Gambar Artikel" 
                                             width="100" 
                                             class="img-thumbnail rounded">
                                    @else
                                        <small class="text-muted">-</small>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 'published')
                                        <span class="badge bg-success">Dipublikasikan</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Draf</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.preview', $item->id) }}" 
                                       class="btn btn-sm btn-info" title="Pratinjau">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.edit', $item->id) }}" 
                                       class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.destroy', $item->id) }}" 
                                          method="POST" 
                                          class="d-inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada artikel.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $artikel->links() }}
            </div>
        </div>
    </div>
</div>
@endsection