@extends('layouts.dkm')

@section('title', 'Jadwal Imam')

@section('content')
<div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">

    {{-- Header dan Tombol Tambah Atas --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-3 sm:mb-0">Jadwal Imam</h2>
        <a href="{{ route('dkm.manajemenKonten.jadwalImam.create') }}" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition duration-300 text-center">
            <i class="fas fa-plus mr-2"></i>Tambah Jadwal
        </a>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Kontainer Jadwal --}}
    <div class="space-y-4">

        {{-- Header untuk Tampilan Desktop (LG) --}}
        <div class="hidden lg:grid lg:grid-cols-4 gap-4 bg-gray-100 p-4 rounded-t-lg font-bold text-gray-600">
            <div>Foto Imam</div>
            <div>Nama Imam</div>
            <div>Waktu Sholat</div>
            <div class="text-center">Aksi</div>
        </div>

        {{-- Loop Data Jadwal Imam --}}
        @forelse($jadwal as $j)
            <div class="bg-gray-50 border rounded-lg p-4 grid grid-cols-1 lg:grid-cols-4 gap-4 items-center hover:bg-gray-100 transition duration-300">

                {{-- Kolom Foto Imam --}}
                <div class="flex justify-center lg:justify-start">
                    @if($j->gambar)
                        <img src="{{ asset('storage/'.$j->gambar) }}" class="w-20 h-20 object-cover rounded-full shadow-sm">
                    @else
                        <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                    @endif
                </div>

                {{-- Kolom Nama Imam --}}
                <div class="text-center lg:text-left">
                    <div class="font-bold text-gray-600 lg:hidden mb-1">Nama Imam</div>
                    <div class="text-gray-800 text-lg">{{ $j->nama }}</div>
                </div>

                {{-- Kolom Waktu Sholat --}}
                <div class="text-center lg:text-left">
                    <div class="font-bold text-gray-600 lg:hidden mb-1">Waktu Sholat</div>
                    <div class="text-gray-800">{{ $j->waktu_sholat }}</div>
                </div>

                {{-- Kolom Aksi --}}
                <div class="flex gap-2 justify-center items-center mt-2 lg:mt-0">
                    <a href="{{ route('dkm.manajemenKonten.jadwalImam.edit', $j->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-300 text-sm">
                       <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit</span>
                    </a>

                    {{-- Tombol Hapus yang memicu modal --}}
                    <button type="button" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition duration-300 text-sm delete-button" data-form-id="delete-form-{{ $j->id }}">
                        <i class="fas fa-trash"></i> <span class="hidden sm:inline">Hapus</span>
                    </button>

                    {{-- Form Hapus yang tersembunyi --}}
                    <form id="delete-form-{{ $j->id }}" class="hidden" action="{{ route('dkm.manajemenKonten.jadwalImam.destroy', $j->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

            </div>
        @empty
            <div class="text-center py-10 bg-gray-50 rounded-lg">
                <p class="text-gray-500">Belum ada jadwal imam yang ditambahkan.</p>
            </div>
        @endforelse
    </div>

    {{-- Tombol Tambah Bawah (Opsional, jika masih diperlukan) --}}
    <div class="mt-8 flex justify-end">
         <a href="{{ route('dkm.manajemenKonten.jadwalImam.create') }}" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition duration-300 text-center">
            <i class="fas fa-plus mr-2"></i>Tambah Jadwal
        </a>
    </div>

</div>

{{-- MODAL KONFIRMASI HAPUS --}}
<div id="delete-modal" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <div class="text-center">
            <h3 class="text-lg font-bold text-gray-900">Konfirmasi Penghapusan</h3>
            <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus jadwal ini? Tindakan ini tidak dapat dibatalkan.</p>
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