@extends('layouts.risnha')

@section('title', 'Manajemen Artikel Risnha')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-900">
            Manajemen Artikel Risnha
        </h1>
        <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.create') }}" 
           class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
            <i class="fa fa-plus mr-2"></i>
            Tambah Artikel
        </a>
    </div>

    @if (session('success'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 5%;">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Artikel
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
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="width: 15%;">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($artikel as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-middle">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 align-middle">
                                {{ $item->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 align-middle">
                                {{ $item->kategori->nama ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 align-middle">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                                         alt="Gambar Artikel" 
                                         width="100" 
                                         class="rounded border border-gray-200">
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 align-middle">
                                @if($item->status == 'published')
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full bg-blue-100 text-blue-800">
                                        Dipublikasikan
                                    </span>
                                @else
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full bg-yellow-100 text-yellow-800">
                                        Draf
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center align-middle">
                                <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.preview', $item->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 mr-3" title="Pratinjau">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.edit', $item->id) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 mr-3" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.destroy', $item->id) }}" 
                                      method="POST" 
                                      class="inline-block" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-900" type="submit" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                Belum ada artikel.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $artikel->links() }}
        </div>
    </div>
</div>

@endsection