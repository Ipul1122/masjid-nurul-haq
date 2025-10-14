<nav class="bg-white shadow-md fixed top-0 left-0 right-0 z-30">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-mosque text-white text-lg"></i>
                    </div>
                    <h1 class="font-bold text-lg text-gray-800 leading-tight">Masjid Nurul Haq</h1>
                </a>
            </div>

            <div class="hidden md:flex md:items-center">
                <div class="ml-10 flex items-baseline space-x-1">
                    <a href="/" class="text-gray-700 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                    <div class="relative group">
                        <button class="flex items-center text-gray-700 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium focus:outline-none">
                            <span>Profil</span> <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md mt-1 py-1 w-48 z-40">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50">Visi Misi</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50">Sejarah Masjid</a>
                        </div>
                    </div>
                    <a href="{{ route('penggunaMasjid.lihatKonten.kontenMasjid') }}" class="text-gray-700 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium">Konten</a>
                    <a href="#" class="text-gray-700 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium">Keuangan</a>
                    <a href="#" class="text-gray-700 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium">Galeri</a>
                    <a href="#" class="text-gray-700 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium">Risnha</a>
                </div>
                
                <div class="live-clock-display text-sm font-medium text-gray-600 ml-6"></div>

                <a href="{{ route('dkm.login') }}" class="ml-6 bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                    Login
                </a>
            </div>

            <div class="-mr-2 flex md:hidden">
                <button id="mobile-menu-button" type="button" class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-emerald-600 hover:bg-gray-100 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <i id="mobile-menu-icon" class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t">
            
            <div class="live-clock-display text-center text-gray-700 py-3 text-sm font-medium border-b mb-2"></div>

            <a href="/" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
            <div>
                <button class="mobile-dropdown-toggle w-full flex justify-between items-center text-gray-700 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">
                    <span>Profil</span>
                    <i class="fas fa-chevron-down text-sm transition-transform duration-200"></i>
                </button>
                <div class="mobile-dropdown-menu hidden pl-4 mt-1 space-y-1">
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50">Visi Misi</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50">Sejarah Masjid</a>
                </div>
            </div>
            <div>
                <button class="mobile-dropdown-toggle w-full flex justify-between items-center text-gray-700 hover:bg-gray-100 px-3 py-2 rounded-md text-base font-medium">
                    <span>Konten</span>
                    <i class="fas fa-chevron-down text-sm transition-transform duration-200"></i>
                </button>
                <div class="mobile-dropdown-menu hidden pl-4 mt-1 space-y-1">
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50">Artikel</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50">Kegiatan Masjid</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:bg-gray-50">Jadwal Masjid</a>
                </div>
            </div>
            <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Keuangan</a>
            <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Galeri</a>
            <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Risnha</a>
            <div class="border-t border-gray-200 my-2"></div>
            <a href="dkm/login.blade.php" class="block text-center bg-blue-600 text-white hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium">Login</a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- Logika untuk menu mobile ---
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('mobile-menu-icon');
        menuButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('fa-bars');
            menuIcon.classList.toggle('fa-times');
        });

        const dropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
        dropdownToggles.forEach(button => {
            button.addEventListener('click', () => {
                const dropdownMenu = button.nextElementSibling;
                const icon = button.querySelector('i');
                dropdownMenu.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });

        // --- [DISESUAIKAN] Logika untuk Jam Responsif ---
        // Menggunakan class selector untuk menargetkan kedua elemen jam
        const clockElements = document.querySelectorAll('.live-clock-display');

        function updateClock() {
            const now = new Date();
            const options = {
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            const formattedTime = now.toLocaleString('id-ID', options).replace(/\./g, ':');
            
            // Memperbarui setiap elemen jam yang ditemukan
            clockElements.forEach(element => {
                element.textContent = formattedTime;
            });
        }

        updateClock();
        setInterval(updateClock, 1000);
    });
</script>