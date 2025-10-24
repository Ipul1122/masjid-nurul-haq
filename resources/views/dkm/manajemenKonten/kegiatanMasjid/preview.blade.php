@extends('layouts.dkm')

@section('title', 'Preview Kegiatan Masjid')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
    
    {{-- Gambar Utama --}}
    @if($kegiatan->gambar)
        <img src="{{ asset('storage/' . $kegiatan->gambar) }}" alt="Gambar {{ $kegiatan->judul }}" class="w-full h-64 object-cover rounded-t-lg mb-6">
    @endif

    {{-- Judul dan Kategori --}}
    <div class="mb-4">
        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">{{ $kegiatan->kategori->nama ?? 'Tanpa Kategori' }}</span>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">{{ $kegiatan->judul }}</h1>
    </div>

    {{-- Detail Kegiatan --}}
    <div class="flex items-center text-gray-600 text-sm mb-6 border-b pb-4">
        <span>Oleh: <strong>{{ $kegiatan->nama_ustadz }}</strong></span>
        <span class="mx-2">|</span>
        <span>Jadwal: <strong>{{ \Carbon\Carbon::parse($kegiatan->jadwal)->translatedFormat('l, d F Y \p\u\k\u\l H:i') }} WIB</strong></span>
    </div>

    {{-- Deskripsi --}}
    <div class="prose max-w-none text-gray-700">
        {!! $kegiatan->deskripsi !!}
    </div>

    <hr class="my-8">

    {{-- Tombol Aksi --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
            &larr; Kembali ke Daftar
        </a>

        {{-- ✅ PERUBAHAN: Form untuk Publikasi (diberi ID, onsubmit dihapus) --}}
        @if($kegiatan->status == 'draft')
            <form id="publish-form" action="{{ route('dkm.manajemenKonten.kegiatanMasjid.publish', $kegiatan->id) }}" method="POST">
                @csrf
                @method('PUT') 
                
                {{-- ✅ PERUBAHAN: Tombol diubah jadi type="button" dan diberi ID --}}
                <button type="button" id="publish-button" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Kirim ke Publik &rarr;
                </button>
            </form>
        @else
            <span class="px-4 py-2 bg-green-200 text-green-800 rounded-lg font-semibold">Sudah Dipublikasikan</span>
        @endif
    </div>
</div>

{{-- ✅ PERUBAHAN: Menambahkan Modal Konfirmasi Publish --}}
<div id="publish-modal" class="fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <div class="text-center">
            <h3 class="text-lg font-bold text-gray-900">Konfirmasi Publikasi</h3>
            <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin mempublikasikan kegiatan ini? Tindakan ini akan membuatnya terlihat oleh publik.</p>
        </div>
        <div class="mt-6 flex justify-center gap-4">
            <button id="cancel-publish" type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                Batal
            </button>
            <button id="confirm-publish" type="button" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Ya, Publikasikan
            </button>
        </div>
    </div>
</div>

{{-- ✅ PERUBAHAN: Menambahkan Script untuk Modal Publish --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const publishModal = document.getElementById('publish-modal');
    const publishButton = document.getElementById('publish-button');
    const cancelPublishButton = document.getElementById('cancel-publish');
    const confirmPublishButton = document.getElementById('confirm-publish');
    const formToSubmit = document.getElementById('publish-form');

    // Hanya tambahkan event listener jika tombol publish ada (status 'draft')
    if (publishButton) {
        publishButton.addEventListener('click', function () {
            if (formToSubmit) {
                publishModal.classList.remove('hidden');
                publishModal.classList.add('flex'); // Gunakan flex untuk memposisikan
            }
        });
    }

    // Tombol Batal pada modal
    cancelPublishButton.addEventListener('click', function () {
        publishModal.classList.add('hidden');
        publishModal.classList.remove('flex');
    });

    // Tombol Konfirmasi pada modal
    confirmPublishButton.addEventListener('click', function () {
        if (formToSubmit) {
            formToSubmit.submit();
        }
    });

    // Klik di luar modal untuk menutup
    window.addEventListener('click', function (event) {
        if (event.target === publishModal) {
            publishModal.classList.add('hidden');
            publishModal.classList.remove('flex');
        }
    });
});
</script>
@endsection