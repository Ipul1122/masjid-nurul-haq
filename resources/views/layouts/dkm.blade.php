<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Masjid Nurul Haq') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom Scrollbar Styles */
        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }
        .scrollbar-thin::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Firefox scrollbar */
        .scrollbar-thin {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 z-40 w-72 h-screen transition-transform duration-300 transform -translate-x-full lg:translate-x-0 bg-white shadow-xl border-r border-gray-200">
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
        <div class="flex flex-col flex-1 min-h-0">
            <!-- Scrollable Menu Area -->
            <nav class="flex-1 overflow-y-auto p-4 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100" id="sidebarNav">
                <!-- User Profile Section -->
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
                <div class="space-y-2 pb-4">
                    <!-- Dashboard -->
                    <a href="{{route('dkm.dashboard')}}" class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                        <i class="fas fa-chart-line w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Manage Pengguna -->
                    <div class="menu-group">
                        <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                            <div class="flex items-center">
                                <i class="fas fa-users w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                <span class="font-medium">Manage Pengguna</span>
                            </div>
                            <i class="fas fa-chevron-down transition-transform duration-200"></i>
                        </button>
                        <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="ml-8 mt-2 mb-2 space-y-1">
                                <a href="{{ route('dkm.managePengguna.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                    <i class="fas fa-user-cog w-4 h-4 mr-2"></i>
                                    Kelola Pengguna
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Manage Konten -->
                    <div class="menu-group">
                        <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                            <div class="flex items-center">
                                <i class="fas fa-edit w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                <span class="font-medium">Manage Konten</span>
                            </div>
                            <i class="fas fa-chevron-down transition-transform duration-200"></i>
                        </button>
                        <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="ml-8 mt-2 mb-2 space-y-1">
                                <a href="{{ route('dkm.manajemenKonten.kegiatanMasjid.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                    <i class="fas fa-calendar-alt w-4 h-4 mr-2"></i>
                                    Kegiatan Masjid
                                </a>
                                <a href="{{ route('dkm.manajemenKonten.artikel.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                    <i class="fas fa-newspaper w-4 h-4 mr-2"></i>
                                    Artikel
                                </a>
                                <a href="{{ route('dkm.manajemenKonten.jadwalImam.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                    <i class="fas fa-clock w-4 h-4 mr-2"></i>
                                    Jadwal Imam
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Manage Keuangan -->
                    <div class="menu-group">
                        <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                            <div class="flex items-center">
                                <i class="fas fa-wallet w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                <span class="font-medium">Manage Keuangan</span>
                            </div>
                            <i class="fas fa-chevron-down transition-transform duration-200"></i>
                        </button>
                        <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="ml-8 mt-2 mb-2 space-y-1">
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

                    <!-- Manage Fasilitas -->
                    <div class="menu-group">
                        <button class="menu-toggle w-full flex items-center justify-between px-4 py-3 text-gray-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-200 group">
                            <div class="flex items-center">
                                <i class="fas fa-building w-5 h-5 mr-3 group-hover:text-emerald-600"></i>
                                <span class="font-medium">Manage Fasilitas</span>
                            </div>
                            <i class="fas fa-chevron-down transition-transform duration-200"></i>
                        </button>
                        <div class="menu-submenu max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="ml-8 mt-2 mb-2 space-y-1">
                                <a href="{{ route('dkm.manajemenFasilitas.galeri.index') }}" class="block px-4 py-2 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                                    <i class="fas fa-images w-4 h-4 mr-2"></i>
                                    Manage Galeri
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Fixed Logout Button at Bottom -->
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

    <!-- Mobile Navbar -->
    <header class="lg:hidden fixed top-0 left-0 right-0 z-30 bg-white shadow-md">
        <div class="flex items-center justify-between px-4 py-3">
            <button id="sidebarToggle" class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="font-bold text-lg text-gray-900">Masjid Nurul Haq</h1>
            <div class="flex items-center space-x-2">
                <!-- Notifikasi -->
                <a href="{{ route('dkm.notifikasi.index') }}" class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all">
                    <i class="fas fa-bell text-lg"></i>
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="lg:ml-72">
        <!-- Desktop Header -->
        <header class="hidden lg:block bg-white shadow-sm border-b border-gray-200">
            <div class="flex items-center justify-between px-6 py-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
                    <p class="text-gray-600">Selamat datang di panel administrasi</p>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Notifikasi -->
                    <a href="{{ route('dkm.notifikasi.index') }}" class="relative p-3 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-1 right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                    </a>
                    
                    <!-- User Menu -->
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

        <!-- Page Content -->
        <main class="p-4 lg:p-6 mt-16 lg:mt-0 min-h-screen bg-gray-50">
            @yield('content')
            
            {{-- <!-- Sample Content -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Konten Utama</h3>
                <p class="text-gray-600">Ini adalah area konten utama yang akan menampilkan berbagai halaman sesuai dengan menu yang dipilih.</p>
                
                <!-- Sample Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-6 rounded-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-indigo-600 font-medium">Total Pengguna</p>
                                <p class="text-2xl font-bold text-indigo-900">1,234</p>
                            </div>
                            <i class="fas fa-users text-3xl text-indigo-400"></i>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-green-50 to-emerald-100 p-6 rounded-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-emerald-600 font-medium">Kegiatan Aktif</p>
                                <p class="text-2xl font-bold text-emerald-900">25</p>
                            </div>
                            <i class="fas fa-calendar-alt text-3xl text-emerald-400"></i>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-amber-50 to-orange-100 p-6 rounded-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-orange-600 font-medium">Total Donasi</p>
                                <p class="text-2xl font-bold text-orange-900">Rp 15.5M</p>
                            </div>
                            <i class="fas fa-chart-line text-3xl text-orange-400"></i>
                        </div>
                    </div>
                </div>
            </div> --}}
        </main>
    </div>

    <!-- Backdrop untuk mobile -->
    <div id="sidebarBackdrop" class="fixed inset-0 z-30 bg-black bg-opacity-50 hidden lg:hidden"></div>

    <script>
        // Sidebar Toggle untuk Mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        sidebarToggle?.addEventListener('click', openSidebar);
        sidebarClose?.addEventListener('click', closeSidebar);
        backdrop?.addEventListener('click', closeSidebar);

        // Close sidebar saat window resize ke desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                closeSidebar();
            }
        });

        // Menu Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggles = document.querySelectorAll('.menu-toggle');
            const sidebarNav = document.getElementById('sidebarNav');
            
            menuToggles.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const menuGroup = this.closest('.menu-group');
                    const submenu = menuGroup.querySelector('.menu-submenu');
                    const chevron = this.querySelector('.fas.fa-chevron-down');
                    
                    // Check if submenu is currently open
                    const isOpen = submenu.classList.contains('menu-open');
                    
                    // Close all other submenus
                    document.querySelectorAll('.menu-submenu').forEach(otherSubmenu => {
                        if (otherSubmenu !== submenu) {
                            otherSubmenu.classList.remove('menu-open');
                            otherSubmenu.style.maxHeight = '0px';
                            const otherGroup = otherSubmenu.closest('.menu-group');
                            const otherChevron = otherGroup.querySelector('.fas.fa-chevron-down');
                            if (otherChevron) {
                                otherChevron.style.transform = 'rotate(0deg)';
                            }
                        }
                    });
                    
                    // Toggle current submenu
                    if (isOpen) {
                        // Close current menu
                        submenu.classList.remove('menu-open');
                        submenu.style.maxHeight = '0px';
                        chevron.style.transform = 'rotate(0deg)';
                    } else {
                        // Open current menu
                        submenu.classList.add('menu-open');
                        submenu.style.maxHeight = submenu.scrollHeight + 20 + 'px'; // Add extra space for padding
                        chevron.style.transform = 'rotate(180deg)';
                        
                        // Auto scroll to ensure opened menu is visible
                        setTimeout(() => {
                            const menuGroupRect = menuGroup.getBoundingClientRect();
                            const sidebarNavRect = sidebarNav.getBoundingClientRect();
                            const submenuHeight = submenu.scrollHeight;
                            
                            // Check if the expanded menu extends below the visible area
                            if (menuGroupRect.bottom + submenuHeight > sidebarNavRect.bottom) {
                                // Scroll to make the menu group visible
                                const scrollTop = sidebarNav.scrollTop;
                                const offsetTop = menuGroup.offsetTop - sidebarNav.offsetTop;
                                const targetScrollTop = offsetTop - 20; // 20px padding from top
                                
                                sidebarNav.scrollTo({
                                    top: targetScrollTop,
                                    behavior: 'smooth'
                                });
                            }
                        }, 300); // Wait for animation to complete
                    }
                });
            });

            // Active menu highlighting
            const currentPath = window.location.pathname;
            const menuLinks = document.querySelectorAll('nav a[href]');
            
            menuLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('bg-emerald-100', 'text-emerald-700', 'border-r-4', 'border-emerald-600');
                    
                    // If it's a submenu item, also expand its parent
                    const parentSubmenu = link.closest('.menu-submenu');
                    if (parentSubmenu) {
                        const parentGroup = parentSubmenu.closest('.menu-group');
                        const parentButton = parentGroup.querySelector('.menu-toggle');
                        const chevron = parentButton.querySelector('.fas.fa-chevron-down');
                        
                        parentSubmenu.classList.add('menu-open');
                        parentSubmenu.style.maxHeight = parentSubmenu.scrollHeight + 20 + 'px';
                        if (chevron) {
                            chevron.style.transform = 'rotate(180deg)';
                        }
                        
                        // Auto scroll to active menu
                        setTimeout(() => {
                            const linkRect = link.getBoundingClientRect();
                            const sidebarNavRect = sidebarNav.getBoundingClientRect();
                            
                            if (linkRect.bottom > sidebarNavRect.bottom || linkRect.top < sidebarNavRect.top) {
                                const offsetTop = parentGroup.offsetTop - sidebarNav.offsetTop;
                                sidebarNav.scrollTo({
                                    top: offsetTop - 20,
                                    behavior: 'smooth'
                                });
                            }
                        }, 100);
                    }
                }
            });
        });
    </script>
</body>
</html>