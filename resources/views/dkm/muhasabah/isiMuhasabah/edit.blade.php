@extends('layouts.dkm')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Pertanyaan</h1>
    
    <div class="bg-white p-6 rounded shadow-md max-w-2xl">
        <form action="{{ route('dkm.muhasabah.soal.update', $soal->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Pertanyaan --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pertanyaan</label>
                <input type="text" name="pertanyaan" value="{{ $soal->pertanyaan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            {{-- Deskripsi / Penjelasan (Opsional) --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi / Penjelasan (Opsional)</label>
                <textarea name="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="2">{{ $soal->deskripsi }}</textarea>
            </div>

            {{-- Required Soal --}}
            <div class="flex items-center">
                <input type="checkbox" name="is_required" id="is_required" class="w-4 h-4 text-red-600 rounded border-gray-300 focus:ring-red-500" {{ $soal->is_required ? 'checked' : '' }}>
                <label class="ml-2 text-sm font-bold text-gray-700" for="is_required">Wajib Diisi (Required)?</label>
            </div>

            {{-- Tipe Jawaban --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tipe Jawaban</label>
                <select name="tipe_soal" id="tipe_soal" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" onchange="toggleOpsi()">
                    <option value="short_text" {{ $soal->tipe_soal == 'short_text' ? 'selected' : '' }}>Jawaban Singkat (Text)</option>
                    <option value="paragraph" {{ $soal->tipe_soal == 'paragraph' ? 'selected' : '' }}>Jawaban Panjang (Cerita)</option>
                    <option value="radio" {{ $soal->tipe_soal == 'radio' ? 'selected' : '' }}>Pilihan Ganda (Radio Button)</option>
                    <option value="checkbox" {{ $soal->tipe_soal == 'checkbox' ? 'selected' : '' }}>Checklist (Bisa pilih banyak)</option>
                </select>
            </div>

            {{-- Opsi Jawaban --}}
            <div id="area_opsi" class="mb-4 {{ in_array($soal->tipe_soal, ['radio', 'checkbox']) ? '' : 'hidden' }} p-4 bg-gray-50 border rounded">
                <label class="block text-gray-700 text-sm font-bold mb-2">Opsi Jawaban</label>
                
                <div id="container_input_opsi">
                    @if(!empty($soal->opsi_jawaban))
                        @foreach($soal->opsi_jawaban as $opsi)
                        <div class="flex mb-2">
                            <input type="text" name="opsi[]" value="{{ $opsi }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                            <button type="button" onclick="this.parentElement.remove()" class="ml-2 text-red-500 font-bold">X</button>
                        </div>
                        @endforeach
                    @else
                        <div class="flex mb-2">
                            <input type="text" name="opsi[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" placeholder="Pilihan 1">
                        </div>
                    @endif
                </div>

                <button type="button" onclick="tambahOpsi()" class="mt-2 text-sm text-blue-600 hover:text-blue-800 font-bold">+ Tambah Opsi Lain</button>
            </div>

            <div class="flex gap-4 mb-4">
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Urutan Tampil</label>
                    <input type="number" name="urutan" value="{{ $soal->urutan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                </div>
                <div class="w-1/2 flex items-center mt-6">
                    <input type="checkbox" name="is_active" id="is_active" class="mr-2 leading-tight" {{ $soal->is_active ? 'checked' : '' }}>
                    <label class="text-sm text-gray-700 font-bold" for="is_active">Aktifkan Soal Ini?</label>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Pertanyaan
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