@extends('layouts.penggunaMasjid')

@section('content')
<div class="mt-16 bg-green-50 font-sans p-8 md:py-12">
    <div class="container mx-auto max-w-4xl">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-bold text-emerald-800 mb-8 text-center">Donatur Masjid Nurul Haq</h2>
            <p class="text-center text-gray-600 mb-10">
                Kami mengucapkan terima kasih yang sebesar-besarnya kepada para donatur yang telah menyisihkan sebagian rezekinya. Semoga Allah SWT membalas kebaikan Anda dengan pahala yang berlipat ganda. Amin.
            </p>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full bg-white">
                    <thead class="bg-emerald-600 text-white">
                        <tr>
                            <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm text-center">No</th>
                            <th class="w-8/12 py-3 px-4 uppercase font-semibold text-sm text-left">Nama Donatur</th>
                            <th class="w-3/12 py-3 px-4 uppercase font-semibold text-sm text-center">Tanggal Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($donasiTerverifikasi as $index => $donasi)
                            <tr class="{{ $loop->even ? 'bg-emerald-50' : 'bg-white' }} hover:bg-gray-100 transition-colors duration-200">
                                <td class="py-3 px-4 text-center">{{ $index + 1 }}</td>
                                <td class="py-3 px-4">
                                    {{-- Untuk menjaga privasi, kita samarkan sebagian nama donatur --}}
                                    {{ Str::mask($donasi->nama_donatur, '*', 3) }}
                                </td>
                                <td class="py-3 px-4 text-center text-sm text-gray-600">
                                    {{-- 'updated_at' akan merefleksikan waktu verifikasi --}}
                                    {{ $donasi->updated_at->format('d M Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-10 px-4 text-gray-500">
                                    Belum ada data donasi terverifikasi untuk ditampilkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('penggunaMasjid.donasi.index') }}" class="bg-orange-500 text-white font-semibold py-2 px-6 rounded-lg hover:bg-orange-600 transition-colors duration-300">
                    Kembali ke Halaman Donasi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection