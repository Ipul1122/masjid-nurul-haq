@php
    // Mengambil data running text dari database
    $runningText = \App\Models\TampilanPenggunaMasjid\RunningText::first();
@endphp

{{-- Kondisi ini hanya akan menampilkan div jika data ada DAN content-nya tidak kosong --}}
@if($runningText && !empty($runningText->content))
<div class="shadow-lg sticky top-16  overflow-hidden z-20" style="background-color: {{ $runningText->background_color }}; color: {{ $runningText->text_color }};">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-3">
            {{-- 
              Konten di dalam <p> ini akan dianimasikan oleh CSS.
              Kita gabungkan teks dari database dan teks dari API di sini.
            --}}
            <p class="whitespace-nowrap animate-marquee">
                
                {{-- 1. Teks Pengumuman dari Database --}}
                <span>{{ $runningText->content }}</span>

                {{-- 2. Pemisah --}}
                <span class="mx-4">+++</span>

                {{-- 3. Placeholder untuk Jadwal Sholat (akan diisi oleh JavaScript) --}}
                <span id="jadwal-sholat-text" class="font-semibold">Memuat jadwal sholat...</span>

            </p>
        </div>
    </div>
</div>

{{-- 
  CSS Animasi Marquee (Biarkan seperti aslinya)
--}}
<style>
@keyframes marquee {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}
.animate-marquee {
    display: inline-block;
    padding-left: 100%; 
    /* Durasi animasi bisa disesuaikan jika teks menjadi terlalu panjang */
    animation: marquee 45s linear infinite; 
}
/* Memastikan span di dalam p tidak ter-wrap */
.animate-marquee span {
    display: inline-block;
}
</style>

{{-- 
  Script untuk memanggil API Jadwal Sholat.
  Script ini hanya akan dimuat jika running text aktif.
--}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Panggil API internal yang sudah kita buat
        fetch('/api/jadwal-sholat-hari-ini')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Data jadwal sholat tidak ditemukan hari ini.');
                }
                return response.json();
            })
            .then(data => {
                // Jika berhasil, format datanya menjadi string
                // Contoh: "Jadwal Sholat Hari Ini (23 Oktober): Shubuh: 04:11 | ..."
                const jadwalString = `Jadwal Sholat Hari Ini (${data.tanggal} ${data.bulan}): 
                    Shubuh: ${data.Shubuh} | 
                    Terbit: ${data.Terbit} | 
                    Dhuhur: ${data.Dhuhur} | 
                    Asar: ${data.Asar} | 
                    Maghrib: ${data.Maghrib} | 
                    Isya: ${data.Isya}`;
                
                // Masukkan string yang sudah diformat ke dalam placeholder span
                document.getElementById('jadwal-sholat-text').textContent = jadwalString;
            })
            .catch(error => {
                // Jika terjadi error (API gagal atau data tidak ada)
                console.error('Error fetching jadwal sholat:', error);
                // Tampilkan pesan error di running text
                document.getElementById('jadwal-sholat-text').textContent = 'Jadwal sholat tidak tersedia saat ini.';
            });
    });
</script>
@endif