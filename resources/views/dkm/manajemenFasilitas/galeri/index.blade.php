@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Galeri</h2>
        <a href="{{ route('dkm.manajemenFasilitas.galeri.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah</a>
    </div>

    {{-- Filter Kategori (Bentuk Link) --}}
    <div class="mb-4 flex flex-wrap items-center gap-2">
        <span class="font-semibold text-gray-700">Kategori:</span>
        <a href="{{ route('dkm.manajemenFasilitas.galeri.index', request()->except('kategori_id')) }}" 
           class="px-3 py-1 text-sm rounded-full {{ !request('kategori_id') ? 'bg-blue-600 text-white shadow' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
            Semua
        </a>
        @foreach($kategoris as $kategori)
            <a href="{{ route('dkm.manajemenFasilitas.galeri.index', array_merge(request()->query(), ['kategori_id' => $kategori->id])) }}"
               class="px-3 py-1 text-sm rounded-full {{ request('kategori_id') == $kategori->id ? 'bg-blue-600 text-white shadow' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                {{ $kategori->nama }}
            </a>
        @endforeach
    </div>

    {{-- Filter Bulan dan Tahun (Form Terpisah) --}}
    <form method="GET" action="{{ route('dkm.manajemenFasilitas.galeri.index') }}" class="mb-4">
        @if(request('kategori_id'))
            <input type="hidden" name="kategori_id" value="{{ request('kategori_id') }}">
        @endif
        
        <div class="flex items-end gap-4">
            <div>
                <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                <select name="bulan" id="bulan" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">Semua Bulan</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                <select name="tahun" id="tahun" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter Tanggal</button>
        </div>
    </form>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    {{-- Tabel Galeri --}}
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
                    <td class="border px-4 py-2">{{ $item->tanggal->translatedFormat('l, d-m-Y') }}</td>
                    <td class="border px-4 py-2">
                        @if(is_array($item->gambar))
                            @foreach($item->gambar as $img)
                                <img src="{{ asset('storage/'.$img) }}" alt="" class="w-20 h-20 object-cover inline-block">
                            @endforeach
                        @endif
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

    {{-- Paginasi --}}
    <div class="mt-4">
        {{ $galeris->appends(request()->query())->links() }}
    </div>
</div>
@endsection