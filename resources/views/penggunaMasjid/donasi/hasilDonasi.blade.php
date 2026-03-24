@extends('layouts.penggunaMasjid')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 p-8">
            
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-500 mb-4">
                    <i class="fas fa-check-circle text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Daftar Donatur Masjid</h2>
                <p class="text-gray-500 mt-2">Terima kasih atas infaq dan sedekah yang telah diberikan. Semoga Allah membalas dengan pahala yang berlipat ganda.</p>
            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-blue-600 text-white text-sm uppercase tracking-wider">
                            <th class="py-4 px-6 font-semibold w-16 text-center">No</th>
                            <th class="py-4 px-6 font-semibold">Nama Donatur</th>
                            <th class="py-4 px-6 font-semibold">Pesan / Doa</th>
                            <th class="py-4 px-6 font-semibold whitespace-nowrap">Tanggal Donasi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($donasis as $index => $donasi)
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="py-4 px-6 text-gray-700 text-center font-medium">{{ $index + 1 }}</td>
                            
                            {{-- Logika Nama: Jika kosong (null/string kosong), tampilkan Hamba Allah --}}
                            <td class="py-4 px-6 font-bold text-gray-800">
                                {{ !empty($donasi->nama) ? $donasi->nama : 'Hamba Allah' }}
                            </td>
                            
                            {{-- Logika Pesan: Jika kosong, tampilkan Jazakumullah --}}
                            <td class="py-4 px-6 text-gray-600 italic">
                                "{{ !empty($donasi->pesan) ? $donasi->pesan : 'Jazakumullah Khairan Katsiran' }}"
                            </td>
                            
                            <td class="py-4 px-6 text-gray-700 text-sm whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($donasi->created_at)->translatedFormat('d F Y, H:i') }} WIB
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-gray-500">
                                <i class="fas fa-box-open text-4xl mb-3 text-gray-300 block"></i>
                                Belum ada riwayat donasi yang tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-8 text-center flex justify-center gap-4">
                <a href="{{ route('penggunaMasjid.donasi.index') }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-200 transition">
                    <i class="fas fa-arrow-left"></i> Kembali ke Form
                </a>
                <a href="{{ route('penggunaMasjid.donasi.index') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition shadow-lg hover:shadow-xl">
                    <i class="fas fa-home"></i> Halaman Utama
                </a>
            </div>
            
        </div>
    </div>
</div>
@endsection