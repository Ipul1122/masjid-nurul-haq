@extends('layouts.dkm')

@section('title', 'Jadwal Imam')
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between mb-4 items-center">
        <h2 class="text-xl font-bold">Jadwal Imam</h2>
        <a href="{{ route('dkm.manajemenKonten.jadwalImam.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Jadwal</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Foto Imam</th>
                <th class="border px-4 py-2">Nama Imam</th>
                <th class="border px-4 py-2">Waktu Sholat</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwal as $j)
                <tr>
                    <td class="border px-4 py-2">
                    @if($j->gambar)
                        <img src="{{ asset('storage/'.$j->gambar) }}" class="w-16">
                    @else
                        -
                    @endif
                    </td>
                    <td class="border px-4 py-2">{{ $j->nama }}</td>
                    <td class="border px-4 py-2">{{ $j->waktu_sholat }}</td>
                    <td class="border px-4 py-2 flex gap-2">
                        <a href="{{ route('dkm.manajemenKonten.jadwalImam.edit', $j->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
                        <form method="POST" action="{{ route('dkm.manajemenKonten.jadwalImam.destroy', $j->id) }}" onsubmit="return confirm('Hapus jadwal ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center py-3">Belum ada jadwal imam</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
