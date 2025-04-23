<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>KostFinder</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('asset/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('asset/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Main CSS File -->
    <link href="{{ asset('asset/css/main2.css') }}" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

    </style>

    @yield('styles')
</head>

<body class="index-page">
    <header id="header" class="header">
        <div class="header-container">
            <a href="{{ route('index') }}" class="logo">
                <img src="{{ asset('asset/img/icon-kostfinder.png') }}" alt="KostFinder Logo">
                <h1>KostFinder</h1>
            </a>

            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('index') }}"
                            class="{{ request()->routeIs('index') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="{{ route('keunggulan') }}"
                            class="{{ request()->routeIs('keunggulan') ? 'active' : '' }}">Keunggulan</a></li>
                    <li><a href="{{ route('fitur') }}"
                            class="{{ request()->routeIs('fitur') ? 'active' : '' }}">Fitur</a></li>

                </ul>
                <la>
                    <li><a href="{{ route('infografis') }}"
                            class="{{ request()->routeIs('infografis') ? 'active' : '' }}">Infografis</a></li>
                    <li><a href="{{ route('map') }}" class="{{ request()->routeIs('map') ? 'active' : '' }}">Peta</a>
                    </li>
                    <li><a href="{{ route('table-point') }}"
                            class="{{ request()->routeIs('table-point') ? 'active' : '' }}">Tabel</a></li>
                </la>
            </nav>

            @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-getstartedOK"><i class="fa-solid fa-right-from-bracket"></i>
                        Keluar</button>
                </form>
            @else
            <a class="btn-getstartedOK" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i>
                    Masuk</a>
            @endif
        </div>
    </header>

    <!-- Mobile Navigation -->
    <div class="overlay" id="overlay"></div>
    <div class="mobile-nav" id="mobileNav">
        <ul>
            <li><a href="{{ route('index') }}" class="active">Beranda</a></li>
            <li><a href="{{ route('keunggulan') }}">Keunggulan</a></li>
            <li><a href="{{ route('fitur') }}">Fitur</a></li>
            <li><a href="{{ route('infografis') }}">Infografis</a></li>
            <li><a href="{{ route('map') }}">Peta</a></li>
            <li><a href="{{ route('table-point') }}">Tabel</a></li>
            @if (Auth::check())
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-getstarted" >  Keluar</button>
                    </form>
                </li>
            @else
                <li><a class="btn-getstarted" href="{{ route('login') }}"> Masuk</a></li>
            @endif
        </ul>
    </div>

    @yield('content')

    <footer class="footer" >
            <p style="font-size: 13px">Hak Cipta © 2025 EDGIZE. Semua Hak Dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Mobile Menu Toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileNav = document.getElementById('mobileNav');
        const overlay = document.getElementById('overlay');

        mobileMenuToggle.addEventListener('click', () => {
            mobileNav.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : 'auto';
        });

        overlay.addEventListener('click', () => {
            mobileNav.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        // Close mobile menu when clicking on a link
        const mobileLinks = document.querySelectorAll('.mobile-nav a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileNav.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
