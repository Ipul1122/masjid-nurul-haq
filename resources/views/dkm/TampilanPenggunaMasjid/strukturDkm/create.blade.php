@extends('layouts.dkm')

@section('title', 'Tambah Anggota DKM')

@section('content')

<div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Anggota Struktur DKM</h2>
        <p class="text-gray-600">Isi formulir di bawah ini untuk menambahkan anggota baru.</p>
    </div>

    {{-- Form --}}
    <form id="strukturDkmForm" action="{{ route('dkm.tampilanPenggunaMasjid.strukturDkm.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Grid Container --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Kolom Kiri (Form Input) --}}
            <div class="lg:col-span-2 space-y-4">

                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Contoh: H. Muhammad Syaifulloh">
                    <span id="nama-error" class="text-red-500 text-sm mt-1 hidden"></span>
                    @error('nama')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Divisi / Jabatan --}}
                <div>
                    <label for="divisi" class="block text-sm font-medium text-gray-700 mb-1">Divisi / Jabatan</label>
                    <input type="text" id="divisi" name="divisi" value="{{ old('divisi') }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Contoh: Ketua DKM">
                    <span id="divisi-error" class="text-red-500 text-sm mt-1 hidden"></span>
                    @error('divisi')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            {{-- Kolom Kanan (Upload Gambar) --}}
            <div class="lg:col-span-1 space-y-2">
                <label class="block text-sm font-medium text-gray-700">Gambar (Foto)</label>
                
                {{-- Image Preview --}}
                <div class="w-full">
                    <img id="img-preview" src="{{ asset('images/person-icon.png') }}" alt="Preview Foto Anggota" 
                         class="w-full h-48 object-cover rounded-lg bg-gray-100 border border-gray-300">
                </div>

                {{-- Tombol Upload --}}
                <input type="file" id="gambar" name="gambar" class="hidden" accept="image/*" onchange="previewImage(event)">
                <label for="gambar" class="cursor-pointer w-full inline-block text-center bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-50 transition duration-300">
                    <i class="fas fa-upload mr-2"></i>Pilih Gambar
                </label>
                
                <span id="gambar-error" class="text-red-500 text-sm mt-1 hidden"></span>
                @error('gambar')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-3">
            <a href="{{ route('dkm.tampilanPenggunaMasjid.strukturDkm.index') }}"
               class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-300 transition duration-300">
                Batal
            </a>
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-blue-700 transition duration-300">
                <i class="fas fa-save mr-2"></i>Simpan Anggota
            </button>
        </div>

    </form>

</div>
<script>
    // Fungsi untuk preview gambar
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('img-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Validasi Sisi Klien
    document.getElementById('strukturDkmForm').addEventListener('submit', function(event) {
        let isValid = true;
        
        // Reset errors
        document.getElementById('nama-error').classList.add('hidden');
        document.getElementById('divisi-error').classList.add('hidden');
        document.getElementById('gambar-error').classList.add('hidden');

        // Validasi Nama
        const nama = document.getElementById('nama').value;
        if (!nama) {
            document.getElementById('nama-error').textContent = 'Nama Lengkap wajib diisi.';
            document.getElementById('nama-error').classList.remove('hidden');
            isValid = false;
        }

        // Validasi Divisi
        const divisi = document.getElementById('divisi').value;
        if (!divisi) {
            document.getElementById('divisi-error').textContent = 'Divisi / Jabatan wajib diisi.';
            document.getElementById('divisi-error').classList.remove('hidden');
            isValid = false;
        }

        // Validasi Gambar
        const gambar = document.getElementById('gambar').files;
        if (gambar.length === 0) {
            document.getElementById('gambar-error').textContent = 'Gambar (Foto) wajib diupload.';
            document.getElementById('gambar-error').classList.remove('hidden');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); // Hentikan submit form
        }
    });
</script>

@endsection