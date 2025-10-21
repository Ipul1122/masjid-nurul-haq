@extends('layouts.risnhaMasjid.risnhaMasjid')

@section('title', 'Profile Risnha')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800">Visi & Misi</h1>
            <p class="text-lg text-gray-600 mt-2">Arah dan Tujuan Remaja Islam Masjid Nurul Haq</p>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-8 md:p-12">
            {{-- Visi --}}
            <div class="mb-10">
                <h2 class="text-3xl font-semibold text-blue-600 mb-4 border-l-4 border-blue-600 pl-4">Visi</h2>
                <div class="text-gray-700 text-lg leading-relaxed prose max-w-none">
                    {!! nl2br(e($profile->visi)) !!}
                </div>
            </div>

            {{-- Misi --}}
            <div>
                <h2 class="text-3xl font-semibold text-green-600 mb-4 border-l-4 border-green-600 pl-4">Misi</h2>
                <div class="text-gray-700 text-lg leading-relaxed prose max-w-none">
                    {{-- nl2br mengubah baris baru menjadi <br>, e() untuk keamanan --}}
                    {!! nl2br(e($profile->misi)) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection