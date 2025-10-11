@extends('layouts.dkm')

@section('title', 'Kegiatan Masjid')

@section('content')
<div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">

    {{-- ====================================================================== --}}
    {{-- ======================== KONTROL BAGIAN ATAS ======================= --}}
    {{-- ====================================================================== --}}

    {{-- Header: Judul --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Kegiatan Masjid</h2>
    </div>
    
    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Tombol Aksi dan Filter --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
        {{-- Tombol Tambah & Kelola --}}
        <div class="flex gap-2">
            <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-sm transition-colors duration-200">
                + Tambah Kegiatan
            </a>
            <a href="{{ route('dkm.kategori.kegiatanMasjid.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow-sm transition-colors duration-200">
                Kelola Kategori
            </a>
        </div>
        {{-- Form Filter --}}
        <form method="GET" action="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" class="flex items-center gap-2">
            <select name="kategori_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <option value="">-- Semua Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition-colors duration-200">Filter</button>
        </form>
    </div>

    {{-- ====================================================================== --}}
    {{-- ===================== FORM HAPUS & DAFTAR DATA ===================== --}}
    {{-- ====================================================================== --}}

    <form method="POST" action="{{ route('dkm.manajemenKonten.kegiatanMasjid.destroyMultiple') }}" id="bulkDeleteForm" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data yang dipilih?')">
        @csrf
        @method('DELETE')

        {{-- Tombol Hapus Terpilih (Atas) --}}
        <div class="mb-4">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-sm transition-colors duration-200">
                Hapus Terpilih
            </button>
        </div>

        {{-- Tampilan Tabel untuk Desktop (Medium screen and up) --}}
        <div class="overflow-x-auto hidden md:block">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="p-4">
                            <input type="checkbox" class="selectAllCheckbox rounded border-gray-300">
                        </th>
                        <th scope="col" class="px-6 py-3">Gambar</th>
                        <th scope="col" class="px-6 py-3">Judul Kegiatan</th>
                        <th scope="col" class="px-6 py-3">Ustadz</th>
                        <th scope="col" class="px-6 py-3">Jadwal</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatanMasjid as $kM)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="w-4 p-4">
                                <input type="checkbox" name="ids[]" value="{{ $kM->id }}" class="rowCheckbox rounded border-gray-300">
                            </td>
                            <td class="px-6 py-4">
                                <img src="{{ $kM->gambar ? asset('storage/' . $kM->gambar) : 'https://via.placeholder.com/100' }}" alt="Gambar {{ $kM->judul }}" class="w-16 h-16 object-cover rounded-md">
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $kM->judul }}</td>
                            <td class="px-6 py-4">{{ $kM->nama_ustadz }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($kM->jadwal)->translatedFormat('d F Y, H:i') }}</td>
                            <td class="px-6 py-4"><span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $kM->kategori?->nama ?? '-' }}</span></td>
                            <td class="px-6 py-4 flex items-center gap-2">
                                <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.preview', $kM->id) }}" class="font-medium text-gray-600 hover:underline" target="_blank">Preview</a>
                                <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.edit', ['kegiatanMasjid' => $kM->id, 'page' => request('page', 1)]) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Belum ada kegiatan yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
                {{-- ✅ [BARU] Menambahkan footer tabel sebagai duplikat header --}}
                <tfoot class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="p-4">
                            <input type="checkbox" class="selectAllCheckbox rounded border-gray-300">
                        </th>
                        <th scope="col" class="px-6 py-3">Gambar</th>
                        <th scope="col" class="px-6 py-3">Judul Kegiatan</th>
                        <th scope="col" class="px-6 py-3">Ustadz</th>
                        <th scope="col" class="px-6 py-3">Jadwal</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Tampilan Kartu untuk Mobile (Small screen) --}}
        <div class="grid grid-cols-1 gap-4 md:hidden">
            @forelse($kegiatanMasjid as $kM)
                <div class="bg-gray-50 border rounded-lg p-4 shadow-sm flex items-start gap-4">
                    <input type="checkbox" name="ids[]" value="{{ $kM->id }}" class="rowCheckbox rounded border-gray-300 mt-1">
                    <div class="flex-1">
                        <div class="flex gap-4">
                            <img src="{{ $kM->gambar ? asset('storage/' . $kM->gambar) : 'https://via.placeholder.com/100' }}" alt="Gambar {{ $kM->judul }}" class="w-20 h-20 object-cover rounded-md">
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-gray-900">{{ $kM->judul }}</h3>
                                <p class="text-sm text-gray-600">{{ $kM->nama_ustadz }}</p>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $kM->kategori?->nama ?? '-' }}</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-800 mt-2">
                            <strong>Jadwal:</strong> {{ \Carbon\Carbon::parse($kM->jadwal)->translatedFormat('d F Y, H:i') }}
                        </p>
                        <div class="flex gap-3 mt-3">
                            <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.preview', $kM->id) }}" class="font-medium text-sm text-gray-600 hover:underline" target="_blank">Preview</a>
                            <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.edit', ['kegiatanMasjid' => $kM->id, 'page' => request('page', 1)]) }}" class="font-medium text-sm text-blue-600 hover:underline">Edit</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-4 text-gray-500">
                    Belum ada kegiatan yang ditambahkan.
                </div>
            @endforelse
        </div>
        
        <hr class="my-6">

        {{-- ====================================================================== --}}
        {{-- ======================== KONTROL BAGIAN BAWAH ====================== --}}
        {{-- ====================================================================== --}}

        {{-- Tombol Hapus Terpilih (Bawah) --}}
        <div class="mb-4">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-sm transition-colors duration-200">
                Hapus Terpilih
            </button>
        </div>

        {{-- Tombol Aksi dan Filter (Bawah) --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-4">
            {{-- Tombol Tambah & Kelola --}}
            <div class="flex gap-2">
                <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-sm transition-colors duration-200">
                    + Tambah Kegiatan
                </a>
                <a href="{{ route('dkm.kategori.kegiatanMasjid.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow-sm transition-colors duration-200">
                    Kelola Kategori
                </a>
            </div>
            {{-- Form Filter --}}
            <form method="GET" action="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" class="flex items-center gap-2">
                <select name="kategori_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition-colors duration-200">Filter</button>
            </form>
        </div>

    </form> {{-- Penutup form bulk delete --}}

    {{-- Pagination Links --}}
    <div class="mt-6">
        {{ $kegiatanMasjid->links() }}
    </div>

</div>

{{-- Script untuk checkbox select all (tidak ada perubahan, sudah mendukung banyak selectAll) --}}
<script>
document.querySelectorAll('.selectAllCheckbox').forEach(selectAll => {
    selectAll.addEventListener('change', function() {
        document.querySelectorAll('.rowCheckbox').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        document.querySelectorAll('.selectAllCheckbox').forEach(otherSelectAll => {
            otherSelectAll.checked = this.checked;
        });
    });
});

document.querySelectorAll('.rowCheckbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        if (!this.checked) {
            document.querySelectorAll('.selectAllCheckbox').forEach(selectAll => selectAll.checked = false);
        } else if (document.querySelectorAll('.rowCheckbox:checked').length === document.querySelectorAll('.rowCheckbox').length) {
            document.querySelectorAll('.selectAllCheckbox').forEach(selectAll => selectAll.checked = true);
        }
    });
});
</script>
@endsection