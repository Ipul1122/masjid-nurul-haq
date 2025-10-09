<div class="sidebar">
    <h4 class="text-center">RISNHA</h4>

    <a href="{{ route('risnha.dashboard') }}">
        <i class="fa fa-home me-2"></i> Dashboard
    </a>

    <!-- Link ke halaman kategori kegiatan Risnha -->
    <a href="{{ route('risnha.kategori.kegiatanRisnha.index') }}">
        <i class="fa fa-list me-2"></i> Kategori Kegiatan
    </a>

    <!-- Link ke daftar kegiatan Risnha -->
    <a href="{{ route('risnha.manajemenKontenRisnha.kegiatanRisnha.index') }}">
        <i class="fa fa-calendar-check me-2"></i> Kegiatan Risnha
    </a>

    <a href="{{ route('risnha.kategori.artikelRisnha.index') }}">
        <i class="fa fa-newspaper me-2"></i> Kategori Artikel Risnha
    </a>

    <a href="{{ route('risnha.manajemenKontenRisnha.artikelRisnha.index') }}">
        <i class="fa fa-newspaper me-2"></i> Artikel Risnha
    </a>

    <a href="{{ route('risnha.manajemenKontenRisnha.galeriRisnha.index')}}"><i class="fa fa-image me-2"></i> Galeri Risnha</a>
    <a href="{{ route('risnha.kategori.galeriRisnha.index')}}"><i class="fa fa-image me-2"></i> Kategori Galeri Risnha</a>
    <a href="#"><i class="fa fa-bell me-2"></i> Notifikasi</a>
    <a href="#"><i class="fa fa-users me-2"></i> Struktur Organisasi</a>

    <!-- 🔑 Shortcut Manajemen Pengguna Risnha -->
    <a href="{{ route('risnha.manajemenPenggunaRisnha.index') }}">
        <i class="fa fa-user-cog me-2"></i> Manajemen Pengguna
    </a>

    <a href="{{ route('risnha.logout') }}">
        <i class="fa fa-sign-out-alt me-2"></i> Logout
    </a>
</div>
