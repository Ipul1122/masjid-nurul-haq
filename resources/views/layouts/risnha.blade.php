<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risnha | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #198754; /* hijau islami */
            color: #fff;
            position: fixed;
            top: 0; left: 0;
            padding-top: 60px;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #fff;
            text-decoration: none;
            transition: 0.2s;
        }
        .sidebar a:hover {
            background: #157347;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
        .navbar {
            position: fixed;
            top: 0; left: 240px; right: 0;
            z-index: 1000;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    @include('layouts.sidebarRisnha')

    {{-- Navbar --}}
    @include('layouts.navbarRisnha')

    {{-- Content --}}
    <div class="content mt-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script untuk notifikasi real-time --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notifBadge = document.getElementById('notification-badge');

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
                    .catch(error => console.error('Error fetching notification count:', error));
            }

            // Panggil fungsi setiap 10 detik
            setInterval(fetchNotifCount, 10000);

            // Panggil sekali saat halaman dimuat
            fetchNotifCount();
        });
    </script>
</body>
</html>
