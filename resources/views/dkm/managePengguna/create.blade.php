@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Pengguna DKM</h2>

    <form method="POST" action="{{ route('dkm.managePengguna.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium">Username</label>
            <input type="text" name="username" 
                   class="w-full border px-3 py-2 rounded" 
                   value="{{ old('username') }}" required>
            @error('username')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Password</label>
            <input type="password" name="password" 
                   class="w-full border px-3 py-2 rounded" required>
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        <a href="{{ route('dkm.managePengguna.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
