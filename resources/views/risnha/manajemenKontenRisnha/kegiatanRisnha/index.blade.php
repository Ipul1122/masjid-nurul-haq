@extends('layouts.risnha')

@section('title', 'Manajemen Kegiatan Risnha')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-900">
            Manajemen Kegiatan Risnha
        </h1>
        <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.create') }}" 
           class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
            <i class="fa fa-plus mr-2"></i>
            Tambah Kegiatan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-6" role="alert">
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
                            Nama Kegiatan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Gambar
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 150px;">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($kegiatanRisnha as $kegiatan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $kegiatan->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $kegiatan->kategori->nama_kategori ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($kegiatan->gambar)
                                    <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="gambar" width="100" class="rounded border border-gray-200">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($kegiatan->status == 'published')
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full bg-blue-100 text-blue-800">
                                        Dipublikasikan
                                    </span>
                                @else
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full bg-yellow-100 text-yellow-800">
                                        Draf
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.preview', $kegiatan->id) }}" class="text-blue-600 hover:text-blue-900 mr-3" title="Pratinjau">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.edit', $kegiatan->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.destroy', $kegiatan->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                Tidak ada data kegiatan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection