@extends('layouts.penggunaMasjid')

@section('title', 'Kirim Bukti')

@section('content')

{{-- ELEMEN POPOVER START --}}
<div id="success-popover" class="fixed top-24 right-5 bg-emerald-600 text-white py-4 px-6 rounded-2xl shadow-2xl transform transition-all duration-300 ease-in-out z-50 translate-x-full hidden font-montserrat">
    <div class="flex items-center space-x-3">
        <div class="bg-white/20 rounded-full w-8 h-8 flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <p class="font-bold text-sm">Bukti Anda sudah dikirim dan akan segera diinformasikan.</p>
    </div>
</div>
{{-- ELEMEN POPOVER END --}}

<div class="min-h-screen bg-slate-50 py-12 font-quicksand mt-12 flex items-center">
    <div class="container mx-auto max-w-2xl px-4">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            
            {{-- Header Form --}}
            <div class="bg-gradient-to-r from-emerald-600 to-teal-800 px-6 py-8 text-white text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
                
                @if(isset($lastDonasi) && $lastDonasi)
                    <h2 class="text-2xl font-extrabold mb-2 relative z-10 font-montserrat tracking-tight">Unggah Screenshot Donasi</h2>
                    <p class="text-emerald-100 text-sm relative z-10 font-light italic">Silakan unggah screenshot bukti pembayaran sukses Anda (Opsional).</p>
                @else
                    <h2 class="text-2xl font-extrabold mb-2 relative z-10 font-montserrat tracking-tight">Kirim Bukti Transfer Donasi</h2>
                    <p class="text-emerald-100 text-sm relative z-10 font-light italic">Silakan unggah bukti transfer Anda untuk proses verifikasi manual.</p>
                @endif
            </div>

            <div class="p-8 md:p-10">
                <form action="{{ route('penggunaMasjid.donasi.kirimBukti.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm" class="space-y-6">
                    @csrf

                    @if(isset($lastDonasi) && $lastDonasi)
                        {{-- Tampilkan info donasi yang baru selesai dibayar --}}
                        <div class="bg-emerald-50/40 border border-emerald-100 rounded-2xl p-5 mb-6">
                            <h3 class="text-xs font-bold text-emerald-800 font-montserrat uppercase tracking-wider mb-3">Ringkasan Pembayaran</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm font-medium">
                                <div>
                                    <span class="text-gray-400 block text-xs">Nama Donatur</span>
                                    <span class="text-gray-800 font-bold font-montserrat">{{ $lastDonasi->nama_donatur }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-400 block text-xs">Jumlah Donasi</span>
                                    <span class="text-emerald-600 font-black font-montserrat text-base">Rp {{ number_format($lastDonasi->nominal, 0, ',', '.') }}</span>
                                </div>
                                <div class="sm:col-span-2">
                                    <span class="text-gray-400 block text-xs">Pesan atau Doa</span>
                                    <span class="text-gray-600 italic">"{{ $lastDonasi->pesan ?? 'Jazakumullah Khairan Katsiran' }}"</span>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Tampilkan input field lengkap untuk transfer manual reguler --}}
                        <div>
                            <label for="nama_donatur" class="block text-sm font-extrabold text-gray-700 mb-2 font-montserrat">Nama Donatur</label>
                            <input type="text" name="nama_donatur" id="nama_donatur" required
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-200 text-gray-800 placeholder-gray-400"
                                   placeholder="Nama Anda (Bisa menggunakan Hamba Allah)">
                        </div>

                        <div>
                            <label for="nominal" class="block text-sm font-extrabold text-gray-700 mb-2 font-montserrat">Jumlah Donasi (Nominal)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-400 font-extrabold text-sm font-montserrat">Rp</span>
                                </div>
                                <input type="number" name="nominal" id="nominal" required min="1000"
                                       class="pl-12 w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-200 text-gray-800 placeholder-gray-400 font-montserrat font-bold text-lg"
                                       placeholder="Masukkan nominal donasi">
                            </div>
                        </div>

                        <div>
                            <label for="pesan" class="block text-sm font-extrabold text-gray-700 mb-2 font-montserrat">Pesan atau Doa (Opsional)</label>
                            <textarea name="pesan" id="pesan" rows="3"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-200 text-gray-800 placeholder-gray-400"
                                      placeholder="Tuliskan pesan atau doa (opsional)"></textarea>
                        </div>
                    @endif

                    <div>
                        <label for="bukti_transfer" class="block text-sm font-extrabold text-gray-700 mb-2 font-montserrat">Upload Bukti Transfer</label>
                        
                        <div class="relative border-2 border-dashed border-gray-200 rounded-xl p-6 hover:border-emerald-500 transition-colors duration-200 group text-center bg-gray-50/50">
                            <input type="file" name="bukti_transfer" id="bukti_transfer" required accept=".png,.jpg,.jpeg"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            <div class="flex flex-col items-center justify-center pointer-events-none">
                                <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-600 mb-3 group-hover:scale-110 transition-transform duration-200">
                                    <i class="fas fa-cloud-upload-alt text-xl"></i>
                                </div>
                                <p class="text-sm font-bold text-gray-700 font-montserrat">Pilih file bukti transfer</p>
                                <p class="text-xs text-gray-400 mt-1">Klik untuk menelusuri file Anda</p>
                            </div>
                        </div>
                        <div id="file-name-display" class="mt-2 text-sm text-emerald-600 font-bold hidden flex items-center gap-1.5 justify-center bg-emerald-50 py-2 px-3 rounded-lg border border-emerald-100">
                            <i class="fas fa-file-image"></i>
                            <span id="selected-file-name"></span>
                        </div>
                        <p class="mt-2 text-xs text-gray-400 text-center"><i class="fas fa-info-circle text-emerald-600 mr-1"></i>Format file: PNG, JPG, JPEG. Ukuran maksimal: 5 MB.</p>
                        <p id="file-error" class="mt-2 text-xs text-red-600 hidden text-center font-bold"></p>
                    </div>

                    <div>
                        <button type="submit"
                                id="submit-button"
                                class="w-full bg-emerald-600 text-white font-bold py-4 px-6 rounded-xl hover:bg-emerald-700 active:bg-emerald-800 transition-all duration-200 shadow-lg shadow-emerald-100 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center space-x-2 font-montserrat">
                            <span>{{ isset($lastDonasi) && $lastDonasi ? 'Unggah Screenshot Bukti' : 'Kirim Bukti Transfer' }}</span>
                            {{-- SPINNER UNTUK INDIKATOR LOADING --}}
                            <svg id="loading-spinner" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>

                    @if(isset($lastDonasi) && $lastDonasi)
                        <div class="mt-6 flex flex-col sm:flex-row gap-4 justify-center pt-4 border-t border-gray-100">
                            <a href="{{ route('penggunaMasjid.donasi.finishFlow', ['to' => 'beranda']) }}" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-4 rounded-xl transition duration-200 font-montserrat text-sm flex items-center justify-center gap-2">
                                <i class="fas fa-home text-xs"></i> Kembali ke Beranda
                            </a>
                            <a href="{{ route('penggunaMasjid.donasi.finishFlow', ['to' => 'donasi']) }}" class="flex-1 text-center bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 text-emerald-700 font-bold py-3 px-4 rounded-xl transition duration-200 font-montserrat text-sm flex items-center justify-center gap-2">
                                <i class="fas fa-hand-holding-heart text-xs"></i> Donasi Kembali
                            </a>
                        </div>
                    @else
                        <div class="mt-6 text-center pt-4 border-t border-gray-100">
                            <a href="{{ route('penggunaMasjid.donasi.index') }}" class="text-gray-500 hover:text-gray-700 font-bold transition duration-200 font-montserrat text-sm flex items-center justify-center gap-2">
                                <i class="fas fa-arrow-left text-xs"></i> Kembali ke Halaman Donasi
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('bukti_transfer');
    const fileNameDisplay = document.getElementById('file-name-display');
    const selectedFileName = document.getElementById('selected-file-name');

    if (fileInput) {
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                selectedFileName.textContent = this.files[0].name;
                fileNameDisplay.classList.remove('hidden');
            } else {
                fileNameDisplay.classList.add('hidden');
            }
        });
    }
});

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
    submitButton.classList.add('cursor-not-allowed', 'bg-emerald-800');
    submitButton.classList.remove('hover:bg-emerald-700', 'hover:-translate-y-0.5');
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
    }, 3000);
});
</script>
@endsection