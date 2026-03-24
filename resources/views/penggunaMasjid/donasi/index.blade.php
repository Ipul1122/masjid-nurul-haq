@extends('layouts.penggunaMasjid') {{-- Sesuaikan jika nama layout utama Anda berbeda --}}

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            
            {{-- Bagian Header Form --}}
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-10 text-white text-center relative overflow-hidden">
                {{-- Efek dekorasi background --}}
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
                
                <h2 class="text-3xl font-extrabold mb-3 relative z-10">Salurkan Donasi Anda</h2>
                <p class="text-blue-100 text-lg relative z-10 font-light">"Sedekah tidaklah mengurangi harta." (HR. Muslim)</p>
            </div>

            {{-- Form Donasi --}}
            <div class="p-8 md:p-10">
                {{-- Pastikan action mengarah ke route proses Midtrans yang kita buat sebelumnya --}}
                <form action="{{ route('penggunaMasjid.donasi.proses') }}" method="POST" id="form-donasi">
                    @csrf
                    
                    {{-- 1. Pilih Nominal --}}
                    <div class="mb-8">
                        <label class="block text-gray-800 font-bold mb-4 text-lg">Pilih Nominal Donasi</label>
                        
                        {{-- Tombol Preset Nominal --}}
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-5">
                            <button type="button" class="btn-nominal border-2 border-blue-500 text-blue-600 hover:bg-blue-50 focus:ring-2 focus:ring-blue-300 rounded-xl py-3 font-semibold transition-all" data-val="10000">Rp 10.000</button>
                            <button type="button" class="btn-nominal border-2 border-blue-500 text-blue-600 hover:bg-blue-50 focus:ring-2 focus:ring-blue-300 rounded-xl py-3 font-semibold transition-all" data-val="50000">Rp 50.000</button>
                            <button type="button" class="btn-nominal border-2 border-blue-500 text-blue-600 hover:bg-blue-50 focus:ring-2 focus:ring-blue-300 rounded-xl py-3 font-semibold transition-all" data-val="100000">Rp 100.000</button>
                            <button type="button" class="btn-nominal border-2 border-blue-500 text-blue-600 hover:bg-blue-50 focus:ring-2 focus:ring-blue-300 rounded-xl py-3 font-semibold transition-all" data-val="500000">Rp 500.000</button>
                        </div>
                        
                        <label class="block text-gray-600 font-medium mb-2 text-sm">Atau masukkan nominal lainnya:</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-bold text-lg">Rp</span>
                            </div>
                            <input type="number" name="nominal" id="nominal" min="10000" 
                                   class="pl-12 w-full border-2 border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-0 transition-colors py-4 text-lg font-bold text-gray-800 placeholder-gray-300" 
                                   placeholder="Minimal 10.000" required>
                        </div>
                    </div>

                    {{-- 2. Data Diri --}}
                    <div class="mb-6">
                        <label for="nama" class="block text-gray-800 font-bold mb-2">Nama Lengkap (Opsional)</label>
                        <input type="text" name="nama" id="nama" 
                               class="w-full border-2 border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-0 transition-colors py-3 px-4" 
                               placeholder="Nama Anda (Bisa dikosongkan untuk Hamba Allah)">
                        <p class="text-xs text-gray-500 mt-2"><i class="fas fa-info-circle"></i> Kosongkan jika Anda ingin berdonasi secara anonim.</p>
                    </div>

                    {{-- 3. Pesan/Doa --}}
                    <div class="mb-10">
                        <label for="pesan" class="block text-gray-800 font-bold mb-2">Pesan atau Doa (Opsional)</label>
                        <textarea name="pesan" id="pesan" rows="3" 
                                  class="w-full border-2 border-gray-200 rounded-xl shadow-sm focus:border-blue-500 focus:ring-0 transition-colors py-3 px-4" 
                                  placeholder="Tuliskan doa untuk Anda, keluarga, atau kerabat..."></textarea>
                    </div>

                    {{-- 4. Tombol Submit --}}
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold text-lg py-4 rounded-xl hover:bg-blue-700 active:bg-blue-800 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-200 flex justify-center items-center gap-2">
                        <span>Lanjutkan ke Pembayaran</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    
                    {{-- Trust Badge --}}
                    <div class="text-center mt-6 text-sm text-gray-500 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Pembayaran Aman & Terverifikasi oleh <span class="font-bold text-gray-700">Midtrans</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script Tambahan untuk Efek Tombol Preset Nominal --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnNominals = document.querySelectorAll('.btn-nominal');
        const inputNominal = document.getElementById('nominal');

        // Event saat tombol nominal diklik
        btnNominals.forEach(button => {
            button.addEventListener('click', function() {
                // Reset semua tombol ke style default
                btnNominals.forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                    btn.classList.add('text-blue-600', 'bg-white', 'border-blue-500');
                });
                
                // Tambahkan style aktif ke tombol yang diklik
                this.classList.remove('text-blue-600', 'bg-white', 'border-blue-500');
                this.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                
                // Masukkan nilai ke input form
                inputNominal.value = this.getAttribute('data-val');
            });
        });

        // Hapus status aktif pada tombol jika user mengetik nominal secara manual
        inputNominal.addEventListener('input', function() {
            btnNominals.forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                btn.classList.add('text-blue-600', 'bg-white', 'border-blue-500');
            });
        });
    });
</script>
@endsection