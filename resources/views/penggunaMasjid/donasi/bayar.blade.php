@extends('layouts.penggunaMasjid') 

@section('title', 'Selesaikan Donasi')

@section('content')
<div class="container mx-auto py-16 px-4">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-lg text-center">
        <h2 class="text-2xl font-bold mb-4">Selesaikan Donasi Anda</h2>
        <p class="mb-2">Terima kasih, <strong>{{ $request->nama ?? 'Hamba Allah' }}</strong></p>
        <p class="text-gray-600 mb-6">Nominal: <span class="font-bold text-blue-600">Rp {{ number_format($request->nominal, 0, ',', '.') }}</span></p>

        {{-- Tombol untuk memunculkan popup Snap --}}
        <button id="pay-button" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
            Pilih Metode Pembayaran
        </button>
    </div>
</div>

{{-- Script Midtrans Snap (Sandbox) --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        // SnapToken didapat dari controller
        snap.pay('{{ $snapToken }}', {
            // Callback ketika pembayaran sukses
            onSuccess: function(result){
                // Arahkan otomatis ke halaman hasil donasi
                window.location.href = "{{ route('penggunaMasjid.donasi.hasilDonasi') }}";
            },
            onPending: function(result){
                alert("Menunggu pembayaran Anda!"); console.log(result);
            },
            onError: function(result){
                alert("Pembayaran gagal!"); console.log(result);
            },
            onClose: function(){
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    };
</script>
@endsection