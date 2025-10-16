@extends('layouts.penggunaMasjid')
@section('title', 'Detail Pemasukkan Masjid')
@section('content')
<div class="container mx-auto px-4 py-6 max-w-7xl">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Pemasukkan</h2>
        <p class="text-gray-600 text-sm mt-1">Lihat rincian pemasukkan masjid berdasarkan periode</p>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <form method="GET" action="{{ route('penggunaMasjid.keuanganMasjid.detailPemasukkanMasjid') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Dropdown Bulan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                    <select name="bulan" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">Semua Bulan</option>
                        @for($m = 1; $m <= 12; $m++)
                            @php
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
                </div>

                <!-- Dropdown Tahun -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <select name="tahun" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunList as $th)
                            @php
                                $hasData = $bulanList->contains('tahun', $th);
                            @endphp
                            <option value="{{ $th }}" {{ (string)$selectedTahun === (string)$th ? 'selected' : '' }}>
                                {{ $th }} {{ $hasData ? '•' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg font-medium transition duration-200 shadow-sm">
                        Filter
                    </button>
                    <a href="{{ route('penggunaMasjid.keuanganMasjid.detailPemasukkanMasjid', []) }}" 
                       class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg font-medium text-center transition duration-200">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-sm">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Table Section -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <!-- Desktop Table -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pemasukkans as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $item->kategori?->nama ?? 'Tidak Dikategorikan' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900 text-right">
                                Rp {{ number_format($item->total, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="font-medium">Belum ada data pemasukkan</p>
                                <p class="text-sm mt-1">Data akan muncul setelah ada transaksi</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                @if($pemasukkans->count() > 0)
                <tfoot>
                    <tr class="bg-gradient-to-r from-blue-50 to-blue-100 border-t-2 border-blue-200">
                        <td colspan="2" class="px-6 py-4 text-sm font-bold text-gray-700 uppercase">
                            Total Pemasukkan
                        </td>
                        <td class="px-6 py-4 text-right text-lg font-bold text-blue-700">
                            Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden divide-y divide-gray-200">
            @forelse($pemasukkans as $item)
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('d M Y') }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('l') }}
                            </p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $item->kategori?->nama ?? 'Tidak Dikategorikan' }}
                        </span>
                    </div>
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <p class="text-lg font-bold text-gray-900">
                            Rp {{ number_format($item->total, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="font-medium">Belum ada data pemasukkan</p>
                    <p class="text-sm mt-1">Data akan muncul setelah ada transaksi</p>
                </div>
            @endforelse

            @if($pemasukkans->count() > 0)
                <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 border-t-2 border-blue-200">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-gray-700 uppercase">Total Pemasukkan</span>
                        <span class="text-lg font-bold text-blue-700">Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection