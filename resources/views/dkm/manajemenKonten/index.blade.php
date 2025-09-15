@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between mb-4 items-center">
        <h2 class="text-xl font-bold">Daftar Kegiatan Masjid</h2>
        <a href="{{ route('dkm.manajemenKonten.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Kegiatan</a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filter Kategori --}}
    <form method="GET" action="{{ route('dkm.manajemenKonten.index') }}" class="mb-4 flex gap-2">
        <select name="kategori_id" class="border px-3 py-2 rounded">
            <option value="">-- Semua Kategori --</option>
            @foreach($kategori as $kat)
                <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
    </form>

    {{-- Form untuk hapus banyak --}}
    <form method="POST" action="{{ route('dkm.manajemenKonten.destroyMultiple') }}" id="bulkDeleteForm">
        @csrf
        @method('DELETE')

        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">
                        <input type="checkbox" id="selectAll">
                    </th>
                    <th class="border px-4 py-2">Judul</th>
                    <th class="border px-4 py-2">Ustadz</th>
                    <th class="border px-4 py-2">Jadwal</th>
                    <th class="border px-4 py-2">Gambar</th>
                    <th class="border px-4 py-2">Kategori</th>
                    <th class="border px-4 py-2">Catatan</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kegiatan as $item)
                    <tr>
                        <td class="border px-4 py-2 text-center">
                            <input type="checkbox" name="ids[]" value="{{ $item->id }}" class="rowCheckbox">
                        </td>
                        <td class="border px-4 py-2">{{ $item->judul }}</td>
                        <td class="border px-4 py-2">{{ $item->nama_ustadz }}</td>
                        <td class="border px-4 py-2">{{ $item->jadwal }}</td>
                        <td class="border px-4 py-2">
                            <div class="relative w-24 h-24">
                                <div class="absolute inset-0 bg-gray-200 animate-pulse rounded-lg" id="skeleton-{{ $item->id }}"></div>
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                         alt="Gambar Kegiatan"
                                         class="w-24 h-24 object-cover rounded-lg hidden"
                                         onload="this.classList.remove('hidden'); document.getElementById('skeleton-{{ $item->id }}').style.display='none';"
                                         onerror="console.error('Gagal load gambar')">
                                @else
                                    <span class="text-gray-500 text-sm">Tidak ada gambar</span>
                                @endif
                            </div>
                        </td>
                        <td class="border px-4 py-2">{{ $item->kategori?->nama ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $item->catatan }}</td>
                        <td class="border px-4 py-2 flex gap-2">
                            <a href="{{ route('dkm.manajemenKonten.edit', $item->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
                            <form method="POST" action="{{ route('dkm.manajemenKonten.destroy', $item->id) }}" onsubmit="return confirm('Hapus kegiatan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center py-3">Belum ada kegiatan</td></tr>
                @endforelse
            </tbody>
        </table>

        {{-- Tombol hapus banyak --}}
        <div class="mt-3">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded" onclick="return confirm('Yakin hapus semua data terpilih?')">
                Hapus Terpilih
            </button>
        </div>
    </form>
</div>

{{-- Script untuk checkbox select all --}}
<script>
document.getElementById('selectAll').addEventListener('change', function() {
    document.querySelectorAll('.rowCheckbox').forEach(cb => cb.checked = this.checked);
});
</script>
@endsection
