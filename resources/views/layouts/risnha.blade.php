<!-- ==================== FILE 1: layouts/risnha.blade.php ==================== -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risnha | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    
    <style>
        :root {
            --primary-color: #198754;
            --primary-dark: #157347;
            --sidebar-width: 240px;
            --navbar-height: 60px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: #f8f9fa;
            color: #333;
            position: fixed;
            top: var(--navbar-height);
            left: 0;
            padding: 0;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 999;
            border-right: 1px solid #e0e0e0;
        }

        /* Sidebar Header */
        .sidebar-header {
            background: var(--primary-color);
            color: #fff;
            padding: 20px;
            text-align: center;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }

        .sidebar-header .logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .sidebar-header h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .sidebar-header p {
            margin: 0;
            font-size: 0.8rem;
            opacity: 0.9;
        }

        /* Sidebar User Info */
        .sidebar-user {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-user-avatar {
            width: 45px;
            height: 45px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .sidebar-user-info h5 {
            margin: 0;
            font-weight: 600;
            font-size: 0.95rem;
            color: #333;
        }

        .sidebar-user-info p {
            margin: 0;
            font-size: 0.75rem;
            color: #999;
        }

        /* Sidebar Menu */
        .sidebar-menu {
            padding: 10px 0;
        }

        .sidebar-menu-item {
            position: relative;
        }

        .sidebar-menu-item a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #555;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }

        .sidebar-menu-item a:hover {
            background: #f0f0f0;
            color: var(--primary-color);
            padding-left: 25px;
        }

        .sidebar-menu-item a i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        /* Submenu */
        .sidebar-menu-item.has-submenu > a::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-left: auto;
            font-size: 0.7rem;
            transition: transform 0.3s ease;
        }

        .sidebar-menu-item.has-submenu.active > a::after {
            transform: rotate(-180deg);
        }

        .sidebar-submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: #fafafa;
        }

        .sidebar-menu-item.active .sidebar-submenu {
            max-height: 500px;
        }

        .sidebar-submenu a {
            padding: 10px 20px 10px 52px;
            font-size: 0.9rem;
            color: #777;
            border-left: 2px solid #ddd;
        }

        .sidebar-submenu a:hover {
            color: var(--primary-color);
            border-left-color: var(--primary-color);
            background: #f5f5f5;
        }

        /* Logout */
        .sidebar-logout {
            padding: 20px;
            border-top: 1px solid #e0e0e0;
            margin-top: auto;
        }

        .sidebar-logout a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            background: #fff3cd;
            color: #d63031;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .sidebar-logout a:hover {
            background: #ffebcd;
            color: #c92a2a;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--navbar-height);
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            z-index: 1001;
            padding: 0 15px;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.3rem;
        }

        .navbar-text {
            font-size: 0.85rem;
            color: #666;
        }

        .navbar-user {
            font-size: 0.9rem;
            color: #333;
        }

        /* Hamburger Menu */
        .hamburger-menu {
            display: none;
            background: none;
            border: none;
            color: var(--primary-color);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 8px 12px;
            margin-right: 15px;
        }

        /* ===== CONTENT ===== */
        .content {
            margin-top: var(--navbar-height);
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: calc(100vh - var(--navbar-height));
        }

        /* ===== MOBILE (max-width: 768px) ===== */
        @media (max-width: 768px) {
            :root {
                --sidebar-width: 0;
            }

            .hamburger-menu {
                display: block;
            }

            .sidebar {
                width: 250px;
                transform: translateX(-100%);
                box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
                padding: 15px;
            }

            /* Overlay ketika sidebar aktif */
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: var(--navbar-height);
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 998;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .navbar {
                left: 0;
            }

            .navbar-text {
                display: none;
            }

            .navbar-brand {
                font-size: 1.1rem;
            }
        }

        /* ===== TABLET (768px - 1024px) ===== */
        @media (min-width: 769px) and (max-width: 1024px) {
            .navbar-text {
                font-size: 0.8rem;
            }
        }

        /* Scrollbar untuk sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f0f0f0;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #bbb;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    @include('layouts.navbarRisnha')

    {{-- Sidebar --}}
    @include('layouts.sidebarRisnha')

    {{-- Sidebar Overlay (untuk mobile) --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- Content --}}
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    
    <script>
        // Hamburger Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.getElementById('hamburgerMenu');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (hamburger) {
                hamburger.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                });
            }

            // Tutup sidebar ketika link diklik
            const sidebarLinks = document.querySelectorAll('.sidebar a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            });

            // Tutup sidebar ketika overlay diklik
            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }

            // Notifikasi real-time
            const notifBadge = document.getElementById('notification-badge');
            if (notifBadge) {
                function fetchNotifCount() {
                    fetch('{{ route('risnha.notifikasiRisnha.count') }}')
                        .then(response => response.json())
                        .then(data => {
                            if (data.count > 0) {
                                notifBadge.innerText = data.count;
                                notifBadge.style.display = 'inline-block';
                            } else {
                                notifBadge.innerText = '';
                                notifBadge.style.display = 'none';
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
                setInterval(fetchNotifCount, 10000);
                fetchNotifCount();
            }
        });
    </script>
</body>
</html>