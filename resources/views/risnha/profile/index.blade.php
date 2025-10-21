@extends('layouts.risnha')

@section('title', 'Manajemen Profile Risnha')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Manajemen Visi & Misi Risnha</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('risnha.profile.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="visi" class="block text-gray-700 text-sm font-bold mb-2">Visi</label>
                <textarea name="visi" id="visi" rows="5"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('visi') border-red-500 @enderror"
                          placeholder="Tuliskan visi Risnha di sini...">{{ old('visi', $profile->visi) }}</textarea>
                @error('visi')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="misi" class="block text-gray-700 text-sm font-bold mb-2">Misi</label>
                <textarea name="misi" id="misi" rows="10"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('misi') border-red-500 @enderror"
                          placeholder="Tuliskan misi Risnha di sini (gunakan format bullet point jika perlu)...">{{ old('misi', $profile->misi) }}</textarea>
                @error('misi')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection