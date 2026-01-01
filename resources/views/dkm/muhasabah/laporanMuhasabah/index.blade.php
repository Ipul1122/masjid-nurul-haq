@extends('layouts.dkm')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Laporan Masuk Muhasabah</h1>

    <div class="bg-white p-4 rounded shadow mb-6">
        <form action="{{ route('dkm.muhasabah.laporanMuhasabah.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Pilih Group</label>
                <select name="group_id" class="w-full border rounded p-2" onchange="this.form.submit()">
                    <option value="">-- Semua Group --</option>
                    @foreach($groups as $g)
                        <option value="{{ $g->id }}" {{ request('group_id') == $g->id ? 'selected' : '' }}>
                            {{ $g->nama_group }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Pilih Anggota</label>
                <select name="anggota_id" class="w-full border rounded p-2">
                    <option value="">-- Semua Anggota --</option>
                    @foreach($anggotas as $a)
                        <option value="{{ $a->id }}" {{ request('anggota_id') == $a->id ? 'selected' : '' }}>
                            {{ $a->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal Awal</label>
                <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="w-full border rounded p-2">
            </div>

            <div class="md:col-span-4 text-right">
                <a href="{{ route('dkm.muhasabah.laporanMuhasabah.index') }}" class="text-gray-500 mr-4 text-sm underline">Reset Filter</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700">
                    Tampilkan Data
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-md rounded my-6 overflow-x-auto p-4">
        @php $currentDate = null; @endphp
        @forelse($laporans as $laporan)
            @if($currentDate !== $laporan->tanggal)
                <div class="mb-4 border-b-4 border-blue-100 pb-4">
                    <h2 class="text-lg font-bold text-blue-800 mb-2 bg-blue-50 p-2 rounded">
                        📅 Tanggal: {{ \Carbon\Carbon::parse($laporan->tanggal)->translatedFormat('l, d F Y') }}
                    </h2>
                </div>
                @php $currentDate = $laporan->tanggal; @endphp
            @endif

            <div class="ml-4 mb-4 border border-gray-200 rounded p-4 hover:shadow-md transition">
                <div class="flex justify-between items-start mb-3 border-b pb-2">
                    <div>
                        <span class="text-gray-500 text-xs font-bold uppercase tracking-wider">{{ $laporan->anggota->group->nama_group ?? 'Tanpa Group' }}</span>
                        <h3 class="text-xl font-bold text-gray-800">{{ $laporan->anggota->nama_lengkap }}</h3>
                    </div>
                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Terisi</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($laporan->detail_jawaban as $item)
                        <div class="bg-gray-50 p-3 rounded">
                            <p class="text-xs text-gray-500 font-bold mb-1">{{ $item->soal->pertanyaan }}</p>
                            <p class="text-gray-800">{{ $item->jawaban }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center py-10 text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="mt-2">Belum ada data laporan yang sesuai filter.</p>
            </div>
        @endforelse
    </div>
<div class="mt-6 mb-10">
        {{-- Cek apakah ada halaman lebih dari 1. Jika tidak, sembunyikan seluruh container --}}
        @if($laporans->hasPages())
            <div class="bg-black p-4 rounded shadow">
                {{-- Gunakan method links() standar (tanpa parameter view khusus) --}}
                {{ $laporans->links('pagination::simple-tailwind') }}
            </div>
        @endif
    </div>
    
</div>
@endsection