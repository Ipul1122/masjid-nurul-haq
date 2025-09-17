@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Edit Jadwal Imam</h2>

    <form method="POST" action="{{ route('dkm.manajemenKonten.jadwalImam.update', $jadwalImam->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="block mb-1">Foto Imam</label>
            @if($jadwalImam->gambar)
                <img src="{{ asset('storage/'.$jadwalImam->gambar) }}" alt="Foto Imam" class="w-32 mb-2">
            @endif
            <input type="file" name="gambar" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block mb-1">Nama Imam</label>
            <input type="text" name="nama" value="{{ $jadwalImam->nama }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Waktu Sholat</label>
            <select name="waktu_sholat" class="w-full border px-3 py-2 rounded" required>
                @foreach(['Subuh','Zhuhur','Ashar','Maghrib','Isya'] as $waktu)
                    <option value="{{ $waktu }}" {{ $jadwalImam->waktu_sholat == $waktu ? 'selected' : '' }}>{{ $waktu }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('dkm.manajemenKonten.jadwalImam.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
