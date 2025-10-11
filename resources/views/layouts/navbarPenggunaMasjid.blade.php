<nav class="bg-white shadow-md fixed top-0 left-0 right-0 z-30">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0">
                 <a href="/" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-mosque text-white text-lg"></i>
                    </div>
                    <h1 class="font-bold text-lg text-gray-800 leading-tight">Masjid Nurul Haq</h1>
                </a>
            </div>

            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="/" class="text-gray-700 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                    <a href="#" class="text-gray-700 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium">Kegiatan</a>
                    <a href="#" class="text-gray-700 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium">Artikel</a>
                    <a href="#" class="text-gray-700 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium">Jadwal Imam</a>
                    <a href="#" class="text-gray-700 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium">Galeri</a>
                    <a href="#" class="text-gray-700 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium">Keuangan</a>
                </div>
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
            <a href="/" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
            <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Kegiatan</a>
            <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Artikel</a>
            <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Jadwal Imam</a>
            <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Galeri</a>
            <a href="#" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Keuangan</a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('mobile-menu-icon');

        menuButton.addEventListener('click', function () {
            const isMenuOpen = !mobileMenu.classList.contains('hidden');
            mobileMenu.classList.toggle('hidden');
            
            if (isMenuOpen) {
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            } else {
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-times');
            }
        });
    });
</script>