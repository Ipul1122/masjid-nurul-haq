@extends('layouts.dkm')

@section('title', 'tambah Pemasukkan')
@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Pemasukkan</h2>

    <form action="{{ route('dkm.manajemenKeuangan.pemasukkan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="block mb-1">Total Pemasukkan</label>
            <input type="text" name="total" id="total" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Tanggal Pemasukkan</label>
            <input type="date" name="tanggal"
                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                class="w-full border px-3 py-2 rounded"
                required>
        </div>
        <div class="mb-3">
            <label class="block mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('dkm.manajemenKeuangan.pemasukkan.index') }}" class="ml-2 text-gray-600">Batal</a>
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
