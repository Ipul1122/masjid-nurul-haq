@extends('layouts.dkm')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Anggota</h1>
    
    <div class="bg-blue-50 p-4 rounded mb-6 border-l-4 border-blue-500">
        Menambahkan anggota ke group: <strong>{{ $group->nama_group }}</strong>
    </div>

    <div class="bg-white p-6 rounded shadow-md max-w-lg">
        <form action="{{ route('dkm.muhasabah.anggota.store', $group->id) }}" method="POST">
            @csrf

            {{-- Nama Lengkap Anggota --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap Anggota</label>
                <input type="text" name="nama_lengkap" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: Heru Santoso" required>
            </div>

            {{-- Nomor WhatsApp --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Whatsapp</label>
                <input type="text" name="no_wa" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: 081234567890">
            </div>

            {{-- Username Login --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username Login</label>
                <input type="text" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: heru" required>
            </div>

            {{-- Password Login --}}
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="text" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: heru123" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan Anggota
                </button>
                <a href="{{ route('dkm.muhasabah.anggota.index', $group->id) }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection