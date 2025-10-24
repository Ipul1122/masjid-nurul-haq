@extends('layouts.dkm')

@section('title', 'Tambah Kegiatan Masjid')
@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Kegiatan</h2>

    {{-- ✅ PERUBAHAN: Menambahkan id pada form --}}
    <form method="POST" action="{{ route('dkm.manajemenKonten.kegiatanMasjid.store') }}" enctype="multipart/form-data" id="kegiatanForm">
        @csrf
        <div class="mb-4">
            <label class="block mb-1" for="judul">Judul</label>
            {{-- ✅ PERUBAHAN: Menambahkan id --}}
            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1" for="nama_ustadz">Nama Ustadz</label>
            {{-- ✅ PERUBAHAN: Menambahkan id --}}
            <input type="text" name="nama_ustadz" id="nama_ustadz" value="{{ old('nama_ustadz') }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1" for="jadwal">Jadwal</label>
            {{-- ✅ PERUBAHAN: Menambahkan id --}}
            <input type="datetime-local" name="jadwal" id="jadwal" value="{{ old('jadwal') }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1">Gambar</label>
            <input type="file" name="gambar" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block mb-1" for="deskripsi">Deskripsi</label>
            <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
            <trix-editor input="deskripsi" class="w-full border px-3 py-2 rounded"></trix-editor>
        </div>
        
        <div class="mb-4">
            <label class="block mb-1" for="kategori_id">Kategori</label>
            {{-- ✅ PERUBAHAN: Menambahkan id --}}
            <select name="kategori_id" id="kategori_id" class="w-full border px-3 py-2 rounded @if($kategori->isEmpty()) bg-gray-100 cursor-not-allowed @endif" 
                    @if($kategori->isEmpty()) disabled @endif>
                
                <option value="">-- Pilih Kategori --</option>
                
                @forelse($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @empty
                    <option value="" disabled>-- Kategori Kosong --</option>
                @endforelse
            </select>

            @if($kategori->isEmpty())
                <p class="text-red-500 text-sm mt-1">
                    Kategori tidak tersedia, buat 
                    <a href="{{ route('dkm.kategori.kegiatanMasjid.create') }}" class="font-bold text-xl text-blue-600 hover:underline">
                        kategori kegiatan Masjid
                    </a> 
                    segera
                </p>
            @endif
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" id="btnBatal" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('kegiatanForm');
        const btnBatal = document.getElementById('btnBatal');
        const storageKey = 'kegiatanFormDraft'; 
        
        // Daftar ID field yang akan disimpan
        const fieldsToSave = ['judul', 'nama_ustadz', 'jadwal', 'deskripsi', 'kategori_id'];

        function loadDraft() {
            @if(!session()->has('errors'))
                const draft = JSON.parse(localStorage.getItem(storageKey));
                if (draft) {
                    fieldsToSave.forEach(fieldId => {
                        const field = document.getElementById(fieldId);
                        if (field && draft[fieldId]) {
                            if (fieldId === 'deskripsi') {
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


        // 1. Muat draf saat halaman dibuka
        loadDraft();

        // 2. Simpan draf setiap kali ada perubahan input
        form.addEventListener('input', saveDraft);
        
        // 3. Simpan draf untuk Trix editor (karena event-nya beda)
        document.addEventListener('trix-change', function(event) {
            // Pastikan event berasal dari editor yang benar
            if (event.target.input && fieldsToSave.includes(event.target.input.id)) {
                saveDraft();
            }
        });

        // 4. Bersihkan draf saat form berhasil disubmit
        form.addEventListener('submit', clearDraft);

        // 5. Bersihkan draf saat tombol "Batal" diklik
        btnBatal.addEventListener('click', clearDraft);
    });
</script>
@endsection