@extends('layouts.dkm')

@section('title', 'Atur Running Text')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Atur Running Text di Halaman Utama</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('dkm.tampilanPenggunaMasjid.runningText.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Isi Teks</label>
            {{-- Perbaikan: Gunakan optional chaining (?->) atau null coalescing operator (??) --}}
            <textarea name="content" id="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Tulis pengumuman di sini...">
                {{ old('content', $runningText->content ?? '') }}
            </textarea>
            <p class="mt-1 text-sm text-gray-500">Teks ini akan berjalan di bagian atas halaman utama website.</p>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Simpan Perubahan</button>
    </form>
</div>
@endsection

