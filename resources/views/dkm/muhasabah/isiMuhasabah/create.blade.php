@extends('layouts.dkm')

@section('title', 'Tambah Pertanyaan Muhasabah')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Pertanyaan Muhasabah</h1>
    
    <div class="bg-white p-6 rounded shadow-md max-w-2xl">
        <form action="{{ route('dkm.muhasabah.soal.store') }}" method="POST">
            @csrf

            {{-- Pertanyaan --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pertanyaan</label>
                <input type="text" name="pertanyaan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: Apakah Anda sholat Dhuha hari ini?" required>
            </div>

            {{-- Deskripsi / Penjelasan (Opsional) --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi / Penjelasan (Opsional)</label>
                <textarea name="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="2" placeholder="Contoh: Minimal 2 rakaat sebelum dzuhur."></textarea>
            </div>

            {{-- Tipe Jawaban --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tipe Jawaban</label>
                <select name="tipe_soal" id="tipe_soal" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" onchange="toggleOpsi()">
                    <option value="short_text">Jawaban Singkat (Text)</option>
                    <option value="paragraph">Jawaban Panjang (Cerita)</option>
                    <option value="radio">Pilihan Ganda (Radio Button)</option>
                    <option value="checkbox">Checklist (Bisa pilih banyak)</option>
                </select>
            </div>

            {{-- Opsi Jawaban --}}
            <div id="area_opsi" class="mb-4 hidden p-4 bg-gray-50 border rounded">
                <label class="block text-gray-700 text-sm font-bold mb-2">Opsi Jawaban</label>
                <p class="text-xs text-gray-500 mb-2">Masukkan pilihan jawaban di bawah ini:</p>
                
                <div id="container_input_opsi">
                    <div class="flex mb-2">
                        <input type="text" name="opsi[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" placeholder="Pilihan 1">
                    </div>
                    <div class="flex mb-2">
                        <input type="text" name="opsi[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" placeholder="Pilihan 2">
                    </div>
                </div>

                <button type="button" onclick="tambahOpsi()" class="mt-2 text-sm text-blue-600 hover:text-blue-800 font-bold">+ Tambah Opsi Lain</button>
            </div>

            <div class="flex gap-4 mb-4">
                {{-- Urutan Tampil --}}
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Urutan Tampil</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $nextUrutan) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                </div>

                {{-- Required Soal --}}
                <div class="w-1/2 flex flex-col justify-center mt-4 space-y-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500" checked>
                        <label class="ml-2 text-sm font-bold text-gray-700" for="is_active">Tampilkan Soal Ini?</label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_required" id="is_required" class="w-4 h-4 text-red-600 rounded border-gray-300 focus:ring-red-500" checked>
                        <label class="ml-2 text-sm font-bold text-gray-700" for="is_required">Wajib Diisi (Required)?</label>
                        <span class="text-xs text-gray-500 ml-1">(Jika dicentang, user tidak bisa submit kosong)</span>
                    </div>
                </div>

                {{-- Aktifkan Soal --}}
                <div class="w-1/2 flex items-center mt-6">
                    <input type="checkbox" name="is_active" id="is_active" class="mr-2 leading-tight" checked>
                    <label class="text-sm text-gray-700 font-bold" for="is_active">Aktifkan Soal Ini?</label>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan Pertanyaan
                </button>
                <a href="{{ route('dkm.muhasabah.soal.index') }}" class="text-blue-500 hover:text-blue-800 font-bold text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleOpsi() {
        const tipe = document.getElementById('tipe_soal').value;
        const area = document.getElementById('area_opsi');
        
        if (tipe === 'radio' || tipe === 'checkbox') {
            area.classList.remove('hidden');
        } else {
            area.classList.add('hidden');
        }
    }

    function tambahOpsi() {
        const container = document.getElementById('container_input_opsi');
        const div = document.createElement('div');
        div.className = 'flex mb-2';
        div.innerHTML = `
            <input type="text" name="opsi[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" placeholder="Pilihan Baru">
            <button type="button" onclick="this.parentElement.remove()" class="ml-2 text-red-500 font-bold">X</button>
        `;
        container.appendChild(div);
    }
</script>
@endsection