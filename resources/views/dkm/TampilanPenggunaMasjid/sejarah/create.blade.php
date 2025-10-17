@extends('layouts.dkm')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="max-w-4xl mx-auto">
        <form action="{{ route('dkm.tampilanPenggunaMasjid.sejarah.store') }}" method="POST">
            @csrf

            {{-- Container Utama dengan Shadow dan Sudut Tumpul --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                
                {{-- Header Card --}}
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800">Tambah Sejarah Baru</h2>
                    <p class="text-sm text-gray-500 mt-1">Isi detail sejarah pada form di bawah ini.</p>
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
                            <input type="text" id="judul" name="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 transition" placeholder="Contoh: Sejarah Berdirinya Masjid" value="{{ old('judul') }}">
                        </div>
                        
                        {{-- Input Deskripsi (Textarea) --}}
                        <div>
                            <label for="editor" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi</label>
                            {{-- Class di bawah ini akan menjadi dasar sebelum library rich text editor (seperti TinyMCE/Trix) diinisialisasi --}}
                            <textarea id="editor" name="deskripsi" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="Tuliskan isi sejarah di sini...">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Footer Card - Tombol Aksi --}}
                <div class="bg-gray-50 p-6 flex items-center justify-end space-x-4">
                    <a href="{{ route('dkm.tampilanPenggunaMasjid.sejarah.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold text-sm rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Simpan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection