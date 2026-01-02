@extends('layouts.dkm')

@section('title', 'Setting Form Muhasabah')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Setting Form Muhasabah</h1>
        <a href="{{ route('dkm.muhasabah.soal.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
            + Tambah Pertanyaan
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
        <table class="min-w-full w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">Urutan</th>
                    <th class="py-3 px-6 text-left">Pertanyaan</th>
                    <th class="py-3 px-6 text-left">Tipe</th>
                    <th class="py-3 px-6 text-left">Opsi Jawaban</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($soals as $soal)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-center font-bold">{{ $soal->urutan }}</td>
                    <td class="py-3 px-6 text-left">{{ $soal->pertanyaan }}</td>
                    <td class="py-3 px-6 text-left">
                        @if($soal->tipe_soal == 'short_text') <span class="bg-gray-200 px-2 py-1 rounded text-xs">Singkat</span> @endif
                        @if($soal->tipe_soal == 'paragraph') <span class="bg-gray-200 px-2 py-1 rounded text-xs">Paragraf</span> @endif
                        @if($soal->tipe_soal == 'radio') <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs">Pilihan Ganda (1)</span> @endif
                        @if($soal->tipe_soal == 'checkbox') <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">Checklist (Banyak)</span> @endif
                    </td>
                    <td class="py-3 px-6 text-left">
                        @if(!empty($soal->opsi_jawaban))
                            <ul class="list-disc ml-4 text-xs">
                                @foreach($soal->opsi_jawaban as $opsi)
                                    <li>{{ $opsi }}</li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        @if($soal->is_active)
                            <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Aktif</span>
                        @else
                            <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">Non-Aktif</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <a href="{{ route('dkm.muhasabah.soal.edit', $soal->id) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            <form action="{{ route('dkm.muhasabah.soal.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Hapus pertanyaan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-4 transform hover:text-red-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-3 px-6 text-center text-gray-500">Belum ada pertanyaan muhasabah.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection