@extends('layouts.dkm')

@section('title', 'Kegiatan Masjid')

@section('content')
<div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Kegiatan Masjid</h2>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-4">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Tombol Aksi dan Filter --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
        <div class="flex gap-2">
            <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-sm">
                + Tambah Kegiatan
            </a>
            <a href="{{ route('dkm.kategori.kegiatanMasjid.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow-sm">
                Kelola Kategori
            </a>
        </div>

        <form method="GET" action="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" class="flex items-center gap-2 flex-wrap">
            <select name="kategori_id" class="border-gray-300 rounded-md shadow-sm">
                <option value="">-- Semua Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="border-gray-300 rounded-md shadow-sm">
                <option value="">-- Semua Status --</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm">Filter</button>
        </form>
    </div>

    {{-- 🔧 FORM HAPUS MULTIPLE --}}
    <form method="POST" action="{{ route('dkm.manajemenKonten.kegiatanMasjid.destroyMultiple') }}" id="bulkDeleteForm" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data yang dipilih?')">
        @csrf
        @method('DELETE')

        <div class="mb-4">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow-sm">
                Hapus Terpilih
            </button>
        </div>

        {{-- Tabel Desktop --}}
        <div class="overflow-x-auto hidden md:block">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="p-4"><input type="checkbox" class="selectAllCheckbox rounded border-gray-300"></th>
                        <th class="px-6 py-3">Gambar</th>
                        <th class="px-6 py-3">Judul Kegiatan</th>
                        <th class="px-6 py-3">Ustadz</th>
                        <th class="px-6 py-3">Jadwal</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatanMasjid as $kM)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="w-4 p-4">
                                <input type="checkbox" name="ids[]" value="{{ $kM->id }}" class="rowCheckbox rounded border-gray-300">
                            </td>
                            <td class="px-6 py-4">
                                <img src="{{ $kM->gambar ? asset('storage/' . $kM->gambar) : 'https://via.placeholder.com/100' }}" 
                                     alt="Gambar {{ $kM->judul }}" 
                                     class="w-16 h-16 object-cover rounded-md">
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $kM->judul }}</td>
                            <td class="px-6 py-4">{{ $kM->nama_ustadz }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($kM->jadwal)->translatedFormat('d F Y, H:i') }}</td>
                            <td class="px-6 py-4">
                                @if($kM->status === 'published')
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Published</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.preview', $kM->id) }}" class="font-medium text-gray-600 hover:underline" target="_blank">Preview</a>
                                    <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.edit', $kM->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                                </div>

                                {{-- 🔧 Form publish DIPISAH dari form hapus --}}
                                @if($kM->status === 'draft')
                                    <form action="{{ route('dkm.manajemenKonten.kegiatanMasjid.publish', $kM->id) }}" method="POST" class="mt-1" onsubmit="return confirm('Anda yakin ingin mempublikasikan kegiatan ini?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="font-medium text-green-600 hover:underline p-0 border-0 bg-transparent">Publish</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4">Belum ada kegiatan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tampilan Mobile --}}
        <div class="grid grid-cols-1 gap-4 md:hidden">
            @forelse($kegiatanMasjid as $kM)
                <div class="bg-gray-50 border rounded-lg p-4 shadow-sm flex items-start gap-4">
                    <input type="checkbox" name="ids[]" value="{{ $kM->id }}" class="rowCheckbox rounded border-gray-300 mt-1">
                    <div>
                        <p class="font-semibold">{{ $kM->judul }}</p>
                        <p class="text-sm text-gray-500">{{ $kM->nama_ustadz }}</p>
                        <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($kM->jadwal)->translatedFormat('d F Y, H:i') }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-4 text-gray-500">Belum ada kegiatan.</div>
            @endforelse
        </div>
    </form>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $kegiatanMasjid->appends(request()->query())->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.querySelector('.selectAllCheckbox');
    const rowCheckboxes = document.querySelectorAll('.rowCheckbox');

    if (selectAll) {
        selectAll.addEventListener('change', function () {
            rowCheckboxes.forEach(cb => cb.checked = this.checked);
        });
    }

    rowCheckboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            if (!this.checked) selectAll.checked = false;
            else if (document.querySelectorAll('.rowCheckbox:checked').length === rowCheckboxes.length)
                selectAll.checked = true;
        });
    });
});
</script>
@endsection
