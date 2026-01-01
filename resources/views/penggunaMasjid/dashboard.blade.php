@extends('layouts.penggunaMasjid')

@section('title', 'Masjid Nurul Haq - Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    {{-- Notifikasi Sukses --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex justify-between items-center bg-white p-6 rounded-lg shadow mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Assalamu'alaikum, {{ $role == 'group' ? $user->nama_group : $user->nama_lengkap }}
            </h1>
            <div class="mt-1">
                <p class="text-gray-600 text-sm">
                    Anda login sebagai: <span class="font-semibold capitalize text-green-600">{{ $role }}</span>
                </p>
                @if($role == 'anggota' && $user->group)
                    <p class="text-gray-600 text-sm">
                        Anda berada di grup: <span class="font-bold text-blue-600">{{ $user->group->nama_group }}</span>
                    </p>
                @endif
            </div>
        </div>

        {{-- Form Logout --}}
        <form action="{{ route('muhasabah.logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-red-500 hover:text-red-700 font-bold border border-red-500 px-4 py-2 rounded hover:bg-red-50 transition duration-300">
                Logout
            </button>
        </form>
    </div>

    {{-- ROLE GROUP --}}
    @if($role == 'group')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-blue-100 p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold text-blue-800">Total Anggota</h3>
            <p class="text-4xl font-bold text-blue-600 mt-2">{{ count($data) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow md:col-span-2">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Daftar Anggota Group Anda</h3>
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="py-2 text-left">Nama</th>
                        <th class="py-2 text-left">Username</th>
                        <th class="py-2 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $anggota)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3">{{ $anggota->nama_lengkap }}</td>
                        <td class="py-3 text-gray-500">{{ $anggota->username }}</td>
                        <td class="py-3 text-center">
                            <span class="bg-gray-200 text-gray-600 px-2 py-1 rounded text-xs">Anggota</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- ROLE ANGGOTA --}}
    @if($role == 'anggota')
    <div class="bg-white p-6 rounded-lg shadow max-w-3xl mx-auto">
        <h2 class="text-xl font-bold text-center mb-6 border-b pb-4">Form Muhasabah Harian</h2>
        
        {{-- FORM ACTION KE ROUTE STORE (POST) --}}
        <form action="{{ route('muhasabah.store') }}" method="POST"> 
            @csrf
            
            @foreach($soals as $soal)
            <div class="mb-6 border-b border-gray-100 pb-4 last:border-0">
                <label class="block text-gray-800 font-semibold mb-1">
                    {{ $loop->iteration }}. {{ $soal->pertanyaan }}
                    @if($soal->is_required) <span class="text-red-500 text-sm">*</span> @endif
                </label>

                @if($soal->deskripsi)
                    <p class="text-sm text-gray-500 mb-3 italic">{{ $soal->deskripsi }}</p>
                @endif

                @if($soal->tipe_soal == 'short_text')
                    <input type="text" name="jawaban[{{ $soal->id }}]" class="w-full border-gray-300 rounded shadow-sm focus:border-green-500 focus:ring-green-500" {{ $soal->is_required ? 'required' : '' }}>
                
                @elseif($soal->tipe_soal == 'paragraph')
                    <textarea name="jawaban[{{ $soal->id }}]" rows="3" class="w-full border-gray-300 rounded shadow-sm focus:border-green-500 focus:ring-green-500" {{ $soal->is_required ? 'required' : '' }}></textarea>
                
                @elseif($soal->tipe_soal == 'radio')
                    <div class="flex flex-col gap-2">
                        @foreach($soal->opsi_jawaban as $opsi)
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" name="jawaban[{{ $soal->id }}]" value="{{ $opsi }}" class="text-green-600 focus:ring-green-500" {{ $soal->is_required ? 'required' : '' }}>
                            <span class="ml-2">{{ $opsi }}</span>
                        </label>
                        @endforeach
                    </div>

                @elseif($soal->tipe_soal == 'checkbox')
                    <div class="flex flex-col gap-2">
                        @foreach($soal->opsi_jawaban as $opsi)
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="jawaban[{{ $soal->id }}][]" value="{{ $opsi }}" class="text-green-600 focus:ring-green-500 rounded">
                            <span class="ml-2">{{ $opsi }}</span>
                        </label>
                        @endforeach
                    </div>
                @endif
            </div>
            @endforeach

            <div class="mt-8">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded shadow-lg transform transition hover:scale-105">
                    Kirim Laporan Muhasabah
                </button>
            </div>
        </form>
    </div>
    @endif
</div>
@endsection