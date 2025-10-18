@extends('layouts.penggunaMasjid')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8 mt-16">
    
    {{-- Container Utama --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        
        {{-- Header Card --}}
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Sejarah Masjid Nurul Haq</h2>
            <p class="text-sm text-gray-500 mt-1">Menelusuri jejak dan perkembangan Masjid Nurul Haq dari masa ke masa.</p>
        </div>

        {{-- Body Card --}}
        <div class="p-6">
            @forelse ($sejarahs as $sejarah)
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $sejarah->judul }}</h3>
                    <div class="prose prose-sm max-w-full text-gray-600">
                        {!! $sejarah->deskripsi !!}
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500">
                    <p class="font-semibold mt-2">Belum ada data sejarah</p>
                    <p class="text-sm">Saat ini data mengenai sejarah masjid belum tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection