@extends('layouts.penggunaMasjid')

@section('title', 'Bayar Donasi')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 flex items-center">
    <div class="max-w-lg mx-auto px-4 w-full">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 relative">
            
            {{-- Hiasan Atas --}}
            <div class="bg-blue-600 h-2 w-full"></div>

            <div class="p-8 text-center">
                <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 text-blue-600">
                    <i class="fas fa-wallet text-3xl"></i>
                </div>
                
                <h2 class="text-2xl font-extrabold text-gray-800 mb-2">Selesaikan Donasi Anda</h2>
                <p class="text-gray-500 mb-6">Jazakumullah khairan, <strong>{{ !empty($nama) ? $nama : 'Hamba Allah' }}</strong>.</p>
                
                <div class="bg-gray-50 rounded-2xl p-6 mb-6 border border-gray-100">
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider mb-1">Total Nominal</p>
                    <p class="text-4xl font-black text-blue-600">Rp {{ number_format($nominal, 0, ',', '.') }}</p>
                </div>

                {{-- Timer Mundur --}}
                <div class="mb-8">
                    <p class="text-sm text-gray-500 mb-2">Selesaikan pembayaran dalam waktu:</p>
                    <div class="flex justify-center items-center gap-2 text-red-500 font-bold bg-red-50 py-3 px-6 rounded-xl border border-red-100 inline-flex">
                        <i class="far fa-clock text-xl animate-pulse"></i>
                        <span id="countdown-timer" class="text-2xl tracking-widest tabular-nums">--:--</span>
                    </div>
                    <p id="expired-text" class="text-sm text-red-600 font-bold mt-2 hidden">WAKTU HABIS!</p>
                </div>

                <div class="flex flex-col gap-3">
                    <button id="pay-button" class="w-full bg-blue-600 text-white px-6 py-4 rounded-xl font-bold hover:bg-blue-700 active:bg-blue-800 transition shadow-lg hover:shadow-xl flex justify-center items-center gap-2 text-lg">
                        Buka Menu Pembayaran <i class="fas fa-external-link-alt text-sm"></i>
                    </button>
                    
                    <a href="{{ route('penggunaMasjid.donasi.batal') }}" class="w-full bg-white text-gray-500 border border-gray-200 px-6 py-3 rounded-xl font-bold hover:bg-gray-50 transition text-sm">
                        Batalkan Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script Midtrans Snap (Sandbox) --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // === 1. LOGIKA COUNTDOWN TIMER ===
        // Ambil expiry_time dari controller (dalam format Unix Timestamp)
        const expiryTime = {{ $expiryTime }};
        const timerElement = document.getElementById("countdown-timer");
        const expiredText = document.getElementById("expired-text");
        const payButton = document.getElementById("pay-button");

        // Update timer setiap 1 detik
        const x = setInterval(function() {
            const now = new Date().getTime();
            const distance = expiryTime - now;

            // Kalkulasi menit dan detik
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Tambahkan angka 0 di depan jika kurang dari 10 (contoh: 09, 08)
            const displayMinutes = minutes < 10 ? "0" + minutes : minutes;
            const displaySeconds = seconds < 10 ? "0" + seconds : seconds;

            // Tampilkan di layar
            if (distance > 0) {
                timerElement.innerHTML = displayMinutes + ":" + displaySeconds;
            }

            // Jika waktu habis
            if (distance < 0) {
                clearInterval(x);
                timerElement.innerHTML = "00:00";
                timerElement.classList.replace("text-red-500", "text-gray-400");
                timerElement.parentElement.classList.replace("bg-red-50", "bg-gray-100");
                timerElement.parentElement.classList.replace("border-red-100", "border-gray-200");
                
                expiredText.classList.remove("hidden");
                
                // Matikan tombol bayar
                payButton.disabled = true;
                payButton.classList.replace("bg-blue-600", "bg-gray-400");
                payButton.classList.remove("hover:bg-blue-700", "hover:shadow-xl");
                payButton.innerHTML = "Transaksi Kedaluwarsa";
                
                // Otomatis batalkan dan kembali ke form dalam 2 detik
                setTimeout(() => {
                    window.location.href = "{{ route('penggunaMasjid.donasi.batal') }}";
                }, 2000);
            }
        }, 1000);

        // === 2. LOGIKA PEMBAYARAN MIDTRANS ===
        payButton.onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    window.location.href = "{{ route('penggunaMasjid.donasi.hasilDonasi') }}";
                },
                onPending: function(result){
                    // User menutup popup transfer bank tanpa langsung bayar
                    // Biarkan saja, timer masih akan berjalan di latar belakang
                    console.log('Menunggu pembayaran', result);
                },
                onError: function(result){
                    alert("Pembayaran gagal!"); 
                    console.log(result);
                },
                onClose: function(){
                    // User menekan tombol silang di popup midtrans
                    console.log('Popup ditutup');
                }
            });
        };
        
        // Opsional: Buka popup otomatis saat halaman pertama kali diload
        // payButton.click(); 
    });
</script>
@endsection