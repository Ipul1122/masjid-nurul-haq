@extends('layouts.penggunaMasjid')

@section('content')
<div class="min-h-screen bg-slate-50 py-12 my-12 font-quicksand">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 p-6 md:p-10">
            
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-emerald-50 text-emerald-600 mb-4 shadow-inner">
                    <i class="fas fa-check-circle text-4xl"></i>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-800 font-montserrat tracking-tight">Daftar Donatur Masjid</h2>
                <p class="text-gray-500 mt-2 max-w-xl mx-auto">Terima kasih atas infaq dan sedekah yang telah diberikan. Semoga Allah membalas dengan pahala yang berlipat ganda.</p>
            </div>

            {{-- Filter Bulan & Tahun --}}
            <div class="mb-8 bg-slate-50 p-6 rounded-2xl border border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="text-gray-700 font-bold font-montserrat text-sm">
                    Filter Donatur:
                </div>
                <form method="GET" action="{{ route('penggunaMasjid.donasi.hasilDonasi') }}" class="flex flex-wrap gap-3 items-center">
                    <select name="month" class="px-4 py-2 border-2 border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition duration-200 outline-none bg-white text-gray-700 font-semibold font-montserrat">
                        <option value="all" {{ $month == 'all' ? 'selected' : '' }}>Semua Bulan</option>
                        @foreach($months as $val => $name)
                            <option value="{{ $val }}" {{ $val == $month ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>

                    <select name="year" class="px-4 py-2 border-2 border-gray-200 rounded-xl text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition duration-200 outline-none bg-white text-gray-700 font-semibold font-montserrat">
                        <option value="all" {{ $year == 'all' ? 'selected' : '' }}>Semua Tahun</option>
                        @foreach($availableYears as $y)
                            <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-bold px-6 py-2.5 rounded-xl transition duration-200 shadow-md shadow-emerald-100 hover:shadow-lg font-montserrat text-sm flex items-center gap-2">
                        <i class="fas fa-filter text-xs"></i> Filter
                    </button>
                </form>
            </div>

            {{-- Tampilan Desktop: Table (Tersembunyi di Mobile) --}}
            <div class="hidden md:block overflow-hidden rounded-2xl border border-gray-100 shadow-sm mb-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-600 text-white text-sm uppercase tracking-wider font-montserrat">
                            <th class="py-4 px-6 font-bold w-20 text-center">No</th>
                            <th class="py-4 px-6 font-bold">Nama Donatur</th>
                            <th class="py-4 px-6 font-bold">Nominal</th>
                            <th class="py-4 px-6 font-bold">Pesan / Doa</th>
                            <th class="py-4 px-6 font-bold whitespace-nowrap">Tanggal Donasi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($donasis as $index => $donasi)
                        <tr class="hover:bg-emerald-50/30 transition-colors">
                            <td class="py-4 px-6 text-gray-500 text-center font-bold font-montserrat">{{ $donasis->firstItem() + $index }}</td>
                            
                            <td class="py-4 px-6 font-bold text-gray-800 font-montserrat">
                                {{ !empty($donasi->nama_donatur) ? $donasi->nama_donatur : 'Hamba Allah' }}
                            </td>

                            <td class="py-4 px-6 font-extrabold text-emerald-600 font-montserrat">
                                Rp {{ number_format($donasi->nominal ?? 0, 0, ',', '.') }}
                            </td>
                            
                            <td class="py-4 px-6 text-gray-600 italic">
                                "{{ !empty($donasi->pesan) ? $donasi->pesan : 'Jazakumullah Khairan Katsiran' }}"
                            </td>
                            
                            <td class="py-4 px-6 text-gray-500 text-sm whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($donasi->created_at)->translatedFormat('d F Y, H:i') }} WIB
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-500">
                                <i class="fas fa-box-open text-4xl mb-3 text-gray-300 block"></i>
                                Belum ada riwayat donasi yang tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Tampilan Mobile: Cards (Tersembunyi di Desktop) --}}
            <div class="block md:hidden space-y-4 mb-6">
                @forelse($donasis as $index => $donasi)
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:border-emerald-500 transition-all duration-200">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center font-bold font-montserrat text-sm">
                                {{ substr(!empty($donasi->nama_donatur) ? $donasi->nama_donatur : 'Hamba Allah', 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 font-montserrat">{{ !empty($donasi->nama_donatur) ? $donasi->nama_donatur : 'Hamba Allah' }}</h4>
                                <span class="text-xs text-gray-400 block">{{ \Carbon\Carbon::parse($donasi->created_at)->translatedFormat('d F Y, H:i') }} WIB</span>
                            </div>
                        </div>
                        <span class="text-xs bg-emerald-50 text-emerald-700 font-bold px-2.5 py-1 rounded-full font-montserrat">
                            #{{ $donasis->firstItem() + $index }}
                        </span>
                    </div>
                    
                    <div class="mt-2 bg-slate-50 py-2 px-3 rounded-lg border border-slate-100/50 mb-3">
                        <span class="text-xs text-gray-400 block uppercase tracking-wider font-semibold font-montserrat">Nominal</span>
                        <span class="text-lg font-black text-emerald-600 font-montserrat">Rp {{ number_format($donasi->nominal ?? 0, 0, ',', '.') }}</span>
                    </div>

                    <div class="text-sm text-gray-600 italic">
                        "{{ !empty($donasi->pesan) ? $donasi->pesan : 'Jazakumullah Khairan Katsiran' }}"
                    </div>
                </div>
                @empty
                <div class="bg-white p-8 text-center text-gray-500 rounded-2xl border border-gray-100 shadow-sm">
                    <i class="fas fa-box-open text-4xl mb-3 text-gray-300 block"></i>
                    Belum ada riwayat donasi yang tercatat.
                </div>
                @endforelse
            </div>

            {{-- Navigasi Paginasi --}}
            @if($donasis->hasPages())
            <div class="mt-8 px-2 custom-pagination">
                {{ $donasis->links() }}
            </div>
            @endif

            {{-- Tombol Kembali --}}
            <div class="mt-10 text-center flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('penggunaMasjid.donasi.index') }}" class="inline-flex items-center justify-center gap-2 bg-gray-100 text-gray-700 px-6 py-3 rounded-xl font-bold hover:bg-gray-200 transition font-montserrat text-sm">
                    <i class="fas fa-hand-holding-heart text-xs"></i> Donasi Baru
                </a>
                <a href="{{ route('penggunaMasjid.donasi.kirimBukti') }}" class="inline-flex items-center justify-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-emerald-700 active:bg-emerald-800 transition shadow-lg shadow-emerald-100 hover:shadow-xl font-montserrat text-sm">
                    <i class="fas fa-cloud-upload-alt text-xs"></i> Kirim Bukti Transfer
                </a>
                <a href="{{ route('index') }}" class="inline-flex items-center justify-center gap-2 bg-white border border-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold hover:bg-gray-50 transition font-montserrat text-sm">
                    <i class="fas fa-home text-xs"></i> Halaman Utama Beranda
                </a>
            </div>
            
        </div>
    </div>
</div>

<style>
    /* Styling kustom untuk paginasi agar selaras dengan warna emerald */
    .custom-pagination nav svg {
        display: inline-block;
    }
    .custom-pagination nav p {
        font-family: 'Quicksand', sans-serif;
    }
    .custom-pagination nav span[aria-current="page"] span {
        background-color: rgb(5 150 105) !important; /* emerald-600 */
        border-color: rgb(5 150 105) !important;
        color: white !important;
    }
    .custom-pagination nav a:hover {
        background-color: rgb(209 250 229) !important; /* emerald-100 */
        color: rgb(6 95 70) !important; /* emerald-800 */
    }
</style>
@endsection