@extends('layouts.penggunaMasjid')

@section('content')
<div class="mt-16 bg-green-50 font-sans p-8 md:py-12">
    <div class="container mx-auto max-w-2xl">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-emerald-800 mb-6 text-center">Kirim Bukti Transfer Donasi</h2>

            {{-- CATATAN PENTING:
                 Pastikan route 'donasi.kirimBukti.store' sudah didefinisikan di file web.php Anda.
                 Contoh: Route::post('/penggunaMasjid/donasi/kirimBukti', [DonasiController::class, 'storeBukti'])->name('donasi.kirimBukti.store');
                 Validasi (ukuran maks 5MB dan format) sebaiknya dilakukan di sisi server (Controller).
            --}}
            
            <form action="#" method="POST" enctype="multipart/form-data" id="uploadForm" class="space-y-6">
                @csrf

                <div>
                    <label for="nama_donatur" class="block text-sm font-medium text-gray-700 mb-1">Nama Anda</label>
                    <input type="text" name="nama_donatur" id="nama_donatur" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition duration-150 ease-in-out"
                           placeholder="Masukkan nama lengkap Anda">
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
                            class="w-full bg-emerald-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-emerald-600 transition-all duration-300 ease-in-out">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('uploadForm').addEventListener('submit', function(event) {
    const fileInput = document.getElementById('bukti_transfer');
    const fileError = document.getElementById('file-error');
    
    // Sembunyikan pesan error sebelumnya
    fileError.classList.add('hidden');
    fileError.textContent = '';

    // Cek apakah ada file yang dipilih
    if (fileInput.files.length === 0) {
        return; // Validasi 'required' dari HTML akan menangani ini
    }

    const file = fileInput.files[0];
    const maxSize = 5 * 1024 * 1024; // 5 MB in bytes

    // Cek ukuran file
    if (file.size > maxSize) {
        event.preventDefault(); // Mencegah form dikirim
        fileError.textContent = 'Ukuran file tidak boleh lebih dari 5 MB.';
        fileError.classList.remove('hidden');
    }
});
</script>
@endsection