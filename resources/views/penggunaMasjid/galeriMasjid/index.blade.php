@extends('layouts.penggunaMasjid')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header -->
    <div class="mb-6 mt-16">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Galeri Masjid</h2>
        <p class="mt-1 text-sm text-gray-600">Dokumentasi kegiatan dan momen di masjid</p>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-6 mb-6">
        <!-- Filter Kategori -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-3">Filter Kategori</label>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('penggunaMasjid.galeriMasjid.index', request()->except('kategori_id')) }}" 
                   class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ !request('kategori_id') ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Semua
                </a>
                @foreach($kategoris as $kategori)
                    <a href="{{ route('penggunaMasjid.galeriMasjid.index', array_merge(request()->query(), ['kategori_id' => $kategori->id])) }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request('kategori_id') == $kategori->id ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ $kategori->nama }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-gray-200 my-5"></div>

        <!-- Filter Tanggal -->
        <form method="GET" action="{{ route('penggunaMasjid.galeriMasjid.index') }}">
            @if(request('kategori_id'))
                <input type="hidden" name="kategori_id" value="{{ request('kategori_id') }}">
            @endif
            
            <label class="block text-sm font-semibold text-gray-700 mb-3">Filter Tanggal</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                <div>
                    <select name="bulan" id="bulan" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="">Semua Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div>
                    <select name="tahun" id="tahun" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="">Semua Tahun</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-200 shadow-sm">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        @forelse($galeris as $item)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                @if(is_array($item->gambar))
                    @foreach($item->gambar as $img)
                        <div class="aspect-video w-full overflow-hidden bg-gray-100">
                            <img src="{{ asset('storage/'.$img) }}" 
                                 alt="{{ $item->judul }}" 
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                    @endforeach
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 text-lg mb-1 line-clamp-2">{{ $item->judul }}</h3>
                    <p class="text-xs text-gray-500 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $item->tanggal->translatedFormat('l, d-m-Y') }}
                    </p>
                    @if($item->deskripsi)
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $item->deskripsi }}</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p class="mt-3 text-gray-600 font-medium">Belum ada data galeri</p>
                    <p class="mt-1 text-sm text-gray-500">Galeri akan muncul di sini setelah ditambahkan</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($galeris->hasPages())
        <div class="mt-8">
            {{ $galeris->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection