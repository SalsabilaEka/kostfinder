@extends('layouts.template')

@section('styles')
    <style>
        :root {
            --default-font: "Poppins", sans-serif;
            --heading-font: "Poppins", sans-serif;
            --nav-font: "Poppins", sans-serif;
            --brand-font: "Righteous", sans-serif;
            --background-color: #F9EDE3;
            --primary-color: #6B4145;
            --secondary-color: #673E42;
            --accent-color: #673E42;
            --text-color: #4F5153;
            --dark-color: #2d3748;
            --light-color: #f7fafc;
            --brand-color: #673E42;
            --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            --navbar-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {

            line-height: 1.6;
            color: #333;
            background-color: #F9EDE3;
            position: relative;
            min-height: 100vh;
            padding-top: var(--navbar-height);
        }

        .main-content {
            padding: 3rem 0;
            min-height: calc(100vh - var(--navbar-height) - var(--footer-height));
        }

        /* Section Title */
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s forwards 0.3s;
            padding-top: 1rem;
        }

        .section-title h2 {
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            color: var(--dark-color);
            font-weight: 700;
        }

        .brand {
            color: var(--brand-color);
            position: relative;
        }

        .brand::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--secondary-color);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.4s ease;
        }

        .brand:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        /* Content Wrapper */
        .content-wrapper {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .features-list {
            flex: 1;
            min-width: 300px;
            max-width: 600px;
        }

        .image-container {
            position: relative;
            flex: 1;
            min-width: 300px;
            max-width: 500px;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Feature Items */
        .feature-item {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            border-radius: 12px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transform: translateX(-50px);
            opacity: 0;
            transition: var(--transition);
        }

        .feature-item.visible {
            transform: translateX(0);
            opacity: 1;
        }

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            position: relative;
            width: 60px;
            height: 60px;
            min-width: 60px;
            perspective: 1000px;
        }

        .feature-icon-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .feature-item:hover .feature-icon-inner {
            transform: rotateY(180deg);
        }

        .feature-icon-front,
        .feature-icon-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1.5rem;
        }

        .feature-icon-front {
            background: var(--secondary-color);
            color: white;
        }

        .feature-icon-back {
            background: #967a67;
            color: white;
            transform: rotateY(180deg);
        }

        .feature-content h3 {
            font-size: 1.25rem;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .feature-content p {
            color: #718096;
            line-height: 1.6;
        }

        /* Image Container Styles */
        .feature-image {
            position: relative;
            z-index: 3;
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            transform: scale(0.95);
            transition: var(--transition);
            animation: float 6s ease-in-out infinite;
        }

        .image-container:hover .feature-image {
            transform: scale(1);
        }

        .circle-bg-light,
        .circle-bg-dark {
            position: absolute;
            border-radius: 50%;
            z-index: 1;
            animation: pulse 8s infinite alternate;
        }

        .circle-bg-light {
            width: 300px;
            height: 300px;
            background: rgba(167, 100, 46, 0.34);
            top: 10%;
            left: 10%;
            animation-delay: 0.5s;
        }

        .circle-bg-dark {
            width: 200px;
            height: 200px;
            background: rgb(218, 207, 197);
            bottom: 10%;
            right: 10%;
        }

        /* Animations */
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

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) scale(0.95);
            }

            50% {
                transform: translateY(-20px) scale(0.95);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .content-wrapper {
                flex-direction: column;
                align-items: center;
            }

            .features-list {
                max-width: 100%;
            }

            .image-container {
                margin-top: 3rem;
                height: 400px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0 1rem;
            }

            .navbar-nav {
                position: fixed;
                top: var(--navbar-height);
                left: -100%;
                width: 80%;
                height: calc(100vh - var(--navbar-height));
                background-color: white;
                flex-direction: column;
                align-items: flex-start;
                padding: 2rem;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
                transition: var(--transition);
            }

            .navbar-nav.active {
                left: 0;
            }

            .nav-item {
                margin: 1rem 0;
            }

            .navbar-toggler {
                display: block;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .feature-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .feature-icon {
                margin-bottom: 1rem;
            }

            .image-container {
                height: 350px;
            }

            .circle-bg-light {
                width: 250px;
                height: 250px;
            }

            .circle-bg-dark {
                width: 150px;
                height: 150px;
            }
        }

        @media (max-width: 480px) {
            :root {
                --navbar-height: 60px;

            }

            .section-title h2 {
                font-size: 1.75rem;
            }

            .content-wrapper {
                padding: 0 1rem;
            }

            .feature-item {
                padding: 1rem;
            }

            .feature-content h3 {
                font-size: 1.1rem;
            }

            .feature-content p {
                font-size: 0.9rem;
            }

            .image-container {
                height: 280px;
            }
        }

        /* Zoom Responsiveness */
        @media (max-width: 400px),
        (max-height: 600px) {
            .feature-item {
                margin-bottom: 1.5rem;
                padding: 1rem;
            }

            .section-title {
                padding: 20px;
            }

            .feature-icon {
                width: 50px;
                height: 50px;
                min-width: 50px;
            }

            .feature-content h3 {
                font-size: 1rem;
            }

            .feature-content p {
                font-size: 0.85rem;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }
        }
    </style>
@endsection

@section('content')
    <main class="main-content">
        <section class="why-choose-section">
            <div class="section-title">
                <h2>Mengapa pilih <span class="brand" style="font-family: var(--brand-font)">KostFinder</span>?</h2>
            </div>

            <div class="content-wrapper">
                <div class="features-list">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <div class="feature-icon-inner">
                                <div class="feature-icon-front">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="feature-icon-back">
                                    <i class="fas fa-bus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="feature-content">
                            <h3>Temukan akses fasilitas umum khususnya halte</h3>
                            <p>Dengan fitur pencarian pintar, kamu bisa menemukan kos berdasarkan lokasi, harga, dan
                                fasilitas yang sesuai kebutuhanmu.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <div class="feature-icon-inner">
                                <div class="feature-icon-front">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="feature-icon-back">
                                    <i class="fas fa-search-dollar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="feature-content">
                            <h3>Informasi Lengkap & Transparan</h3>
                            <p>Semua kos yang terdaftar memiliki detail lengkap, mulai dari harga, fasilitas, hingga
                                aturan kos. Tidak perlu takut ada biaya tersembunyi!</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <div class="feature-icon-inner">
                                <div class="feature-icon-front">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div class="feature-icon-back">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                            </div>
                        </div>
                        <div class="feature-content">
                            <h3>Tanpa Perantara & Bebas Biaya Admin</h3>
                            <p>Langsung hubungi pemilik kos tanpa ribet! Tidak ada tambahan biaya atau komisi yang
                                membebani pencari kos.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <div class="feature-icon-inner">
                                <div class="feature-icon-front">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="feature-icon-back">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                            </div>
                        </div>
                        <div class="feature-content">
                            <h3>Dukungan untuk Pemilik Kos</h3>
                            <p>Punya kamar kosong? Daftarkan kosmu dengan mudah dan jangkau lebih banyak calon penyewa
                                melalui KostFinder!</p>
                        </div>
                    </div>
                </div>

                <div class="image-container">
                    <div class="circle-bg-light"></div>
                    <div class="circle-bg-dark"></div>
                    <img src="{{ asset('asset/img/keunggulan.png') }}" alt="KostFinder App Preview" class="feature-image">

                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const featureItems = document.querySelectorAll('.feature-item');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, index * 200);
                    }
                });
            }, {
                threshold: 0.1
            });

            featureItems.forEach(item => {
                observer.observe(item);
            });

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
@endsection
