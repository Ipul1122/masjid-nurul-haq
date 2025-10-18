@extends('layouts.PenggunaMasjid')
@section('title', 'Kontak Kami - Masjid Nurul Haq')
@section('content')

<div class="bg-gray-50 py-12 mt-16">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800">Hubungi Kami</h2>
            <p class="text-gray-600 mt-2 text-lg">
                Kami siap mendengar saran, pertanyaan, atau pesan dari Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- MAP -->
            <div class="shadow-md rounded-lg overflow-hidden">
                <div class="relative pb-[75%]">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63467.81462986914!2d106.72586652167968!3d-6.165774899999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f642d88d5841%3A0x6c31ab35f182053a!2sMasjid%20Nurul%20Haq!5e0!3m2!1sid!2sid!4v1760611760400!5m2!1sid!2sid" 
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

            <!-- FORM -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <form id="kontakForm" class="space-y-5">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input 
                            type="text" 
                            id="nama" 
                            placeholder="Masukkan nama Anda"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            placeholder="contoh@gmail.com"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"
                        >
                    </div>

                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input 
                            type="tel" 
                            id="telepon" 
                            placeholder="08xxxxxxxxxx"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"
                        >
                    </div>

                    <div>
                        <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
                        <textarea 
                            id="pesan" 
                            rows="4" 
                            placeholder="Tuliskan pesan Anda di sini..." 
                            required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"
                        ></textarea>
                    </div>

                    <button 
                        type="submit"
                        class="inline-flex items-center justify-center w-full bg-green-600 text-white font-semibold py-3 rounded-lg hover:bg-green-700 transition"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.52 3.48A11.76 11.76 0 0012 0 11.9 11.9 0 001.3 16.6L0 24l7.6-2a11.9 11.9 0 004.4.8 12 12 0 0012-12 11.8 11.8 0 00-3.48-8.32zM12 21.5a9.3 9.3 0 01-4.75-1.3l-.35-.2-4.5 1.2 1.2-4.4-.2-.35A9.3 9.3 0 1121.5 12 9.4 9.4 0 0112 21.5zm5.3-7.1l-1.4-.7a1 1 0 00-1 .1l-.9.6a7.4 7.4 0 01-3.2-3.2l.6-.9a1 1 0 00.1-1l-.7-1.4a1 1 0 00-1.1-.5c-.3 0-.7.2-1 .4a4 4 0 00-1.7 3.2 7 7 0 001.6 3.7 7 7 0 003.7 1.6 4 4 0 003.2-1.7c.2-.3.4-.7.4-1a1 1 0 00-.5-1.1z"/>
                        </svg>
                        Kirim Pesan via WhatsApp
                    </button>

                    <p class="text-center text-gray-500 text-sm mt-2">
                        Klik tombol di atas untuk menghubungi DKM langsung.
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('kontakForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const nama = document.getElementById('nama').value.trim();
    const email = document.getElementById('email').value.trim();
    const telepon = document.getElementById('telepon').value.trim();
    const pesan = document.getElementById('pesan').value.trim();

    // Nomor tujuan WhatsApp DKM (ubah sesuai kebutuhan)
    const nomorDKM = '6285693672730';

    // Pesan yang dikirim ke WhatsApp
    const text = 
`Assalamualaikum, saya ingin bertanya mengenai. Tapi sebelum itu perkenalkan:
Nama: ${nama}
Email: ${email}
Nomor Telepon: ${telepon}
Pesan: ${pesan}`;

    // Buka WhatsApp dengan pesan yang telah diisi
    const url = `https://wa.me/${nomorDKM}?text=${encodeURIComponent(text)}`;
    window.open(url, '_blank');
});
</script>

@endsection
