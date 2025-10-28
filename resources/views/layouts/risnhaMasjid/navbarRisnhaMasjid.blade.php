<nav class="bg-white shadow-sm fixed top-0 left-0 right-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('penggunaMasjid.risnhaMasjid.index') }}" class="flex items-center space-x-2.5 flex-shrink-0">
                    <div class="w-10 h-10 flex items-center justify-center shadow-sm">
                        <img src="{{ asset('images/logo_risnha.png') }}" alt="Logo Masjid Nurul Haq" >
                    </div>
                    <span class="font-semibold text-gray-900 text-base hidden sm:block">RISNHA</span>
                </a>

            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('penggunaMasjid.risnhaMasjid.index') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                    Beranda
                </a>
                <a href="{{ route('penggunaMasjid.risnhaMasjid.profileRisnha') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                    Profile
                </a>
                <a href="{{ route('penggunaMasjid.risnhaMasjid.kontenRisnha') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                    Konten
                </a>
                <a href="{{ route('penggunaMasjid.risnhaMasjid.galeriRisnhaMasjid') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                    Galeri
                </a>
                <a href="{{ route('index') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                    Dkm
                </a>
                <a href="{{ route('penggunaMasjid.risnhaMasjid.kontakRisnha') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                    Kontak
                </a>
            </div>

            <div class="hidden lg:flex items-center space-x-4">
                <div class="static-date text-xs font-medium text-gray-600 bg-gray-50 px-3 py-1.5 rounded-lg"></div>
                <a href="{{ route('risnha.login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
                    Login
                </a>
            </div>

            <button id="mobile-toggle" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="lg:hidden hidden border-t border-gray-100">
        <div class="px-4 py-3 space-y-1 max-h-[calc(100vh-4rem)] overflow-y-auto">
            <div class="static-date text-center text-sm font-medium text-gray-700 bg-gray-50 py-2 rounded-lg mb-3"></div>

            <a href="{{ route('penggunaMasjid.risnhaMasjid.index') }}" class="block text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                Beranda
            </a>
            <a href="{{route('penggunaMasjid.risnhaMasjid.kontenRisnha')}}" class="block text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                Konten
            </a>
            <a href="{{ route('penggunaMasjid.risnhaMasjid.galeriRisnhaMasjid') }}" class="block text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                Galeri
            </a>
            <a href="{{ route('index') }}" class="block text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                Dkm
            </a>
            <a href="{{ route('penggunaMasjid.risnhaMasjid.kontakRisnha') }}" class="block text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                Kontak
            </a>
            <a href="{{ route('penggunaMasjid.risnhaMasjid.profileRisnha') }}" class="block text-gray-700 hover:bg-blue-50 hover:text-blue-600 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                Profile
            </a>
            
            <div class="pt-3">
                <a href="{{ route('risnha.login') }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white px-3 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm">
                    Login
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="pt-16">
    </div>