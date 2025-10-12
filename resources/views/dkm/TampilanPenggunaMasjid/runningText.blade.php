@extends('layouts.dkm')

@section('title', 'Atur Running Text')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Atur Running Text di Halaman Utama</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('dkm.tampilanPenggunaMasjid.runningText.update') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Isi Teks</label>
            <textarea name="content" id="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $runningText->content ?? '' }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="text_color" class="block mb-2 text-sm font-medium text-gray-900">Warna Teks</label>
                <input type="color" name="text_color" id="text_color" value="{{ $runningText->text_color ?? '#000000' }}" class="p-1 h-10 w-full block bg-white border border-gray-300 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none">
            </div>
            <div>
                <label for="background_color" class="block mb-2 text-sm font-medium text-gray-900">Warna Latar</label>
                <input type="color" name="background_color" id="background_color" value="{{ $runningText->background_color ?? '#FFFFFF' }}" class="p-1 h-10 w-full block bg-white border border-gray-300 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none">
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
    </form>
</div>
@endsection