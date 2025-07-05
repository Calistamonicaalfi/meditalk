<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') | MediTalk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 12px 15px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }

        .sidebar a.active {
            background-color: rgba(255,255,255,0.2);
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-item i {
            margin-right: 10px;
            width: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-user-md"></i> MediTalk Admin
        </div>
        
        <nav>
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </div>
            
            <div class="nav-item">
                <a href="{{ route('dokter.index') }}" class="{{ request()->routeIs('dokter.*') ? 'active' : '' }}">
                    <i class="fas fa-user-md"></i> Manajemen Dokter
                </a>
            </div>
            
            <div class="nav-item">
                <a href="{{ route('jadwal.index') }}" class="{{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i> Jadwal Dokter
                </a>
            </div>
            
            <div class="nav-item">
                <a href="{{ route('admin.booking.index') }}" class="{{ request()->routeIs('admin.booking.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i> Data Booking
                </a>
            </div>
            
            <div class="nav-item">
                <a href="{{ route('article.index') }}" class="{{ request()->routeIs('article.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i> Artikel Kesehatan
                </a>
            </div>
        </nav>
        
        <div style="margin-top: 50px;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h4 class="mb-0">@yield('title', 'Dashboard')</h4>
            <small class="text-muted">Selamat datang, {{ Auth::user()->name }}</small>
        </div>
        
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>