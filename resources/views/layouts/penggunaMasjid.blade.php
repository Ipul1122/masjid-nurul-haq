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
</body>
</html>