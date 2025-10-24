@extends('layouts.dkm')

@section('title', 'tambah Pengeluaran')
@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah pengeluaran</h2>

    <form action="{{ route('dkm.manajemenKeuangan.pengeluaran.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="block mb-1">Total pengeluaran</label>
            <input type="text" name="total" id="total" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Tanggal pengeluaran</label>
            <input type="date" name="tanggal"
                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                class="w-full border px-3 py-2 rounded"
                required>
        </div>

        {{-- <div class="mb-3">
            <label class="block mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                @endforeach
            </select>
        </div> --}}

        {{-- KATEGORI --}}
          <div class="mb-3">
            <label class="block mb-1" for="kategori_id">Kategori Pengeluaran</label>
            {{-- ✅ PERUBAHAN: Menambahkan id --}}
            <select name="kategori_id" id="kategori_id" class="w-full border px-3 py-2 rounded @if($kategori->isEmpty()) bg-gray-100 cursor-not-allowed @endif" 
                    @if($kategori->isEmpty()) disabled @endif>
                
                <option value="">-- Pilih Kategori Pengeluaran --</option>
                
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
                    <a href="{{ route('dkm.kategori.pengeluaran.create') }}" class="font-bold text-xl text-blue-600 hover:underline">
                        kategori Pengeluaran
                    </a> 
                    segera
                </p>
            @endif
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('dkm.manajemenKeuangan.pengeluaran.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const totalInput = document.getElementById('total');
    totalInput.addEventListener('input', function () {
        // ambil hanya digit
        let digits = this.value.replace(/[^0-9]/g, '');
        if (!digits) { this.value = ''; return; }
        // konversi ke number lalu format
        const num = parseInt(digits, 10);
        this.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(num);
    });
});
</script>
@endsection
