<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --default-font: "Poppins", sans-serif;
            --heading-font: "Poppins", sans-serif;
            --nav-font: "Poppins", sans-serif;
            --brand-font: "Righteous", sans-serif;
            --background-color: #F9EDE3;
            --default-color: #ffffff;
            --heading-color: #ffffff;
            --accent-color: #673E42;
            --surface-color: #6B4145;
            --contrast-color: #ffffff;
            --nav-color: #6B4145;
            --nav-hover-color: #673E42;
            --text-color: #4F5153;
            --transition-speed: 0.3s;
            --shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 5px 15px rgba(0, 0, 0, 0.2);
            --border-radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--default-font);
            color: var(--text-color);
            background-color: var(--background-color);
            line-height: 1.6;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styles */
        .header {
            background-color: var(--default-color);
            box-shadow: var(--shadow);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 997;
            padding: 15px 15px;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            gap: 10px;
        }

        .logo img {
            height: 40px;
            width: auto;
        }

        .logo h1 {
            font-family: var(--brand-font);
            color: var(--accent-color);
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* Navigation Styles */
        .navmenu {
            display: flex;
            align-items: center;
        }

        .navmenu ul,
        .navmenu la {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        .navmenu a {
            font-family: var(--nav-font);
            color: var(--nav-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            padding: 8px 12px;
            border-radius: var(--border-radius);
            transition: all var(--transition-speed) ease;
            position: relative;
        }

        .navmenu a:hover,
        .navmenu a.active {
            color: var(--nav-hover-color);
        }

        .navmenu a.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background-color: var(--accent-color);
        }

        /* Button Styles */
        .btn-getstartedOK,
        .btn-getstarted {
            background-color: var(--accent-color);
            color: var(--contrast-color);
            border: none;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            font-family: var(--nav-font);
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-getstartedOK:hover,
        .btn-getstarted:hover {
            background-color: var(--surface-color);
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--accent-color);
            cursor: pointer;
            padding: 5px;
        }

        /* Mobile Navigation */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-speed) ease;
        }

        .mobile-nav {
            position: fixed;
            top: 0;
            right: -100%;
            width: 280px;
            height: 100%;
            background-color: var(--default-color);
            z-index: 10000;
            overflow-y: auto;
            transition: all var(--transition-speed) ease;
            padding: 80px 20px 20px;
        }

        .mobile-nav ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .mobile-nav a,
        .mobile-nav .btn-getstarted {
            display: block;
            padding: 12px 15px;
            color: var(--nav-color);
            text-decoration: none;
            font-family: var(--nav-font);
            font-weight: 500;
            border-radius: var(--border-radius);
            transition: all var(--transition-speed) ease;
        }

        .mobile-nav a:hover,
        .mobile-nav a.active {
            background-color: rgba(107, 65, 69, 0.1);
            color: var(--nav-hover-color);
        }

        .mobile-nav .btn-getstarted {
            background-color: var(--accent-color);
            color: var(--contrast-color);
            text-align: center;
            margin-top: 20px;
        }

        .mobile-nav .btn-getstarted:hover {
            background-color: var(--surface-color);
        }

        /* Footer Styles */
        .footer {
            flex-shrink: 0;
            background-color: var(--surface-color);
            color: var(--contrast-color);
            text-align: center;
            padding: 20px;
            font-family: var(--default-font);
            font-size: 0.9rem;
            width: 100%;
            margin-top: auto;
            /* Pastikan footer selalu di bawah */
        }

        /* Main Content Padding */
        .main {
            padding-top: 80px;
            min-height: calc(100vh - 120px);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .navmenu {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .btn-getstartedOK {
                display: none;
            }

            .header-container {
                padding: 0 15px;
            }
        }

        @media (max-width: 768px) {
            .logo h1 {
                font-size: 1.3rem;
            }

            .logo img {
                height: 35px;
            }

            .mobile-nav {
                width: 250px;
            }
        }

        @media (max-width: 576px) {
            .logo h1 {
                font-size: 1.1rem;
            }

            .logo img {
                height: 30px;
            }

            .footer p {
                font-size: 0.8rem;
            }
        }

        /* Zoom Responsive Adjustments */
        @media (max-width: 400px),
        (max-height: 400px) {
            .logo h1 {
                font-size: 1rem;
            }

            .logo img {
                height: 25px;
            }

            .mobile-nav {
                width: 220px;
                padding-top: 70px;
            }

            .mobile-nav a,
            .mobile-nav .btn-getstarted {
                padding: 10px 12px;
                font-size: 0.9rem;
            }

            .footer p {
                font-size: 0.7rem;
            }
        }

        /* Large Screen Adjustments */
        @media (min-width: 1600px) {
            .header-container {
                max-width: 1400px;
            }

            .navmenu a {
                font-size: 1.1rem;
                padding: 10px 15px;
            }

            .btn-getstartedOK {
                padding: 12px 25px;
                font-size: 1.1rem;
            }
        }

        /* Active States for Mobile Nav */
        .mobile-nav.active {
            right: 0;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Animation for Mobile Menu */
        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
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

                <a href="{{ route('index') }}" class="{{ request()->routeIs('index') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('keunggulan') }}"
                    class="{{ request()->routeIs('keunggulan') ? 'active' : '' }}">Keunggulan</a>
                <a href="{{ route('fitur') }}" class="{{ request()->routeIs('fitur') ? 'active' : '' }}">Fitur</a>
                <a href="{{ route('infografis') }}"
                    class="{{ request()->routeIs('infografis') ? 'active' : '' }}">Infografis</a>
                <a href="{{ route('map') }}" class="{{ request()->routeIs('map') ? 'active' : '' }}">Peta</a>
                <a href="{{ route('table-point') }}"
                    class="{{ request()->routeIs('table-point') ? 'active' : '' }}">Tabel</a>

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
            <li><a href="{{ route('index') }}" class="{{ request()->routeIs('index') ? 'active' : '' }}">Beranda</a>
            </li>
            <li><a href="{{ route('keunggulan') }}"
                    class="{{ request()->routeIs('keunggulan') ? 'active' : '' }}">Keunggulan</a></li>
            <li><a href="{{ route('fitur') }}" class="{{ request()->routeIs('fitur') ? 'active' : '' }}">Fitur</a>
            </li>
            <li><a href="{{ route('infografis') }}"
                    class="{{ request()->routeIs('infografis') ? 'active' : '' }}">Infografis</a></li>
            <li><a href="{{ route('map') }}" class="{{ request()->routeIs('map') ? 'active' : '' }}">Peta</a></li>
            <li><a href="{{ route('table-point') }}"
                    class="{{ request()->routeIs('table-point') ? 'active' : '' }}">Tabel</a></li>
            @if (Auth::check())
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-getstarted">Keluar</button>
                    </form>
                </li>
            @else
                <li><a class="btn-getstarted" href="{{ route('login') }}">Masuk</a></li>
            @endif
        </ul>
    </div>

    @yield('content')

    <footer class="footer">
        <p>Hak Cipta © 2025 Edgize. Semua Hak Dilindungi.</p>
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
