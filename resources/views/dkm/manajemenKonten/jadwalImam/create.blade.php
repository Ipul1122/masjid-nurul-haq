@extends('layouts.dkm')

@section('title', 'Tambah Jadwal Imam')
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Jadwal Imam</h2>

    <form method="POST" action="{{ route('dkm.manajemenKonten.jadwalImam.store') }} " enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="block mb-1">Foto Imam</label>
            <input type="file" name="gambar" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block mb-1">Nama Imam</label>
            <input type="text" name="nama" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Waktu Sholat</label>
            <select name="waktu_sholat" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Waktu --</option>
                <option value="Subuh">Subuh</option>
                <option value="Zhuhur">Zhuhur</option>
                <option value="Ashar">Ashar</option>
                <option value="Maghrib">Maghrib</option>
                <option value="Isya">Isya</option>
            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('dkm.manajemenKonten.jadwalImam.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection
