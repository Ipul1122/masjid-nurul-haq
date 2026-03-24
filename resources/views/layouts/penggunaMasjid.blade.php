<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta name="description" content="@yield('description', 'Situs resmi Masjid Nurul Haq. Menampilkan informasi kegiatan, artikel islami, laporan keuangan, dan aktivitas remaja masjid (RISNHA).')">
    <meta name="keywords" content="Masjid Nurul Haq, Kegiatan Masjid, Artikel Islami, Keuangan Masjid, RISNHA">
    <meta property="og:title" content="@yield('title', 'Website Resmi Masjid Nurul Haq')">
    <meta property="og:description" content="@yield('description', 'Situs resmi Masjid Nurul Haq...')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo-masjid-nur-haq.png'))"> <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Website Resmi Masjid Nurul Haq')">
    <meta name="twitter:description" content="@yield('description', 'Situs resmi Masjid Nurul Haq...')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logo-masjid-nur-haq.png'))">
    <link rel="icon" href="{{ asset('images/logo-masjid-nur-haq.png') }} " type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    {{-- Navbar dimuat di sini --}}
    @include('layouts.navbarPenggunaMasjid')

    {{-- Running Text dimuat di sini --}}
    @include('layouts.runningText')
    
    <main>
        {{-- Konten halaman (dari file lain) akan dimuat di sini --}}
        @yield('content') 
    </main>

    {{-- Footer dimuat di sini --}}
    @include('layouts.footerPenggunaMasjid')

    @if(session()->has('pending_donasi_token') && (now()->timestamp * 1000) < session('expiry_time') && !request()->routeIs('penggunaMasjid.donasi.proses') && !request()->routeIs('penggunaMasjid.donasi.resume') && !request()->routeIs('penggunaMasjid.donasi.index'))
        
        <div id="sticky-toast-donasi" class="fixed bottom-5 right-5 md:bottom-10 md:right-10 z-[9999] bg-white border-l-4 border-yellow-500 rounded-xl shadow-[0_10px_40px_rgba(0,0,0,0.2)] p-5 w-80 md:w-96 transform transition-transform duration-500 translate-y-0" style="animation: slideUp 0.5s ease-out forwards;">
            <div class="flex justify-between items-start mb-2">
                <div class="flex items-center gap-2 text-yellow-600 font-extrabold text-lg">
                    <i class="fas fa-wallet animate-pulse"></i> Donasi Tertunda
                </div>
                <button onclick="document.getElementById('sticky-toast-donasi').style.display='none'" class="text-gray-400 hover:text-gray-700 transition">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            
            <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                Sistem mendeteksi Anda memiliki transaksi donasi yang belum diselesaikan. Lanjutkan pembayaran sekarang?
            </p>
            
            <div class="flex justify-end gap-3 mt-2">
                <a href="{{ route('penggunaMasjid.donasi.batal') }}" class="px-4 py-2 text-sm text-red-600 bg-red-50 hover:bg-red-100 rounded-lg font-bold transition">
                    Batal
                </a>
                <a href="{{ route('penggunaMasjid.donasi.resume') }}" class="px-5 py-2 text-sm bg-yellow-500 text-white hover:bg-yellow-600 rounded-lg font-bold transition shadow-md flex items-center gap-2">
                    <span>Ya, Lanjut</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <style>
            @keyframes slideUp {
                0% { transform: translateY(150%); opacity: 0; }
                100% { transform: translateY(0); opacity: 1; }
            }
        </style>
        
    @endif
</body>
</html>