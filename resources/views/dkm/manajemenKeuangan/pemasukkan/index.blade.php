@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Pemasukkan</h2>
        <a href="{{ route('dkm.manajemenKeuangan.pemasukkan.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Total</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemasukkans as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->tanggal->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2 flex gap-2">
                        <a href="{{ route('dkm.manajemenKeuangan.pemasukkan.edit', $item->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('dkm.manajemenKeuangan.pemasukkan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center py-3">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
