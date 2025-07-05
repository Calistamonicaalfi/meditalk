<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Pasien Panel') | MediTalk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            width: 240px;
            background-color: #198754;
            color: white;
            padding: 20px;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 8px 0;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #157347;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .header {
            background-color: #198754;
            color: white;
            padding: 15px 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Pasien Panel</h4>
        <hr>
        <a href="{{ route('pasien.dashboard') }}">Dashboard</a>
        <a href="{{ route('pasien.booking.index') }}">Riwayat Booking</a>
        <a href="{{ route('pasien.booking.create') }}">Booking Baru</a>
        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            <button class="btn btn-danger btn-sm w-100">Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h5>@yield('title', 'Dashboard')</h5>
        </div>
        <div class="p-3">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
