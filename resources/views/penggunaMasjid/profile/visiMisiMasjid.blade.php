@extends('layouts.penggunaMasjid')

@section('title', 'Visi & Misi Masjid')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6 sm:p-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 text-center">Visi & Misi Masjid</h2>

            @if ($dataExists)
                <div class="space-y-8">
                    <div>
                        <h3 class="text-xl sm:text-2xl font-semibold text-gray-700 border-b-2 border-green-500 pb-2 mb-4">Visi</h3>
                        <div class="prose max-w-full text-gray-600">
                            {!! $visiMisi->visi !!}
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl sm:text-2xl font-semibold text-gray-700 border-b-2 border-green-500 pb-2 mb-4">Misi</h3>
                        <div class="prose max-w-full text-gray-600">
                            {!! $visiMisi->misi !!}
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Data Tidak Ditemukan</h3>
                    <p class="mt-1 text-sm text-gray-500">Data Visi & Misi belum ditambahkan.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection