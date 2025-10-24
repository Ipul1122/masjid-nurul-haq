@extends('layouts.dkm')

@section('title', 'Daftar Galeri')

@section('content')
<div class="bg-white p-6 rounded shadow">
    {{-- ✅ PERUBAHAN DIMULAI DI SINI --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Galeri</h2>
        <div class="flex gap-2">
            <a href="{{ route('dkm.manajemenFasilitas.galeri.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Tambah</a>
            <a href="{{ route('dkm.kategori.galeri.index') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Kelola Kategori</a>
        </div>
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
        
        <div class="flex items-end gap-4 flex-wrap"> {{-- Tambahkan flex-wrap --}}
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
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow-sm">Filter Tanggal</button> {{-- Sedikit styling --}}
        </div>
    </form>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div> {{-- Perbaikan styling notifikasi --}}
    @endif

    {{-- Tabel Galeri --}}
    <div class="overflow-x-auto"> {{-- Tambahkan overflow --}}
        <table class="w-full border-collapse border text-sm"> {{-- Ukuran font --}}
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2 text-left">Kategori</th> {{-- Text align --}}
                    <th class="border px-4 py-2 text-left">Judul</th>
                    <th class="border px-4 py-2 text-left">Tanggal</th>
                    <th class="border px-4 py-2 text-left">Gambar</th>
                    <th class="border px-4 py-2 text-left">Deskripsi</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galeris as $item)
                    <tr class="hover:bg-gray-50"> {{-- Hover effect --}}
                        <td class="border px-4 py-2">{{ $item->kategori?->nama ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $item->judul }}</td>
                        <td class="border px-4 py-2 whitespace-nowrap">{{ $item->tanggal->translatedFormat('d M Y') }}</td> {{-- Format lebih pendek & nowrap --}}
                        <td class="border px-4 py-2">
                            @if(is_array($item->gambar))
                                <div class="flex flex-wrap gap-2"> {{-- Flex wrap untuk gambar --}}
                                    @foreach($item->gambar as $img)
                                        <img src="{{ asset('storage/'.$img) }}" alt="Gambar {{ $item->judul }}" class="w-16 h-16 object-cover rounded"> {{-- Ukuran & rounded --}}
                                    @endforeach
                                </div>
                            @elseif(is_string($item->gambar)) {{-- Handle jika hanya string --}}
                                <img src="{{ asset('storage/'.$item->gambar) }}" alt="Gambar {{ $item->judul }}" class="w-16 h-16 object-cover rounded">
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $item->deskripsi ?? '-' }}</td>
                        <td class="border px-4 py-2">
                            <div class="flex justify-center gap-2"> {{-- Flex & gap --}}
                                <a href="{{ route('dkm.manajemenFasilitas.galeri.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">Edit</a> {{-- Warna & ukuran font --}}
                                
                                {{-- Tombol Hapus dengan Modal --}}
                                <button type="button" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs delete-button" data-form-id="delete-form-{{ $item->id }}">
                                    Hapus
                                </button>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('dkm.manajemenFasilitas.galeri.destroy', $item->id) }}" method="POST" class="hidden">
                                    @csrf 
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4 border">Belum ada data galeri</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>


    {{-- Paginasi --}}
    <div class="mt-4">
        {{ $galeris->appends(request()->query())->links() }}
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div id="delete-modal" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm mx-4">
        <div class="text-center">
            <h3 class="text-lg font-bold text-gray-900">Konfirmasi Penghapusan</h3>
            <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus item galeri ini? Gambar terkait juga akan dihapus.</p>
        </div>
        <div class="mt-6 flex justify-center gap-4">
            <button id="cancel-delete" type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                Batal
            </button>
            <button id="confirm-delete" type="button" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

{{-- Script untuk Modal Hapus --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('delete-modal');
    const cancelDeleteButton = document.getElementById('cancel-delete');
    const confirmDeleteButton = document.getElementById('confirm-delete');
    const deleteButtons = document.querySelectorAll('.delete-button');
    let formToSubmit = null;

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const formId = this.getAttribute('data-form-id');
            formToSubmit = document.getElementById(formId);
            if (formToSubmit) {
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex'); // Tampilkan modal
            }
        });
    });

    cancelDeleteButton.addEventListener('click', function () {
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex'); // Sembunyikan modal
        formToSubmit = null;
    });

    confirmDeleteButton.addEventListener('click', function () {
        if (formToSubmit) {
            formToSubmit.submit();
        }
    });

    // Klik di luar modal untuk menutup
    window.addEventListener('click', function (event) {
        if (event.target === deleteModal) {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex'); // Sembunyikan modal
            formToSubmit = null;
        }
    });
});
</script>
@endsection
