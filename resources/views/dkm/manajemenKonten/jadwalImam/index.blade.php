@extends('layouts.dkm')

@section('title', 'Jadwal Imam')
@section('content')
<div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">

    {{-- Header dan Tombol Tambah Atas --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-3 sm:mb-0">Jadwal Imam</h2>
        <a href="{{ route('dkm.manajemenKonten.jadwalImam.create') }}" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition duration-300 text-center">
            <i class="fas fa-plus mr-2"></i>Tambah Jadwal
        </a>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Kontainer Jadwal --}}
    <div class="space-y-4">

        {{-- Header untuk Tampilan Desktop (LG) --}}
        <div class="hidden lg:grid lg:grid-cols-4 gap-4 bg-gray-100 p-4 rounded-t-lg font-bold text-gray-600">
            <div>Foto Imam</div>
            <div>Nama Imam</div>
            <div>Waktu Sholat</div>
            <div class="text-center">Aksi</div>
        </div>

        {{-- Loop Data Jadwal Imam --}}
        @forelse($jadwal as $j)
            <div class="bg-gray-50 border rounded-lg p-4 grid grid-cols-1 lg:grid-cols-4 gap-4 items-center hover:bg-gray-100 transition duration-300">
                
                {{-- Kolom Foto Imam --}}
                <div class="flex justify-center lg:justify-start">
                    @if($j->gambar)
                        <img src="{{ asset('storage/'.$j->gambar) }}" class="w-20 h-20 object-cover rounded-full shadow-sm">
                    @else
                        <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                    @endif
                </div>

                {{-- Kolom Nama Imam --}}
                <div class="text-center lg:text-left">
                    <div class="font-bold text-gray-600 lg:hidden mb-1">Nama Imam</div>
                    <div class="text-gray-800 text-lg">{{ $j->nama }}</div>
                </div>

                {{-- Kolom Waktu Sholat --}}
                <div class="text-center lg:text-left">
                    <div class="font-bold text-gray-600 lg:hidden mb-1">Waktu Sholat</div>
                    <div class="text-gray-800">{{ $j->waktu_sholat }}</div>
                </div>

                {{-- Kolom Aksi --}}
                <div class="flex gap-2 justify-center items-center mt-2 lg:mt-0">
                    <a href="{{ route('dkm.manajemenKonten.jadwalImam.edit', $j->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition duration-300 text-sm">
                       <i class="fas fa-edit"></i> <span class="hidden sm:inline">Edit</span>
                    </a>
                    <form method="POST" action="{{ route('dkm.manajemenKonten.jadwalImam.destroy', $j->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow hover:bg-red-700 transition duration-300 text-sm">
                            <i class="fas fa-trash"></i> <span class="hidden sm:inline">Hapus</span>
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="text-center py-10 bg-gray-50 rounded-lg">
                <p class="text-gray-500">Belum ada jadwal imam yang ditambahkan.</p>
            </div>
        @endforelse
    </div>

    {{-- Tombol Tambah Bawah --}}
    <div class="mt-8 flex justify-end">
         <a href="{{ route('dkm.manajemenKonten.jadwalImam.create') }}" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition duration-300 text-center">
            <i class="fas fa-plus mr-2"></i>Tambah Jadwal
        </a>
    </div>

</div>
@endsection