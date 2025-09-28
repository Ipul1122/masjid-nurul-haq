@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Daftar Kategori Artikel</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('dkm.kategori.artikel.create') }}" 
       class="bg-green-600 text-white px-4 py-2 rounded mb-3 inline-block">+ Tambah Kategori</a>
    <a href="{{ route('dkm.manajemenKonten.artikel.index') }}" 
       class="bg-green-600 text-white px-4 py-2 rounded mb-3 inline-block">Lihat Artikel</a>

    <table class="w-full border-collapse border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategoriArtikel as $item)
            <tr>
                <td class="border px-4 py-2">{{ $item->id }}</td>
                <td class="border px-4 py-2">{{ $item->nama }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('dkm.kategori.artikel.edit', $item->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
                    <form method="POST" action="{{ route('dkm.kategori.artikel.destroy', $item->id) }}" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center py-3">Belum ada kategori</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
