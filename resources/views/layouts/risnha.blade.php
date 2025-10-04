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

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">RISNHA</h4>
        <a href="{{ route('risnha.dashboard') }}"><i class="fa fa-home me-2"></i> Dashboard</a>
        {{-- <a href="{{ route('risnha.kategori-kegiatan.create') }}" class="fa fa-home me-3">Kategori</a> --}}
        <a href="#"><i class="fa fa-newspaper me-2"></i> Artikel Remaja</a>
        <a href="#"><i class="fa fa-image me-2"></i> Media</a>
        <a href="#"><i class="fa fa-comments me-2"></i> Forum / Aspirasi</a>
        <a href="#"><i class="fa fa-calendar-days me-2"></i> Kalender</a>
        <a href="#"><i class="fa fa-bell me-2"></i> Notifikasi</a>
        <a href="#"><i class="fa fa-users me-2"></i> Struktur Organisasi</a>
        <a href="{{ route('risnha.logout') }}"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand">Dashboard Risnha</span>
            <div class="d-flex">
                <span class="me-3">
                    Halo, {{ \App\Models\Risnha::find(session('risnha_id'))->username ?? 'Guest' }}
                </span>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="content mt-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
