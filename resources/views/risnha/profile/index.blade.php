@extends('layouts.risnha')
@section('title', 'Manajemen Profile Risnha')
@section('content')
<div class="container mx-auto px-4 py-8">

    <h1 class="text-3xl font-bold mb-8 text-green-800">Manajemen Profile Risnha</h1>

    {{-- Form Visi & Misi --}}
    <div class="bg-white p-8 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-semibold mb-6 text-gray-700">Visi & Misi</h2>
        @if (session('successVisiMisi'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('successVisiMisi') }}</p>
            </div>
        @endif
        <form action="{{ route('risnha.profile.storeVisiMisi') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="visi" class="block text-gray-700 text-sm font-bold mb-2">Visi</label>
                <textarea name="visi" id="visi" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('visi') border-red-500 @enderror">{{ old('visi', $profile->visi) }}</textarea>
                @error('visi')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label for="misi" class="block text-gray-700 text-sm font-bold mb-2">Misi</label>
                <textarea name="misi" id="misi" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('misi') border-red-500 @enderror">{{ old('misi', $profile->misi) }}</textarea>
                @error('misi')<p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                    Simpan Visi & Misi
                </button>
            </div>
        </form>
    </div>



    {{-- Manajemen Struktur Organisasi --}}

    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6 text-gray-700">Manajemen Struktur Organisasi</h2>
        @if (session('successOrganisasi'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('successOrganisasi') }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <strong>Error!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Tambah Baru --}}
        <div class="border-b-2 pb-6 mb-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-600">Tambah Struktur Organisasi Baru</h3>
            <form action="{{ route('risnha.profile.storeOrganisasi') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="gambar_organisasi" class="block text-gray-700 text-sm font-bold mb-2">Gambar (Wajib)</label>
                    <input type="file" name="gambar_organisasi" id="gambar_organisasi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                        Tambah Baru
                    </button>
                </div>
            </form>
        </div>

        {{-- Daftar Struktur Organisasi yang Ada --}}
        <h3 class="text-xl font-semibold mb-4 text-gray-600">Daftar Struktur Organisasi</h3>
        <div class="space-y-6">
            @forelse($organisasis as $item)
                <div class="border rounded-lg p-4 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <img src="{{ asset('images/organisasi_risnha/' . $item->gambar_organisasi) }}" alt="Struktur Organisasi" class="max-w-xs border rounded p-2">
                    </div>

                    <div class="md:col-span-2 space-y-4">
                        {{-- Form Update --}}
                        <form action="{{ route('risnha.profile.updateOrganisasi', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label for="deskripsi_{{ $item->id }}" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi_{{ $item->id }}" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                            </div>
                            <div>
                                <label for="gambar_organisasi_{{ $item->id }}" class="block text-gray-700 text-sm font-bold mb-2 mt-2">Ganti Gambar (Opsional)</label>
                                <input type="file" name="gambar_organisasi" id="gambar_organisasi_{{ $item->id }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <button type="submit" class="mt-4 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update
                            </button>
                        </form>

                        {{-- Form Delete --}}
                        <form action="{{ route('risnha.profile.destroyOrganisasi', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center">Belum ada struktur organisasi yang diunggah.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection