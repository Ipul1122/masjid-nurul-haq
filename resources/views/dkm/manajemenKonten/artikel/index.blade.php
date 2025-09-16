@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between mb-4 items-center">
        <h2 class="text-xl font-bold">Daftar Artikel Masjid</h2>
        <a href="{{ route('dkm.manajemenKonten.artikel.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Artikel</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Judul</th>
                <th class="border px-4 py-2">Gambar</th>
                <th class="border px-4 py-2">Deskripsi</th>
                <th class="border px-4 py-2">Tanggal Rilis</th>
                <th class="border px-4 py-2">Kategori</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($artikels as $art)
                <tr>
                    <td class="border px-4 py-2">{{ $art->judul }}</td>
                    <td class="border px-4 py-2">
                        @if($art->gambar)
                            <img src="{{ asset('storage/' . $art->gambar) }}" class="w-20 h-20 object-cover rounded">
                        @else
                            <span class="text-gray-500">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ Str::limit($art->deskripsi, 100) }}</td>
                    <td class="border px-4 py-2">{{ $art->tanggal_rilis->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2">{{ $art->kategori?->nama ?? '--' }}</td>
                    <td class="border px-4 py-2 flex gap-2">
                        <a href="{{ route('dkm.manajemenKonten.artikel.edit', $art->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
                        <form method="POST" action="{{ route('dkm.manajemenKonten.artikel.destroy', $art->id) }}" onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-3">Belum ada artikel</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
