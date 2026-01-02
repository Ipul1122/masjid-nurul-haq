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