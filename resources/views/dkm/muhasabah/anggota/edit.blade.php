@extends('layouts.dkm')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Anggota</h1>

    <div class="bg-blue-50 p-4 rounded mb-6 border-l-4 border-blue-500 text-blue-800">
        Mengedit anggota dari group: <strong>{{ $anggota->group->nama_group }}</strong>
    </div>
    
    <div class="bg-white p-6 rounded shadow-md max-w-lg">
        <form action="{{ route('dkm.muhasabah.anggota.update', $anggota->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap Anggota</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username Login</label>
                <input type="text" name="username" value="{{ old('username', $anggota->username) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password Baru (Opsional)</label>
                <input type="text" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Isi jika ingin mengganti password">
                <p class="text-xs text-gray-500 mt-1">*Kosongkan jika tidak ingin mengubah password.</p>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Anggota
                </button>
                <a href="{{ route('dkm.muhasabah.anggota.index', $anggota->group_id) }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection