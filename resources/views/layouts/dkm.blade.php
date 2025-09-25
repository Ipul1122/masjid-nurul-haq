<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Masjid Nurul Haq') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

    <!-- Main Content -->
    <div class="lg:ml-72">
        <main class="p-4 lg:p-6 mt-16 lg:mt-0 min-h-screen bg-gray-50">
            @yield('content')
        </main>
    </div>

    <!-- Backdrop -->
    <div id="sidebarBackdrop" class="fixed inset-0 z-30 bg-black bg-opacity-50 hidden lg:hidden"></div>

    {{-- Script lama tetap --}}
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

        // Script toggle menu tetap sama seperti semula
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggles = document.querySelectorAll('.menu-toggle');
            const sidebarNav = document.getElementById('sidebarNav');
            // ... seluruh script lama tetap
        });
    </script>
</body>
</html>
