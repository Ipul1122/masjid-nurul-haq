@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Pemasukkan</h2>
        <div class="flex gap-2">
            <a href="{{ route('dkm.manajemenKeuangan.pemasukkan.create') }}"
               class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah</a>
        </div>
    </div>

    {{-- Filter Bulan & Tahun --}}
    <form method="GET" action="{{ route('dkm.manajemenKeuangan.pemasukkan.index') }}" class="mb-4 flex gap-2 items-center">
        {{-- Dropdown Bulan --}}
        <select name="bulan" class="border px-3 py-2 rounded">
            <option value="">-- Pilih Bulan --</option>
            @for($m = 1; $m <= 12; $m++)
                @php
                    // Cek apakah bulan ini punya data (jika tahun dipilih, filter by tahun)
                    $hasData = $bulanList->contains(function($item) use ($m, $selectedTahun) {
                        if ($selectedTahun) {
                            return $item->bulan == $m && $item->tahun == $selectedTahun;
                        }
                        return $item->bulan == $m;
                    });
                @endphp
                <option value="{{ $m }}" {{ (string)$selectedBulan === (string)$m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }} {{ $hasData ? '•' : '' }}
                </option>
            @endfor
        </select>

        {{-- Dropdown Tahun --}}
        <select name="tahun" class="border px-3 py-2 rounded">
            <option value="">-- Pilih Tahun --</option>
            @foreach($tahunList as $th)
                @php
                    $hasData = $bulanList->contains('tahun', $th);
                @endphp
                <option value="{{ $th }}" {{ (string)$selectedTahun === (string)$th ? 'selected' : '' }}>
                    {{ $th }} {{ $hasData ? '•' : '' }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
        <a href="{{ route('dkm.manajemenKeuangan.pemasukkan.index', []) }}" class="bg-gray-300 text-black px-4 py-2 rounded">Reset ke Bulan Ini</a>
    </form>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        @if($pemasukkans->count() > 0)
            <form id="bulkDeleteForm" action="{{ route('dkm.manajemenKeuangan.pemasukkan.bulkDelete') }}" method="POST" onsubmit="return confirm('Hapus data terpilih?')">
                @csrf
                @method('DELETE')
                <input type="hidden" name="ids" id="bulkDeleteIds">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Hapus Terpilih</button>
            </form>
        @endif
    </div>

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2 text-center"><input type="checkbox" id="selectAll"></th>
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Total</th>
                <th class="border px-4 py-2">Kategori</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemasukkans as $item)
                <tr>
                    <td class="border px-4 py-2 text-center">
                        <input type="checkbox" class="selectItem" value="{{ $item->id }}">
                    </td>
                    <td class="border px-4 py-2">
                        {{-- Format: Hari, dd MMMM yyyy (Indonesia) --}}
                        {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                    </td>
                    <td class="border px-4 py-2">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">{{ $item->kategori?->nama ?? '--' }}</td>
                    <td class="border px-4 py-2 flex gap-2">
                        <a href="{{ route('dkm.manajemenKeuangan.pemasukkan.edit', $item->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('dkm.manajemenKeuangan.pemasukkan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-3">Belum ada data</td></tr>
            @endforelse
        </tbody>

        @if($pemasukkans->count() > 0)
        <tfoot>
            <tr class="bg-gray-200 font-bold">
                <td colspan="2" class="border px-4 py-2 text-right">Total Pemasukkan:</td>
                <td class="border px-4 py-2">Rp. {{ number_format($totalPemasukkan, 0, ',', '.') }}</td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
        @endif
    </table>
</div>

<script>
document.getElementById('selectAll')?.addEventListener('change', function() {
    document.querySelectorAll('.selectItem').forEach(cb => cb.checked = this.checked);
});

// Bulk delete: kumpulkan id terpilih sebelum submit
document.getElementById('bulkDeleteForm')?.addEventListener('submit', function(e) {
    let ids = [];
    document.querySelectorAll('.selectItem:checked').forEach(cb => ids.push(cb.value));
    if (ids.length === 0) {
        e.preventDefault();
        alert('Tidak ada data yang dipilih');
        return false;
    }
    document.getElementById('bulkDeleteIds').value = ids.join(',');
});
</script>
@endsection
