@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Galeri</h2>
        <a href="{{ route('dkm.manajemenFasilitas.galeri.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Kategori</th>
                <th class="border px-4 py-2">Judul</th>
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Gambar</th>
                <th class="border px-4 py-2">Deskripsi</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($galeris as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->kategori?->nama ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $item->judul }}</td>
                    <td class="border px-4 py-2">{{ $item->tanggal->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2">
                        @foreach($item->gambar as $img)
                            <img src="{{ asset('storage/'.$img) }}" alt="" class="w-20 h-20 object-cover inline-block">
                        @endforeach
                    </td>
                    <td class="border px-4 py-2">{{ $item->deskripsi ?? '-' }}</td>
                    <td class="border px-4 py-2 flex gap-2">
                        <a href="{{ route('dkm.manajemenFasilitas.galeri.edit', $item->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('dkm.manajemenFasilitas.galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-3">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
