@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between mb-4 items-center">
        <h2 class="text-xl font-bold">Daftar Kategori pengeluaran</h2>
        <a href="{{ route('dkm.kategori.pengeluaran.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Kategori</a>
    </div>
    <div class="flex justify-between mb-4 items-center">
        <h2 class="text-xl font-bold">Catat Pengeluaran</h2>
        <a href="{{ route('dkm.manajemenKeuangan.pengeluaran.index') }}" class="bg-green-600 text-white px-4 py-2 rounded">Catat Pengeluaran</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategori as $kat)
                <tr>
                    <td class="border px-4 py-2">{{ $kat->nama }}</td>
                    <td class="border px-4 py-2 flex gap-2">
                        <a href="{{ route('dkm.kategori.pengeluaran.edit', $kat->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
                        <form method="POST" action="{{ route('dkm.kategori.pengeluaran.destroy', $kat->id) }}" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="2" class="text-center py-3">Belum ada kategori</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
