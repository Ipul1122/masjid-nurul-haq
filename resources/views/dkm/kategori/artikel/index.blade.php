@extends('layouts.dkm')

@section('title', 'Kategori Artikel')

@section('content')
<div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Kategori Artikel</h2>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Tombol Aksi --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
        <div class="flex gap-2">
            <a href="{{ route('dkm.kategori.artikel.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-sm">+ Tambah Kategori</a>
            <a href="{{ route('dkm.manajemenKonten.artikel.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow-sm">Kembali ke Artikel</a>
        </div>
    </div>

    {{-- Tampilan Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Nama Kategori</th>
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoriArtikel as $item)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $item->id }}</td>
                    <td class="px-6 py-4">{{ $item->nama }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-4">
                            <a href="{{ route('dkm.kategori.artikel.edit', $item->id) }}" class="font-medium text-blue-600 hover:underline" title="Edit">Edit</a>
                            
                            {{-- Tombol pemicu modal --}}
                            <button type="button" class="font-medium text-red-600 hover:underline p-0 border-0 bg-transparent delete-button" data-form-id="delete-form-{{ $item->id }}" title="Hapus">
                                Hapus
                            </button>

                            {{-- Form hapus tersembunyi --}}
                            <form id="delete-form-{{ $item->id }}" class="hidden" action="{{ route('dkm.kategori.artikel.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">Belum ada kategori artikel.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL KONFIRMASI HAPUS --}}
<div id="delete-modal" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <div class="text-center">
            <h3 class="text-lg font-bold text-gray-900">Konfirmasi Penghapusan</h3>
            <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus kategori ini? Tindakan ini tidak dapat dibatalkan.</p>
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

{{-- JAVASCRIPT UNTUK MODAL --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('delete-modal');
    const cancelDeleteButton = document.getElementById('cancel-delete');
    const confirmDeleteButton = document.getElementById('confirm-delete');
    const deleteButtons = document.querySelectorAll('.delete-button');
    let formToSubmit = null;

    // Fungsi untuk menampilkan modal
    function showModal() {
        if (formToSubmit) {
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
        }
    }

    // Fungsi untuk menyembunyikan modal
    function hideModal() {
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex');
        formToSubmit = null;
    }

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const formId = this.getAttribute('data-form-id');
            formToSubmit = document.getElementById(formId);
            showModal();
        });
    });

    cancelDeleteButton.addEventListener('click', function () {
        hideModal();
    });

    confirmDeleteButton.addEventListener('click', function () {
        if (formToSubmit) {
            formToSubmit.submit();
        }
    });

    // Sembunyikan modal jika klik di luar area modal
    window.addEventListener('click', function (event) {
        if (event.target === deleteModal) {
            hideModal();
        }
    });
});
</script>
@endsection