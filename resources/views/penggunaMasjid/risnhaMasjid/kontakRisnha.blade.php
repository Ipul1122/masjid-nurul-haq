@extends('layouts.risnhaMasjid.risnhaMasjid')

@section('title', 'Kontak Kami - Risnha')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-8 md:p-12">
            
            {{-- Header --}}
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-800">Hubungi Kami</h1>
                <p class="text-lg text-gray-500 mt-2">Punya pertanyaan, saran, atau kritik? Jangan ragu untuk menghubungi kami.</p>
            </div>

            {{-- Form Kontak --}}
            {{-- Kita gunakan ID "kontakForm" untuk dihubungkan dengan JavaScript --}}
            <form id="kontakForm" class="space-y-6">
                
                {{-- Nama --}}
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" 
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition duration-200" 
                           placeholder="Nama Anda" required>
                </div>

                {{-- Email --}}
                <div>
                    <label for="gmail" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                    <input type="email" name="gmail" id="gmail" 
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition duration-200" 
                           placeholder="anda@gmail.com" required>
                </div>
                
                {{-- No. Telepon --}}
                <div>
                    <label for="telp" class="block text-sm font-medium text-gray-700 mb-2">No. Telepon (WhatsApp)</label>
                    <input type="tel" name="telp" id="telp" 
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition duration-200" 
                           placeholder="08xxxxxxxxxx" required>
                </div>

                {{-- Pesan --}}
                <div>
                    <label for="pesan" class="block text-sm font-medium text-gray-700 mb-2">Pesan Anda</label>
                    <textarea name="pesan" id="pesan" rows="5" 
                              class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition duration-200" 
                              placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                </div>

                {{-- Tombol Kirim --}}
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-md text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform transition-transform duration-200 hover:-translate-y-1">
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12.04 2C6.58 2 2.13 6.45 2.13 12C2.13 13.66 2.54 15.21 3.21 16.6L2.06 20.94L6.52 19.82C7.89 20.45 9.4 20.77 10.95 20.77C11.43 20.77 11.91 20.74 12.39 20.67L12.04 2ZM18.46 15.03C18.17 15.54 17.16 16.05 16.4 16.1C15.63 16.14 14.7 15.89 13.91 15.3L13.1 14.86C11.23 13.79 9.87 12.04 9.01 10.74L8.14 9.47C7.41 8.36 7.8 7.39 8.1 6.91C8.34 6.5 8.79 6.27 9.17 6.27C9.32 6.27 9.46 6.27 9.6 6.27C9.83 6.27 10.02 6.8 10.21 7.23C10.4 7.68 10.6 8.19 10.6 8.29C10.6 8.52 10.53 8.76 10.38 8.95L10.03 9.35C9.9 9.5 9.77 9.61 9.87 9.8C9.96 9.99 10.37 10.7 11.08 11.38C11.97 12.23 12.75 12.5 13.04 12.63C13.29 12.73 13.43 12.7 13.57 12.56L14.01 12.08C14.2 11.91 14.44 11.85 14.67 11.95C14.91 12.04 16 12.68 16 12.68C16.48 12.89 16.87 13.08 17.15 13.25C17.43 13.42 17.61 13.51 17.68 13.63C17.74 13.75 17.74 14.24 17.46 14.75L18.46 15.03Z" />
                        </svg>
                        Kirim via WhatsApp
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    // Menangkap event submit pada form
    document.getElementById('kontakForm').addEventListener('submit', function(e) {
        // Mencegah form terkirim secara normal
        e.preventDefault();

        // 1. Mengambil data dari form
        let nama = document.getElementById('nama').value;
        let gmail = document.getElementById('gmail').value;
        let telp = document.getElementById('telp').value;
        let pesan = document.getElementById('pesan').value;

        // 2. Nomor WhatsApp Tujuan
        let noTujuan = '6285693672730'; // Gunakan 62, bukan 0

        // 3. Format pesan (menggunakan encodeURIComponent untuk mengubah spasi, dll.)
        let templatePesan = `Halo Risnha, saya ingin menghubungi Anda.
-------------------------
*Nama:* ${nama}
*Email:* ${gmail}
*No. Telp:* ${telp}

*Pesan:*
${pesan}
-------------------------`;

        let pesanEncoded = encodeURIComponent(templatePesan);

        // 4. Membuat URL WhatsApp
        let waURL = `https://wa.me/${noTujuan}?text=${pesanEncoded}`;

        // 5. Mengarahkan pengguna ke URL WhatsApp
        window.open(waURL, '_blank');
    });
</script>
@endsection