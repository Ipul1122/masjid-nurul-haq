@extends('layouts.risnha')

@section('title', 'Artikel Risnha')
@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Daftar Artikel Risnha</h3>

    <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.create') }}" class="btn btn-primary mb-3">
        <i class="fa fa-plus me-2"></i>Tambah Artikel
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Nama Artikel</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($artikelRisnha as $index => $artikel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $artikel->nama }}</td>
                                <td>{{ $artikel->kategori->nama ?? '-' }}</td>
                                <td>
                                    @if ($artikel->foto)
                                        <img src="{{ asset('storage/' . $artikel->foto) }}" 
                                             alt="foto artikel" 
                                             width="80" 
                                             class="rounded shadow-sm border">
                                    @else
                                        <small class="text-muted">Tidak ada</small>
                                    @endif
                                </td>
                                <td>{{ Str::limit($artikel->deskripsi, 60) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.edit', $artikel->id) }}" 
                                       class="btn btn-sm btn-warning me-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.destroy', $artikel->id) }}" 
                                          method="POST" 
                                          class="d-inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada artikel</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Menampilkan pagination jika ada --}}
            @if (method_exists($artikelRisnha, 'links'))
                <div class="mt-3">
                    {{ $artikelRisnha->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

