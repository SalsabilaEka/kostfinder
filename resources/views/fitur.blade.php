@extends('layouts.template')

@section('styles')
    <style>
        /* Tambahkan di section styles Anda */
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .main-content {
            margin-top: 10%;
        }

        .footer {
            background-color: #ECCDA0;
            border-top: 5px solid #673E42;
            padding: 20px 0;
            text-align: center;
            margin-top: auto;
            /* Ini yang akan push footer ke bawah */
        }

        .footer p {
            color: black;
            font-size: 15px;
            font-weight: 400;
            margin: 0;
        }

        /* Features Section */
        .features-2 {
            padding: 150px 0 100px;
            position: relative;
            background-color: var(--background-color);
        }

        .features-2 .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .features-2 .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;

        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: var(--accent-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .feature-icon i {
            font-size: 1.5rem;
        }

        .feature-icon:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .feature-content {
            max-width: 280px;
        }

        .feature-content h3 {
            font-weight: 700;
            color: var(--surface-color);
            margin-bottom: 10px;
            font-size: 18px;
            line-height: 1.3;
        }

        .feature-content p {
            color: var(--text-color);
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 0;
        }

        .phone-mockup {
            text-align: center;
            padding: 0 20px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .phone-mockup img {
            max-height: 500px;
            width: auto;
            animation: float 3s ease-in-out infinite;
        }

        /* Layout for feature columns */
        .col-lg-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            padding: 0 15px;
            gap: 2rem;
        }

        /* Animation */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Feature item alignment */
        .left-features {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            padding-right: 40px;
        }

        .right-features {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding-left: 40px;
        }

        .feature-item.text-end {
            text-align: right;
        }

        .feature-item.text-start {
            text-align: left;
        }

        /* Spacing between elements */
        .d-flex.gap-4 {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .left-features {
                padding-right: 20px;
            }

            .right-features {
                padding-left: 20px;
            }
        }

        @media (max-width: 992px) {
            .main-content {
                margin-top: 1100px;
            }
            .features-2 {
                padding: 120px 0 80px;
            }

            .col-lg-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .phone-mockup {
                order: -1;
                margin-bottom: 40px;
                max-width: 300px;
            }

            .feature-item {
                margin-bottom: 30px;
                max-width: 500px;
                margin-left: auto;
                margin-right: auto;
            }

            .feature-icon {
                width: 60px;
                height: 60px;
                font-size: 20px;
            }

            .feature-content h3 {
                font-size: 16px;
            }

            .left-features,
            .right-features {
                align-items: center;
                padding: 0;
            }

            .feature-item.text-end,
            .feature-item.text-start {
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-top: 800px;
            }
            .features-2 {
                padding: 100px 0 60px;
            }

            .feature-item {
                margin-bottom: 25px;
            }

            .feature-icon {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }

            .feature-content h3 {
                font-size: 15px;
            }

            .feature-content p {
                font-size: 13px;
            }

            .phone-mockup img {
                max-height: 350px;
            }

            .footer p {
                font-size: 13px;
            }

            .footer {}
        }

        @media (max-width: 480px) {
            .features-2 {
                padding: 100px 0 60px;
            }

            .logo h1 {
                font-size: 20px;
            }

            .logo img {
                height: 30px;
            }

            .feature-item {
                margin-bottom: 25px;
            }

            .feature-icon {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }

            .feature-content h3 {
                font-size: 15px;
            }

            .feature-content p {
                font-size: 13px;
            }

            .phone-mockup img {
                max-height: 350px;
            }

            .footer p {
                font-size: 13px;
            }

            .footer {}
        }
        @media (max-width: 350px) {
            .main-content{
                margin-top: 900px;
            }
            .features-2 {
                padding: 100px 0 60px;
            }

            .logo h1 {
                font-size: 18px;
            }

            .logo img {
                height: 30px;
            }

            .feature-item {
                margin-bottom: 25px;
            }

            .feature-icon {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }

            .feature-content h3 {
                font-size: 15px;
            }

            .feature-content p {
                font-size: 13px;
            }

            .phone-mockup img {
                max-height: 350px;
            }

            .footer p {
                font-size: 13px;
            }

            .footer {}
        }
    </style>
@endsection

@section('content')
<main class="main-content">
    <!-- Features 2 Section -->
    <section id="fitur" class="features-2 section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center">

                <!-- Left Column -->
                <div class="col-lg-4 left-features">
                    <div class="feature-item text-end mb-5" data-aos="fade-right" data-aos-delay="200">
                        <div class="d-flex align-items-center justify-content-end gap-4">
                            <div class="feature-content">
                                <h3>Fitur Filter & Search Rekomendasi Kos</h3>
                                <p>Titik kos yang ditampilkan dapat disesuaikan dengan preferensi pengguna.</p>
                            </div>
                            <div class="feature-icon">
                                <i class="bi bi-search"></i>
                            </div>
                        </div>
                    </div>

                    <div class="feature-item text-end mb-5" data-aos="fade-right" data-aos-delay="300">
                        <div class="d-flex align-items-center justify-content-end gap-4">
                            <div class="feature-content">
                                <h3>Fitur Buffering Jarak Kos</h3>
                                <p>Peta menampilkan titik kos sesuai jarak radius yang dipilih.</p>
                            </div>
                            <div class="feature-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                        </div>
                    </div>

                    <div class="feature-item text-end mb-5" data-aos="fade-right" data-aos-delay="400">
                        <div class="d-flex align-items-center justify-content-end gap-4">
                            <div class="feature-content">
                                <h3>Fitur Routing</h3>
                                <p>Menampilkan rute tercepat berdasarkan jarak atau waktu tempuh.</p>
                            </div>
                            <div class="feature-icon ">
                                <i class="bi bi-signpost-2"></i>
                            </div>
                        </div>
                    </div>

                    <div class="feature-item text-end" data-aos="fade-right" data-aos-delay="500">
                        <div class="d-flex align-items-center justify-content-end gap-4">
                            <div class="feature-content">
                                <h3>Fitur Aksesibilitas Transportasi Umum</h3>
                                <p>Menampilkan lokasi halte bus di sekitar kos dan informasi jadwal.</p>
                            </div>
                            <div class="feature-icon">
                                <i class="bi bi-bus-front"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Center Image Column -->
                <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="phone-mockup text-center">
                        <img src="{{ asset('asset/img/phone-app.png') }}" alt="Phone Mockup" class="img-fluid">
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4 right-features">
                    <div class="feature-item mb-5 text-start" data-aos="fade-left" data-aos-delay="200">
                        <div class="d-flex align-items-center gap-4">
                            <div class="feature-icon ">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                            <div class="feature-content">
                                <h3>Fitur CRUD Data Kos</h3>
                                <p>Pemilik kos dapat menambahkan dan memperbarui data kos.</p>
                            </div>
                        </div>
                    </div>

                    <div class="feature-item mb-5 text-start" data-aos="fade-left" data-aos-delay="300">
                        <div class="d-flex align-items-center gap-4">
                            <div class="feature-icon ">
                                <i class="bi bi-bar-chart-line"></i>
                            </div>
                            <div class="feature-content">
                                <h3>Fitur Dashboard Analisis Statistik</h3>
                                <p>Menampilkan statistik tren harga sewa kos dalam bentuk grafik.</p>
                            </div>
                        </div>
                    </div>

                    <div class="feature-item mb-5 text-start" data-aos="fade-left" data-aos-delay="400">
                        <div class="d-flex align-items-center gap-4">
                            <div class="feature-icon ">
                                <i class="bi bi-diagram-3"></i>
                            </div>
                            <div class="feature-content">
                                <h3>Fitur Clustering Kos</h3>
                                <p>Menampilkan hasil clustering dalam peta interaktif.</p>
                            </div>
                        </div>
                    </div>

                    <div class="feature-item text-start" data-aos="fade-left" data-aos-delay="500">
                        <div class="d-flex align-items-center gap-4">
                            <div class="feature-icon">
                                <i class="bi bi-map"></i>
                            </div>
                            <div class="feature-content">
                                <h3>Fitur Akses Pendidikan</h3>
                                <p>Menampilkan lokasi fakultas di universitas UGM dan UNY.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
    <script>
        // Initialize AOS animation
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = 'none';
            }
        });
    </script>
@endsection
