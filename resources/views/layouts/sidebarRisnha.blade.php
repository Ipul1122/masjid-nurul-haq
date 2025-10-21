<div class="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <div class="logo-icon">
            <i class="fas fa-leaf"></i>
        </div>
        <div>
            <h4>RISNHA</h4>
            <p>Admin Panel</p>
        </div>
    </div>

    <!-- User Info -->
    <div class="sidebar-user">
        <div class="sidebar-user-avatar">
            {{ strtoupper(substr(\App\Models\Risnha::find(session('risnha_id'))->username ?? 'G', 0, 1)) }}
        </div>
        <div class="sidebar-user-info">
            <h5>{{ \App\Models\Risnha::find(session('risnha_id'))->username ?? 'Guest' }}</h5>
            <p>RISNHA Administrator</p>
        </div>
    </div>

    <!-- Menu -->
    <div class="sidebar-menu">
        <div class="sidebar-menu-item">
            <a href="{{ route('risnha.dashboard') }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- Kelola Konten -->
        <div class="sidebar-menu-item has-submenu" onclick="toggleSubmenu(this)">
            <a href="javascript:void(0)">
                <i class="fas fa-newspaper"></i>
                <span>Kelola Konten</span>
            </a>
            <div class="sidebar-submenu">
                <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.index') }}">
                    <i class="fas fa-calendar-check"></i> Kegiatan Risnha
                </a>
                <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.index') }}">
                    <i class="fas fa-file-alt"></i> Artikel Risnha
                </a>
                <a href="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.index') }}">
                    <i class="fas fa-images"></i> Galeri Risnha
                </a>
            </div>
        </div>

        <!-- Kelola Kategori -->
        <div class="sidebar-menu-item has-submenu" onclick="toggleSubmenu(this)">
            <a href="javascript:void(0)">
                <i class="fas fa-tags"></i>
                <span>Kelola Kategori</span>
            </a>
            <div class="sidebar-submenu">
                <a href="{{ route('risnha.kategori.kegiatanRisnha.index') }}">
                    <i class="fas fa-list"></i> Kategori Kegiatan
                </a>
                <a href="{{ route('risnha.kategori.artikelRisnha.index') }}">
                    <i class="fas fa-list"></i> Kategori Artikel
                </a>
                <a href="{{ route('risnha.kategori.galeriRisnha.index') }}">
                    <i class="fas fa-list"></i> Kategori Galeri
                </a>
            </div>
        </div>

        <!-- Notifikasi -->
        <div class="sidebar-menu-item">
            <a href="{{ route('risnha.notifikasiRisnha.index') }}">
                <i class="fas fa-bell"></i>
                <span>Notifikasi</span>
            </a>
        </div>

        <!-- Manajemen Pengguna -->
        <div class="sidebar-menu-item">
            <a href="{{ route('risnha.manajemenPenggunaRisnha.index') }}">
                <i class="fas fa-user-cog"></i>
                <span>Manajemen Pengguna</span>
            </a>
        
        </div>
        <!-- Manajemen Pengguna -->
        <div class="sidebar-menu-item">
            <a href="{{ route('risnha.tampilanPenggunaMasjid.homeSectionRisnha.index') }}">
                <i class="fas fa-user-cog"></i>
                <span>Manajemen tampilan</span>
            </a>
        </div>

        <!-- Manajemen profile -->
        <div class="sidebar-menu-item">
            <a href="{{ route('risnha.profile.index') }}">
                <i class="fas fa-user-cog"></i>
                <span>Manajemen profile</span>
            </a>
        </div>
    </div>

    <!-- Logout -->
    <div class="sidebar-logout">
        <a href="{{ route('risnha.logout') }}">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>
</div>

<script>
function toggleSubmenu(element) {
    element.classList.toggle('active');
    const otherItems = element.parentElement.querySelectorAll('.sidebar-menu-item.has-submenu.active');
    otherItems.forEach(item => {
        if (item !== element) {
            item.classList.remove('active');
        }
    });
}
</script>