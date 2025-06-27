<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MediTalk - Konsultasi Dokter Online')</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 1rem 0;
            margin-top: 40px;
        }
        .footer-text {
            text-align: center;
        }
        .hero {
            padding: 60px 0;
            background-color: #0d6efd;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">MediTalk</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dokter') }}">Dokter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('artikel') }}">Artikel</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    @hasSection('hero')
        @yield('hero')
    @else
        <div class="hero">
            <div class="container">
                <h1>Selamat Datang di MediTalk</h1>
                <p>Temukan dokter terbaik dan informasi kesehatan terpercaya</p>
            </div>
        </div>
    @endif

    <!-- Konten Utama -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="footer-text mb-0">© {{ date('Y') }} MediTalk - All rights reserved</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
