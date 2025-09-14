@extends('layouts.dkm')
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Pengguna DKM</h2>

    <form method="POST" action="{{ route('dkm.managePengguna.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1">Username</label>
            <input type="text" name="username" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Password</label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
        </div>
        <button class="bg-green-600 text-black px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('dkm.managePengguna.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
