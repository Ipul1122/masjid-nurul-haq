@extends('layouts.dkm')

@section('title', 'Edit Sejarah Masjid')


@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="max-w-4xl mx-auto">
        {{-- Pastikan form action dan method-nya benar untuk update --}}
        <form action="{{ route('dkm.tampilanPenggunaMasjid.sejarah.update', $sejarah->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Container Utama dengan Shadow dan Sudut Tumpul --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                
                {{-- Header Card --}}
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800">Edit Sejarah</h2>
                    <p class="text-sm text-gray-500 mt-1">Lakukan perubahan pada konten sejarah yang sudah ada.</p>
                </div>

                {{-- Body Card - Tempat Form --}}
                <div class="p-6">
                    {{-- Penanganan Error --}}
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                            <p class="font-bold">Oops! Ada beberapa masalah:</p>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="space-y-6">
                        {{-- Input Judul --}}
                        <div>
                            <label for="judul" class="block mb-2 text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" id="judul" name="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 transition" placeholder="Contoh: Sejarah Berdirinya Masjid" value="{{ old('judul', $sejarah->judul) }}">
                        </div>
                        
                        {{-- Input Deskripsi (Textarea) --}}
                        <div>
                            <label for="editor" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="editor" name="deskripsi" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 transition" placeholder="Tuliskan isi sejarah di sini...">{{ old('deskripsi', $sejarah->deskripsi) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Footer Card - Tombol Aksi --}}
                <div class="bg-gray-50 p-6 flex items-center justify-end space-x-4">
                    <a href="{{ route('dkm.tampilanPenggunaMasjid.sejarah.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white font-semibold text-sm rounded-lg shadow-md hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Update Perubahan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection