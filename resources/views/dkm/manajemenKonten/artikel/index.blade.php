@extends('layouts.dkm')

@section('title', 'Artikel')
@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Daftar Artikel</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- 🔎 Filter berdasarkan kategori --}}
    <form method="GET" action="{{ route('dkm.manajemenKonten.artikel.index') }}" class="mb-4 flex items-center gap-3 flex-wrap">
        <label for="kategori_id" class="font-medium">Filter Kategori:</label>
        <select name="kategori_id" id="kategori_id" class="border rounded px-3 py-2">
            <option value="">-- Semua Kategori --</option>
            @foreach(\App\Models\KategoriArtikel::all() as $kategori)
                <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Terapkan</button>
        <a href="{{ route('dkm.manajemenKonten.artikel.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Reset</a>
    </form>

    <a href="{{ route('dkm.manajemenKonten.artikel.create') }}" 
       class="bg-green-600 text-white px-4 py-2 rounded mb-3 inline-block">+ Tambah Artikel</a>
    <a href="{{ route('dkm.kategori.artikel.index') }}" 
       class="bg-green-600 text-white px-4 py-2 rounded mb-3 inline-block">Kelola kategori</a>

    <form method="POST" action="{{ route('dkm.manajemenKonten.artikel.bulkDelete') }}" 
          onsubmit="return confirm('Yakin ingin menghapus artikel terpilih?')">
        @csrf
        @method('DELETE')

        {{-- BUTTON DELETE MULTIPLE --}}
         <button type="submit" 
                class="mb-3 bg-red-600 text-white px-4 py-2 rounded"
                id="btnDeleteSelected" disabled>
            Hapus Terpilih
        </button>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border text-sm sm:text-base">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-2 py-2">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Judul</th>
                        <th class="border px-4 py-2">Kategori</th>
                        <th class="border px-4 py-2">Gambar</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artikels as $artikel)
                    <tr>
                        <td class="border px-2 py-2 text-center">
                            <input type="checkbox" name="ids[]" value="{{ $artikel->id }}" class="row-checkbox">
                        </td>
                        <td class="border px-4 py-2">{{ $artikel->id }}</td>
                        <td class="border px-4 py-2 font-semibold">{{ $artikel->judul }}</td>
                        <td class="border px-4 py-2">{{ $artikel->kategori->nama ?? '-' }}</td>
                        <td class="border px-4 py-2">
                            {{-- Logika untuk menampilkan gambar tetap sama --}}
                            @php
                                $gambarList = [];
                                if ($artikel->gambar) {
                                    if (is_array($artikel->gambar)) {
                                        $gambarList = $artikel->gambar;
                                    } elseif (is_string($artikel->gambar) && str_starts_with($artikel->gambar, '[')) {
                                        $gambarList = json_decode($artikel->gambar, true) ?? [];
                                    } elseif (is_string($artikel->gambar)) {
                                        $gambarList = explode(',', $artikel->gambar);
                                    }
                                }
                            @endphp
                            <div class="flex flex-wrap gap-2">
                                @if (!empty($gambarList) && isset($gambarList[0]))
                                    <img src="{{ asset('storage/' . trim($gambarList[0])) }}" 
                                         alt="Gambar Artikel" 
                                         class="w-16 h-16 object-cover rounded border">
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </div>
                        </td>
                        <td class="border px-4 py-2">
                            <div class="flex flex-wrap gap-2">
                                {{-- 👇 TOMBOL PREVIEW BARU 👇 --}}
                                <a href="{{ route('dkm.manajemenKonten.artikel.preview', $artikel->id) }}" 
                                target="_blank" 
                                class="bg-gray-500 text-white px-3 py-1 rounded">Preview</a>

                                <a href="{{ route('dkm.manajemenKonten.artikel.edit', ['artikel' => $artikel->id, 'page' => request('page', 1)]) }}" 
                                class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
                                
                                {{-- <form onsubmit="return confirm('Yakin ingin menghapus artikel ini?');"
                                    action="{{ route('dkm.manajemenKonten.artikel.destroy', ['artikel' => $artikel->id, 'page' => request('page', 1)]) }}" 
                                    method="POST" 
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                                </form> --}}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        {{-- Colspan disesuaikan menjadi 6 --}}
                        <td colspan="6" class="text-center py-3">Belum ada artikel</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- BUTTON DELETE MULTIPLE --}}
            <button type="submit" 
                    class="mb-3 mt-4 bg-red-600 text-white px-4 py-2 rounded"
                    id="btnDeleteSelected" disabled>
                Hapus Terpilih
            </button>

            <div class="mt-4">
                {{ $artikels->links() }}
            </div>

        </div>
    </form>
</div>

{{-- Script untuk select all checkbox (sudah benar, tidak ada perubahan) --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAll');
    const deleteButtons = document.querySelectorAll('#btnDeleteSelected');
    const checkboxes = document.querySelectorAll('.row-checkbox');

    function toggleDeleteButton() {
        const checked = document.querySelectorAll('.row-checkbox:checked').length > 0;
        deleteButtons.forEach(button => {
            button.disabled = !checked;
        });
    }

    if (selectAll) {
        selectAll.addEventListener('change', function (e) {
            checkboxes.forEach(cb => cb.checked = e.target.checked);
            toggleDeleteButton();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            if (!this.checked) {
                selectAll.checked = false;
            } else {
                if (document.querySelectorAll('.row-checkbox:checked').length === checkboxes.length) {
                    selectAll.checked = true;
                }
            }
            toggleDeleteButton();
        });
    });
    
    // Initial check in case of back navigation
    toggleDeleteButton();
});
</script>
@endsection