<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard DKM</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Dashboard DKM</h1>
        <form method="POST" action="{{ route('dkm.logout') }}">
            @csrf
            <button class="bg-red-600 text-white px-3 py-1 rounded">Logout</button>
        </form>
    </div>

    @yield('content')
</body>
</html>
