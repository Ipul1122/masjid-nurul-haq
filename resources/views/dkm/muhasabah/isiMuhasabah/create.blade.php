@extends('layouts.dkm')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Pertanyaan Muhasabah</h1>
    
    <div class="bg-white p-6 rounded shadow-md max-w-2xl">
        <form action="{{ route('dkm.muhasabah.soal.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pertanyaan</label>
                <input type="text" name="pertanyaan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: Apakah Anda sholat Dhuha hari ini?" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tipe Jawaban</label>
                <select name="tipe_soal" id="tipe_soal" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" onchange="toggleOpsi()">
                    <option value="short_text">Jawaban Singkat (Text)</option>
                    <option value="paragraph">Jawaban Panjang (Cerita)</option>
                    <option value="radio">Pilihan Ganda (Radio Button)</option>
                    <option value="checkbox">Checklist (Bisa pilih banyak)</option>
                </select>
            </div>

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
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Urutan Tampil</label>
                    <input type="number" name="urutan" value="1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                </div>
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