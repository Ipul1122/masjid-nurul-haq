@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit pengeluaran</h2>

    <form action="{{ route('dkm.manajemenKeuangan.pengeluaran.update', $pengeluaran->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="block">Total pengeluaran</label>
            <input type="text" name="total" id="total" class="w-full border px-3 py-2 rounded" 
                   value="Rp. {{ number_format($pengeluaran->total, 0, ',', '.') }}" required>
        </div>

        <div class="mb-3">
            <label class="block">Tanggal pengeluaran</label>
            <input type="date" name="tanggal" value="{{ $pengeluaran->tanggal->format('Y-m-d') }}" 
                   class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ $pengeluaran->kategori_id == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama }}
                    </option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('dkm.manajemenKeuangan.pengeluaran.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>

<script>
    const totalInput = document.getElementById('total');
    totalInput.addEventListener('keyup', function(e) {
        let value = this.value.replace(/[^,\d]/g, '');
        let formatted = new Intl.NumberFormat('id-ID').format(value);
        this.value = value ? 'Rp. ' + formatted : '';
    });
</script>
@endsection
