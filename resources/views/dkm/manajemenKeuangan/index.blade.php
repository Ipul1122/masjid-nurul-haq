@extends('layouts.dkm')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Laporan Keuangan</h2>
    </div>

    {{-- Filter Bulan & Tahun --}}
    <form method="GET" action="{{ route('dkm.manajemenKeuangan.index') }}" class="mb-6 flex gap-2 items-center">
        <select name="bulan" class="border px-3 py-2 rounded">
            <option value="">-- Pilih Bulan --</option>
            @for($m = 1; $m <= 12; $m++)
                {{-- Gunakan $inputBulan untuk mencocokkan pilihan --}}
                <option value="{{ $m }}" {{ (string)$inputBulan === (string)$m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                </option>
            @endfor
        </select>

        <select name="tahun" class="border px-3 py-2 rounded">
            <option value="">-- Pilih Tahun --</option>
            @foreach($tahunList as $th)
                <option value="{{ $th }}" {{ (string)$selectedTahun === (string)$th ? 'selected' : '' }}>
                    {{ $th }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
        <a href="{{ route('dkm.manajemenKeuangan.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Reset ke Bulan Ini</a>
    </form>

    {{-- Rangkuman Keuangan --}}
    <div class="border rounded p-4">
        <h3 class="text-lg font-semibold mb-3">
            {{-- Tampilkan judul secara dinamis --}}
            Rangkuman untuk: 
            @if($tampilkanNamaBulan && !empty($selectedBulan))
                {{ \Carbon\Carbon::create()->month((int)$selectedBulan)->translatedFormat('F') }}
            @endif
            {{ $selectedTahun }}
        </h3>
        
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Total Pemasukkan</span>
                <span class="font-bold text-green-600">Rp. {{ number_format($totalPemasukkan, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-gray-600">Total Pengeluaran</span>
                <span class="font-bold text-red-600">Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
            </div>
            
            <hr class="my-2">

            <div class="flex justify-between items-center text-lg">
                <span class="font-bold">Saldo Akhir</span>
                <span class="font-extrabold {{ $saldoAkhir >= 0 ? 'text-blue-700' : 'text-red-700' }}">
                    Rp. {{ number_format($saldoAkhir, 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>

</div>
@endsection