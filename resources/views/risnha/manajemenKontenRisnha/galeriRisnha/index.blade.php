@extends('layouts.risnha')

@section('title', 'Manajemen Galeri Risnha')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-900">
            Manajemen Galeri Risnha
        </h1>
        <div class="flex items-center gap-3">
            <a href="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.create') }}" 
               class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                + Tambah Galeri
            </a>
            <a href="{{ route('penggunaMasjid.risnhaMasjid.galeriRisnhaMasjid') }}" 
               target="_blank" 
               class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                Lihat Halaman Publik
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Galeri
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Foto
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Deskripsi
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($galeri as $index => $g)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-middle">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 align-middle">
                                {{ $g->nama_galeri }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 align-middle">
                                {{ $g->kategori?->nama_kategori ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 align-middle">
                                @if ($g->foto)
                                    <img src="{{ asset('storage/' . $g->foto) }}" alt="Foto Galeri" width="100" class="rounded border border-gray-200">
                                @else
                                    <span class="text-gray-500">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 align-middle whitespace-normal break-words">
                                {{ $g->deskripsi }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium align-middle">
                                <a href="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.edit', $g->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.destroy', $g->id) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-900" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                Belum ada data galeri
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection