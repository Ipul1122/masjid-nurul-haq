@extends('layouts.dkm')

@section('title', 'Manajemen Artikel')

@section('content')
<div class="bg-white p-4 sm:p-6 rounded-lg shadow-md relative">

    {{-- Header dan Notifikasi --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Artikel</h2>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Tombol Aksi dan Filter --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
        <div class="flex gap-2">
            <a href="{{ route('dkm.manajemenKonten.artikel.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-sm">+ Tambah Artikel</a>
            <a href="{{ route('dkm.kategori.artikel.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow-sm">Kelola Kategori</a>
        </div>
        <form method="GET" action="{{ route('dkm.manajemenKonten.artikel.index') }}" class="flex items-center gap-2 flex-wrap">
            <select name="kategori_id" class="border-gray-300 rounded-md shadow-sm">
                <option value="">-- Semua Kategori --</option>
                @foreach(\App\Models\KategoriArtikel::all() as $kategori)
                    <option value="{{ $kategori->id }}" @selected(request('kategori_id') == $kategori->id)>{{ $kategori->nama }}</option>
                @endforeach
            </select>
            <select name="status" class="border-gray-300 rounded-md shadow-sm">
                <option value="">-- Semua Status --</option>
                <option value="draft" @selected(request('status') == 'draft')>Draft</option>
                <option value="published" @selected(request('status') == 'published')>Published</option>
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm">Filter</button>
        </form>
    </div>

    {{-- Tampilan Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Gambar</th>
                    <th scope="col" class="px-6 py-3">Judul</th>
                    <th scope="col" class="px-6 py-3">Kategori</th>
                    <th scope="col" class="px-6 py-3">Tanggal Rilis</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($artikels as $artikel)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <img src="{{ $artikel->gambar ? asset('storage/' . $artikel->gambar) : 'https://via.placeholder.com/100' }}" alt="Gambar {{ $artikel->judul }}" class="w-16 h-16 object-cover rounded-md">
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $artikel->judul }}</td>
                        <td class="px-6 py-4">{{ $artikel->kategori->nama ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($artikel->tanggal_rilis)->translatedFormat('d F Y') }}</td>
                        <td class="px-6 py-4">
                            @if($artikel->status == 'published')
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Published</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-4">
                                <a href="{{ route('dkm.manajemenKonten.artikel.preview', $artikel->id) }}" class="font-medium text-gray-600 hover:underline" target="_blank" title="Preview">Preview</a>
                                <a href="{{ route('dkm.manajemenKonten.artikel.edit', ['artikel' => $artikel->id, 'page' => request('page', 1)]) }}" class="font-medium text-blue-600 hover:underline" title="Edit">Edit</a>
                                <button type="button" class="font-medium text-red-600 hover:underline p-0 border-0 bg-transparent delete-button" data-form-id="delete-form-{{ $artikel->id }}" title="Hapus">
                                    Hapus
                                </button>
                                <form id="delete-form-{{ $artikel->id }}" class="hidden" action="{{ route('dkm.manajemenKonten.artikel.destroy', $artikel->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada artikel.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Links --}}
    <div class="mt-6">
        {{ $artikels->appends(request()->query())->links() }}
    </div>
</div>

{{-- MODAL KONFIRMASI HAPUS --}}
{{-- Perbaikan: class 'flex' dihapus dari sini --}}
<div id="delete-modal" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <div class="text-center">
            <h3 class="text-lg font-bold text-gray-900">Konfirmasi Penghapusan</h3>
            <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.</p>
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
            deleteModal.classList.add('flex'); // Perbaikan: Tambahkan 'flex' saat modal tampil
        }
    }

    // Fungsi untuk menyembunyikan modal
    function hideModal() {
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex'); // Perbaikan: Hapus 'flex' saat modal sembunyi
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

    window.addEventListener('click', function (event) {
        if (event.target === deleteModal) {
            hideModal();
        }
    });
});
</script>
@endsection