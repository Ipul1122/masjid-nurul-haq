@extends('layouts.dkm')

@section('title', 'Sejarah Masjid')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">

    {{-- Header Halaman --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Sejarah Masjid</h1>
        <a href="{{ route('dkm.tampilanPenggunaMasjid.sejarah.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold text-sm rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Sejarah
        </a>
    </div>

    {{-- Notifikasi Sukses --}}
    @if ($message = Session::get('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
             class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <p>{{ $message }}</p>
        </div>
    @endif

    {{-- Notifikasi Peringatan Tahun Hilang --}}
    @if ($warning = Session::get('warning_no_year'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition
             class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 mb-6 rounded-md shadow-sm" role="alert">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.485 2.495c.646-1.136 2.384-1.136 3.03 0l6.29 11.007a1.875 1.875 0 0 1-1.516 2.748H3.71A1.875 1.875 0 0 1 2.195 13.5L8.485 2.495ZM10 6a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 6Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                </svg>
                <p>{{ $warning }}</p>
            </div>
        </div>
    @endif


    {{-- Tabel Daftar Sejarah --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi Singkat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($sejarahs as $index => $sejarah)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <div class="flex items-center gap-x-2">
                                    <span>{{ $sejarah->judul }}</span>
                                    @if(!preg_match('/(\d{4})/', $sejarah->judul))
                                        <div class="group relative flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-yellow-500">
                                                <path fill-rule="evenodd" d="M8.485 2.495c.646-1.136 2.384-1.136 3.03 0l6.29 11.007a1.875 1.875 0 0 1-1.516 2.748H3.71A1.875 1.875 0 0 1 2.195 13.5L8.485 2.495ZM10 6a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 6Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 w-max max-w-xs px-2 py-1 bg-gray-900 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-10 pointer-events-none">
                                                Tanpa tahun 4 digit
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{!! Str::limit(strip_tags($sejarah->deskripsi), 50) !!}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                {{-- Tombol Edit (Tetap) --}}
                                <a href="{{ route('dkm.tampilanPenggunaMasjid.sejarah.edit',$sejarah->id) }}" class="text-indigo-600 hover:text-indigo-900 transition">Edit</a>

                                <button type="button"
                                        class="text-red-600 hover:text-red-900 transition delete-trigger-button"
                                        data-form-id="delete-form-{{ $sejarah->id }}"> 
                                    Hapus
                                </button>

                                <form id="delete-form-{{ $sejarah->id }}"
                                      action="{{ route('dkm.tampilanPenggunaMasjid.sejarah.destroy',$sejarah->id) }}"
                                      method="POST"
                                      class="hidden"> 
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-sm text-gray-500">
                                Belum ada data sejarah yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="delete-modal" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50 hidden"> {{-- Pastikan 'flex' dihapus dari sini --}}
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm transform transition-all scale-95 opacity-0" id="delete-modal-content"> {{-- ID baru untuk animasi --}}
        <div class="text-center">
            <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <h3 class="text-lg font-bold text-gray-900">Konfirmasi Penghapusan</h3>
            <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus data sejarah ini? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="mt-6 flex justify-center gap-4">
            <button id="cancel-delete" type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                Batal
            </button>
            <button id="confirm-delete" type="button" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('delete-modal');
    const deleteModalContent = document.getElementById('delete-modal-content'); 
    const cancelDeleteButton = document.getElementById('cancel-delete');
    const confirmDeleteButton = document.getElementById('confirm-delete');
    const deleteTriggerButtons = document.querySelectorAll('.delete-trigger-button'); 
    let formToSubmit = null;

    function showModal() {
        if (formToSubmit && deleteModal) {
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex'); 
            void deleteModalContent.offsetWidth; 
            deleteModalContent.classList.remove('scale-95', 'opacity-0');
            deleteModalContent.classList.add('scale-100', 'opacity-100');
        }
    }

    // Fungsi untuk menyembunyikan modal dengan animasi
    function hideModal() {
        if (deleteModal) {
            deleteModalContent.classList.remove('scale-100', 'opacity-100');
            deleteModalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex'); 
                formToSubmit = null; 
            }, 150); 
        }
    }

    // Tambahkan event listener ke setiap tombol "Hapus" di tabel
    deleteTriggerButtons.forEach(button => {
        button.addEventListener('click', function () {
            const formId = this.getAttribute('data-form-id');
            formToSubmit = document.getElementById(formId);
            if (formToSubmit) {
                showModal();
            } else {
                console.error('Form not found for ID:', formId);
            }
        });
    });

    // Event listener untuk tombol "Batal" di modal
    cancelDeleteButton.addEventListener('click', function () {
        hideModal();
    });

    // Event listener untuk tombol "Ya, Hapus" di modal
    confirmDeleteButton.addEventListener('click', function () {
        if (formToSubmit) {
            formToSubmit.submit(); 
        } else {
            console.error('No form selected to submit.');
            hideModal(); 
        }
    });

    // Event listener untuk menutup modal jika klik di luar kontennya
    window.addEventListener('click', function (event) {
        if (event.target === deleteModal) {
            hideModal();
        }
    });

    // Event listener untuk menutup modal dengan tombol Escape
    window.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
            hideModal();
        }
    });
});
</script>
@endsection
