<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
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