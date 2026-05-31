@extends('layouts.penggunaMasjid')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 font-quicksand mt-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            
            {{-- Bagian Header Form --}}
            <div class="bg-gradient-to-r from-emerald-600 to-teal-800 px-6 py-10 text-white text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
                
                <h2 class="text-3xl font-extrabold mb-3 relative z-10 font-montserrat tracking-tight">Salurkan Donasi Anda</h2>
                <p class="text-emerald-100 text-lg relative z-10 font-light italic">"Sedekah tidaklah mengurangi harta." (HR. Muslim)</p>
            </div>

            <div class="px-8 md:px-10 pt-8 pb-10">
                @if(session('info'))
                    {{-- Floating Toast Alert Peringatan + Tombol Aksi --}}
                    <div id="flash-toast" class="fixed top-24 left-1/2 transform -translate-x-1/2 z-[10000] bg-emerald-50 text-emerald-950 p-5 rounded-2xl shadow-2xl flex flex-col gap-3 w-[90%] max-w-md border-b-4 border-emerald-600" style="animation: slideDownBounce 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;">
                        
                        {{-- Bagian Teks & Ikon --}}
                        <div class="flex items-start gap-4">
                            <div class="bg-emerald-600/10 rounded-full w-10 h-10 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-exclamation-triangle text-xl text-emerald-600"></i>
                            </div>
                            <div class="flex-1 pt-1">
                                <h4 class="font-bold text-lg font-montserrat leading-none mb-1">Akses Tertunda</h4>
                                <p class="font-medium text-sm text-gray-600 leading-snug">{{ session('info') }}</p>
                            </div>
                            <button type="button" onclick="closeToast()" class="text-gray-400 hover:text-gray-600 p-1.5 rounded-lg transition flex-shrink-0">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        
                        {{-- Bagian Tombol Lanjut ke Halaman Proses --}}
                        <div class="flex justify-end mt-1 border-t border-emerald-100 pt-3">
                            <a href="{{ route('penggunaMasjid.donasi.resume') }}" onclick="closeToast()" class="bg-emerald-600 text-white hover:bg-emerald-700 px-5 py-2.5 rounded-xl text-sm font-bold shadow-md transition flex items-center gap-2 hover:-translate-y-0.5 font-montserrat">
                                Buka Halaman Pembayaran <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>

                    </div>

                    <style>
                        @keyframes slideDownBounce {
                            0% { top: -100px; opacity: 0; transform: translate(-50%, -20px) scale(0.9); }
                            100% { top: 100px; opacity: 1; transform: translate(-50%, 0) scale(1); }
                        }
                        .toast-fade-out {
                            animation: fadeOutUp 0.4s ease-in forwards !important;
                        }
                        @keyframes fadeOutUp {
                            0% { top: 100px; opacity: 1; transform: translate(-50%, 0) scale(1); }
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
                        
                        setTimeout(() => {
                            closeToast();
                        }, 8000);
                    </script>
                @endif

                {{-- JIKA ADA TRANSAKSI TERTUNDA: Tampilkan Peringatan dan SEMBUNYIKAN FORM --}}
                @if(isset($pendingToken) && $pendingToken)
                    <div class="bg-emerald-50 border border-emerald-100 text-emerald-900 rounded-2xl p-8 text-center shadow-sm relative overflow-hidden">
                        <div class="absolute inset-0 bg-emerald-100 opacity-20 w-full animate-pulse"></div>
                        
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-lock text-3xl"></i>
                            </div>
                            <h4 class="font-bold text-xl mb-2 font-montserrat">Selesaikan Transaksi Anda</h4>
                            <p class="text-gray-600 mb-6 max-w-md mx-auto">Anda masih memiliki transaksi donasi yang belum diselesaikan. Harap pilih untuk melanjutkannya atau membatalkannya agar dapat membuat donasi baru.</p>
                            
                            <div class="flex flex-col sm:flex-row justify-center gap-4">
                                <a href="{{ route('penggunaMasjid.donasi.batal') }}" class="px-6 py-3 bg-white border border-red-200 text-red-600 hover:bg-red-50 rounded-xl font-bold transition font-montserrat">
                                    <i class="fas fa-times mr-2"></i> Batalkan Donasi Lama
                                </a>
                                <button type="button" onclick="lanjutkanPembayaran()" class="px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-bold transition shadow-lg shadow-emerald-200 font-montserrat">
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
                                onSuccess: function(result){ window.location.href = "{{ route('penggunaMasjid.donasi.paymentSuccess') }}"; },
                                onPending: function(result){ alert("Menunggu pembayaran Anda."); },
                                onError: function(result){ alert("Pembayaran gagal!"); }
                            });
                        }
                    </script>

                {{-- JIKA TIDAK ADA TRANSAKSI TERTUNDA: Tampilkan Form Donasi Normal --}}
                @else
                    <form action="{{ route('penggunaMasjid.donasi.proses') }}" method="POST" id="form-donasi">
                        @csrf
                        
                        {{-- Kartu Ketentuan & Himbauan Donasi --}}
                        <div class="bg-amber-50 border-l-4 border-amber-500 p-5 rounded-2xl mb-8 text-sm text-amber-900 shadow-sm">
                            <div class="flex gap-3">
                                <div class="bg-amber-100 rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 text-amber-700">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-amber-950 font-montserrat mb-1.5">Ketentuan & Etika Donasi</h4>
                                    <ul class="list-disc list-inside space-y-1.5 font-medium text-amber-800">
                                        <li><strong>Dilarang</strong> menggunakan kata-kata kasar, tidak pantas, atau SARA pada kolom Nama dan Pesan/Doa.</li>
                                        <li><strong>Dilarang keras</strong> menyalurkan dana yang bersumber dari aktivitas ilegal (termasuk judi online / judol, korupsi, pencucian uang, dsb).</li>
                                        <li><strong>Wajib</strong> melampirkan bukti transaksi yang sah dan valid jika melakukan transfer manual, atau mengunggah screenshot setelah pembayaran elektronik berhasil demi kelancaran verifikasi.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        {{-- 1. Pilih Nominal --}}
                        <div class="mb-8">
                            <label class="block text-gray-800 font-extrabold mb-4 text-lg font-montserrat">Pilih Nominal Donasi</label>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-5">
                                <button type="button" class="btn-nominal border-2 border-gray-200 text-gray-700 hover:border-emerald-500 hover:bg-emerald-50/30 focus:ring-4 focus:ring-emerald-100 rounded-xl py-3 font-semibold transition-all duration-200 font-montserrat" data-val="10000">Rp 10.000</button>
                                <button type="button" class="btn-nominal border-2 border-gray-200 text-gray-700 hover:border-emerald-500 hover:bg-emerald-50/30 focus:ring-4 focus:ring-emerald-100 rounded-xl py-3 font-semibold transition-all duration-200 font-montserrat" data-val="50000">Rp 50.000</button>
                                <button type="button" class="btn-nominal border-2 border-gray-200 text-gray-700 hover:border-emerald-500 hover:bg-emerald-50/30 focus:ring-4 focus:ring-emerald-100 rounded-xl py-3 font-semibold transition-all duration-200 font-montserrat" data-val="100000">Rp 100.000</button>
                                <button type="button" class="btn-nominal border-2 border-gray-200 text-gray-700 hover:border-emerald-500 hover:bg-emerald-50/30 focus:ring-4 focus:ring-emerald-100 rounded-xl py-3 font-semibold transition-all duration-200 font-montserrat" data-val="500000">Rp 500.000</button>
                            </div>
                            
                            <label class="block text-gray-600 font-medium mb-2 text-sm">Atau masukkan nominal lainnya:</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-400 font-extrabold text-lg font-montserrat">Rp</span>
                                </div>
                                <input type="number" name="nominal" id="nominal" min="10000" 
                                    class="pl-12 w-full border-2 border-gray-200 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-200 py-4 text-lg font-bold text-gray-800 placeholder-gray-300 font-montserrat" 
                                    placeholder="Minimal 10.000" required>
                            </div>
                        </div>

                        {{-- 2. Data Diri --}}
                        <div class="mb-6">
                            <label for="nama" class="block text-gray-800 font-extrabold mb-2 font-montserrat">Nama Lengkap (Opsional)</label>
                            <input type="text" name="nama" id="nama" 
                                class="w-full border-2 border-gray-200 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-200 py-3 px-4 text-gray-800 placeholder-gray-400" 
                                placeholder="Nama Anda (Bisa dikosongkan untuk Hamba Allah)">
                            <p class="text-xs text-gray-500 mt-2"><i class="fas fa-info-circle text-emerald-600 mr-1"></i> Kosongkan jika Anda ingin berdonasi secara anonim.</p>
                        </div>

                        {{-- 3. Pesan/Doa --}}
                        <div class="mb-10">
                            <label for="pesan" class="block text-gray-800 font-extrabold mb-2 font-montserrat">Pesan atau Doa (Opsional)</label>
                            <textarea name="pesan" id="pesan" rows="3" 
                                    class="w-full border-2 border-gray-200 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-200 py-3 px-4 text-gray-800 placeholder-gray-400" 
                                    placeholder="Tuliskan doa untuk Anda, keluarga, atau kerabat..."></textarea>
                        </div>

                        {{-- 4. Tombol Submit --}}
                        <button type="submit" class="w-full bg-emerald-600 text-white font-bold text-lg py-4 rounded-xl hover:bg-emerald-700 active:bg-emerald-800 shadow-lg shadow-emerald-100 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 flex justify-center items-center gap-2 font-montserrat">
                            <span>Lanjutkan ke Pembayaran</span>
                            <i class="fas fa-arrow-right text-sm"></i>
                        </button>
                        
                        <div class="text-center mt-6 text-sm text-gray-500 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Pembayaran Aman & Terverifikasi oleh <span class="font-bold text-gray-700">Midtrans</span>
                        </div>

                        <div class="mt-6 border-t border-gray-100 pt-6 text-center">
                            <p class="text-sm text-gray-500 font-medium">
                                Ingin melakukan transfer manual? 
                                <a href="{{ route('penggunaMasjid.donasi.kirimBukti') }}" class="text-emerald-600 hover:text-emerald-700 font-extrabold hover:underline transition-colors duration-200">
                                    Kirim Bukti Transfer di Sini
                                </a>
                            </p>
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
                        btn.classList.remove('bg-emerald-600', 'text-white', 'border-emerald-600', 'shadow-md', 'shadow-emerald-100');
                        btn.classList.add('text-gray-700', 'bg-white', 'border-gray-200');
                    });
                    this.classList.remove('text-gray-700', 'bg-white', 'border-gray-200');
                    this.classList.add('bg-emerald-600', 'text-white', 'border-emerald-600', 'shadow-md', 'shadow-emerald-100');
                    inputNominal.value = this.getAttribute('data-val');
                });
            });

            inputNominal.addEventListener('input', function() {
                btnNominals.forEach(btn => {
                    btn.classList.remove('bg-emerald-600', 'text-white', 'border-emerald-600', 'shadow-md', 'shadow-emerald-100');
                    btn.classList.add('text-gray-700', 'bg-white', 'border-gray-200');
                });
            });
        }
    });
</script>
@endsection