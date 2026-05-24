@extends('layouts.penggunaMasjid')

@section('title', 'Visi & Misi Masjid')

@section('content')
<!-- Custom Styles for Montserrat & Quicksand Fonts -->
<style>
    .font-montserrat {
        font-family: 'Montserrat', sans-serif;
    }
    .font-quicksand {
        font-family: 'Quicksand', sans-serif;
    }
    
    /* Custom style overrides for rendering WYSIWYG database values cleanly */
    .visi-misi-content ul {
        list-style-type: disc !important;
        padding-left: 1.5rem !important;
        margin-top: 0.75rem !important;
        margin-bottom: 0.75rem !important;
    }
    .visi-misi-content ol {
        list-style-type: decimal !important;
        padding-left: 1.5rem !important;
        margin-top: 0.75rem !important;
        margin-bottom: 0.75rem !important;
    }
    .visi-misi-content li {
        margin-bottom: 0.5rem !important;
        line-height: 1.625 !important;
    }
    .visi-misi-content p {
        margin-bottom: 0.75rem !important;
    }
</style>

<div class="container mx-auto px-4 py-12 mt-16 max-w-6xl">
    
    <!-- Title Area -->
    <div class="text-center mb-12 sm:mb-16">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-800 font-montserrat tracking-tight mb-3">
            Visi & Misi Masjid
        </h2>
        <div class="h-1 w-20 bg-gradient-to-r from-emerald-500 to-teal-500 mx-auto rounded-full"></div>
        <p class="text-gray-500 font-quicksand mt-4 text-sm sm:text-base max-w-xl mx-auto">
            Arah dan tujuan perjuangan dakwah serta pengelolaan kepengurusan Masjid.
        </p>
    </div>

    @if ($dataExists)
        {{-- Visi & Misi Grid --}}
        <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
            
            {{-- Visi Card --}}
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl border border-emerald-50/50 hover:border-emerald-500/20 transition-all duration-500 overflow-hidden transform hover:-translate-y-2">
                <!-- Premium Green/Emerald Header -->
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 p-6 sm:p-8 relative overflow-hidden">
                    <!-- Background shapes -->
                    <div class="absolute right-0 bottom-0 w-32 h-32 bg-white/5 rounded-full translate-x-12 translate-y-12"></div>
                    
                    <div class="flex items-center space-x-4 relative z-10">
                        <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl border border-white/20 shadow-inner group-hover:scale-115 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-white font-montserrat">Visi</h2>
                    </div>
                </div>
                <!-- Visi Content -->
                <div class="p-6 sm:p-8 md:p-10">
                    <div class="text-gray-700 text-sm sm:text-base md:text-lg leading-relaxed font-quicksand visi-misi-content max-w-none">
                        {!! $visiMisi->visi !!}
                    </div>
                </div>
            </div>

            {{-- Misi Card --}}
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl border border-emerald-50/50 hover:border-emerald-500/20 transition-all duration-500 overflow-hidden transform hover:-translate-y-2">
                <!-- Premium Teal Header -->
                <div class="bg-gradient-to-r from-teal-600 to-teal-700 p-6 sm:p-8 relative overflow-hidden">
                    <!-- Background shapes -->
                    <div class="absolute right-0 bottom-0 w-32 h-32 bg-white/5 rounded-full translate-x-12 translate-y-12"></div>
                    
                    <div class="flex items-center space-x-4 relative z-10">
                        <div class="bg-white/10 backdrop-blur-md p-3.5 rounded-2xl border border-white/20 shadow-inner group-hover:scale-115 transition-transform duration-300">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-white font-montserrat">Misi</h2>
                    </div>
                </div>
                <!-- Misi Content -->
                <div class="p-6 sm:p-8 md:p-10">
                    <div class="text-gray-700 text-sm sm:text-base md:text-lg leading-relaxed font-quicksand visi-misi-content max-w-none">
                        {!! $visiMisi->misi !!}
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Data Tidak Ditemukan Card --}}
        <div class="bg-white rounded-2xl shadow-md border border-emerald-50/50 overflow-hidden max-w-xl mx-auto">
            <div class="text-center py-16 px-6">
                <div class="bg-emerald-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="h-8 w-8 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="mt-2 text-lg font-bold text-gray-800 font-montserrat">Data Tidak Ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500 font-quicksand">Data Visi & Misi belum ditambahkan ke dalam database oleh DKM.</p>
            </div>
        </div>
    @endif
</div>
@endsection