@extends('layouts.penggunaMasjid')

@section('title', 'Masjid Nurul Haq - Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    
    {{-- Header (Sama seperti sebelumnya) --}}
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
        <form action="{{ route('muhasabah.logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-red-500 hover:text-red-700 font-bold border border-red-500 px-4 py-2 rounded hover:bg-red-50 transition duration-300">
                Logout
            </button>
        </form>
    </div>

    {{-- 2. SECTION ANGGOTA GROUP & MONITORING --}}
    @if($role == 'anggota' && isset($temanSeGroup) && $temanSeGroup->isNotEmpty())
    <div class="bg-white p-6 rounded-lg shadow mb-6 border-l-4 border-blue-500">
        
        {{-- Header Section Group --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Group: <span class="text-blue-600 ml-1">{{ $user->group->nama_group ?? '-' }}</span>
            </h3>

            {{-- Filter Tanggal Monitoring --}}
            <form action="{{ route('muhasabah.dashboard') }}" method="GET" class="flex items-center bg-gray-100 p-2 rounded-lg">
                <span class="text-xs font-bold text-gray-500 mr-2">Cek Status Tanggal:</span>
                <input type="date" name="tanggal_lihat" 
                       value="{{ $tanggalLihat }}" 
                       max="{{ date('Y-m-d') }}"
                       onchange="this.form.submit()" 
                       class="text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($temanSeGroup as $teman)
                <div class="relative p-3 rounded-lg border transition duration-200
                    {{ $teman->id == $user->id ? 'bg-blue-50 border-blue-200 ring-1 ring-blue-300' : 'bg-gray-50 border-gray-200' }}">
                    
                    <div class="flex items-start">
                        {{-- Avatar Inisial --}}
                        <div class="flex-shrink-0 h-10 w-10 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm
                            {{ $teman->id == $user->id ? 'bg-blue-500' : ($teman->sudah_lapor ? 'bg-green-500' : 'bg-gray-400') }}">
                            {{ substr($teman->nama_lengkap, 0, 1) }}
                        </div>

                        <div class="ml-3 w-full overflow-hidden">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ $teman->nama_lengkap }}
                                @if($teman->id == $user->id)
                                    <span class="text-xs text-blue-600 font-bold">(Saya)</span>
                                @endif
                            </p>
                            
                            {{-- Status Badge --}}
                            <div class="mt-1 flex items-center justify-between">
                                @if($teman->sudah_lapor)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="mr-1 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                        Sudah Mengisi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="mr-1 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                        Belum
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Ingatkan via WA (Hanya muncul jika BELUM lapor & BUKAN diri sendiri & ADA no WA) --}}
                    @if(!$teman->sudah_lapor && $teman->id != $user->id && !empty($teman->no_wa))
                        @php
                            // Format Nomor WA (08 -> 628)
                            $noWa = preg_replace('/^0/', '62', $teman->no_wa);
                            
                            // Format Tanggal untuk Pesan
                            $tglPesan = \Carbon\Carbon::parse($tanggalLihat)->locale('id')->translatedFormat('l, d F Y');
                            
                            // Isi Pesan
                            $pesan = "Assalamu'alaikum {$teman->nama_lengkap}, afwan mengingatkan, jangan lupa mengisi muhasabah harian untuk tanggal {$tglPesan} ya. Syukron.";
                        @endphp

                        <a href="https://wa.me/{{ $noWa }}?text={{ urlencode($pesan) }}" target="_blank" 
                           class="mt-3 flex items-center justify-center w-full px-3 py-1.5 border border-green-500 text-green-600 text-xs font-medium rounded hover:bg-green-50 transition">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                            Ingatkan
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Tampilan Dashboard Anggota --}}
    @if($role == 'anggota')
    <div class="bg-white p-6 rounded-lg shadow max-w-3xl mx-auto">
        <h2 class="text-xl font-bold text-center mb-6 border-b pb-4">Form Muhasabah Harian</h2>
        
        {{-- [PENTING] Form dibuka DISINI, membungkus Input Tanggal dan Soal --}}
        <form action="{{ route('muhasabah.store') }}" method="POST" onsubmit="return showLoading()"> 
            @csrf
            
            {{-- === INPUT TANGGAL (Harus di dalam Form) === --}}
            <div class="mb-8 bg-blue-50 p-4 rounded-lg border border-blue-200 shadow-sm">
                <label for="tanggal" class="block text-blue-900 font-bold mb-2">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Pilih Tanggal Laporan
                    </div>
                    {{-- Info Tanggal Hari Ini --}}
                    <span class="text-sm font-medium text-green-700 block mt-1 ml-7">
                        Hari ini: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                    </span>
                </label>

                <input type="date" id="tanggal" name="tanggal" 
                       {{-- Value default hari ini, user bisa ganti ke tanggal kemarin --}}
                       value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" 
                       max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-700 font-semibold"
                       required>
                       
                <p class="text-xs text-blue-700 mt-2 italic">
                    * Pastikan tanggal sesuai. Jika mengisi rapel (kemarin), silakan ganti tanggal di atas.
                </p>
            </div>
            {{-- ============================================ --}}

            {{-- Loop Pertanyaan --}}
            @foreach($soals as $soal)
            <div class="mb-6 border-b border-gray-100 pb-4 last:border-0">
                <label class="block text-gray-800 font-semibold mb-1">
                    {{ $loop->iteration }}. {{ $soal->pertanyaan }}
                    @if($soal->is_required) <span class="text-red-500">*</span> @endif
                </label>

                @if($soal->deskripsi)
                    <p class="text-sm text-gray-500 mb-3 italic">{{ $soal->deskripsi }}</p>
                @endif

                @if($soal->tipe_soal == 'short_text')
                    <input type="text" name="jawaban[{{ $soal->id }}]" class="w-full border-gray-300 rounded shadow-sm focus:ring-green-500 focus:border-green-500" {{ $soal->is_required ? 'required' : '' }}>
                
                @elseif($soal->tipe_soal == 'paragraph')
                    <textarea name="jawaban[{{ $soal->id }}]" rows="3" class="w-full border-gray-300 rounded shadow-sm focus:ring-green-500 focus:border-green-500" {{ $soal->is_required ? 'required' : '' }}></textarea>
                
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
        </form> {{-- Penutup Form disini --}}
    </div>
    @endif

    {{-- Tampilan Ketua Group (Jika ada) --}}
    @if($role == 'group')
       {{-- ... (kode ketua group tetap) ... --}}
    @endif

</div>

{{-- SweetAlert Script --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showLoading() {
        Swal.fire({
            title: 'Mengirim Laporan...',
            html: 'Mohon tunggu sebentar.',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });
        return true;
    }

    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                title: 'Jazakallah Khair!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#16a34a',
                timer: 4000
            });
        @endif
        @if(session('error'))
            Swal.fire({
                title: 'Mohon Maaf',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonColor: '#dc2626'
            });
        @endif
        @if ($errors->any())
             Swal.fire({
                title: 'Periksa Kembali',
                text: "{{ $errors->first() }}",
                icon: 'warning',
                confirmButtonColor: '#ca8a04'
            });
        @endif
    });
</script>
@endsection