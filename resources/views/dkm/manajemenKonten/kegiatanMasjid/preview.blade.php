<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview: {{ $kegiatanMasjid->judul }}</title>

    {{-- Memuat Tailwind CSS dari CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Style tambahan untuk konten artikel (prose) --}}
    <style>
        .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
            color: #1f2937; /* gray-900 */
        }
        .prose p {
            margin-bottom: 1.25em;
        }
        .prose ul, .prose ol {
            margin-left: 1.25rem;
            margin-bottom: 1.25em;
        }
        .prose ul {
            list-style-type: disc;
        }
        .prose ol {
            list-style-type: decimal;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">

    <main class="container mx-auto p-4 md:p-8">
        <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
    
            <article>
                {{-- Judul Artikel --}}
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                    {{ $kegiatanMasjid->judul }}
                </h1>

                {{-- Meta Info (Ustadz & Jadwal) --}}
                <div class="flex flex-wrap items-center text-gray-500 text-sm mb-6">
                    <span>Oleh: <strong>{{ $kegiatanMasjid->nama_ustadz }}</strong></span>
                    <span class="mx-2">•</span>
                    <span>{{ \Carbon\Carbon::parse($kegiatanMasjid->jadwal)->translatedFormat('l, d F Y H:i') }} WIB</span>
                </div>
        
                <hr class="mb-6">
        
                {{-- Gambar Utama --}}
                @if($kegiatanMasjid->gambar)
                    <img src="{{ asset('storage/' . $kegiatanMasjid->gambar) }}" alt="{{ $kegiatanMasjid->judul }}" class="w-full h-auto max-h-96 object-cover rounded-lg mb-6">
                @endif
        
        
                {{-- Konten Deskripsi --}}
                <div class="prose prose-lg max-w-none">
                    {!! $kegiatanMasjid->deskripsi !!}
                </div>
            </article>
        
            {{-- Tombol Kembali --}}
            <div class="mt-8 pt-6 border-t">
                <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" 
                   class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    &larr; Kembali ke Daftar Kegiatan
                </a>
            </div>
        
        </div>
    </main>

</body>
</html>