@extends('layouts.penggunaMasjid')

@section('title', 'Keuangan Masjid - Masjid Nurul Haq')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Header Section --}}
        <div class="mb-8 mt-16">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Keuangan Masjid</h1>
            <p class="text-gray-600 text-sm md:text-base">Pantau laporan keuangan masjid secara real-time</p>
        </div>

        {{-- Chart Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 md:p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
                <h2 class="text-lg md:text-xl font-semibold text-gray-900">Grafik Keuangan Tahunan</h2>
                
                {{-- Filter Form --}}
                <form method="GET" action="{{ route('penggunaMasjid.keuanganMasjid.index') }}" class="flex flex-wrap gap-2">
                    <select name="bulan" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        @foreach(range(1,12) as $b)
                            <option value="{{ $b }}" {{ $b == $bulan ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>
                    <select name="tahun" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none">
                        @for($y = date('Y')-5; $y <= date('Y'); $y++)
                            <option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium shadow-sm">
                        Filter
                    </button>
                </form>
            </div>

            {{-- Chart Container --}}
            <div class="w-full overflow-x-auto">
                <div style="min-width:600px; height:320px;">
                    <canvas id="financeChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Report Title --}}
        <div class="mb-4">
            <h2 class="text-lg md:text-xl font-semibold text-gray-900">
                Laporan Bulan {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} {{ $tahun }}
            </h2>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
            
            {{-- Pemasukkan Card --}}
            <div class="bg-gradient-to-br from-green-50 to-white rounded-xl shadow-sm border border-green-100 p-5 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 rounded-lg bg-green-500">
                        <i class="fas fa-arrow-down text-white text-xl"></i>
                    </div>
                    <span class="text-xs font-medium text-green-700 bg-green-100 px-2 py-1 rounded-full">+</span>
                </div>
                <h3 class="text-sm text-gray-600 font-medium mb-1">Total Pemasukkan</h3>
                <p class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                    Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}
                </p>
                <a href="{{ route('penggunaMasjid.keuanganMasjid.detailPemasukkanMasjid') }}" 
                   class="text-sm text-green-600 hover:text-green-700 font-medium inline-flex items-center group">
                    Lihat detail
                    <i class="fas fa-arrow-right ml-1 text-xs group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            {{-- Pengeluaran Card --}}
            <div class="bg-gradient-to-br from-red-50 to-white rounded-xl shadow-sm border border-red-100 p-5 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 rounded-lg bg-red-500">
                        <i class="fas fa-arrow-up text-white text-xl"></i>
                    </div>
                    <span class="text-xs font-medium text-red-700 bg-red-100 px-2 py-1 rounded-full">-</span>
                </div>
                <h3 class="text-sm text-gray-600 font-medium mb-1">Total Pengeluaran</h3>
                <p class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                </p>
                <a href="{{ route('penggunaMasjid.keuanganMasjid.detailPengeluaranMasjid') }}" 
                   class="text-sm text-red-600 hover:text-red-700 font-medium inline-flex items-center group">
                    Lihat detail
                    <i class="fas fa-arrow-right ml-1 text-xs group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            {{-- Saldo Card --}}
            <div class="bg-gradient-to-br {{ $saldoAkhir >= 0 ? 'from-blue-50' : 'from-orange-50' }} to-white rounded-xl shadow-sm border {{ $saldoAkhir >= 0 ? 'border-blue-100' : 'border-orange-100' }} p-5 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 rounded-lg {{ $saldoAkhir >= 0 ? 'bg-blue-500' : 'bg-orange-500' }}">
                        <i class="fas fa-wallet text-white text-xl"></i>
                    </div>
                    <span class="text-xs font-medium {{ $saldoAkhir >= 0 ? 'text-blue-700 bg-blue-100' : 'text-orange-700 bg-orange-100' }} px-2 py-1 rounded-full">
                        {{ $saldoAkhir >= 0 ? '=' : '!' }}
                    </span>
                </div>
                <h3 class="text-sm text-gray-600 font-medium mb-1">Saldo Akhir</h3>
                <p class="text-2xl md:text-3xl font-bold {{ $saldoAkhir >= 0 ? 'text-blue-600' : 'text-orange-600' }} mb-3">
                    Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
                </p>
                <p class="text-sm text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>Total keuangan bulan ini
                </p>
            </div>

        </div>

    </div>

    {{-- Chart.js Script --}}
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
                        backgroundColor: 'rgba(34,197,94,0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($dataPengeluaran),
                        borderColor: 'rgb(239,68,68)',
                        backgroundColor: 'rgba(239,68,68,0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Saldo Akhir',
                        data: @json($dataSaldo),
                        borderColor: 'rgb(59,130,246)',
                        backgroundColor: 'rgba(59,130,246,0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
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
                        align: 'end',
                        labels: {
                            font: { 
                                family: 'Inter, system-ui, sans-serif', 
                                size: 12,
                                weight: '500'
                            },
                            boxWidth: 12,
                            boxHeight: 12,
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        borderColor: 'rgba(255, 255, 255, 0.1)',
                        borderWidth: 1,
                        titleFont: {
                            size: 13,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 12
                        },
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
                        grid: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 45,
                            minRotation: 0,
                            autoSkip: true,
                            font: {
                                size: 11
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID', {
                                    notation: 'compact',
                                    compactDisplay: 'short'
                                }).format(value);
                            },
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection