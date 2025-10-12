@extends('layouts.penggunaMasjid')

@section('title', 'Beranda')

@section('content')
{{-- CAROUSEL --}}
{{-- 
    Data untuk carousel sekarang diambil dari variabel $homeSections 
    yang dikirim oleh homeController, bukan lagi dipanggil langsung dari view.
--}}

<h1>TESTING ke 10000000</h1>

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-semibold mb-4">Selamat Datang!</h2>
        <p>
            Ini adalah halaman utama untuk para jamaah Masjid Nurul Haq. Silakan gunakan menu di navigasi untuk melihat informasi lainnya.
        </p>
    </div>
</div>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-semibold mb-4">Selamat Datang!</h2>
        <p>
            Ini adalah halaman utama untuk para jamaah Masjid Nurul Haq. Silakan gunakan menu di navigasi untuk melihat informasi lainnya.
        </p>
    </div>
</div>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-semibold mb-4">Selamat Datang!</h2>
        <p>
            Ini adalah halaman utama untuk para jamaah Masjid Nurul Haq. Silakan gunakan menu di navigasi untuk melihat informasi lainnya.
        </p>
    </div>
</div>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
    <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-semibold mb-4">Selamat Datang!</h2>
        <p>
            Ini adalah halaman utama untuk para jamaah Masjid Nurul Haq. Silakan gunakan menu di navigasi untuk melihat informasi lainnya.
        </p>
    </div>
</div>

{{-- Tambahkan script untuk carousel --}}
<script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
@endsection