@extends('layouts.dkm') {{-- nanti kita bikin layout dasar --}}
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Daftar Pengguna DKM</h2>
        <a href="{{ route('dkm.managePengguna.create') }}" class="bg-green-600 text-black px-4 py-2 rounded">+ Tambah Pengguna</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Username</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($managePengguna as $mp)
            <tr>
                <td class="border px-4 py-2">{{ $mp->id }}</td>
                <td class="border px-4 py-2">{{ $mp->username }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('dkm.managePengguna.edit', $mp->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
                    <form method="POST" action="{{ route('dkm.managePengguna.destroy', $mp->id) }}" onsubmit="return confirm('Hapus pengguna ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
