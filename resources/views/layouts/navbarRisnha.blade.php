<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand">Dashboard Risnha</span>
        <div class="d-flex align-items-center">
            
            <!-- [MODIFIED] Menambahkan elemen untuk jam realtime -->
            <span class="navbar-text me-3" id="realtime-clock-risnha"></span>

            {{-- Notifikasi --}}
            @php
                // Jika admin (dkm) tampilkan semua, jika risnha tampilkan miliknya
                if(session()->has('dkm_id') || session()->get('is_admin') === true) {
                    // Gunakan scope 'valid' yang sudah ada di model untuk mengambil notifikasi < 5 menit
                    $jumlahNotifikasi = \App\Models\NotifikasiRisnha::valid()->count();
                } elseif(session()->has('risnha_id')) {
                    $jumlahNotifikasi = \App\Models\NotifikasiRisnha::valid()->where('risnha_id', session('risnha_id'))->count();
                } else {
                    $jumlahNotifikasi = 0;
                }
            @endphp

            <a href="{{ route('risnha.notifikasiRisnha.index') }}" class="me-3 position-relative text-dark" title="Notifikasi">
                <i class="fas fa-bell fa-lg"></i>
                {{-- Tambahkan id="notification-badge" --}}
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notification-badge">
                    {{-- Tampilkan hanya jika jumlah notifikasi > 0 --}}
                    @if($jumlahNotifikasi > 0)
                        {{ $jumlahNotifikasi }}
                    @endif
                </span>
            </a>

            <span class="me-3">
                Halo, {{ \App\Models\Risnha::find(session('risnha_id'))->username ?? 'Guest' }}
            </span>
        </div>
    </div>
</nav>

<!-- [NEW] Script untuk menjalankan jam realtime -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Pilih elemen jam berdasarkan ID yang unik
    const clockElement = document.getElementById('realtime-clock-risnha');

    // 2. Pastikan elemennya ada sebelum menjalankan script
    if (clockElement) {
        
        function updateClock() {
            const now = new Date();
            
            // 3. Opsi format untuk tanggal dan waktu (Bahasa Indonesia)
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false // Menggunakan format 24 jam
            };

            // 4. Ubah tanggal ke format string lokal (id-ID)
            // .replace() untuk memperbaiki format pemisah waktu dari titik menjadi titik dua
            const formattedTime = now.toLocaleString('id-ID', options).replace(/\./g, ':');
            
            // 5. Update konten teks di elemen jam
            clockElement.textContent = formattedTime;
        }

        // 6. Jalankan fungsi pertama kali agar jam langsung muncul
        updateClock();
        
        // 7. Atur interval untuk memperbarui jam setiap detik (1000 milidetik)
        setInterval(updateClock, 1000);
    }
});
</script>
