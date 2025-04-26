@extends('layouts.template')

@section('styles')
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
            --primary-color: #6B4145;
            --secondary-color: #673E42;
            --circle-bg-light: #E6DAD0;
            --circle-bg-dark: #DACFC5;
            --icon-bg: #B3A99E;
            --white: #ffffff;
            --header-bg: #E6C99E;
            --nav-hover: #673E42;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 10px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: all var(--transition-speed) ease;
            box-shadow: var(--shadow);
            text-align: center;

            font-size: 20px;

        }

        .btn-primary {
            background-color: #8F7059;
            color: white;
            border: 3px solid var(--primary-color);
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            border-radius: 12px;

        }

        .btn-primary:hover {
            color: white;
            background-color: #5b4636;
            border-color: #d6c5b8;
            box-shadow: var(--shadow-hover);
            transform: translateY(-3px);
        }

        /* Hero Section */
        .hero {
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }

        .hero .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
        }

        .hero-content {
            text-align: center;
            animation: fadeInUp 1s ease-out;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            margin-bottom: 30px;
            color: var(--primary-color);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero-content h2 {
            font-size: 1.8rem;
            margin-bottom: 30px;
            font-weight: 400;
            line-height: 1.3;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .hero-image {
            animation: float 6s ease-in-out infinite;
        }

        .hero-image img {
            animation: float 6s ease-in-out infinite;
            margin-left: auto;
            margin-top: 20px;
            padding-left: 20px;
            max-width: 100%;
            height: auto;
        }

        /* Features Section */
        .box4 {
            padding: 40px 50px;
            background-color: var(--light-bg);
        }

        .features-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;

        }

        .feature-item {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: var(--shadow);
            transition: all var(--transition-speed) ease;
            text-align: center;
            animation: fadeIn 1s ease-out;
            animation-fill-mode: both;
        }

        .feature-item:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }

        .feature-item:nth-child(1) {
            animation-delay: 0.4s;
        }

        .feature-item:nth-child(2) {
            animation-delay: 0.8s;
        }

        .feature-item:nth-child(3) {
            animation-delay: 0.12s;
        }

        .feature-item:nth-child(4) {
            animation-delay: 0.16s;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 1.8rem;
            transition: all var(--transition-speed) ease;
        }

        .feature-item:hover .icon-circle {
            transform: rotate(360deg);
            background-color: rgb(196, 165, 129);
        }

        .feature-text h3 {
            margin-bottom: 15px;
            font-size: 1.3rem;
            text-align: center;
        }

        /* About Section */
        .about-section {
            padding: 80px 30px;
            position: relative;
        }

        .about-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .about-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 50px;
            position: relative;
        }

        .about-image {
            display: flex;
            flex-direction: column;
            gap: 40px;
            align-items: center;
            z-index: 3;
        }

        .about-image img {
            z-index: 3;
            max-width: 50%;
            height: auto;
            border-radius: 20px;
            animation: fadeInRight 1s ease-out;
        }

        .about-content {
            text-align: center;
        }

        .circle-wrapper h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }

        .circle-wrapper h2 span:nth-child(1) {
            color: var(--primary-color);
        }

        .circle-wrapper h2 span:nth-child(2) {
            color: var(--text-color);
            font-weight: 700;
        }

        .circle-wrapper h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .about-description {
            max-width: 800px;
            margin: 0 auto;
            font-size: 1.1rem;
            line-height: 1.8;
            animation: fadeInUp 1s ease-out;
            text-align: justify;
        }

        /* SDGS Section */
        .sdgs-section {
            padding: 80px 0;
            background-color: var(--light-bg);
        }

        .sdgs-container {
            max-width: 1200px;
            margin: 0 auto;

            padding: 0 30px;
        }

        .sdgs-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 50px;
            position: relative;
        }

        .sdgs-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .sdgs-content-wrapper {
            display: flex;
            flex-direction: column;
            gap: 40px;
            align-items: center;
        }

        .sdgs-text-content {
            order: 2;
            max-width: 800px;
            margin: 0 auto;
            font-size: 1.1rem;
            line-height: 1.8;
            animation: fadeInUp 1s ease-out;
            text-align: justify;
        }

        .sdgs-content {
            margin-bottom: 30px;
            font-size: 1.1rem;
            line-height: 1.8;
            animation: fadeInUp 1s ease-out;
        }

        .sdgs-cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 40px;
        }

        .sdgs-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all var(--transition-speed) ease;
            width: 180px;
            animation: fadeIn 1s ease-out;
            animation-fill-mode: both;
        }

        .sdgs-card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .sdgs-card:nth-child(2) {
            animation-delay: 0.4s;
        }

        .sdgs-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
            transform: translateY(-3px);
        }

        .sdgs-card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            text-align: center;
        }

        .sdgs-card-body {
            padding: 20px;
            text-align: center;
            font-weight: 600;
        }

        .sdgs-image-container {
            order: 1;
            position: relative;
            animation: fadeIn 1s ease-out;
            margin-left: auto;
            /* Dorong ke kanan */
            padding-left: 30px;
            display: flex;
            justify-content: flex-end;
        }

        .sdgs-image {
            max-width: 70%;
            height: auto;
            position: relative;
            z-index: 2;
        }

        .circle-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            background-color: rgba(145, 89, 49, 0.64);
            border-radius: 50%;
            z-index: 1;
            animation: pulse 4s infinite ease-in-out;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.1;
            }

            50% {
                transform: translate(-50%, -50%) scale(1.1);
                opacity: 0.2;
            }

            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.1;
            }
        }

        /* Responsive Styles */
        @media (min-width: 768px) {

            .hero .container {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                text-align: left;
            }

            .hero-content {
                text-align: left;
                max-width: 50%;
            }

            .hero-buttons {
                justify-content: flex-start;
            }

            .about-container {
                flex-direction: row;
                text-align: left;
            }

            .about-content {
                text-align: left;
                max-width: 50%;
            }

            .about-image {
                padding-left: 40px;
            }

            .about-image img {
                max-width: 50%;
            }

            .sdgs-content-wrapper {
                flex-direction: row;
                justify-content: space-between;
            }

            .sdgs-text-content {
                order: 1;
                max-width: 50%;
            }

            .sdgs-image-container {
                order: 2;
            }

            .hero-image {
                max-width: 45%;
                /* Mengurangi lebar maksimum */
                padding-left: 40px;
                /* Jarak lebih besar di desktop */
            }
        }

        @media (min-width: 992px) {
            .hero-content h1 {
                font-size: 4rem;
            }

            .hero-content h2 {
                font-size: 2.2rem;
            }

            .about-description {
                font-size: 1.2rem;
            }

        }

        @media (max-width: 576px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content h2 {
                font-size: 1.4rem;
            }

            .hero-buttons .btn {
                width: 100%;
            }

            .features-container {
                grid-template-columns: 1fr;
            }

            .sdgs-title {
                text-align: center;
                font-size: 2rem;
                margin-bottom: 50px;
                position: relative;
            }

            .about-title {
                text-align: center;
                font-size: 2rem;
                margin-bottom: 50px;
                position: relative;
            }

            .sdgs-card {
                width: 100%;
            }
        }

        /* Zoom Responsive */
        @media (max-width: 400px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .about-title {
                text-align: center;
                font-size: 2rem;
                margin-bottom: 50px;
                position: relative;
            }


            .hero-content h2 {
                font-size: 1.2rem;
            }

            .sdgs-title {
                text-align: center;
                font-size: 2rem;
                margin-bottom: 50px;
                position: relative;
            }

            .btn {
                padding: 10px 20px;
                font-size: 0.9rem;
            }

            .feature-text h3 {
                font-size: 1.1rem;
            }

            .about-description {
                font-size: 1rem;
            }
        }

        @media (min-width: 2000px) {
            .container {
                max-width: 1600px;
            }

            .hero-content h1 {
                font-size: 5rem;
            }

            .hero-content h2 {
                font-size: 2.5rem;
            }

            .btn {
                padding: 15px 30px;
                font-size: 1.2rem;
            }

            .feature-text h3 {
                font-size: 1.5rem;
            }

            .about-description {
                font-size: 1.3rem;
            }
        }

        /* Animation */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        .animate-fade-in {
            opacity: 0;
            transition: opacity 0.8s ease-out;
        }

        .animate-fade-in.animated {
            opacity: 1;
        }

        .animate-slide-left {
            opacity: 0;
            transform: translateX(-30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-slide-left.animated {
            opacity: 1;
            transform: translateX(0);
        }

        .animate-slide-right {
            opacity: 0;
            transform: translateX(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-slide-right.animated {
            opacity: 1;
            transform: translateX(0);
        }

        .animate-scale-up {
            opacity: 0;
            transform: scale(0.95);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-scale-up.animated {
            opacity: 1;
            transform: scale(1);
        }

        .animate-delay-1 {
            transition-delay: 0.2s;
        }

        .animate-delay-2 {
            transition-delay: 0.4s;
        }

        .animate-delay-3 {
            transition-delay: 0.6s;
        }

        .animate-delay-4 {
            transition-delay: 0.8s;
        }
    </style>
@endsection

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero">
            <div class="container">
                <div class="hero-content animate-on-scroll">
                    <h1 class="animate-fade-in" style="font-family: var(--brand-font)">KostFinder</h1>
                    <h2 class="animate-fade-in animate-delay-1" style="font-weight: bold">Dekat Kampus, Dekat
                        Impian<br>Temukan Kos Idealmu!</h2>
                    <div class="hero-buttons animate-fade-in animate-delay-2">
                        <a href="{{ route('map') }}" class="btn btn-primary">Cari Kos</a>
                        @if (Auth::check())
                            <a href="{{ route('addMap') }}" class="btn btn-primary">Tambahkan Kos</a>
                        @endif
                    </div>
                </div>
                <div class="hero-image animate-scale-up">
                    <img src="{{ asset('asset/img/hero.png') }}" alt="Hero Image">
                </div>
            </div>
        </section>
        <section id="box4" class="box4">
            <div class="features-container">
                <div class="feature-item animate-on-scroll"onmouseover="this.style.transform='translateY(-10px)'"
                    onmouseout="this.style.transform=''">
                    <div class="icon-circle">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="feature-text">
                        <h3>Pemetaan Interaktif</h3>
                        <p>Temukan kos terbaik melalui fitur pada peta interaktif.</p>
                    </div>
                </div>

                <div class="feature-item animate-on-scroll animate-delay-1"onmouseover="this.style.transform='translateY(-10px)'"
                    onmouseout="this.style.transform=''">
                    <div class="icon-circle">
                        <i class="fas fa-filter"></i>
                    </div>
                    <div class="feature-text">
                        <h3>Filter Sesuai Kebutuhan</h3>
                        <p>Cari kos berdasarkan harga dan fasilitas.</p>
                    </div>
                </div>

                <div class="feature-item animate-on-scroll animate-delay-2"onmouseover="this.style.transform='translateY(-10px)'"
                    onmouseout="this.style.transform=''">
                    <div class="icon-circle">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="feature-text">
                        <h3>Informasi Lengkap</h3>
                        <p>Lihat harga, fasilitas, foto, kontak pemilik, dan alamat lengkap kos.</p>
                    </div>
                </div>

                <div class="feature-item animate-on-scroll animate-delay-3"onmouseover="this.style.transform='translateY(-10px)'"
                    onmouseout="this.style.transform=''">
                    <div class="icon-circle">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="feature-text">
                        <h3>Chat dengan Pemilik</h3>
                        <p>Hubungi pemilik kos untuk tanya atau reservasi.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-section">
            <div class="about-container">
                <div class="circle-wrapper2 animate-slide-left">
                    <div class="about-image">
                        <img src="{{ asset('asset/img/about.png') }}" alt="About Image">
                        <div class="circle-bg"></div>
                    </div>
                </div>
                <div class="about-content animate-slide-right">
                    <div class="circle-wrapper">
                        <h2 class="about-title"><span>Apa itu</span> <span>KostFinder</span><span>?</span></h2>
                        <div class="about-description">
                            KostFinder adalah solusi pintar untuk menemukan kos impian bagi Anda yang berkuliah di kampus
                            wilayah Kabupaten
                            Sleman seperti UGM atau UNY. Dilengkapi dengan pemetaan interaktif, filter pencarian, dan
                            informasi lengkap,
                            mencari tempat tinggal yang nyaman kini menjadi lebih cepat dan praktis!
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="sdgs-section">
            <div class="sdgs-container">
                <h2 class="sdgs-title animate-on-scroll">Mendukung SDGS 4 dan 11</h2>
                <div class="sdgs-content-wrapper">
                    <div class="sdgs-text-content">
                        <p class="sdgs-content animate-on-scroll">
                            Solusi ini tidak hanya memudahkan pencarian kos, tetapi juga mendukung Tujuan Pembangunan
                            Berkelanjutan (SDGs) poin 4 (Pendidikan Berkualitas) dan poin 11 (Kota dan Komunitas
                            Berkelanjutan).
                            Dengan meningkatkan akses informasi bagi mahasiswa serta memperluas visibilitas bagi pemilik
                            kos,
                            aplikasi ini turut berkontribusi dalam mewujudkan pembangunan berkelanjutan di kawasan
                            pendidikan.
                        </p>

                        <div class="sdgs-cards">
                            <div class="sdgs-card animate-on-scroll"onmouseover="this.style.transform='translateY(-10px)'"
                                onmouseout="this.style.transform=''">
                                <div class="sdgs-card-header">
                                    <h3>SDGs 4</h3>
                                </div>
                                <div class="sdgs-card-body">
                                    <p>Pendidikan<br>Berkualitas</p>
                                </div>
                            </div>

                            <div class="sdgs-card animate-on-scroll animate-delay-1"onmouseover="this.style.transform='translateY(-10px)'"
                                onmouseout="this.style.transform=''">
                                <div class="sdgs-card-header">
                                    <h3>SDGs 11</h3>
                                </div>
                                <div class="sdgs-card-body">
                                    <p>Kota dan<br>Komunitas<br>Berkelanjutan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sdgs-image-container animate-scale-up">
                        <div class="sdgs-image-wrapper">
                            <img src="{{ asset('asset/img/sdgs.png') }}" alt="SDGs Image" class="sdgs-image">
                            <div class="circle-bg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function isInViewport(element) {
                const rect = element.getBoundingClientRect();
                return (
                    rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.75 &&
                    rect.bottom >= 0
                );
            }

            function handleScroll() {
                const elements = document.querySelectorAll(
                    '.animate-on-scroll, .animate-fade-in, .animate-slide-left, .animate-slide-right, .animate-scale-up'
                );

                elements.forEach(element => {
                    if (isInViewport(element)) {
                        element.classList.add('animated');
                    }
                });
            }

            handleScroll();

            window.addEventListener('scroll', handleScroll);
        });
    </script>
@endsection
