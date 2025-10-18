<header class="lg:hidden fixed top-0 left-0 right-0 z-30 bg-white shadow-md h-14 ">
    <div class="flex items-center justify-between px-4 h-full">
        <button id="sidebarToggle" class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <h1 class="font-bold text-lg text-gray-900">Masjid Nurul Haq</h1>
        <div class="flex items-center space-x-2">
            <div class="realtime-clock text-xs text-gray-700 font-medium hidden sm:block"></div>
            
            <a href="{{ route('dkm.notifikasi.index') }}" class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all">
                <i class="fas fa-bell text-lg"></i>
                {{-- PERBAIKAN: Tambahkan ID unik 'notification-badge-mobile' --}}
                <span id="notification-badge-mobile"
                      class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full {{ ($notifCount ?? 0) > 0 ? 'inline-flex' : 'hidden' }} items-center justify-center">
                    {{ ($notifCount ?? 0) > 9 ? '9+' : ($notifCount ?? 0) }}
                </span>
            </a>
        </div>
    </div>
</header>

<header class="hidden lg:flex fixed top-0 left-0 right-0 z-30 bg-white shadow-sm border-b border-gray-200 h-20  ">
    <div class="flex items-center justify-between w-full px-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
            <p class="text-gray-600">Selamat datang di panel administrasi</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="text-sm text-gray-800 font-medium bg-gray-100 px-4 py-2 rounded-lg flex items-center space-x-2">
                <i class="fas fa-calendar-alt text-gray-500"></i>
                <span class="realtime-clock"></span>
            </div>
            
            <a href="{{ route('dkm.notifikasi.index') }}" class="relative p-3 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all">
                <i class="fas fa-bell text-lg"></i>
                {{-- PERBAIKAN: Tambahkan ID unik 'notification-badge-desktop' --}}
                <span id="notification-badge"
                      class="absolute top-1 right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full {{ ($notifCount ?? 0) > 0 ? 'inline-flex' : 'hidden' }} items-center justify-center">
                    {{ ($notifCount ?? 0) > 9 ? '9+' : ($notifCount ?? 0) }}
                </span>
            </a>
            <div class="flex items-center space-x-3 px-3 py-2 bg-gray-50 rounded-xl">
                <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div class="text-sm">
                    <p class="font-medium text-gray-900">Admin</p>
                    <p class="text-gray-600">Online</p>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- Kode HTML lainnya seperti <aside> dan <main> tidak perlu diubah, jadi saya hapus dari sini --}}

{{-- Script untuk jam realtime (TIDAK DIUBAH) --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const clockElements = document.querySelectorAll('.realtime-clock');

    if (clockElements.length > 0) {
        function updateClock() {
            const now = new Date();
            const options = {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
                hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false
            };
            const formattedTime = now.toLocaleString('id-ID', options).replace(/\./g, ':');
            clockElements.forEach(el => {
                el.textContent = formattedTime;
            });
        }
        updateClock();
        setInterval(updateClock, 1000);
    }
});
</script>

{{-- PERBAIKAN: Skrip notifikasi yang sudah dibersihkan dan diperbaiki --}}
{{-- Anda bisa memindahkan skrip ini ke layouts/dkm.blade.php agar lebih rapi --}}
<script>
(function(){
    // Mencegah skrip ini berjalan lebih dari sekali
    if (window.__notif_sync_started) return;
    window.__notif_sync_started = true;
    
    /**
     * Fungsi untuk memperbarui semua badge notifikasi di halaman.
     * @param {number} count - Jumlah notifikasi.
     */
    function updateAllBadges(count) {
        // Pilih semua elemen badge (desktop dan mobile)
        const badges = document.querySelectorAll('#notification-badge, #notification-badge-mobile');
        
        badges.forEach(badge => {
            if (count > 0) {
                badge.textContent = count > 9 ? '9+' : count;
                badge.style.display = 'inline-flex';
            } else {
                badge.style.display = 'none';
            }
        });
    }

    /**
     * Fungsi untuk mengambil jumlah notifikasi terbaru dari server.
     */
    async function refreshNotifCount() {
        try {
            const response = await fetch("{{ route('dkm.notifikasi.count') }}", {
                headers: { 'Accept': 'application/json' }
            });

            if (!response.ok) {
                console.error("Gagal mengambil jumlah notifikasi.");
                return;
            }
            
            const data = await response.json();
            if (typeof data.count !== 'undefined') {
                updateAllBadges(data.count);
            }
        } catch (error) {
            console.error('Error saat refresh notifikasi:', error);
        }
    }

    // Panggil fungsi untuk pertama kali
    refreshNotifCount();
    
    // Atur interval untuk memeriksa jumlah notifikasi setiap 15 detik
    setInterval(refreshNotifCount, 15000);

})();
</script>