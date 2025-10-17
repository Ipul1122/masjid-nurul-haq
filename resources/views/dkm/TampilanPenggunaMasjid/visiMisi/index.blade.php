@extends('layouts.dkm')

@section('title', 'Visi & Misi')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Visi & Misi Masjid</h2>
    </div>

    {{-- Notifikasi --}}
    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    @endif
    @if ($message = Session::get('info'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    @endif

    @if ($dataExists)
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-3">Visi</h3>
            <div class="prose max-w-full text-gray-700">
                {!! $visiMisi->visi !!}
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-3">Misi</h3>
            <div class="prose max-w-full text-gray-700">
                {!! $visiMisi->misi !!}
            </div>
        </div>

        <div class="mt-6 flex items-center space-x-2">
            <a href="{{ route('dkm.tampilanPenggunaMasjid.visiMisi.edit', $visiMisi->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                Edit
            </a>
            <form action="{{ route('dkm.tampilanPenggunaMasjid.visiMisi.destroy', $visiMisi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Hapus
                </button>
            </form>
        </div>
    @else
        <div class="text-center py-10">
            <p class="text-gray-500 mb-4">Data Visi & Misi belum ditambahkan.</p>
            <a href="{{ route('dkm.tampilanPenggunaMasjid.visiMisi.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-5 rounded-full transition duration-300">
                + Buat Visi & Misi
            </a>
        </div>
    @endif
</div>
@endsection

