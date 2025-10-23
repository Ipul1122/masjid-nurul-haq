@extends('layouts.penggunaMasjid')

@section('title', 'Visi & Misi Masjid')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-10 text-center">Visi & Misi Masjid</h2>

    @if ($dataExists)
        {{-- Visi & Misi --}}
        <div class="grid md:grid-cols-2 gap-6 md:gap-8">
            
            {{-- Visi Card --}}
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 backdrop-blur-sm p-3 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold text-white">Visi</h2>
                    </div>
                </div>
                <div class="p-6 md:p-8">
                    {{-- Menggunakan variabel dan render dari kode asli --}}
                    <div class="text-gray-700 text-base md:text-lg leading-relaxed prose max-w-none">
                        {!! $visiMisi->visi !!}
                    </div>
                </div>
            </div>

            {{-- Misi Card --}}
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                <div class="bg-gradient-to-r from-blue-700 to-blue-800 p-6">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 backdrop-blur-sm p-3 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold text-white">Misi</h2>
                    </div>
                </div>
                <div class="p-6 md:p-8">
                    {{-- Menggunakan variabel dan render dari kode asli --}}
                    <div class="text-gray-700 text-base md:text-lg leading-relaxed prose max-w-none">
                        {!! $visiMisi->misi !!}
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Menggunakan blok 'else' dari kode asli, dibungkus card agar rapi --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="text-center py-16 px-6">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Data Tidak Ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">Data Visi & Misi belum ditambahkan.</p>
            </div>
        </div>
    @endif
</div>
@endsection