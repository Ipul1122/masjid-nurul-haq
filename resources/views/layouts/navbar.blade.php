<!-- Mobile Navbar -->
<header class="lg:hidden fixed top-0 left-0 right-0 z-30 bg-white shadow-md h-14">
    <div class="flex items-center justify-between px-4 py-3">
        <button id="sidebarToggle" class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <h1 class="font-bold text-lg text-gray-900">Masjid Nurul Haq</h1>
        <div class="flex items-center space-x-2">
            <a href="{{ route('dkm.notifikasi.index') }}" class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all">
                <i class="fas fa-bell text-lg"></i>
                @if($notifCount > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                        {{ $notifCount > 9 ? '9+' : $notifCount }}
                    </span>
                @endif
            </a>
        </div>
    </div>
</header>

<!-- Desktop Navbar -->
<header class="hidden lg:block fixed top-0 left-0 right-0 z-30 bg-white shadow-sm border-b border-gray-200 h-20">
    <div class="flex items-center justify-between px-6 py-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
            <p class="text-gray-600">Selamat datang di panel administrasi</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('dkm.notifikasi.index') }}" class="relative p-3 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all">
                <i class="fas fa-bell text-lg"></i>
                @if($notifCount > 0)
                    <span class="absolute top-1 right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                        {{ $notifCount > 9 ? '9+' : $notifCount }}
                    </span>
                @endif
            </a>
            <div class="flex items-center space-x-3 px-3 py-2 bg-gray-50 rounded-xl">
                <div class="w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div class="text-sm">
                    <p class="font-medium text-gray-900">Admin</p>
                    <p class="text-gray-600">Online </p>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Konten utama -->
<main class="pt-14 lg:pt-20">
    {{-- konten kamu disini --}}
</main>
