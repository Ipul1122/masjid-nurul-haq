  <!-- Navbar -->
    <nav class="bg-white shadow-sm fixed top-0 left-0 right-0 z-50 border-b border-gray-100 ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2.5 flex-shrink-0">
                    <div class="w-9 h-9 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-sm">
                        <i class="fas fa-mosque text-white text-base"></i>
                    </div>
                    <span class="font-semibold text-gray-900 text-base hidden sm:block">Masjid Nurul Haq</span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('index') }}" class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                        Beranda
                    </a>
                    
                    <!-- Dropdown Profil -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <span>Profil</span>
                            <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                        </button>
                        <div class="absolute left-0 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 py-1">
                            <a href="{{ route('penggunaMasjid.profile.visiMisiMasjid') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">Visi Misi</a>
                            <a href="{{ route('penggunaMasjid.profile.sejarahMasjid') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">Sejarah Masjid</a>
                        </div>
                    </div>

                    <a href="{{ route('penggunaMasjid.lihatKonten.kontenMasjid') }}" class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                        Konten
                    </a>
                    <a href="{{ route('penggunaMasjid.keuanganMasjid.index') }}" class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                        Keuangan
                    </a>
                    <a href="{{ route('penggunaMasjid.galeriMasjid.index') }}" class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                        Galeri
                    </a>
                    <a href="#" class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                        Risnha
                    </a>
                    <a href="{{ route('penggunaMasjid.kontakMasjid.index') }}" class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                        Kontak
                    </a>
                    <a href="{{ route('penggunaMasjid.donasi.index') }}" class="text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                        Donasi
                    </a>
                </div>

                <!-- Clock & Login -->
                <div class="hidden lg:flex items-center space-x-4">
                    <div class="live-clock text-xs font-medium text-gray-600 bg-gray-50 px-3 py-1.5 rounded-lg"></div>
                    <a href="{{ route('dkm.login') }}" class="bg-blue-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
                        Login
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-toggle" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden hidden border-t border-gray-100">
            <div class="px-4 py-3 space-y-1 max-h-[calc(100vh-4rem)] overflow-y-auto">
                <!-- Clock Mobile -->
                <div class="live-clock text-center text-sm font-medium text-gray-700 bg-gray-50 py-2 rounded-lg mb-3"></div>

                <a href="{{ route('index') }}" class="block text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                    Beranda
                </a>
                
                <!-- Mobile Dropdown -->
                <div>
                    <button class="mobile-dropdown-toggle w-full flex justify-between items-center text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                        <span>Profil</span>
                        <i class="fas fa-chevron-down text-xs transition-transform"></i>
                    </button>
                    <div class="mobile-dropdown-content hidden mt-1 ml-4 space-y-1">
                        <a href="{{ route('penggunaMasjid.profile.visiMisiMasjid') }}" class="block text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 px-3 py-2 rounded-lg text-sm transition-colors">Visi Misi</a>
                        <a href="{{route('penggunaMasjid.profile.sejarahMasjid')}}" class="block text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 px-3 py-2 rounded-lg text-sm transition-colors">Sejarah Masjid</a>
                    </div>
                </div>

                <a href="{{route('penggunaMasjid.lihatKonten.kontenMasjid')}}" class="block text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                    Konten
                </a>
                <a href="{{route('penggunaMasjid.keuanganMasjid.index')}}" class="block text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                    Keuangan
                </a>
                <a href="{{ route('penggunaMasjid.galeriMasjid.index') }}" class="block text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                    Galeri
                </a>
                <a href="#" class="block text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                    Risnha
                </a>
                <a href="{{ route('penggunaMasjid.kontakMasjid.index') }}" class="block text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                    Kontak
                </a>
                <a href="{{ route('penggunaMasjid.kontakMasjid.index') }}" class="block text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                    Donasi
                </a>
                
                <div class="pt-3">
                    <a href="{{ route('dkm.login') }}" class="block text-center bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    

    <script>
        // Mobile Menu Toggle
        const mobileToggle = document.getElementById('mobile-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileIcon = mobileToggle.querySelector('i');

        mobileToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileIcon.classList.toggle('fa-bars');
            mobileIcon.classList.toggle('fa-times');
        });

        // Mobile Dropdown
        const dropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const content = toggle.nextElementSibling;
                const icon = toggle.querySelector('i');
                content.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });

        // Live Clock
        const clockElements = document.querySelectorAll('.live-clock');
        
        function updateClock() {
            const now = new Date();
            const options = {
                weekday: 'short',
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            const time = now.toLocaleString('id-ID', options);
            
            clockElements.forEach(el => {
                el.textContent = time;
            });
        }

        updateClock();
        setInterval(updateClock, 1000);

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.add('hidden');
                mobileIcon.classList.remove('fa-times');
                mobileIcon.classList.add('fa-bars');
            }
        });
    </script>