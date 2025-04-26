@extends('layouts.template')

@section('styles')
    <style>
        :root {
            --primary-color: #6B4145;
            --secondary-color: #673E42;
            --accent-color: #673E42;
            --text-color: #4F5153;
            --light-bg: #F9EDE3;
            --white: #ffffff;
            --feature-icon-bg: #F5E6D8;
            --transition-speed: 0.4s;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 8px 25px rgba(0, 0, 0, 0.15);
            --navbar-height: 90px;
        }

        /* Safe Area for Content Below Navbar */
        .main-content2 {
            padding: calc(var(--navbar-height) + 2rem) 0 3rem 0;
            background-color: var(--light-bg);
            min-height: 100vh;
        }

        /* Responsive Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            position: relative;
        }

        /* Improved Row Layout */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -0.75rem;
            position: relative;
            z-index: 1;
        }

        /* Enhanced Column System */
        .col-lg-4 {
            width: 100%;
            padding: 0 0.75rem;
            margin-bottom: 1.5rem;
        }

        /* Optimized Feature Items */
        .feature-item {
            margin-bottom: 1.5rem;
            opacity: 0;
            transform: translateY(20px);
            transition: all var(--transition-speed) cubic-bezier(0.25, 0.46, 0.45, 0.94);
            padding: 1rem;

        }

        .feature-item.animated {
            opacity: 1;
            transform: translateY(0);
        }

        /* Improved Flex Layout */
        .d-flex {
            display: flex;
            flex-direction: column;
        }

        .align-items-center {
            align-items: center;
        }

        .gap-4 {
            gap: 1rem;
        }

        /* Better Feature Content */
        .feature-content {
            flex: 1;
            order: 1;
            margin: -1em;
        }

        .feature-content h3 {
            font-size: clamp(1rem, 4vw, 1.25rem);
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-weight: 600;
            line-height: 1.3;
        }

        .feature-content p {
            font-size: clamp(0.85rem, 3.5vw, 0.95rem);
            color: var(--text-color);
            line-height: 1.5;
            margin-bottom: 0;
        }

        /* Optimized Feature Icons */
        .feature-icon {
            width: clamp(40px, 10vw, 50px);
            height: clamp(40px, 10vw, 50px);
            background-color: var(--feature-icon-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(1rem, 4vw, 1.25rem);
            color: var(--primary-color);
            transition: all var(--transition-speed) ease;
            flex-shrink: 0;
            order: 2;
            margin-top: 0.5rem;
        }

        .feature-item:hover .feature-icon {
            background-color: var(--primary-color);
            color: var(--white);
            transform: rotate(15deg) scale(1.1);
        }

        /* Responsive Phone Mockup */
        .phone-mockup {
            position: relative;
            padding: 1rem 0;
            z-index: 2;
            margin: 1rem auto;
            max-width: 250px;
        }

        .phone-mockup img {
            width: 100%;
            height: auto;
            max-height: 550px;
            object-fit: contain;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.1));
            animation: float 6s ease-in-out infinite;
        }

        /* Text Alignment Adjustments */
        .text-center {
            text-align: center;
        }

        .text-end .feature-content {
            text-align: right;
        }

        .text-start .feature-content {
            text-align: left;
        }

        /* Animation Improvements */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Advanced Responsive Breakpoints */
        @media (min-width: 576px) {
            .d-flex {
                flex-direction: row;
            }

            .text-end .feature-icon {
                order: 2;
                margin-left: 1rem;
                margin-top: 0;
            }

            .text-start .feature-icon {
                order: 0;
                margin-right: 1rem;
                margin-top: 0;
            }

            .phone-mockup {
                max-width: 300px;
            }
        }

        @media (min-width: 768px) {
            .col-lg-4 {
                width: 50%;
                margin-bottom: 2rem;
            }

            .feature-item {
                padding: 1.25rem;
            }

            .phone-mockup {
                max-width: 350px;
                padding: 2rem 0;
            }
        }

        @media (min-width: 992px) {
            .col-lg-4 {
                width: 33.333%;
            }

            .feature-content h3 {
                font-size: clamp(1.1rem, 1.2vw, 1.3rem);
            }

            .feature-content p {
                font-size: clamp(0.9rem, 1vw, 1rem);
            }

            .phone-mockup {
                max-width: 280px;
                padding: 0;
            }
        }

        @media (min-width: 1200px) {
            .container {
                padding: 0 1.5rem;
            }

            .feature-item {
                padding: 1.5rem;
            }

            .phone-mockup {
                max-width: 320px;
            }
        }

        /* Special Adjustments for Very Small Devices */
        @media (max-width: 375px) {
            .main-content2 {
                padding-top: calc(var(--navbar-height) + 1rem);
            }

            .feature-item {
                padding: 0.75rem;
            }

            .gap-4 {
                gap: 0.75rem;
            }
        }

        /* Print Styles */
        @media print {
            .main-content2 {
                padding-top: 1rem;
                background-color: transparent;
            }

            .feature-item {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #eee;
            }
        }
    </style>
@endsection

@section('content')
    <main class="main-content2">
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
                                    <p>Menampilkan titik kos sesuai preferensi pengguna.</p>
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
                        <div class="feature-item text-end" data-aos="fade-right" data-aos-delay="500">
                            <div class="d-flex align-items-center justify-content-end gap-4">
                                <div class="feature-content">
                                    <h3>Fitur NDBI</h3>
                                    <p>Menampilkan informasi indeks kepadatan bangunan tahun 2020-2024</p>
                                </div>
                                <div class="feature-icon">
                                    <i class="bi bi-buildings"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Center Image Column -->
                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                        <div class="phone-mockup text-center">
                            <img src="{{ asset('asset/img/web-phone.svg') }}" alt="Phone Mockup" class="img-fluid">
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
                        <div class="feature-item text-start" data-aos="fade-left" data-aos-delay="500">
                            <div class="d-flex align-items-center gap-4">
                                <div class="feature-icon">
                                    <i class="bi bi-thermometer-sun"></i>
                                </div>
                                <div class="feature-content">
                                    <h3>Fitur Suhu Permukaan</h3>
                                    <p>Menampilkan informasi suhu permukaan tanah tahun 2020-2024.</p>
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
        // Animation initialization
        document.addEventListener('DOMContentLoaded', function() {
            if (!('IntersectionObserver' in window)) {
                document.querySelectorAll('[data-aos]').forEach(el => {
                    el.classList.add('aos-animate');
                });
                return;
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('aos-animate');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            });

            document.querySelectorAll('[data-aos]').forEach(el => {
                observer.observe(el);

                // Apply delay if specified
                const delay = el.getAttribute('data-aos-delay');
                if (delay) {
                    el.style.transitionDelay = delay + 'ms';
                }
            });
        });
    </script>
@endsection
