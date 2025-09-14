<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login DKM</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-center">Login DKM</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('dkm.login.submit') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input type="text" name="username" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
            </div>
            <button class="w-full bg-blue-600 text-black py-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>

</body>
</html>
