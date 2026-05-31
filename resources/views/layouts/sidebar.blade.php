<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 z-40 w-72 h-screen transition-transform duration-300 transform -translate-x-full lg:translate-x-0 bg-white shadow-xl border-r border-gray-200 flex flex-col">
    <!-- Header Sidebar -->
    <div class="flex items-center justify-between p-6 border-b border-gray-200 bg-gradient-to-r from-emerald-600 to-teal-600">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                <i class="fas fa-mosque text-emerald-600 text-lg"></i>
            </div>
            <div class="text-white">
                <h1 class="font-bold text-lg leading-tight">Masjid Nurul Haq</h1>
                <p class="text-emerald-100 text-sm">Admin Dashboard</p>
            </div>
        </div>
        <button id="sidebarClose" class="lg:hidden text-white hover:bg-white/20 p-2 rounded-lg transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 flex flex-col min-h-0">
        <nav id="sidebarNav" class="flex-1 overflow-y-auto p-4 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
            <!-- User Profile -->
            <div class="mb-6 p-4 bg-gray-50 rounded-xl">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-emerald-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">Admin User</p>
                        <p class="text-sm text-gray-600">DKM Administrator</p>
                    </div>
                </div>
            </div>

            <!-- Menu Items -->
            <div class="space-y-4 pb-4">
                <!-- SECTION 1: MENU UTAMA -->
                <div>
                    <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>
                    <div class="space-y-1">
                        <!-- Dashboard -->
                        <a href="{{ route('dkm.dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                            <i class="fas fa-chart-line w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </div>
                </div>

                <!-- SECTION 2: HALAMAN PUBLIK (ALIGNED WITH NAVBAR) -->
                <div>
                    <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Halaman Publik</p>
                    <div class="space-y-1.5">
                        
                        <!-- Beranda -->
                        <div class="menu-group">
                            <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                                <div class="flex items-center">
                                    <i class="fas fa-home w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                    <span class="font-medium">Beranda</span>
                                </div>
                                <i class="fas fa-chevron-down transition-transform duration-200"></i>
                            </button>
                            <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="ml-8 mt-1 mb-2 space-y-1">
                                    <a href="{{ route('dkm.tampilanPenggunaMasjid.homeSection.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-image w-4 h-4 mr-2"></i>
                                        Kelola Banner
                                    </a>
                                    <a href="{{ route('dkm.tampilanPenggunaMasjid.runningText.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-text-width w-4 h-4 mr-2"></i>
                                        Running Text
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Profil -->
                        <div class="menu-group">
                            <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                                <div class="flex items-center">
                                    <i class="fas fa-id-card w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                    <span class="font-medium">Profil</span>
                                </div>
                                <i class="fas fa-chevron-down transition-transform duration-200"></i>
                            </button>
                            <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="ml-8 mt-1 mb-2 space-y-1">
                                    <a href="{{ route('dkm.tampilanPenggunaMasjid.visiMisi.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-bullseye w-4 h-4 mr-2"></i>
                                        Visi Misi
                                    </a>
                                    <a href="{{ route('dkm.tampilanPenggunaMasjid.sejarah.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-history w-4 h-4 mr-2"></i>
                                        Sejarah Masjid
                                    </a>
                                    <a href="{{ route('dkm.tampilanPenggunaMasjid.strukturDkm.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-sitemap w-4 h-4 mr-2"></i>
                                        Struktur DKM
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Donasi -->
                        <div class="menu-group">
                            <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                                <div class="flex items-center">
                                    <i class="fas fa-hand-holding-usd w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                    <span class="font-medium">Donasi</span>
                                </div>
                                <i class="fas fa-chevron-down transition-transform duration-200"></i>
                            </button>
                            <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="ml-8 mt-1 mb-2 space-y-1">
                                    <a href="{{ route('dkm.tampilanPenggunaMasjid.buktiDonasi.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-file-invoice-dollar w-4 h-4 mr-2"></i>
                                        Bukti Donasi
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Konten -->
                        <div class="menu-group">
                            <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                                <div class="flex items-center">
                                    <i class="fas fa-newspaper w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                    <span class="font-medium">Konten</span>
                                </div>
                                <i class="fas fa-chevron-down transition-transform duration-200"></i>
                            </button>
                            <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="ml-8 mt-1 mb-2 space-y-1">
                                    <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-calendar-alt w-4 h-4 mr-2"></i>
                                        Kegiatan Masjid
                                    </a>
                                    <a href="{{ route('dkm.manajemenKonten.artikel.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-edit w-4 h-4 mr-2"></i>
                                        Artikel
                                    </a>
                                    <a href="{{ route('dkm.manajemenKonten.jadwalImam.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-clock w-4 h-4 mr-2"></i>
                                        Jadwal Imam
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Keuangan -->
                        <div class="menu-group">
                            <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                                <div class="flex items-center">
                                    <i class="fas fa-wallet w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                    <span class="font-medium">Keuangan</span>
                                </div>
                                <i class="fas fa-chevron-down transition-transform duration-200"></i>
                            </button>
                            <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="ml-8 mt-1 mb-2 space-y-1">
                                    <a href="{{ route('dkm.manajemenKeuangan.pemasukkan.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-arrow-up w-4 h-4 mr-2 text-green-500"></i>
                                        Laporan Pemasukkan
                                    </a>
                                    <a href="{{ route('dkm.manajemenKeuangan.pengeluaran.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-arrow-down w-4 h-4 mr-2 text-red-500"></i>
                                        Laporan Pengeluaran
                                    </a>
                                    <a href="{{ route('dkm.manajemenKeuangan.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-chart-pie w-4 h-4 mr-2"></i>
                                        Laporan Total Keuangan
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Galeri -->
                        <div class="menu-group">
                            <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                                <div class="flex items-center">
                                    <i class="fas fa-images w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                    <span class="font-medium">Galeri</span>
                                </div>
                                <i class="fas fa-chevron-down transition-transform duration-200"></i>
                            </button>
                            <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="ml-8 mt-1 mb-2 space-y-1">
                                    <a href="{{ route('dkm.manajemenFasilitas.galeri.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-images w-4 h-4 mr-2"></i>
                                        Manage Galeri
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- SECTION 3: ADMINISTRASI & SISTEM -->
                <div>
                    <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Administrasi & Sistem</p>
                    <div class="space-y-1.5">

                        <!-- Muhasabah -->
                        <div class="menu-group">
                            <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                                <div class="flex items-center">
                                    <i class="fas fa-clipboard-list w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                    <span class="font-medium">Kelola Muhasabah</span>
                                </div>
                                <i class="fas fa-chevron-down transition-transform duration-200"></i>
                            </button>
                            <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="ml-8 mt-1 mb-2 space-y-1">
                                    <a href="{{ route('dkm.muhasabah.group.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-users w-4 h-4 mr-2"></i>
                                        Kelola Group Muhasabah
                                    </a>
                                    <a href="{{ route('dkm.muhasabah.soal.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-question-circle w-4 h-4 mr-2"></i>
                                        Kelola Soal Muhasabah
                                    </a>
                                    <a href="{{ route('dkm.muhasabah.laporanMuhasabah.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-chart-line w-4 h-4 mr-2"></i>
                                        Aktifitas Muhasabah
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div class="menu-group">
                            <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                                <div class="flex items-center">
                                    <i class="fas fa-tags w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                    <span class="font-medium">Kelola Kategori</span>
                                </div>
                                <i class="fas fa-chevron-down transition-transform duration-200"></i>
                            </button>
                            <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="ml-8 mt-1 mb-2 space-y-1">
                                    <a href="{{route('dkm.kategori.artikel.index')}}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-newspaper w-4 h-4 mr-2"></i>
                                        Artikel
                                    </a>
                                    <a href="{{ route('dkm.kategori.galeri.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-images w-4 h-4 mr-2"></i>
                                        Galeri
                                    </a>
                                    <a href="{{ route('dkm.kategori.kegiatanMasjid.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-calendar-alt w-4 h-4 mr-2"></i>
                                        Kegiatan Masjid
                                    </a>
                                    <a href="{{ route('dkm.kategori.pemasukkan.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-arrow-up w-4 h-4 mr-2 text-green-500"></i>
                                        Pemasukkan
                                    </a>
                                    <a href="{{ route('dkm.kategori.pengeluaran.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-arrow-down w-4 h-4 mr-2 text-red-500"></i>
                                        Pengeluaran
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Kelola Dkm -->
                        <div class="menu-group">
                            <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                                <div class="flex items-center">
                                    <i class="fas fa-user-shield w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                    <span class="font-medium">Kelola Sistem</span>
                                </div>
                                <i class="fas fa-chevron-down transition-transform duration-200"></i>
                            </button>
                            <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="ml-8 mt-1 mb-2 space-y-1">
                                    <a href="{{ route('dkm.managePengguna.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-user-cog w-4 h-4 mr-2"></i>
                                        Kelola DKM
                                    </a>
                                    <a href="{{ route('dkm.manajemenPengaturan.backupData.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                        <i class="fas fa-database w-4 h-4 mr-2"></i>
                                        Backup Data
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-gray-200 bg-white">
            <form method="POST" action="{{ route('dkm.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-red-600 rounded-xl hover:bg-red-50 transition-all duration-200 group">
                    <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Sidebar & Menu Toggle Script -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var sidebar = document.getElementById('sidebar');
    var sidebarClose = document.getElementById('sidebarClose');
    if (sidebarClose) {
      sidebarClose.addEventListener('click', function() {
        sidebar.classList.add('-translate-x-full');
      });
    }
    var sidebarOpen = document.getElementById('sidebarOpen');
    if (sidebarOpen) {
      sidebarOpen.addEventListener('click', function() {
        sidebar.classList.remove('-translate-x-full');
      });
    }

    // Menu toggle
    var toggles = document.querySelectorAll('.menu-toggle');
    toggles.forEach(function(toggle) {
      toggle.addEventListener('click', function() {
        var submenu = toggle.parentElement.querySelector('.menu-submenu');
        var chevron = toggle.querySelector('.fa-chevron-down');
        if (submenu) {
          if (submenu.style.maxHeight && submenu.style.maxHeight !== '0px') {
            submenu.style.maxHeight = '0px';
            if (chevron) chevron.style.transform = '';
          } else {
            submenu.style.maxHeight = submenu.scrollHeight + 'px';
            if (chevron) chevron.style.transform = 'rotate(180deg)';
          }
        }
      });
    });
  });
</script>
