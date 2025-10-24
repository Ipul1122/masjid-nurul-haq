@extends('layouts.dkm')

{{-- ✅ PERUBAHAN: Menyamakan title dengan heading --}}
@section('title', 'Tambah Artikel')
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Artikel</h2>

    {{-- ✅ PERUBAHAN: Menambahkan id pada form --}}
    <form method="POST" action="{{ route('dkm.manajemenKonten.artikel.store') }}" enctype="multipart/form-data" id="artikelForm">
        @csrf

        <div class="mb-3">
            <label class="block mb-1" for="judul">Judul</label>
            {{-- ✅ PERUBAHAN: Menambahkan id dan old() --}}
            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1" for="gambar">Gambar</label>
            {{-- ✅ PERUBAHAN: Menambahkan id --}}
            <input type="file" name="gambar" id="gambar" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block mb-1" for="deskripsi">Deskripsi</label>
            <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
            <trix-editor input="deskripsi" class="w-full border px-3 py-2 rounded"></trix-editor>
        </div>

        <div class="mb-3">
            <label class="block mb-1" for="tanggal_rilis">Tanggal Rilis</label>
            {{-- ✅ PERUBAHAN: Menambahkan id dan prioritas old() --}}
            <input type="date" name="tanggal_rilis" id="tanggal_rilis" value="{{ old('tanggal_rilis', now()->format('Y-m-d')) }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        
          <div class="mb-3">
            <label class="block mb-1" for="kategori_id">Kategori</label>
            {{-- ✅ PERUBAHAN: Menambahkan id --}}
            <select name="kategori_id" id="kategori_id" class="w-full border px-3 py-2 rounded @if($kategoriArtikels->isEmpty()) bg-gray-100 cursor-not-allowed @endif" 
                    @if($kategoriArtikels->isEmpty()) disabled @endif>
                
                <option value="">-- Pilih kategori Artikel --</option>
                
                @forelse($kategoriArtikels as $kat)
                    <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @empty
                    <option value="" disabled>-- Kategori Kosong --</option>
                @endforelse
            </select>

            @if($kategoriArtikels->isEmpty())
                <p class="text-red-500 text-sm mt-1">
                    Kategori tidak tersedia, buat 
                    <a href="{{ route('dkm.kategori.artikel.create') }}" class="font-bold text-xl text-blue-600 hover:underline">
                        kategori Artikel Masjid
                    </a> 
                    segera
                </p>
            @endif
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        {{-- ✅ PERUBAHAN: Menambahkan id pada tombol Batal --}}
        <a href="{{ route('dkm.manajemenKonten.artikel.index') }}" id="btnBatal" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>

{{-- ✅ PERUBAHAN: Menambahkan script untuk simpan draf otomatis --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('artikelForm');
        const btnBatal = document.getElementById('btnBatal');
        const storageKey = 'artikelFormDraft'; // Kunci unik untuk form ini
        
        // Daftar ID field yang akan disimpan
        const fieldsToSave = ['judul', 'deskripsi', 'tanggal_rilis', 'kategori_id'];

        // Fungsi untuk memuat data dari localStorage
        function loadDraft() {
            // Jangan muat draf jika ada error validasi (Laravel akan mengisi via old())
            @if(!session()->has('errors'))
                const draft = JSON.parse(localStorage.getItem(storageKey));
                if (draft) {
                    fieldsToSave.forEach(fieldId => {
                        const field = document.getElementById(fieldId);
                        if (field && draft[fieldId]) {
                            if (fieldId === 'deskripsi') {
                                // Penanganan khusus untuk Trix editor
                                field.value = draft[fieldId];
                                const trixEditor = document.querySelector(`trix-editor[input="${fieldId}"]`);
                                if (trixEditor) {
                                    trixEditor.editor.loadHTML(draft[fieldId]);
                                }
                            } else {
                                field.value = draft[fieldId];
                            }
                        }
                    });
                }
            @endif
        }

        // Fungsi untuk menyimpan data ke localStorage
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

        // Fungsi untuk membersihkan draf
        function clearDraft() {
            localStorage.removeItem(storageKey);
        }

        // --- Event Listeners ---
        loadDraft();
        form.addEventListener('input', saveDraft);
        document.addEventListener('trix-change', function(event) {
            if (event.target.input && fieldsToSave.includes(event.target.input.id)) {
                saveDraft();
            }
        });
        form.addEventListener('submit', clearDraft);
        btnBatal.addEventListener('click', clearDraft);
    });
</script>
@endsection