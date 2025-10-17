@extends('layouts.dkm')

@section('title', 'Buat Visi & Misi')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Buat Visi & Misi</h2>

    <form method="POST" action="{{ route('dkm.tampilanPenggunaMasjid.visiMisi.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="visi-input">Visi</label>
            <input id="visi-input" type="hidden" name="visi" value="{{ old('visi') }}">
            <trix-editor input="visi-input" class="w-full border px-3 py-2 rounded bg-white"></trix-editor>
             @error('visi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="misi-input">Misi</label>
            <input id="misi-input" type="hidden" name="misi" value="{{ old('misi') }}">
            <trix-editor input="misi-input" class="w-full border px-3 py-2 rounded bg-white"></trix-editor>
             @error('misi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('dkm.tampilanPenggunaMasjid.visiMisi.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection

