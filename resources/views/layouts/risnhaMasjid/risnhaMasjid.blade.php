<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"/>
</head>
<body class="bg-gray-100">

    {{-- Navbar --}}
    @include('layouts.risnhaMasjid.navbarRisnhaMasjid')


    {{-- Running Text --}}
    {{-- @include('layouts.runningText') --}}
    {{-- Footer --}}
    
    <main class=""> <div class="">
        @yield('content')
    </div>
</main>

    @include('layouts.risnhaMasjid.footerRisnhaMasjid')


</body>
</html>