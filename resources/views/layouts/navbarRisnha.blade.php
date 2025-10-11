<nav class="navbar">
    <div class="d-flex align-items-center justify-content-between w-100">
        
        <!-- Left Side: Hamburger & Brand -->
        <div class="d-flex align-items-center">
            <button class="hamburger-menu" id="hamburgerMenu" title="Menu">
                <i class="fas fa-bars"></i>
            </button>
            <span class="navbar-brand ms-2">Manajemen Risnha</span>
        </div>

        <!-- Right Side: Clock, Notification & User -->
        <div class="d-flex align-items-center gap-3">
            <span class="navbar-text" id="realtime-clock-risnha"></span>

            @php
                if(session()->has('dkm_id') || session()->get('is_admin') === true) {
                    $jumlahNotifikasi = \App\Models\NotifikasiRisnha::valid()->count();
                } elseif(session()->has('risnha_id')) {
                    $jumlahNotifikasi = \App\Models\NotifikasiRisnha::valid()->where('risnha_id', session('risnha_id'))->count();
                } else {
                    $jumlahNotifikasi = 0;
                }
            @endphp

            <a href="{{ route('risnha.notifikasiRisnha.index') }}" class="text-dark position-relative" title="Notifikasi" style="font-size: 1.2rem;">
                <i class="fas fa-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notification-badge" style="font-size: 0.65rem;">
                    @if($jumlahNotifikasi > 0)
                        {{ $jumlahNotifikasi }}
                    @endif
                </span>
            </a>

            <span class="navbar-user d-none d-md-inline">
                {{ \App\Models\Risnha::find(session('risnha_id'))->username ?? 'Guest' }}
            </span>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const clockElement = document.getElementById('realtime-clock-risnha');
    
    if (clockElement) {
        function updateClock() {
            const now = new Date();
            const options = {
                weekday: 'short',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            const formattedTime = now.toLocaleString('id-ID', options).replace(/\./g, ':');
            clockElement.textContent = formattedTime;
        }
        
        updateClock();
        setInterval(updateClock, 1000);
    }
});
</script>