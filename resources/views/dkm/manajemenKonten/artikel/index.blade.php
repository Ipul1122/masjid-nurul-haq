@extends('layouts.dkm')

@section('title', 'Artikel')
@section('content')
<div class="bg-white p-4 sm:p-6 rounded shadow">
    <h2 class="text-xl sm:text-2xl font-bold mb-4">Daftar Artikel</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('dkm.manajemenKonten.artikel.bulkDelete') }}" 
          onsubmit="return confirm('Yakin ingin menghapus artikel terpilih?')">
        @csrf
        @method('DELETE')

        {{-- 🔝 BUTTON GROUP ATAS --}}
        <div class="mb-4 space-y-3">
            {{-- Row 1: Tambah & Kelola --}}
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('dkm.manajemenKonten.artikel.create') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm sm:text-base transition-colors">
                    + Tambah Artikel
                </a>
                <a href="{{ route('dkm.kategori.artikel.index') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm sm:text-base transition-colors">
                    📂 Kelola Kategori
                </a>
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm sm:text-base transition-colors btnDeleteSelected" 
                        disabled>
                    🗑️ Hapus Terpilih
                </button>
            </div>

            {{-- Row 2: Filter Kategori --}}
            <div class="bg-gray-50 p-3 rounded border">
                <div class="flex flex-wrap items-center gap-2">
                    <label for="kategori_id_top" class="font-medium text-sm sm:text-base whitespace-nowrap">Filter:</label>
                    <select name="kategori_id" id="kategori_id_top" 
                            class="filter-select border rounded px-3 py-2 text-sm sm:text-base flex-1 sm:flex-initial min-w-[200px]">
                        <option value="">-- Semua Kategori --</option>
                        @foreach(\App\Models\KategoriArtikel::all() as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" onclick="applyFilter()" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm sm:text-base transition-colors">
                        ✓ Terapkan
                    </button>
                    <a href="{{ route('dkm.manajemenKonten.artikel.index') }}" 
                       class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded text-sm sm:text-base transition-colors">
                        ↻ Reset
                    </a>
                </div>
            </div>
        </div>

        {{-- TABEL --}}
        <div class="overflow-x-auto -mx-4 sm:mx-0">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden border rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        {{-- 🔝 THEAD TOP --}}
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-3 text-center w-12">
                                    <input type="checkbox" id="selectAllTop" class="select-all-checkbox w-4 h-4 cursor-pointer">
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Judul</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Gambar</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($artikels as $artikel)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-3 py-3 text-center">
                                    <input type="checkbox" name="ids[]" value="{{ $artikel->id }}" 
                                           class="row-checkbox w-4 h-4 cursor-pointer">
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $artikel->id }}</td>
                                <td class="px-4 py-3">
                                    <span class="text-sm font-semibold text-gray-900">{{ $artikel->judul }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $artikel->kategori->nama ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
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
                                    @if (!empty($gambarList) && isset($gambarList[0]))
                                        <img src="{{ asset('storage/' . trim($gambarList[0])) }}" 
                                             alt="Gambar Artikel" 
                                             class="w-16 h-16 object-cover rounded border shadow-sm">
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('dkm.manajemenKonten.artikel.preview', $artikel->id) }}" 
                                           target="_blank" 
                                           class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1.5 rounded text-xs sm:text-sm transition-colors">
                                            👁️ Preview
                                        </a>
                                        <a href="{{ route('dkm.manajemenKonten.artikel.edit', ['artikel' => $artikel->id, 'page' => request('page', 1)]) }}" 
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-xs sm:text-sm transition-colors">
                                            ✏️ Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="font-medium">Belum ada artikel</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        {{-- 🔽 TFOOT BOTTOM --}}
                        <tfoot class="bg-gray-100 border-t-2 border-gray-300">
                            <tr>
                                <th class="px-3 py-3 text-center w-12">
                                    <input type="checkbox" id="selectAllBottom" class="select-all-checkbox w-4 h-4 cursor-pointer">
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Judul</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Gambar</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- 🔽 BUTTON GROUP BAWAH --}}
        <div class="mt-4 space-y-3">
            {{-- Row 1: Filter Kategori --}}
            <div class="bg-gray-50 p-3 rounded border">
                <div class="flex flex-wrap items-center gap-2">
                    <label for="kategori_id_bottom" class="font-medium text-sm sm:text-base whitespace-nowrap">Filter:</label>
                    <select name="kategori_id" id="kategori_id_bottom" 
                            class="filter-select border rounded px-3 py-2 text-sm sm:text-base flex-1 sm:flex-initial min-w-[200px]">
                        <option value="">-- Semua Kategori --</option>
                        @foreach(\App\Models\KategoriArtikel::all() as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" onclick="applyFilter()" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm sm:text-base transition-colors">
                        ✓ Terapkan
                    </button>
                    <a href="{{ route('dkm.manajemenKonten.artikel.index') }}" 
                       class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded text-sm sm:text-base transition-colors">
                        ↻ Reset
                    </a>
                </div>
            </div>

            {{-- Row 2: Tambah & Kelola --}}
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('dkm.manajemenKonten.artikel.create') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm sm:text-base transition-colors">
                    + Tambah Artikel
                </a>
                <a href="{{ route('dkm.kategori.artikel.index') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm sm:text-base transition-colors">
                    📂 Kelola Kategori
                </a>
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm sm:text-base transition-colors btnDeleteSelected" 
                        disabled>
                    🗑️ Hapus Terpilih
                </button>
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $artikels->links() }}
        </div>
    </form>
