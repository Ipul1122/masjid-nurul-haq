@extends('layouts.penggunaMasjid')

@section('title', 'Keuangan Masjid - Masjid Nurul Haq')

@section('content')
    
    
    {{-- Chart Keuangan --}}
    <div class="bg-white p-6 rounded-lg shadow mb-8 mt-16">
        <div class="flex justify-between items-center mb-4 flex-wrap gap-2">
            <h2 class="text-lg font-bold text-gray-800">Grafik Keuangan Tahunan</h2>
            {{-- Filter Bulan & Tahun --}}
            <form method="GET" action="{{ route('penggunaMasjid.keuanganMasjid.index') }}" class="flex space-x-2">
                <select name="bulan" class="border rounded p-2 text-sm">
                    @foreach(range(1,12) as $b)
                        <option value="{{ $b }}" {{ $b == $bulan ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
                <select name="tahun" class="border rounded p-2 text-sm">
                    @for($y = date('Y')-5; $y <= date('Y'); $y++)
                        <option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
                <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm">
                    Filter
                </button>
            </form>
        </div>

        {{-- responsive wrapper --}}
        <div class="overflow-x-auto">
            <div style="min-width:600px; height:300px;">
                <canvas id="financeChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Statistik Keuangan Bulan Ini --}}
    <h2 class="text-xl font-bold text-gray-800 mb-4">
        Laporan Keuangan Bulan {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} {{ $tahun }}
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Card Pemasukkan --}}
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition flex flex-col justify-between">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-arrow-down text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-500 text-sm font-medium">Total Pemasukkan</h2>
                    <p class="text-2xl font-bold text-gray-800">
                        Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('penggunaMasjid.keuanganMasjid.detailPemasukkanMasjid') }}" class="text-sm text-blue-600 hover:underline">
                    Lihat detail pemasukkan →
                </a>
            </div>
        </div>

        {{-- Card Pengeluaran --}}
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition flex flex-col justify-between">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-arrow-up text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-500 text-sm font-medium">Total Pengeluaran</h2>
                    <p class="text-2xl font-bold text-gray-800">
                        Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('dkm.manajemenKeuangan.pengeluaran.index') }}" class="text-sm text-blue-600 hover:underline">
                    Lihat detail pengeluaran →
                </a>
            </div>
        </div>

        {{-- Card Saldo Akhir --}}
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition flex flex-col justify-between">
            <div class="flex items-center">
                <div class="p-3 rounded-full {{ $saldoAkhir >= 0 ? 'bg-blue-100 text-blue-600' : 'bg-red-100 text-red-600' }}">
                    <i class="fas fa-wallet text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-500 text-sm font-medium">Saldo Akhir</h2>
                    <p class="text-2xl font-bold {{ $saldoAkhir >= 0 ? 'text-blue-700' : 'text-red-700' }}">
                        Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm text-gray-500">
                    Total keuangan bulan ini
                </p>
            </div>
        </div>
    </div>



{{-- Script Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('financeChart').getContext('2d');
    const financeChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [
                {
                    label: 'Pemasukkan',
                    data: @json($dataPemasukkan),
                    borderColor: 'rgb(34,197,94)',
                    backgroundColor: 'rgba(34,197,94,0.2)',
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Pengeluaran',
                    data: @json($dataPengeluaran),
                    borderColor: 'rgb(239,68,68)',
                    backgroundColor: 'rgba(239,68,68,0.2)',
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Saldo Akhir',
                    data: @json($dataSaldo),
                    borderColor: 'rgb(59,130,246)',
                    backgroundColor: 'rgba(59,130,246,0.2)',
                    tension: 0.3,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: { family: 'Inter', size: 12 },
                        boxWidth: 20
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = context.raw || 0;
                            return context.dataset.label + ': Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 30,
                        autoSkip: true
                    }
                },
                y: {
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            }
        }
    });
</script>

@endsection