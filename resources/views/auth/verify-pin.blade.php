<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi PIN</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow w-96">
        <h2 class="text-2xl font-bold mb-4">Masukkan Kode PIN</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('dkm.verifyPin') }}">
            @csrf
            <div class="mb-4">
                <input type="password" name="pin" maxlength="6" placeholder="******"
                       class="w-full border px-3 py-2 rounded text-center tracking-widest text-xl" required>
            </div>
            <button class="bg-blue-600 text-white w-full py-2 rounded">Verifikasi</button>
        </form>
    </div>
</body>
</html>
