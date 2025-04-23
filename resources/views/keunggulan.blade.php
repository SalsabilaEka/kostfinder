@extends('layouts.template')

@section('styles')
<!-- Main CSS File -->
<link href="{{ asset('asset/css/keungglan.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Main Content -->
<main class="main-content">
    <section class="why-choose-section">
        <div class="section-title">
            <h2>Mengapa pilih <span class="brand">KostFinder</span>?</h2>
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
                <div class="question-mark">?</div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
    <script>
        // Animation for feature items
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

            // Smooth scrolling for nav links
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
