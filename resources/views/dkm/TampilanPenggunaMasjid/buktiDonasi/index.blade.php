@extends('layouts.dkm')

@section('title', 'Bukti Donasi')

@section('content')

{{-- ELEMEN POPOVER KONFIRMASI START --}}
<div id="confirmation-backdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
<div id="confirmation-popover" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-xl p-6 z-50 w-full max-w-md hidden">
    <h3 id="popover-title" class="text-lg font-bold text-gray-900 mb-4">Konfirmasi Tindakan</h3>
    <p id="popover-message" class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin melanjutkan?</p>
    <div class="flex justify-end space-x-3">
        <button id="cancel-button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
            Batal
        </button>
        <button id="confirm-button" class="px-4 py-2 text-white rounded-lg">
            Lanjutkan
        </button>
    </div>
</div>
{{-- ELEMEN POPOVER KONFIRMASI END --}}


<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Verifikasi Bukti Donasi</h1>

    {{-- Notifikasi Sukses dari Sesi Laravel --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p class="font-bold">Sukses</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nama Donatur
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Bukti Transfer
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tanggal Kirim
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donasiPending as $donasi)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $donasi->nama_donatur }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ asset('bukti_donasi/' . $donasi->file_bukti) }}" target="_blank">
                                <img src="{{ asset('bukti_donasi/' . $donasi->file_bukti) }}" alt="Bukti" class="w-24 h-auto rounded">
                            </a>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $donasi->created_at->format('d M Y, H:i') }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            <div class="flex justify-center items-center space-x-2">
                                <form id="verify-form-{{ $donasi->id }}" action="{{ route('dkm.tampilanPenggunaMasjid.buktiDonasi.verify', $donasi->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="action-button bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full"
                                            data-form-id="verify-form-{{ $donasi->id }}"
                                            data-message="Apakah Anda yakin ingin memverifikasi donasi ini?"
                                            data-button-color="bg-green-500">
                                        Ya
                                    </button>
                                </form>
                                <form id="reject-form-{{ $donasi->id }}" action="{{ route('dkm.tampilanPenggunaMasjid.buktiDonasi.reject', $donasi->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-button bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                                            data-form-id="reject-form-{{ $donasi->id }}"
                                            data-message="PERHATIAN: Donasi ini akan dihapus permanen. Lanjutkan?"
                                            data-button-color="bg-red-500">
                                        Tidak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 px-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-500">Tidak ada bukti donasi yang perlu diverifikasi saat ini.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const backdrop = document.getElementById('confirmation-backdrop');
    const popover = document.getElementById('confirmation-popover');
    const popoverMessage = document.getElementById('popover-message');
    const confirmButton = document.getElementById('confirm-button');
    const cancelButton = document.getElementById('cancel-button');
    const actionButtons = document.querySelectorAll('.action-button');

    let formToSubmit = null;

    function showPopover() {
        backdrop.classList.remove('hidden');
        popover.classList.remove('hidden');
    }

    function hidePopover() {
        backdrop.classList.add('hidden');
        popover.classList.add('hidden');
    }

    actionButtons.forEach(button => {
        button.addEventListener('click', function () {
            formToSubmit = document.getElementById(this.dataset.formId);
            popoverMessage.textContent = this.dataset.message;
            
            // Atur warna tombol konfirmasi
            confirmButton.className = 'px-4 py-2 text-white rounded-lg'; // Reset kelas
            confirmButton.classList.add(this.dataset.buttonColor);

            showPopover();
        });
    });

    confirmButton.addEventListener('click', function () {
        if (formToSubmit) {
            formToSubmit.submit();
        }
        hidePopover();
    });

    cancelButton.addEventListener('click', hidePopover);
    backdrop.addEventListener('click', hidePopover);
});
</script>

@endsection