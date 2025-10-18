<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dkm | @yield('title')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

    {{-- Favicon dinamis --}}
    <link rel="icon" type="image/png" href="@yield('page-icon', asset('favicon.png'))"/>
    
    {{-- Tambahkan meta tag untuk CSRF Token agar bisa diakses oleh Fetch API --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .scrollbar-thin::-webkit-scrollbar { width: 6px; }
        .scrollbar-thin::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 3px; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        .scrollbar-thin::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .scrollbar-thin { scrollbar-width: thin; scrollbar-color: #cbd5e1 #f1f5f9; }
    </style>
</head>
<body class="bg-gray-50">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Navbar --}}
    @include('layouts.navbar')

    <div class="lg:ml-72">
        <main class="p-4 lg:p-6 mt-16 lg:mt-0 min-h-screen bg-gray-50">
            @yield('content')
        </main>
    </div>

    <div id="sidebarBackdrop" class="fixed inset-0 z-30 bg-black bg-opacity-50 hidden lg:hidden"></div>

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Script lama tetap --}}
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    
    {{-- Skrip Sidebar dan Menu Toggle Anda (TIDAK DIHAPUS) --}}
    <script>
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

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) { closeSidebar(); }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const menuToggles = document.querySelectorAll('.menu-toggle');
            menuToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const submenu = this.nextElementSibling;
                    const icon = this.querySelector('.menu-arrow');
                    
                    if (submenu && submenu.classList.contains('submenu')) {
                        submenu.classList.toggle('hidden');
                        icon.classList.toggle('rotate-180');
                    }
                });
            });
        });
    </script>
    
    {{-- ======================================================== --}}
    {{-- SCRIPT BARU UNTUK NOTIFIKASI (DITAMBAHKAN DI SINI) --}}
    {{-- ======================================================== --}}
    <script>
        /**
         * Fungsi global untuk sinkronisasi dan auto-delete notifikasi
         * serta memperbarui badge di navbar.
         */
        function autoDeleteAndSync() {
            // Ambil CSRF token dari meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route("dkm.notifikasi.autoDeleteOld") }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    // 1. Perbarui badge notifikasi di navbar
                    const notifBadge = document.getElementById('notification-badge'); // Pastikan ID ini ada di navbar Anda
                    if (notifBadge) {
                        notifBadge.textContent = data.count;
                        if (data.count > 0) {
                            notifBadge.style.display = 'inline-flex';
                        } else {
                            notifBadge.style.display = 'none';
                        }
                    }

                    // 2. Jika kita berada di halaman notifikasi, hapus baris yang sudah dihapus
                    if (window.location.pathname.includes('/dkm/notifikasi')) {
                        if (data.deleted > 0 && Array.isArray(data.deleted_ids)) {
                            data.deleted_ids.forEach(id => {
                                const row = document.querySelector(`tr[data-id="${id}"]`);
                                if (row) {
                                    row.remove();
                                }
                            });
                        }
                    }
                }
            })
            .catch(error => console.error('Error syncing notifications:', error));
        }

        // Jalankan fungsi ini setiap 15 detik
        setInterval(autoDeleteAndSync, 15000);

        // Jalankan sekali saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', autoDeleteAndSync);
    </script>
    
    {{-- Directive @yield('scripts') untuk menampung script dari halaman lain --}}
    @yield('scripts')
</body>
</html>