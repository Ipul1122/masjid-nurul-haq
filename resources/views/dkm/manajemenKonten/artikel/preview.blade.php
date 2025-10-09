<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview: {{ $artikel->judul }}</title>
    {{-- Menggunakan Tailwind CSS via CDN untuk styling --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Plugin Typography untuk styling otomatis konten dari Trix Editor --}}
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
</head>
<body class="bg-gray-100">

    <main class="container mx-auto max-w-3xl my-8 p-6 sm:p-8 bg-white rounded-lg shadow-md">
        
        {{-- Judul Artikel --}}
        <h1 class="text-3xl md:text-4xl font-bold mb-2 text-gray-800">{{ $artikel->judul }}</h1>

        {{-- Meta Data: Tanggal & Kategori --}}
        <div class="text-sm text-gray-500 mb-6 border-b pb-4">
            <span>Dirilis pada: {{ \Carbon\Carbon::parse($artikel->tanggal_rilis)->translatedFormat('d F Y') }}</span>
            <span class="mx-2">|</span>
            <span>Kategori: {{ $artikel->kategori->nama ?? 'Tidak ada kategori' }}</span>
        </div>

        {{-- Gambar Utama --}}
        @php
            $firstImage = null;
            if ($artikel->gambar) {
                $gambarList = is_string($artikel->gambar) ? json_decode($artikel->gambar, true) ?? [$artikel->gambar] : $artikel->gambar;
                $firstImage = trim($gambarList[0] ?? null);
            }
        @endphp

        @if ($firstImage)
            <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $artikel->judul }}" class="w-full h-auto object-cover rounded-lg mb-6">
        @endif

        {{-- Deskripsi/Isi Artikel --}}
        
           
        <div class="prose prose-lg max-w-none text-gray-700 break-words">
            {!! $artikel->deskripsi !!}
        </div>

    </main>

</body>
</html>