</div>

{{-- JAVASCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckboxes = document.querySelectorAll('.select-all-checkbox');
    const deleteButtons = document.querySelectorAll('.btnDeleteSelected');
    const checkboxes = document.querySelectorAll('.row-checkbox');
    const filterSelects = document.querySelectorAll('.filter-select');

    // Sync filter dropdowns
    filterSelects.forEach((select, index) => {
        select.addEventListener('change', function() {
            filterSelects.forEach((otherSelect, otherIndex) => {
                if (index !== otherIndex) {
                    otherSelect.value = this.value;
                }
            });
        });
    });

    // Toggle delete button
    function toggleDeleteButton() {
        const checked = document.querySelectorAll('.row-checkbox:checked').length > 0;
        deleteButtons.forEach(button => {
            button.disabled = !checked;
            if (checked) {
                button.classList.remove('opacity-50', 'cursor-not-allowed');
                button.classList.add('cursor-pointer');
            } else {
                button.classList.add('opacity-50', 'cursor-not-allowed');
                button.classList.remove('cursor-pointer');
            }
        });
    }

    // Sync select all checkboxes
    function syncSelectAllCheckboxes() {
        const allChecked = checkboxes.length > 0 && 
                          document.querySelectorAll('.row-checkbox:checked').length === checkboxes.length;
        selectAllCheckboxes.forEach(cb => {
            cb.checked = allChecked;
        });
    }

    // Select all functionality (for both top and bottom)
    selectAllCheckboxes.forEach(selectAll => {
        selectAll.addEventListener('change', function(e) {
            checkboxes.forEach(cb => cb.checked = e.target.checked);
            syncSelectAllCheckboxes();
            toggleDeleteButton();
        });
    });

    // Individual checkbox functionality
    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            syncSelectAllCheckboxes();
            toggleDeleteButton();
        });
    });
    
    // Initial check
    toggleDeleteButton();
    syncSelectAllCheckboxes();
});

// Apply filter function
function applyFilter() {
    const selectedValue = document.querySelector('.filter-select').value;
    const url = new URL(window.location.href);
    
    if (selectedValue) {
        url.searchParams.set('kategori_id', selectedValue);
    } else {
        url.searchParams.delete('kategori_id');
    }
    
    window.location.href = url.toString();
}
</script>

<style>
    /* Smooth transitions */
    button, a {
        transition: all 0.2s ease-in-out;
    }
    
    /* Disabled button style */
    button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    /* Mobile optimization */
    @media (max-width: 640px) {
        .overflow-x-auto {
            -webkit-overflow-scrolling: touch;
        }
    }
    
    /* Make tfoot sticky on scroll if needed */
    tfoot {
        position: sticky;
        bottom: 0;
        z-index: 10;
    }
</style>
@endsection