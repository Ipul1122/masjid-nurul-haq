<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Nurul Haq | @yield('title')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"/>
</head>
<body class="bg-gray-100">

    {{-- Navbar --}}
    @include('layouts.navbarPenggunaMasjid')
      {{-- Jadwal Sholat --}}
    @include('layouts.runningText')

    <main class="py-5"> <div class="">
            @yield('content')
        </div>
    </main>

</body>
</html>