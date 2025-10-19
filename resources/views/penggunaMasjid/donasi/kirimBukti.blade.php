@extends('layouts.penggunaMasjid')

@section('title', 'Kirim Bukti')

@section('content')

{{-- ELEMEN POPOVER START --}}
<div id="success-popover" class="fixed top-5 right-5 bg-green-500 text-white py-3 px-6 rounded-lg shadow-xl transform transition-all duration-300 ease-in-out z-50 translate-x-full hidden">
    <div class="flex items-center space-x-3">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <p class="font-semibold">Bukti Anda sudah dikirim dan akan segera diinformasikan.</p>
    </div>
</div>
{{-- ELEMEN POPOVER END --}}

<div class="mt-16 bg-green-50 font-sans p-8 md:py-12">
    <div class="container mx-auto max-w-2xl">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-emerald-800 mb-6 text-center">Kirim Bukti Transfer Donasi</h2>
            
            <form action="{{ route('penggunaMasjid.donasi.kirimBukti.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm" class="space-y-6">
                @csrf

                <div>
                    <label for="nama_donatur" class="block text-sm font-medium text-gray-700 mb-1">Nama Anda</label>
                    <input type="text" name="nama_donatur" id="nama_donatur" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out"
                           placeholder="Jika tidak masukkan nama, boleh hamba allah">
                </div>

                <div>
                    <label for="bukti_transfer" class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti Transfer</label>
                    <input type="file" name="bukti_transfer" id="bukti_transfer" required accept=".png,.jpg,.jpeg"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    <p class="mt-1 text-xs text-gray-500">Format file: PNG, JPG, JPEG. Ukuran maksimal: 5 MB.</p>
                    <p id="file-error" class="mt-1 text-xs text-red-600 hidden"></p>
                </div>

                <div>
                    <button type="submit"
                            id="submit-button"
                            class="w-full bg-emerald-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-emerald-600 transition-all duration-300 ease-in-out flex items-center justify-center space-x-2">
                        <span>Kirim</span>
                        {{-- SPINNER UNTUK INDIKATOR LOADING --}}
                        <svg id="loading-spinner" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('uploadForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah form dikirim secara langsung

    const form = this;
    const fileInput = document.getElementById('bukti_transfer');
    const fileError = document.getElementById('file-error');
    const submitButton = document.getElementById('submit-button');
    const loadingSpinner = document.getElementById('loading-spinner');
    
    fileError.classList.add('hidden');
    fileError.textContent = '';

    if (fileInput.files.length === 0) {
        // Biarkan validasi 'required' HTML yang menangani
        form.reportValidity(); 
        return;
    }

    const file = fileInput.files[0];
    const maxSize = 5 * 1024 * 1024; // 5 MB

    if (file.size > maxSize) {
        fileError.textContent = 'Ukuran file tidak boleh lebih dari 5 MB.';
        fileError.classList.remove('hidden');
        return;
    }

    // Nonaktifkan tombol dan tunjukkan spinner
    submitButton.disabled = true;
    submitButton.classList.add('cursor-not-allowed', 'bg-emerald-700');
    loadingSpinner.classList.remove('hidden');

    // Tampilkan popover
    const popover = document.getElementById('success-popover');
    popover.classList.remove('hidden');
    setTimeout(() => {
        popover.classList.remove('translate-x-full'); // Animasi masuk
    }, 10);

    // Setelah 3 detik, sembunyikan popover dan kirim form
    setTimeout(() => {
        popover.classList.add('translate-x-full'); // Animasi keluar
        setTimeout(() => {
            popover.classList.add('hidden');
            form.submit(); // Kirim form setelah animasi selesai
        }, 300);
    }, 3000); // 3000 milidetik = 3 detik
});
</script>
@endsection