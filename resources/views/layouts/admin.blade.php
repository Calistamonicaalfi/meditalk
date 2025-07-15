<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') | MediTalk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f8fafc;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: #1e293b;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid #334155;
        }

        .sidebar-header h4 {
            margin: 0;
            font-weight: 700;
            color: #fff;
            font-size: 1.25rem;
        }

        .sidebar-header .logo-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            color: #8b5cf6;
        }

        .nav-menu {
            padding: 1.5rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            color: #94a3b8 !important;
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .nav-link:hover, .nav-link.active {
            background: #8b5cf6;
            color: white !important;
            transform: translateX(4px);
        }

        .nav-link i {
            margin-right: 12px;
            width: 16px;
            text-align: center;
            font-size: 1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        }

        .header {
            background: white;
            padding: 1.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h4 {
            margin: 0;
            font-weight: 600;
            color: #1e293b;
            font-size: 1.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #8b5cf6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .logout-btn {
            background: #ef4444;
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: #dc2626;
            color: white;
        }

        /* Content Wrapper */
        .content-wrapper {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            border-left: 4px solid #8b5cf6;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
        }

        .stat-icon {
            font-size: 1.5rem;
            color: #8b5cf6;
            margin-bottom: 0.5rem;
        }

        /* Buttons */
        .btn {
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #8b5cf6;
            border-color: #8b5cf6;
        }

        .btn-primary:hover {
            background: #7c3aed;
            border-color: #7c3aed;
        }

        .btn-outline-primary {
            color: #8b5cf6;
            border-color: #8b5cf6;
        }

        .btn-outline-primary:hover {
            background: #8b5cf6;
            border-color: #8b5cf6;
        }

        /* Tables */
        .table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .table thead th {
            background: #f8fafc;
            color: #374151;
            border: none;
            font-weight: 600;
            padding: 1rem;
            font-size: 0.875rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #f1f5f9;
        }

        /* Badges */
        .badge {
            border-radius: 6px;
            padding: 0.375rem 0.75rem;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Forms */
        .form-control, .form-select {
            border-radius: 6px;
            border-color: #d1d5db;
            font-size: 0.875rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 0.2rem rgba(139, 92, 246, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            font-size: 0.875rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }

        /* Utilities */
        .text-purple {
            color: #8b5cf6 !important;
        }

        .bg-purple {
            background-color: #8b5cf6 !important;
        }

        .border-purple {
            border-color: #8b5cf6 !important;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo-icon">
                <i class="fas fa-user-md"></i>
            </div>
            <h4>MediTalk Admin</h4>
            <small style="color: #94a3b8;">Panel Administrasi</small>
        </div>

        <nav class="nav-menu">
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.dokter.index') }}" class="nav-link {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}">
                    <i class="fas fa-user-md"></i> Manajemen Dokter
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('jadwal.index') }}" class="nav-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i> Jadwal Dokter
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.booking.index') }}" class="nav-link {{ request()->routeIs('admin.booking.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i> Data Booking
                </a>
            </div>

            <div class="nav-item">
                <a href="{{ route('article.index') }}" class="nav-link {{ request()->routeIs('article.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i> Artikel Kesehatan
                </a>
            </div>
        </nav>

        <div class="mt-auto p-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div>
                <h4>@yield('title', 'Dashboard')</h4>
                <small style="color: #64748b;">Selamat datang, {{ Auth::user()->name }}</small>
            </div>
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div style="font-weight: 600; color: #1e293b;">{{ Auth::user()->name }}</div>
                    <small style="color: #64748b;">{{ Auth::user()->role }}</small>
                </div>
            </div>
        </div>

        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
