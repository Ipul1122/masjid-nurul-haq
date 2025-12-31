@extends('layouts.dkm')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Group</h1>
    
    <div class="bg-white p-6 rounded shadow-md max-w-lg">
        <form action="{{ route('dkm.muhasabah.group.update', $group->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Group / Ketua</label>
                <input type="text" name="nama_group" value="{{ $group->nama_group }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username Login</label>
                <input type="text" name="username" value="{{ $group->username }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password Baru (Opsional)</label>
                <input type="text" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Isi jika ingin mengganti password">
                <p class="text-xs text-gray-500 mt-1">*Kosongkan jika tidak ingin mengubah password.</p>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Group
                </button>
                <a href="{{ route('dkm.muhasabah.group.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection