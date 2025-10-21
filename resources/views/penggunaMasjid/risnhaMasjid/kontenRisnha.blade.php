@extends('layouts.risnhaMasjid.risnhaMasjid')

@section('title', 'Konten Risnha')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4 text-center">Konten Risnha</h1>
    <p class="text-center text-gray-600 mb-8">Jelajahi artikel dan kegiatan terbaru dari Risnha Masjid Nurul Haq.</p>

    <div class="flex justify-center space-x-2 mb-10">
        <a href="{{ route('penggunaMasjid.risnhaMasjid.kontenRisnha', ['filter' => 'semua']) }}"
           class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $filter === 'semua' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
            Semua
        </a>
        <a href="{{ route('penggunaMasjid.risnhaMasjid.kontenRisnha', ['filter' => 'artikel']) }}"
           class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $filter === 'artikel' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
            Artikel
        </a>
        <a href="{{ route('penggunaMasjid.risnhaMasjid.kontenRisnha', ['filter' => 'kegiatan']) }}"
           class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $filter === 'kegiatan' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
            Kegiatan
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($konten as $item)
            @php
                // Menentukan path gambar berdasarkan properti 'tipe'
                $imagePath = ($item->tipe == 'artikel')
                    ? 'storage/artikel_risnha/'
                    : 'storage/kegiatan_risnha/';
            @endphp
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-xs font-semibold {{ $item->tipe == 'artikel' ? 'text-blue-600' : 'text-green-600' }} uppercase">{{ $item->tipe }}</span>
                    <h3 class="text-xl font-semibold my-2">{{ $item->judul }}</h3>
                    <p class="text-gray-700 text-sm">{{ Str::limit(strip_tags($item->deskripsi), 120) }}</p>
                    <a href="{{ route('penggunaMasjid.risnhaMasjid.lihatKontenRisnha', ['type' => $item->tipe, 'id' => $item->id]) }}" class="text-blue-500 hover:underline mt-4 inline-block font-medium">
                        Baca Selengkapnya &rarr;
                    </a>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 lg:col-span-3 text-center py-12">
                <p class="text-gray-500 text-lg">Tidak ada konten yang ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $konten->links() }}
    </div>
</div>
@endsection