@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Edit Pengguna DKM</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('dkm.managePengguna.update', $managePengguna->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-medium">Username</label>
            <input type="text" name="username"
                   value="{{ old('username', $managePengguna->username) }}"
                   class="w-full border px-3 py-2 rounded"
                   required>
            @error('username')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Password (opsional)</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded">
            <p class="text-sm text-gray-500">Kosongkan jika tidak ingin ubah password.</p>
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" type="submit">Update</button>
        <a href="{{ route('dkm.managePengguna.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
