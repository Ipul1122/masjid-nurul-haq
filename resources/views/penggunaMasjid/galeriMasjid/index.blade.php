@extends('layouts.penggunaMasjid')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Galeri Masjid</h2>

    {{-- Filter Kategori (Bentuk Link) --}}
    <div class="mb-4 flex flex-wrap items-center gap-2">
        <span class="font-semibold text-gray-700">Kategori:</span>
        <a href="{{ route('penggunaMasjid.galeriMasjid.index', request()->except('kategori_id')) }}" 
           class="px-3 py-1 text-sm rounded-full {{ !request('kategori_id') ? 'bg-blue-600 text-white shadow' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
            Semua
        </a>
        @foreach($kategoris as $kategori)
            <a href="{{ route('penggunaMasjid.galeriMasjid.index', array_merge(request()->query(), ['kategori_id' => $kategori->id])) }}"
               class="px-3 py-1 text-sm rounded-full {{ request('kategori_id') == $kategori->id ? 'bg-blue-600 text-white shadow' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
                {{ $kategori->nama }}
            </a>
        @endforeach
    </div>

    {{-- Filter Bulan dan Tahun (Form Terpisah) --}}
    <form method="GET" action="{{ route('penggunaMasjid.galeriMasjid.index') }}" class="mb-4">
        {{-- Ini penting untuk menyimpan filter kategori saat filter tanggal digunakan --}}
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

    {{-- Konten Galeri --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @forelse($galeris as $item)
            <div class="border rounded shadow">
                @if(is_array($item->gambar))
                    @foreach($item->gambar as $img)
                        <img src="{{ asset('storage/'.$img) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
                    @endforeach
                @endif
                <div class="p-4">
                    <h3 class="font-bold">{{ $item->judul }}</h3>
                    <p class="text-sm text-gray-600">{{ $item->tanggal->translatedFormat('l, d-m-Y') }}</p>
                    <p class="mt-2">{{ $item->deskripsi ?? '-' }}</p>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center py-3">Belum ada data galeri.</p>
        @endforelse
    </div>

    {{-- Paginasi (Penting: appends() untuk menjaga filter tetap aktif) --}}
    <div class="mt-4">
        {{ $galeris->appends(request()->query())->links() }}
    </div>
</div>
@endsection