@extends('layouts.risnha')

@section('title', 'Kegiatan Risnha')
@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Daftar Kegiatan Risnha</h3>

    <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.create') }}" class="btn btn-primary mb-3">
        <i class="fa fa-plus me-2"></i>Tambah Kegiatan
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Foto</th>
                        <th>Deskripsi</th>
                        <th class="text-center" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kegiatan as $index => $item)
                        <tr>
                            {{-- Nomor urut otomatis --}}
                            <td>{{ $loop->iteration }}</td>
                            {{-- atau jika pakai pagination: {{ $kegiatan->firstItem() + $index }} --}}
                            
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kategori?->nama_kategori ?? '-' }}</td>
                            <td>
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" 
                                         alt="foto" 
                                         width="80" 
                                         class="rounded shadow-sm border">
                                @else
                                    <small class="text-muted">Tidak ada</small>
                                @endif
                            </td>
                            <td>{{ Str::limit($item->deskripsi, 60) }}</td>
                            <td class="text-center">
                                <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.edit', $item->id) }}" 
                                   class="btn btn-sm btn-warning me-1">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.destroy', $item->id) }}" 
                                      method="POST" 
                                      class="d-inline" 
                                      onsubmit="return confirm('Yakin hapus kegiatan ini?')">
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
                            <td colspan="6" class="text-center text-muted">Belum ada kegiatan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination (jika pakai paginate di controller) --}}
            @if (method_exists($kegiatan, 'links'))
                <div class="mt-3">
                    {{ $kegiatan->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
