@extends('layouts.dkm')


@section('title', 'Tambah Galeri')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Galeri</h2>

    {{-- ✅ PERUBAHAN: Menambahkan id pada form --}}
    <form action="{{ route('dkm.manajemenFasilitas.galeri.store') }}" method="POST" enctype="multipart/form-data" id="galeriForm">
        @csrf

        <div class="mb-3">
            <label class="block mb-1" for="judul">Judul</label>
            {{-- ✅ PERUBAHAN: Menambahkan id dan old() --}}
            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1" for="tanggal">Tanggal</label>
            {{-- ✅ PERUBAHAN: Menambahkan id dan old() --}}
            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1" for="gambar">Gambar (Bisa pilih lebih dari satu)</label>
            {{-- ✅ PERUBAHAN: Menambahkan id --}}
            <input type="file" name="gambar[]" id="gambar" multiple accept="image/png,image/jpeg" class="w-full border px-3 py-2 rounded" required>
            <p class="text-sm text-gray-500 mt-1">Pilih satu atau lebih file gambar (jpg, jpeg, png).</p>
        </div>

        <div class="mb-3">
            <label class="block mb-1" for="deskripsi">Deskripsi</label>
            {{-- ✅ PERUBAHAN: Menambahkan id dan old() --}}
            <textarea name="deskripsi" id="deskripsi" class="w-full border px-3 py-2 rounded">{{ old('deskripsi') }}</textarea>
        </div>

         <div class="mb-3">
            <label class="block mb-1" for="kategori_id">Kategori</label>
            {{-- ✅ PERUBAHAN: Menambahkan id dan old() --}}
            <select name="kategori_id" id="kategori_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    {{-- ✅ PERUBAHAN: Menambahkan pengecekan old() --}}
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- KATEGORI --}}
          <div class="mb-3">
            <label class="block mb-1" for="kategori_id">Kategori</label>
            {{-- ✅ PERUBAHAN: Menambahkan id --}}
            <select name="kategori_id" id="kategori_id" class="w-full border px-3 py-2 rounded @if($kategoris->isEmpty()) bg-gray-100 cursor-not-allowed @endif" 
                    @if($kategoris->isEmpty()) disabled @endif>
                
                <option value="">-- Pilih kategori Artikel --</option>
                
                @forelse($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @empty
                    <option value="" disabled>-- Kategori Kosong --</option>
                @endforelse
            </select>

            @if($kategoris->isEmpty())
                <p class="text-red-500 text-sm mt-1">
                    Kategori tidak tersedia, buat 
                    <a href="{{ route('dkm.kategori.galeri.create') }}" class="font-bold text-xl text-blue-600 hover:underline">
                        kategori Galeri Masjid
                    </a> 
                    segera
                </p>
            @endif
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        {{-- ✅ PERUBAHAN: Menambahkan id pada tombol Batal --}}
        <a href="{{ route('dkm.manajemenFasilitas.galeri.index') }}" id="btnBatal" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
    </form>
</div>

{{-- ✅ PERUBAHAN: Menambahkan script untuk simpan draf otomatis --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('galeriForm');
        const btnBatal = document.getElementById('btnBatal');
        const storageKey = 'galeriFormDraft'; // Kunci unik
        
        // Field yang akan disimpan (kecuali file input)
        const fieldsToSave = ['judul', 'tanggal', 'deskripsi', 'kategori_id'];

        function loadDraft() {
            // Jangan load jika ada error validasi
            @if(!session()->has('errors'))
                const draft = JSON.parse(localStorage.getItem(storageKey));
                if (draft) {
                    fieldsToSave.forEach(fieldId => {
                        const field = document.getElementById(fieldId);
                        if (field && draft[fieldId]) {
                            field.value = draft[fieldId];
                        }
                    });
                }
            @endif
        }

        function saveDraft() {
            const draft = {};
            fieldsToSave.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    draft[fieldId] = field.value;
                }
            });
            localStorage.setItem(storageKey, JSON.stringify(draft));
        }

        function clearDraft() {
            localStorage.removeItem(storageKey);
        }

        // Event Listeners
        loadDraft();
        form.addEventListener('input', saveDraft); 
        form.addEventListener('submit', clearDraft);
        btnBatal.addEventListener('click', clearDraft);
    });
</script>
@endsection
