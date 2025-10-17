@extends('layouts.dkm')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    
    {{-- Container Utama --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        
        {{-- Header Card --}}
        <div class="flex flex-col sm:flex-row justify-between items-center p-6 border-b border-gray-200">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Manajemen Sejarah Masjid</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola konten sejarah yang akan ditampilkan kepada pengguna.</p>
            </div>
            <a href="{{ route('dkm.tampilanPenggunaMasjid.sejarah.create') }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-teal-600 text-white font-semibold text-sm rounded-lg shadow-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                Tambah Sejarah
            </a>
        </div>

        {{-- Body Card --}}
        <div class="p-6">
            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
                    <p class="font-bold">Sukses!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            {{-- Wrapper Tabel agar Responsif --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-16">#</th>
                            <th scope="col" class="px-6 py-3">Judul</th>
                            <th scope="col" class="px-6 py-3">Deskripsi</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sejarahs as $sejarah)
                        <tr class="bg-white border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $sejarah->judul }}</td>
                            <td class="px-6 py-4 prose prose-sm max-w-lg">
                                {!! \Illuminate\Support\Str::limit(strip_tags($sejarah->deskripsi), 150, '...') !!}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{-- Scope Alpine.js dimulai di sini untuk setiap baris --}}
                                <div x-data="{ showConfirm: false }" class="relative">
                                    <div class="flex items-center justify-center space-x-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('dkm.tampilanPenggunaMasjid.sejarah.edit', $sejarah->id) }}" class="font-medium text-blue-600 hover:text-blue-800 transition">Edit</a>
                                        <span class="text-gray-300">|</span>
                                        
                                        {{-- Tombol Delete (sekarang menjadi pemicu modal) --}}
                                        <button @click.prevent="showConfirm = true" type="button" class="font-medium text-red-600 hover:text-red-800 transition">
                                            Delete
                                        </button>
                                    </div>

                                    {{-- Popover/Modal Konfirmasi --}}
                                    <div x-show="showConfirm" x-transition @click.away="showConfirm = false" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
                                        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm mx-4">
                                            <h3 class="text-lg font-bold text-gray-800 text-left">Konfirmasi Hapus</h3>
                                            <p class="text-sm text-gray-600 mt-2 text-left">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
                                            <div class="mt-6 flex justify-end space-x-3">
                                                {{-- Tombol Batal --}}
                                                <button @click="showConfirm = false" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                                    Batal
                                                </button>
                                                {{-- Form asli untuk delete, disubmit melalui Alpine --}}
                                                <form x-ref="deleteForm" action="{{ route('dkm.tampilanPenggunaMasjid.sejarah.destroy', $sejarah->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button @click="$refs.deleteForm.submit()" type="button" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                                                        Ya, Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-10 text-gray-500">
                                <p class="font-semibold mt-2">Belum ada data sejarah</p>
                                <p class="text-sm">Silakan tambahkan data sejarah baru.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection