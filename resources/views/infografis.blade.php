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
            flex: 1;
            margin-top: 12%;
            /* Sesuaikan dengan padding/margin yang dibutuhkan */
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

        /* Infographic Section */
        .infographic-section {
            padding: 150px 0 100px;
            position: relative;
            background-color: var(--background-color);
            margin-bottom: 5%;
        }

        .infographic-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .infographic-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .infographic-title h1 {
            font-size: 36px;
            color: var(--surface-color);
            margin-bottom: 15px;
            font-weight: 700;
        }

        .infographic-title p {
            font-size: 18px;
            color: var(--text-color);
        }

        /* Custom Tab Navigation */
        .tab-navigation {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tab-button {
            padding: 12px 25px;
            border-radius: 50px;
            background-color: white;
            color: var(--text-color);
            border: none;
            font-weight: 500;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .tab-button:hover {
            background-color: #f0f0f0;
        }

        .tab-button.active {
            background-color: var(--accent-color);
            color: white;
            font-weight: 600;
        }

        .tab-button i {
            font-size: 18px;
        }

        /* Tab Content */
        .tab-content {
            display: none;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .tab-content.active {
            display: flex;
            flex-wrap: wrap;
        }

        .description-col {
            flex: 1;
            min-width: 300px;
            padding: 40px;
        }

        .chart-col {
            flex: 1;
            min-width: 300px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }

        .content-title {
            color: var(--surface-color);
            margin-bottom: 20px;
            font-weight: 700;
            font-size: 24px;
        }

        .content-description {
            color: var(--text-color);
            margin-bottom: 20px;
            font-size: 16px;
        }

        .content-list {
            list-style-type: none;
            padding-left: 0;
        }

        .content-list li {
            margin-bottom: 15px;
            padding-left: 30px;
            position: relative;
            line-height: 1.6;
        }

        .content-list li:before {
            content: "";
            position: absolute;
            left: 0;
            top: 10px;
            width: 12px;
            height: 12px;
            background-color: var(--accent-color);
            border-radius: 50%;
        }

        @media (max-width: 1200px) {
            .main-content {
                margin-top: 250px;
            }
            .infographic-section {
                padding: 120px 0 80px;
            }

            .tab-navigation {
                flex-direction: column;
                align-items: center;
            }

            .tab-button {
                width: 100%;
                justify-content: center;
            }
        }
        @media (max-width: 992px) {
            .main-content {
                margin-top: 300px;
            }
            .infographic-section {
                padding: 120px 0 80px;
            }

            .tab-navigation {
                flex-direction: column;
                align-items: center;
            }

            .tab-button {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-top: 300px;
            }
            .infographic-section {
                padding: 100px 0 60px;
            }

            .infographic-title h1 {
                font-size: 30px;
            }

            .infographic-title p {
                font-size: 16px;
            }

            .content-title {
                font-size: 20px;
            }

            .description-col,
            .chart-col {
                padding: 20px;
            }

            .footer p {
                font-size: 13px;
            }
        }

        /* Tambahkan di section styles Anda setelah media query yang sudah ada */

        @media (max-width: 552px) {
            .main-content {
                margin-top: 150px;
            }
            .logo h1 {
                font-size: 20px;
            }

            .logo img {
                height: 30px;
            }

            .infographic-section {
                margin-top: 50px;
                padding: 80px 0 40px;
            }

            .infographic-title h1 {
                font-size: 26px;
                margin-bottom: 10px;
            }

            .infographic-title p {
                font-size: 14px;
            }

            .tab-button {
                padding: 10px 15px;
                font-size: 14px;
            }

            .tab-button i {
                font-size: 16px;
            }

            .content-title {
                font-size: 18px;
                margin-bottom: 15px;
            }

            .content-description {
                font-size: 14px;
                margin-bottom: 15px;
            }

            .content-list li {
                font-size: 14px;
                margin-bottom: 10px;
            }

            .description-col,
            .chart-col {
                padding: 15px;
                min-width: 100%;
            }

            .tab-content {
                flex-direction: column;
            }

            .chart-col {
                height: 250px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                margin-top: 150px;
            }
            .logo h1 {
                font-size: 18px;
            }

            .logo img {
                height: 30px;
            }

            .infographic-section {
                margin-top: 50px;
                padding: 70px 0 30px;
            }

            .infographic-title h1 {
                font-size: 24px;
            }

            .infographic-title p {
                font-size: 13px;
            }

            .tab-button {
                padding: 8px 12px;
                font-size: 13px;
            }

            .content-title {
                font-size: 16px;
            }

            .content-description {
                font-size: 13px;
            }

            .content-list li {
                font-size: 13px;
                padding-left: 25px;
            }

            .content-list li:before {
                width: 10px;
                height: 10px;
                top: 8px;
            }

            .footer p {
                font-size: 12px;
            }

            /* Penyesuaian khusus untuk chart */
            .chart-col canvas {
                max-width: 100%;
                max-height: 200px;
            }
        }

        @media (max-width: 350px) {
            .main-content {
                margin-top: 180px;
            }
            .logo h1 {
                font-size: 18px;
            }

            .logo img {
                height: 30px;
            }

            .infographic-section {
                margin-top: 70px;
                padding: 70px 0 30px;
            }

            .infographic-title h1 {
                font-size: 24px;
            }

            .infographic-title p {
                font-size: 13px;
            }

            .tab-button {
                padding: 8px 12px;
                font-size: 13px;
            }

            .content-title {
                font-size: 16px;
            }

            .content-description {
                font-size: 13px;
            }

            .content-list li {
                font-size: 13px;
                padding-left: 25px;
            }

            .content-list li:before {
                width: 10px;
                height: 10px;
                top: 8px;
            }

            .footer p {
                font-size: 12px;
            }

            /* Penyesuaian khusus untuk chart */
            .chart-col canvas {
                max-width: 100%;
                max-height: 200px;
            }
        }
    </style>
@endsection

@section('content')
    <main class="main-content">
        <!-- Infographic Section -->
        <section class="infographic-section">
            <div class="infographic-container">
                <div class="infographic-title">
                    <h1>Infografis Kos</h1>
                    <p>Informasi penting tentang pencarian kos dalam satu tampilan</p>
                </div>

                <!-- Tab Navigation -->
                <div class="tab-navigation">
                    <button class="tab-button active" data-tab="radius">
                        <i class="fas fa-map-marker-alt"></i> Radius Pencarian
                    </button>
                    <button class="tab-button" data-tab="price">
                        <i class="fas fa-tag"></i> Harga Kos
                    </button>
                    <button class="tab-button" data-tab="facilities">
                        <i class="fas fa-home"></i> Fasilitas Popular
                    </button>
                </div>

                <!-- Tab Contents -->
                <div id="radius" class="tab-content active">
                    <div class="description-col">
                        <h2 class="content-title">Distribusi Kos Berdasarkan Jarak</h2>
                        <p class="content-description">Lihat sebaran kos-kosan berdasarkan kedekatannya dengan kampus UGM
                            dan UNY.</p>
                        <ul class="content-list">
                            <li>Grafik batang menunjukkan jumlah kos di tiap kategori jarak</li>
                            <li>Distribusi visual membantu membandingkan kepadatan kos di sekitar UGM dan UNY</li>
                            <li>Gunakan informasi ini untuk memilih lokasi kos yang ideal sesuai preferensi jarak dan
                                aksesibilitas</li>
                        </ul>
                    </div>
                    <div class="chart-col">
                        <canvas id="radiusChart"></canvas>
                    </div>
                </div>

                <div id="price" class="tab-content">
                    <div class="description-col">
                        <h2 class="content-title">Distribusi Kos Berdasarkan Harga</h2>
                        <p class="content-description">Telusuri sebaran kos berdasarkan kisaran harga untuk menemukan opsi
                            yang sesuai dengan anggaran Anda.</p>
                        <ul class="content-list">
                            <li>Memudahkan identifikasi kisaran harga yang paling banyak</li>
                            <li>Dapat digunakan untuk membandingkan dominasi harga di berbagai lokasi sekitar kampus</li>
                            <li>Membantu pengguna menyesuaikan preferensi pencarian dengan kemampuan finansial</li>
                        </ul>
                    </div>
                    <div class="chart-col">
                        <canvas id="priceChart"></canvas>
                    </div>
                </div>

                <div id="facilities" class="tab-content">
                    <div class="description-col">
                        <h2 class="content-title">Distribusi Fasilitas Kos</h2>
                        <p class="content-description">Lihat proporsi fasilitas yang paling sering tersedia di kos-kos
                            terdaftar melalui diagram lingkaran interaktif.</p>
                        <ul class="content-list">
                            <li>Memudahkan pengguna melihat fasilitas populer</li>
                            <li>Dapat digunakan untuk memprioritaskan pencarian kos berdasarkan fasilitas favorit</li>
                            <li>Diagram memberikan gambaran cepat untuk membandingkan popularitas masing-masing fasilitas
                            </li>
                        </ul>

                    </div>
                    <div class="chart-col">
                        <canvas id="facilitiesChart"></canvas>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Tab Navigation Functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabId = button.getAttribute('data-tab');

                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to clicked button and corresponding content
                button.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Initialize Charts
        function initCharts() {
            // Object to store chart instances
            const chartInstances = {
                radiusChart: null,
                priceChart: null,
                facilitiesChart: null
            };

            // Radius Chart (Jarak ke Kampus)
            async function loadRadiusChart() {
                try {
                    const response = await fetch('/api/distance-chart-data');
                    if (!response.ok) throw new Error('Network response was not ok');

                    const {
                        labels,
                        data
                    } = await response.json();
                    const ctx = document.getElementById('radiusChart');

                    // Destroy previous chart if exists
                    if (chartInstances.radiusChart) {
                        chartInstances.radiusChart.destroy();
                    }

                    chartInstances.radiusChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah Kos',
                                data: data,
                                backgroundColor: '#6B4145',
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Distribusi Kos Berdasarkan Jarak ke Kampus UGM-UNY',
                                    font: {
                                        size: 16
                                    }
                                },
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Jumlah Kos'
                                    },
                                    ticks: {
                                        precision: 0,
                                        stepSize: 1
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Jarak dari Kampus'
                                    }
                                }
                            }
                        }
                    });
                } catch (error) {
                    console.error('Error loading radius chart:', error);
                    document.getElementById('radiusChart').innerHTML =
                        '<p class="text-danger">Gagal memuat grafik jarak: ' + error.message + '</p>';
                }
            }

            // Price Chart
            async function loadPriceChart() {
                try {
                    const response = await fetch('/api/price-chart-data');
                    if (!response.ok) throw new Error('Network response was not ok');

                    const {
                        labels,
                        data
                    } = await response.json();
                    const ctx = document.getElementById('priceChart');

                    // Destroy previous chart if exists
                    if (chartInstances.priceChart) {
                        chartInstances.priceChart.destroy();
                    }

                    chartInstances.priceChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah Kos',
                                data: data,
                                backgroundColor: '#6B4145',
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Distribusi Kos Berdasarkan Harga',
                                    font: {
                                        size: 16
                                    }
                                },
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Jumlah Kos'
                                    },
                                    ticks: {
                                        precision: 0,
                                        stepSize: 1
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Harga'
                                    }
                                }
                            }
                        }

                    });
                } catch (error) {
                    console.error('Error loading price chart:', error);
                    document.getElementById('priceChart').innerHTML =
                        '<p class="text-danger">Gagal memuat grafik harga</p>';
                }
            }

            function formatFacilityLabel(originalLabel) {
                const replacements = {
                    'ac': 'AC',
                    'wifi': 'WiFi',
                    'cctv': 'CCTV',
                    'kamarmandi': 'Kamar Mandi',
                    'parkirmotor': 'Parkir Motor',
                    'parkirmobil': 'Parkir Mobil',
                    'ruangtamu': 'Ruang Tamu'
                };

                // Cek apakah ada penggantian khusus
                if (replacements[originalLabel.toLowerCase()]) {
                    return replacements[originalLabel.toLowerCase()];
                }

                // Default transformation
                return originalLabel
                    .replace(/([a-z])([A-Z])/g, '$1 $2') // CamelCase to space
                    .replace(/[_-]/g, ' ') // Underscore/hyphen to space
                    .replace(/\b\w/g, char => char.toUpperCase()); // Capitalize each word
            }

            // Facilities Pie Chart
            async function loadFacilitiesChart() {
                try {
                    const response = await fetch('/api/facility-chart-data');
                    if (!response.ok) throw new Error('Network response was not ok');

                    // Pertama, dapatkan data dari response
                    const {
                        labels,
                        data
                    } = await response.json();

                    // Kemudian format labels
                    const formattedLabels = labels.map(label => formatFacilityLabel(label));

                    const ctx = document.getElementById('facilitiesChart');

                    // Destroy previous chart if exists
                    if (chartInstances.facilitiesChart) {
                        chartInstances.facilitiesChart.destroy();
                    }

                    // Simplified color generation
                    const generateColors = (count) => {
                        const baseColors = [
                            '#673E42', '#8C5D60', '#B58B8E', '#D9B8BB',
                            '#A78A7F', '#7A6A5F', '#5E4B3C', '#3E322C',
                            '#9D8377', '#C4A69D'
                        ];
                        return baseColors.slice(0, count);
                    };

                    chartInstances.facilitiesChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: formattedLabels,
                            datasets: [{
                                data: data,
                                backgroundColor: generateColors(labels.length),
                                borderWidth: 1,
                                borderColor: '#fff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Distribusi Fasilitas Kos',
                                    font: {
                                        size: 16
                                    }
                                },
                                legend: {
                                    position: 'right',
                                    labels: {
                                        boxWidth: 12,
                                        padding: 20,
                                        font: {
                                            size: 12
                                        }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = Math.round((value / total) * 100);
                                            return `${label}: ${value} kos (${percentage}%)`;
                                        }
                                    }
                                }
                            },
                            animation: {
                                animateScale: true,
                                animateRotate: true
                            }
                        }
                    });
                } catch (error) {
                    console.error('Error loading facilities chart:', error);
                    document.getElementById('facilitiesChart').innerHTML =
                        '<p class="text-danger">Gagal memuat grafik fasilitas: ' + error.message + '</p>';
                }
            }

            // Load charts when tabs are clicked
            document.querySelector('.tab-button[data-tab="radius"]').addEventListener('click', loadRadiusChart);
            document.querySelector('.tab-button[data-tab="price"]').addEventListener('click', loadPriceChart);
            document.querySelector('.tab-button[data-tab="facilities"]').addEventListener('click', loadFacilitiesChart);

            // Load initial charts
            loadRadiusChart();
            loadPriceChart();

            // If facilities tab is active on load
            if (document.querySelector('.tab-button[data-tab="facilities"].active')) {
                loadFacilitiesChart();
            }
        }

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            initCharts();

            window.addEventListener('scroll', function() {
                const header = document.getElementById('header');
                header.style.boxShadow = window.scrollY > 50 ?
                    '0 2px 10px rgba(0, 0, 0, 0.1)' :
                    'none';
            });
        });
    </script>
@endsection
