<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MediTalk - Konsultasi Dokter Online')</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-weight: 700;
            color: #667eea !important;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin: 0 5px;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white !important;
            transform: translateY(-1px);
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        footer {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .footer-text {
            text-align: center;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .badge {
            border-radius: 20px;
            padding: 0.5rem 1rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        .dropdown-menu {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .dropdown-item {
            border-radius: 8px;
            margin: 2px 8px;
            padding: 8px 12px;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.3rem;
            }
            
            .navbar-nav .nav-link {
                margin: 2px 0;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-heartbeat me-2"></i>MediTalk
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dokter.*') ? 'active' : '' }}" href="{{ route('dokter.index') }}">
                            <i class="fas fa-user-md me-1"></i>Dokter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('artikel.*') ? 'active' : '' }}" href="{{ route('artikel.index') }}">
                            <i class="fas fa-newspaper me-1"></i>Artikel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('booking.*') ? 'active' : '' }}" href="{{ route('booking') }}">
                            <i class="fas fa-calendar-plus me-1"></i>Booking
                        </a>
                    </li>
                    @if(Auth::check() && Auth::user()->role === 'pasien')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pasien.dashboard') }}">
                                <i class="fas fa-columns me-1"></i>Riwayat Booking
                            </a>
                        </li>
                    @endif
                    @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }} <span class="badge bg-secondary text-white text-capitalize">{{ Auth::user()->role }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><span class="dropdown-item-text"><i class="fas fa-envelope me-2"></i>{{ Auth::user()->email }}</span></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div style="padding-top: 80px;">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-heartbeat me-2"></i>MediTalk</h5>
                    <p class="small">Platform konsultasi dokter online terpercaya untuk kesehatan keluarga Anda.</p>
                </div>
                <div class="col-md-4">
                    <h6>Layanan</h6>
                    <ul class="list-unstyled small">
                        <li><i class="fas fa-user-md me-2"></i>Konsultasi Dokter</li>
                        <li><i class="fas fa-calendar-alt me-2"></i>Booking Online</li>
                        <li><i class="fas fa-newspaper me-2"></i>Artikel Kesehatan</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>Kontak</h6>
                    <ul class="list-unstyled small">
                        <li><i class="fas fa-phone me-2"></i>+62 123 456 789</li>
                        <li><i class="fas fa-envelope me-2"></i>info@meditalk.com</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <hr class="my-3" style="border-color: rgba(255,255,255,0.2);">
            <p class="footer-text mb-0">© {{ date('Y') }} MediTalk - Calista Monica Alfi | All rights reserved</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
