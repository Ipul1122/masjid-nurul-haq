@extends('layouts.penggunaMasjid')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            
            {{-- Bagian Header Form --}}
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-10 text-white text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
                
                <h2 class="text-3xl font-extrabold mb-3 relative z-10">Salurkan Donasi Anda</h2>
                <p class="text-blue-100 text-lg relative z-10 font-light">"Sedekah tidaklah mengurangi harta." (HR. Muslim)</p>
            </div>

            <div class="px-8 md:px-10 pt-8 pb-10">
                @if(session('info'))
                    {{-- Floating Toast Alert Peringatan + Tombol Aksi --}}
                    <div id="flash-toast" class="fixed top-0 left-1/2 transform -translate-x-1/2 z-[10000] bg-red-500 text-white p-5 rounded-2xl shadow-2xl flex flex-col gap-3 w-[90%] max-w-md border-b-4 border-red-700" style="animation: slideDownBounce 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;">
                        
                        {{-- Bagian Teks & Ikon --}}
                        <div class="flex items-start gap-4">
                            <div class="bg-white/20 rounded-full w-10 h-10 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-exclamation-triangle text-xl"></i>
                            </div>
                            <div class="flex-1 pt-1">
                                <h4 class="font-bold text-lg leading-none mb-1">Akses Ditolak</h4>
                                <p class="font-medium text-sm text-red-50 leading-snug">{{ session('info') }}</p>
                            </div>
                            <button type="button" onclick="closeToast()" class="text-white/70 hover:text-white hover:bg-white/10 p-1.5 rounded-lg transition flex-shrink-0">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        
                        {{-- Bagian Tombol Lanjut ke Halaman Proses --}}
                        <div class="flex justify-end mt-1 border-t border-red-400/50 pt-3">
                            <a href="{{ route('penggunaMasjid.donasi.resume') }}" onclick="closeToast()" class="bg-white text-red-600 hover:bg-red-50 px-5 py-2.5 rounded-xl text-sm font-bold shadow-md transition flex items-center gap-2 hover:-translate-y-0.5">
                                Buka Halaman Pembayaran <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                    </div>

                    <style>
                        @keyframes slideDownBounce {
                            0% { top: -100px; opacity: 0; transform: translate(-50%, -20px) scale(0.9); }
                            100% { top: 30px; opacity: 1; transform: translate(-50%, 0) scale(1); }
                        }
                        .toast-fade-out {
                            animation: fadeOutUp 0.4s ease-in forwards !important;
                        }
                        @keyframes fadeOutUp {
                            0% { top: 30px; opacity: 1; transform: translate(-50%, 0) scale(1); }
                            100% { top: -100px; opacity: 0; transform: translate(-50%, -20px) scale(0.9); }
                        }
                    </style>

                    <script>
                        function closeToast() {
                            const toast = document.getElementById('flash-toast');
                            if(toast) {
                                toast.classList.add('toast-fade-out');
                                setTimeout(() => toast.remove(), 400);
                            }
                        }
                        
                        // Waktu timeout saya perpanjang menjadi 8 detik agar user punya cukup waktu untuk membaca dan mengklik tombol.
                        setTimeout(() => {
                            closeToast();
                        }, 8000);
                    </script>
                @endif

                {{-- JIKA ADA TRANSAKSI TERTUNDA: Tampilkan Peringatan dan SEMBUNYIKAN FORM --}}
                @if(isset($pendingToken) && $pendingToken)
                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-xl p-8 text-center shadow-sm relative overflow-hidden">
                        <div class="absolute inset-0 bg-yellow-100 opacity-20 w-full animate-pulse"></div>
                        
                        <div class="relative z-10">
                            <i class="fas fa-lock text-5xl text-yellow-500 mb-4"></i>
                            <h4 class="font-bold text-xl mb-2">Selesaikan Transaksi Anda</h4>
                            <p class="text-gray-600 mb-6">Anda masih memiliki transaksi donasi yang belum diselesaikan. Harap pilih untuk melanjutkannya atau membatalkannya agar dapat membuat donasi baru.</p>
                            
                            <div class="flex flex-col sm:flex-row justify-center gap-4">
                                <a href="{{ route('penggunaMasjid.donasi.batal') }}" class="px-6 py-3 bg-white border-2 border-red-200 text-red-600 hover:bg-red-50 rounded-xl font-bold transition">
                                    <i class="fas fa-times mr-2"></i> Batalkan Donasi Lama
                                </a>
                                <button type="button" onclick="lanjutkanPembayaran()" class="px-6 py-3 bg-yellow-500 text-white rounded-xl hover:bg-yellow-600 font-bold transition shadow-md">
                                    <i class="fas fa-wallet mr-2"></i> Lanjutkan Pembayaran
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Script Midtrans Snap --}}
                    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
                    <script>
                        function lanjutkanPembayaran() {
                            snap.pay('{{ $pendingToken }}', {
                                onSuccess: function(result){ window.location.href = "{{ route('penggunaMasjid.donasi.hasilDonasi') }}"; },
                                onPending: function(result){ alert("Menunggu pembayaran Anda."); },
                                onError: function(result){ alert("Pembayaran gagal!"); }
                            });
                        }
                    </script>

                {{-- JIKA TIDAK ADA TRANSAKSI TERTUNDA: Tampilkan Form Donasi Normal --}}
                @else
                    <form action="{{ route('penggunaMasjid.donasi.proses') }}" method="POST" id="form-donasi">
                        @csrf
                        
                        {{-- 1. Pilih Nominal --}}
                        <div class="mb-8">
                            <label class="block text-gray-800 font-bold mb-4 text-lg">Pilih Nominal Donasi</label>
                            
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
                        
                        <div class="text-center mt-6 text-sm text-gray-500 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Pembayaran Aman & Terverifikasi oleh <span class="font-bold text-gray-700">Midtrans</span>
                        </div>
                    </form>
                @endif {{-- Akhir Blok If-Else Pending Token --}}
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnNominals = document.querySelectorAll('.btn-nominal');
        const inputNominal = document.getElementById('nominal');

        if(btnNominals && inputNominal) {
            btnNominals.forEach(button => {
                button.addEventListener('click', function() {
                    btnNominals.forEach(btn => {
                        btn.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                        btn.classList.add('text-blue-600', 'bg-white', 'border-blue-500');
                    });
                    this.classList.remove('text-blue-600', 'bg-white', 'border-blue-500');
                    this.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                    inputNominal.value = this.getAttribute('data-val');
                });
            });

            inputNominal.addEventListener('input', function() {
                btnNominals.forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                    btn.classList.add('text-blue-600', 'bg-white', 'border-blue-500');
                });
            });
        }
    });
</script>
@endsection