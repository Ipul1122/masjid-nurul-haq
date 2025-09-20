<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Masjid Nurul Haq') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">MASJID NURUL HAQ</h1>

        <div class="flex items-center space-x-4">
            <!-- Notifikasi -->
            <a href="{{ route('dkm.notifikasi.index') }}" class="relative text-gray-600 hover:text-gray-800">
                <!-- Bell Icon (Heroicons) -->
                <svg xmlns="http://www.w3.org/2000/svg" 
                     fill="none" viewBox="0 0 24 24" 
                     stroke-width="1.5" stroke="currentColor" 
                     class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 
                             8.967 0 0118 9.75V9a6 6 0 00-12 0v.75a8.967 8.967 
                             0 01-2.311 6.022c1.733.64 3.56 1.085 
                             5.454 1.31m5.714 0a24.255 24.255 0 
                             01-5.714 0m5.714 0a3 3 0 11-5.714 
                             0" />
                </svg>
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('dkm.logout') }}">
                @csrf
                <button class="bg-red-600 text-white px-3 py-1 rounded">Logout</button>
            </form>
        </div>
    </div>

    @yield('content')
</body>
</html>
