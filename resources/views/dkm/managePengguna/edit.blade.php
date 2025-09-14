@extends('layouts.dkm')
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Edit Pengguna DKM</h2>

    <form method="POST" action="{{ route('dkm.users.update', $user->id) }}">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block mb-1">Username</label>
            <input type="text" name="username" value="{{ $user->username }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Password (opsional)</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded">
            <p class="text-sm text-gray-500">Kosongkan jika tidak ingin ubah password.</p>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('dkm.users.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
