@extends('layouts.template')

@section('styles')
    <link href="https://unpkg.com/maplibre-gl@2.1.9/dist/maplibre-gl.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

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
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--default-font);
            color: #4F5153;
            background-color: var(--background-color);
            margin-top: 80px;
            width: 100%;
            height: auto;
            padding: 0;
            overflow-x: hidden;

        }


        /* Header Styles */
        .header {
            background-color: #E6C99E;
            border-bottom: 5px solid #673E42;
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            padding: 0 20px;
            position: relative;
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .logo h1 {
            font-family: var(--brand-font);
            color: #673E42;
            font-size: 32px;
            margin: 0;
        }

        .navmenu {
            display: flex;
            align-items: center;
        }

        .navmenu ul {
            display: flex;
            list-style: none;
            margin-left: 115px;
            padding: 0;
            gap: 28px;
        }

        .navmenu la {
            display: flex;
            list-style: none;
            margin-left: 300px;
            padding: 0;
            gap: 25px;
        }

        .navmenu a {
            color: var(--nav-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 20px;
            transition: color 0.3s;
        }

        .navmenu a:hover,
        .navmenu a.active {
            color: var(--nav-hover-color);
            font-weight: 700;
        }

        .btn-getstarted {
            background-color: transparent;
            color: var(--nav-color);
            padding: 8px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 20px;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .btn-getstarted:hover {
            color: var(--nav-hover-color);
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--nav-color);
            cursor: pointer;
            z-index: 1001;
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

        /* Footer */
        .footer {
            background-color: #ECCDA0 !important;
            border-top: 5px solid #673E42 !important;
            padding: 20px 0 !important;
            text-align: center !important;
            position: fixed !important;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 1000 !important;
        }

        /* Tambahkan padding bottom ke main content agar tidak tertutup footer */
        .main {
            padding-bottom: 100px !important;
        }

        .footer p {
            color: black;
            font-size: 15px;
            font-weight: 400;
            margin: 0;
        }

        /* Mobile Navigation */
        .mobile-nav {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            max-width: 400px;
            height: 100vh;
            background-color: #E6C99E;
            border-left: 5px solid #673E42;
            z-index: 1000;
            transition: right 0.3s ease;
            padding: 80px 20px 20px;
            overflow-y: auto;
        }

        .mobile-nav.active {
            right: 0;
        }

        .mobile-nav ul {
            list-style: none;
            padding: 0;
        }

        .mobile-nav li {
            margin-bottom: 20px;
        }

        .mobile-nav a {
            color: var(--nav-color);
            text-decoration: none;
            font-size: 20px;
            font-weight: 500;
        }

        .mobile-nav a:hover {
            color: var(--nav-hover-color);
            font-weight: 700;
        }

        .mobile-nav .btn-getstarted {
            display: inline-block;
            margin-top: 20px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Modal styles */
        .modal {
            z-index: 1100;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none;
            overflow: hidden;
            outline: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Background overlay */
        }

        .modal.show {
            display: block;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .modal-dialog {
            z-index: 1101;
            /* Lebih tinggi dari modal background */
            margin: 1.75rem auto;
            max-width: 600px;
            position: relative;
            pointer-events: none;
            /* Memungkinkan klik melalui dialog saat tidak aktif */
        }

        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: 10px;
            outline: 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            width: 100vw;
            height: 100vh;
            background-color: #000;
        }

        .modal-backdrop.fade {
            opacity: 0;
        }

        .modal-backdrop.show {
            opacity: 0.5;
        }

        .modal-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 1rem;
            background-color: #6C4F51;
            color: white;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }

        .modal-title {
            margin-bottom: 0;
            line-height: 1.5;
            font-weight: 600;
        }

        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1rem;
            background-color: white;
            /* Pastikan background putih */
        }

        .modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 1rem;
            border-top: none;
            background-color: #f8f9fa;
            border-radius: 0 0 10px 10px;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .navmenu ul {
                margin-left: 50px;
            }

            .navmenu la {
                margin-left: 200px;
            }

            .left-features {
                padding-right: 20px;
            }

            .right-features {
                padding-left: 20px;
            }
        }

        @media (max-width: 1230px) {
            .header-container {
                justify-content: flex-end;
            }

            .logo {
                position: static;
                transform: none;
                margin-right: auto;
            }

            .navmenu {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
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
        }

        @media (max-width: 480px) {
            .logo h1 {
                font-size: 24px;
            }

            .logo img {
                height: 30px;
            }

            .footer p {
                font-size: 12px;
            }
        }

        #map {
            height: calc(88vh - 56px);
            width: 100%;
            margin: 0;
        }

        /* Control panel styles */
        #map-controls {
            position: absolute;
            top: 13%;
            left: 10px;
            background: white;
            padding: 8px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            gap: 8px;
        }

        .control-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .control-group-title {
            font-size: 12px;
            font-weight: bold;
            color: #6C4F51;
            margin-bottom: 3px;
            padding-bottom: 3px;
            border-bottom: 1px solid #eee;
        }

        #basemap-control {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        #map-controls button {
            padding: 6px 10px;
            font-size: 12px;
            border: none;
            border-radius: 3px;
            background-color: #f0f0f0;
            cursor: pointer;
            transition: background-color 0.2s;
            text-align: left;
            width: 100%;
        }

        #map-controls button:hover {
            background-color: #ddd;
        }

        #map-controls button.active-basemap {
            background-color: #6C4F51;
            color: white;
        }

        #map-controls button.digitasi-active {
            background-color: #6C4F51;
            color: white;
        }

        .kos-pin {
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.5);
            border-radius: 50%;
        }

        .mapboxgl-popup-content {
            max-width: 300px !important;
            border-radius: 8px !important;
        }

        .mapboxgl-popup-close-button {
            font-size: 18px;
            padding: 5px 8px;
        }

        .toast-notification {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #6C4F51;
            color: white;
            padding: 12px 24px;
            border-radius: 5px;
            z-index: 10000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s, fadeOut 0.3s 2.7s forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                bottom: 0;
            }

            to {
                opacity: 1;
                bottom: 20px;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                bottom: 20px;
            }

            to {
                opacity: 0;
                bottom: 0;
            }
        }

        .toast-notification i {
            font-size: 18px;
        }

        /* Untuk tombol Batal (abu-abu muda) */
        .modal-footer .btn-secondary {
            background-color: #f0f0f0;
            border-color: #f0f0f0;
            color: #333;
        }

        /* Untuk tombol Simpan (coklat) */
        .modal-footer .btn-primary {
            background-color: #6C4F51;
            border-color: #6C4F51;
            color: white;
        }

        /* Efek hover untuk tombol Batal */
        .modal-footer .btn-secondary:hover {
            background-color: #e0e0e0;
            border-color: #e0e0e0;
            color: #333;
        }

        /* Efek hover untuk tombol Simpan */
        .modal-footer .btn-primary:hover {
            background-color: #5a3f40;
            border-color: #5a3f40;
            color: white;
        }

        /* Override khusus untuk tombol ini */
        #add-point-btn {
            color: #6C4F51 !important;
            border-color: #6C4F51 !important;
            background-color: transparent !important;
            transition: all 0.3s ease;
        }

        #add-point-btn:hover {
            background-color: #6C4F51 !important;
            color: white !important;
        }
    </style>
@endsection

@section('content')

    <body>
        <div id="map"></div>

        <div id="map-controls">
            <div class="control-group">
                <div class="control-group-title">Basemap</div>
                <div id="basemap-control">
                    <button id="street" class="active-basemap">Street</button>
                    <button id="satellite">Satellite</button>
                </div>
            </div>
            <div class="control-group">
                <div class="control-group-title">Digitasi</div>
                <button id="add-point-btn" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-plus"></i> Tambah Titik Kos
                </button>
            </div>
        </div>

        <!-- Modal Form Tambah Point -->
        <div class="modal fade" id="addPointModal" tabindex="-1" aria-labelledby="addPointModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPointModalLabel">Tambah Data Kos</h5>
                    </div>
                    <form id="add-point-form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="point-geom" name="geom">

                            <div style="display: flex; gap: 20px;">
                                <!-- Left Column -->
                                <div style="flex: 1;">
                                    <div style="margin-bottom: 16px;">
                                        <label for="nama"
                                            style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Nama
                                            Kos <span style="color: #dc3545;">*</span></label>
                                        <input type="text" id="nama" name="nama"
                                            style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; transition: border-color 0.15s ease-in-out;"
                                            required>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label for="alamat"
                                            style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Alamat
                                            <span style="color: #dc3545;">*</span></label>
                                        <textarea id="alamat" name="alamat" rows="2"
                                            style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; resize: vertical; min-height: 80px;"></textarea>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label for="pemilik"
                                            style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Nama
                                            Pemilik</label>
                                        <input type="text" id="pemilik" name="pemilik"
                                            style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label for="telepon"
                                            style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Telepon</label>
                                        <input type="text" id="telepon" name="telepon"
                                            style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label for="jenis"
                                            style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Jenis
                                            Kos <span style="color: #dc3545;">*</span></label>
                                        <select id="jenis" name="jenis"
                                            style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; background-color: white; cursor: pointer;"
                                            required>
                                            <option value="">Pilih Jenis</option>
                                            <option value="Kos Putri">Kos Putri</option>
                                            <option value="Kos Putra">Kos Putra</option>
                                            <option value="Kos Campuran">Kos Campuran</option>
                                        </select>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label for="harga"
                                            style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Harga
                                            per Bulan <span style="color: #dc3545;">*</span></label>
                                        <input type="number" id="harga" name="harga"
                                            style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;"
                                            required>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label
                                            style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Metode
                                            Pembayaran</label>
                                        <div style="display: flex; flex-direction: column; gap: 8px;">
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="tunai" name="tunai" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Tunai</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="transfer" name="transfer" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Transfer</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="ewallet" name="ewallet" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>E-Wallet</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div style="flex: 1;">
                                    <div style="margin-bottom: 16px;">
                                        <label for="lbangunan"
                                            style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Luas
                                            Bangunan (m²)</label>
                                        <input type="number" id="lbangunan" name="lbangunan" step="0.01"
                                            style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label for="ltanah"
                                            style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Luas
                                            Tanah (m²)</label>
                                        <input type="number" id="ltanah" name="ltanah" step="0.01"
                                            style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label for="jenissertifikat"
                                            style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Jenis
                                            Sertifikat</label>
                                        <select id="jenissertifikat" name="jenissertifikat"
                                            style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; background-color: white; cursor: pointer;">
                                            <option value="">Pilih Jenis Sertifikat</option>
                                            <option value="SHM">SHM</option>
                                            <option value="SHGB">SHGB</option>
                                            <option value="HGB">HGB</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label
                                            style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Fasilitas</label>
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="ac" name="ac" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>AC</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="kasur" name="kasur" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Kasur</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="mejakursi" name="mejakursi" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Meja & Kursi</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="kamarmandi" name="kamarmandi" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Kamar Mandi Dalam</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="lemari" name="lemari" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Lemari</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="wifi" name="wifi" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>WiFi</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="dapur" name="dapur" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Dapur</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="kulkas" name="kulkas" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Kulkas</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="ruangtamu" name="ruangtamu" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Ruang Tamu</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label
                                            style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Keamanan</label>
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="parkirmotor" name="parkirmotor"
                                                    value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Parkir Motor</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="parkirmobil" name="parkirmobil"
                                                    value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Parkir Mobil</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="cctv" name="cctv" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>CCTV</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="keamanan" name="keamanan" value="1"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Keamanan 24 Jam</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label
                                            style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Fasilitas
                                            Tambahan</label>
                                        <div style="display: flex; gap: 20px;">
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="listrik" name="listrik" value="Ada"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Listrik</span>
                                            </label>
                                            <label
                                                style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                <input type="checkbox" id="air" name="air" value="Ada"
                                                    style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                <span>Air</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label for="jammalam"
                                            style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Jam
                                            Malam</label>
                                        <select id="jammalam" name="jammalam"
                                            style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; background-color: white; cursor: pointer;">
                                            <option value="">Pilih Jam Malam</option>
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak">Tidak Ada</option>
                                        </select>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label for="ketjammalam"
                                            style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Keterangan
                                            Jam Malam</label>
                                        <input type="text" id="ketjammalam" name="ketjammalam"
                                            style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <label for="foto"
                                            style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Foto
                                            Kos</label>
                                        <input type="file" id="foto" name="foto" accept="image/*"
                                            style="width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                    </div>

                                    <div style="font-size: 13px; color: #6c757d;"><span style="color: #dc3545;">*</span>
                                        Wajib diisi</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"
                                style="padding: 8px 16px; background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 4px; cursor: pointer; margin-right: 20px">Batal</button>
                            <button type="submit" class="btn btn-submit"
                                style="padding: 8px 16px; background-color: #6C4F51; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Form Edit Point -->
<div class="modal fade" id="editPointModal" tabindex="-1" aria-labelledby="editPointModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPointModalLabel">Edit Data Kos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-point-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit-point-id" name="id">
                    <input type="hidden" id="edit-point-geom" name="geom">
                    <input type="hidden" id="edit-image-old" name="image_old">

                    <div style="display: flex; gap: 20px;">
                        <!-- Left Column -->
                        <div style="flex: 1;">
                            <div style="margin-bottom: 16px;">
                                <label for="edit-nama" style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Nama Kos <span style="color: #dc3545;">*</span></label>
                                <input type="text" id="edit-nama" name="nama" style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;" required>
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label for="edit-alamat" style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Alamat <span style="color: #dc3545;">*</span></label>
                                <textarea id="edit-alamat" name="alamat" rows="2" style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; resize: vertical; min-height: 80px;" required></textarea>
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label for="edit-pemilik" style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Nama Pemilik</label>
                                <input type="text" id="edit-pemilik" name="pemilik" style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label for="edit-telepon" style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Telepon</label>
                                <input type="text" id="edit-telepon" name="telepon" style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label for="edit-jenis" style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Jenis Kos <span style="color: #dc3545;">*</span></label>
                                <select id="edit-jenis" name="jenis" style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; background-color: white; cursor: pointer;" required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="Kos Putri">Kos Putri</option>
                                    <option value="Kos Putra">Kos Putra</option>
                                    <option value="Kos Campuran">Kos Campuran</option>
                                </select>
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label for="edit-harga" style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Harga per Bulan <span style="color: #dc3545;">*</span></label>
                                <input type="number" id="edit-harga" name="harga" style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;" required>
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Metode Pembayaran</label>
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-tunai" name="tunai" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Tunai</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-transfer" name="transfer" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Transfer</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-ewallet" name="ewallet" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>E-Wallet</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div style="flex: 1;">
                            <div style="margin-bottom: 16px;">
                                <label for="edit-lbangunan" style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Luas Bangunan (m²)</label>
                                <input type="number" id="edit-lbangunan" name="lbangunan" step="0.01" style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label for="edit-ltanah" style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Luas Tanah (m²)</label>
                                <input type="number" id="edit-ltanah" name="ltanah" step="0.01" style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label for="edit-jenissertifikat" style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Jenis Sertifikat</label>
                                <select id="edit-jenissertifikat" name="jenissertifikat" style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; background-color: white; cursor: pointer;">
                                    <option value="">Pilih Jenis Sertifikat</option>
                                    <option value="SHM">SHM</option>
                                    <option value="SHGB">SHGB</option>
                                    <option value="HGB">HGB</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Fasilitas</label>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-ac" name="ac" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>AC</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-kasur" name="kasur" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Kasur</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-mejakursi" name="mejakursi" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Meja & Kursi</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-kamarmandi" name="kamarmandi" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Kamar Mandi Dalam</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-lemari" name="lemari" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Lemari</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-wifi" name="wifi" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>WiFi</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-dapur" name="dapur" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Dapur</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-kulkas" name="kulkas" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Kulkas</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-ruangtamu" name="ruangtamu" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Ruang Tamu</span>
                                    </label>
                                </div>
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Keamanan</label>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-parkirmotor" name="parkirmotor" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Parkir Motor</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-parkirmobil" name="parkirmobil" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Parkir Mobil</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-cctv" name="cctv" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>CCTV</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-keamanan" name="keamanan" value="1" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Keamanan 24 Jam</span>
                                    </label>
                                </div>
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Fasilitas Tambahan</label>
                                <div style="display: flex; gap: 20px;">
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-listrik" name="listrik" value="Ada" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Listrik</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                        <input type="checkbox" id="edit-air" name="air" value="Ada" style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                        <span>Air</span>
                                    </label>
                                </div>
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label for="edit-jammalam" style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Jam Malam</label>
                                <select id="edit-jammalam" name="jammalam" style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; background-color: white; cursor: pointer;">
                                    <option value="">Pilih Jam Malam</option>
                                    <option value="Ada">Ada</option>
                                    <option value="Tidak">Tidak Ada</option>
                                </select>
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label for="edit-ketjammalam" style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Keterangan Jam Malam</label>
                                <input type="text" id="edit-ketjammalam" name="ketjammalam" style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                            </div>

                            <div style="margin-bottom: 16px;">
                                <label for="edit-foto" style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Foto Kos</label>
                                <input type="file" id="edit-foto" name="foto" accept="image/*" style="width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                <div id="edit-foto-preview" style="margin-top: 8px;">
                                    <img id="edit-foto-preview-img" src="" style="max-width: 200px; border: 1px solid #ddd; border-radius: 4px; display: none;">
                                </div>
                            </div>

                            <div style="font-size: 13px; color: #6c757d;"><span style="color: #dc3545;">*</span> Wajib diisi</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal" style="padding: 8px 16px; background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 4px; cursor: pointer; margin-right:20px">Batal</button>
                    <button type="submit" class="btn btn-submit" style="padding: 8px 16px; background-color: #6C4F51; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

    </body>
@endsection

@section('scripts')
    <script script src="https://unpkg.com/maplibre-gl@2.1.9/dist/maplibre-gl.js"></script>
    <script src="https://unpkg.com/terraformer@1.0.7/terraformer.js"></script>
    <script src="https://unpkg.com/terraformer-wkt-parser@1.1.2/terraformer-wkt-parser.js"></script>
    <script src="https://unpkg.com/@turf/turf@6/turf.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const basemaps = {
            'Street': 'https://basemap.mapid.io/styles/street-2d-building/style.json?key=67d3bf388a760ad05471c4dd',
            'Satellite': 'https://basemap.mapid.io/styles/satellite/style.json?key=67d3bf388a760ad05471c4dd'
        };

        //----------- Map initialization ---------------//
        const map = new maplibregl.Map({
            container: 'map',
            style: basemaps['Street'],
            center: [110.384395, -7.760371],
            zoom: 14
        });

        //----------------- Basemap controls ----------------------//
        function setBasemap(styleUrl) {
            const currentState = {
                center: map.getCenter(),
                zoom: map.getZoom(),
                pitch: map.getPitch(),
                bearing: map.getBearing()
            };

            map.setStyle(styleUrl);

            map.once('styledata', () => {
                map.setCenter(currentState.center);
                map.setZoom(currentState.zoom);
                map.setPitch(currentState.pitch);
                map.setBearing(currentState.bearing);
                fetchPoints();
            });
        }

        function setActiveButton(activeId) {
            document.querySelectorAll('#basemap-control button').forEach(btn => {
                btn.classList.remove('active-basemap');
            });
            document.getElementById(activeId).classList.add('active-basemap');
        }

        document.getElementById('street').addEventListener('click', () => {
            setBasemap(basemaps['Street']);
            setActiveButton('street');
        });

        document.getElementById('satellite').addEventListener('click', () => {
            setBasemap(basemaps['Satellite']);
            setActiveButton('satellite');
        });

        // Variabel Global
        let kosMarkers = [];
        let isAddingPoint = false;
        let clickMarker = null;
        let addPointModal = null;

        // Fungsi Inisialisasi Modal
        function initModal() {
            addPointModal = new bootstrap.Modal(document.getElementById('addPointModal'), {
                backdrop: 'static', // Mencegah modal tertutup saat klik di luar
                keyboard: false, // Mencegah modal tertutup dengan tombol ESC
            });

            document.getElementById('add-point-form').addEventListener('submit', function(e) {
                e.preventDefault();
                savePoint();
            });
            // Reset form saat modal ditutup
            document.getElementById('addPointModal').addEventListener('hidden.bs.modal', function() {
                document.getElementById('add-point-form').reset();
                resetAddPointMode();
            });
        }

        // Fungsi Simpan Point
        async function savePoint() {
            const formElement = document.getElementById('add-point-form');
            const formData = new FormData(formElement);

            formData.append('user_name', '{{ auth()->user()->name }}');

            try {
                const response = await axios.post("{{ route('point.storeGeoJSON') }}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                if (response.data.success) {
                    showToast('Data kos berhasil disimpan!');
                    addPointModal.hide();
                    resetAddPointMode();
                    fetchPoints();
                } else {
                    throw new Error(response.data.message || 'Gagal menyimpan data');
                }
            } catch (error) {
                console.error('Error details:', error.response?.data || error.message);
                let errorMessage = 'Gagal menyimpan data kos';

                if (error.response?.data?.message) {
                    errorMessage += ': ' + error.response.data.message;
                } else if (error.message) {
                    errorMessage += ': ' + error.message;
                }

                showToast(errorMessage);
            }
        }

        // Fungsi Ambil Data Points dari Server
        async function fetchPoints() {
            try {
                const response = await fetch("{{ route('api.points') }}");
                const data = await response.json();
                addKosPoints(data);
            } catch (error) {
                console.error('Error fetching points:', error);
            }
        }

        // Fungsi Aktifkan Mode Tambah Point
        function activateAddPointMode() {
            isAddingPoint = true;
            document.getElementById('add-point-btn').classList.add('digitasi-active');
            map.getCanvas().style.cursor = 'crosshair';
            map.on('click', handleMapClick);
        }

        // Fungsi Nonaktifkan Mode Tambah Point
        function deactivateAddPointMode() {
            isAddingPoint = false;
            document.getElementById('add-point-btn').classList.remove('digitasi-active');
            map.getCanvas().style.cursor = '';
            map.off('click', handleMapClick);

            if (clickMarker) {
                clickMarker.remove();
                clickMarker = null;
            }
        }

        // Fungsi Reset Mode Tambah Point
        function resetAddPointMode() {
            deactivateAddPointMode();
            document.getElementById('add-point-form').reset();
        }

        // Handler Klik Peta saat Mode Tambah Point Aktif
        function handleMapClick(e) {
            const coordinates = e.lngLat;

            // Hapus marker sebelumnya jika ada
            if (clickMarker) {
                clickMarker.remove();
            }

            // Buat marker baru
            const el = document.createElement('div');
            el.className = 'kos-pin';
            el.innerHTML = `<i class="fas fa-map-marker-alt" style="color: #6C4F51; font-size: 26px;"></i>`;

            clickMarker = new maplibregl.Marker(el)
                .setLngLat(coordinates)
                .addTo(map);

            // Buat GeoJSON point
            const pointGeoJSON = {
                type: 'Point',
                coordinates: [coordinates.lng, coordinates.lat]
            };

            // Isi form geom
            document.getElementById('point-geom').value = JSON.stringify(pointGeoJSON);

            // Tampilkan modal form
            addPointModal.show();

            // Nonaktifkan mode tambah point setelah modal muncul
            deactivateAddPointMode();
        }

        // Inisialisasi Modal Edit
        function initEditModal() {
            editPointModal = new bootstrap.Modal(document.getElementById('editPointModal'));

            document.getElementById('edit-point-form').addEventListener('submit', function(e) {
                e.preventDefault();
                updatePoint();
            });

            // Preview foto saat file dipilih
            document.getElementById('edit-foto').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const previewImg = document.getElementById('edit-foto-preview-img');
                        previewImg.src = event.target.result;
                        previewImg.style.display = 'block';

                        // Sembunyikan gambar lama jika ada
                        document.getElementById('edit-image-old').value = '';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function showEditModal(pointId) {
            fetch(`/api/point/${pointId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {

                    if (data.success) {
                        const point = data.data;

                        // Isi form dengan data yang ada
                        document.getElementById('edit-point-id').value = point.id;
                        document.getElementById('edit-nama').value = point.nama;
                        document.getElementById('edit-alamat').value = point.alamat;
                        document.getElementById('edit-pemilik').value = point.pemilik || '';
                        document.getElementById('edit-telepon').value = point.telepon || '';
                        document.getElementById('edit-jenis').value = point.jenis;
                        document.getElementById('edit-harga').value = point.harga;
                        document.getElementById('edit-lbangunan').value = point.lbangunan || '';
                        document.getElementById('edit-ltanah').value = point.ltanah || '';
                        document.getElementById('edit-jenissertifikat').value = point.jenissertifikat || '';
                        document.getElementById('edit-jammalam').value = point.jammalam || '';
                        document.getElementById('edit-ketjammalam').value = point.ketjammalam || '';

                        // Set checkbox values
                        document.getElementById('edit-tunai').checked = point.tunai == 1;
                        document.getElementById('edit-transfer').checked = point.transfer == 1;
                        document.getElementById('edit-ewallet').checked = point.ewallet == 1;
                        document.getElementById('edit-ac').checked = point.ac == 1;
                        document.getElementById('edit-kasur').checked = point.kasur == 1;
                        document.getElementById('edit-mejakursi').checked = point.mejakursi == 1;
                        document.getElementById('edit-kamarmandi').checked = point.kamarmandi == 1;
                        document.getElementById('edit-lemari').checked = point.lemari == 1;
                        document.getElementById('edit-wifi').checked = point.wifi == 1;
                        document.getElementById('edit-dapur').checked = point.dapur == 1;
                        document.getElementById('edit-kulkas').checked = point.kulkas == 1;
                        document.getElementById('edit-ruangtamu').checked = point.ruangtamu == 1;
                        document.getElementById('edit-parkirmotor').checked = point.parkirmotor == 1;
                        document.getElementById('edit-parkirmobil').checked = point.parkirmobil == 1;
                        document.getElementById('edit-cctv').checked = point.cctv == 1;
                        document.getElementById('edit-keamanan').checked = point.keamanan == 1;
                        document.getElementById('edit-listrik').checked = point.listrik === 'Ada';
                        document.getElementById('edit-air').checked = point.air === 'Ada';

                        // Set geom
                        const geom = {
                            type: 'Point',
                            coordinates: [point.longitude, point.latitude]
                        };
                        document.getElementById('edit-point-geom').value = JSON.stringify(geom);

                        // Set foto preview
                        const fotoPreview = document.getElementById('edit-foto-preview-img');
                        if (point.foto) {
                            fotoPreview.src = point.foto;
                            fotoPreview.style.display = 'block';
                            document.getElementById('edit-image-old').value = point.foto.split('/').pop();
                        } else {
                            fotoPreview.style.display = 'none';
                            document.getElementById('edit-image-old').value = '';
                        }

                        // Tampilkan modal
                        editPointModal.show();
                    } else {
                        showToast('Gagal memuat data kos: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan saat memuat data kos');
                });
        }

        // Fungsi untuk update point
        async function updatePoint() {
            const formElement = document.getElementById('edit-point-form');
            const formData = new FormData(formElement);
            const pointId = document.getElementById('edit-point-id').value;

            // Tambahkan nilai default false untuk semua checkbox
            const checkboxes = [
                'tunai', 'transfer', 'ewallet', 'ac', 'kasur', 'mejakursi',
                'kamarmandi', 'lemari', 'wifi', 'dapur', 'kulkas', 'ruangtamu',
                'parkirmotor', 'parkirmobil', 'cctv', 'keamanan', 'listrik', 'air'
            ];

            checkboxes.forEach(name => {
                const checkbox = document.querySelector(`#edit-${name}`);
                formData.set(name, checkbox.checked ? '1' : '0');
            })

            try {
                const response = await axios.post(`/update-point/${pointId}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-HTTP-Method-Override': 'PATCH'
                    }
                });

                if (response.data.success) {
                    showToast('Data kos berhasil diperbarui!');
                    editPointModal.hide();

                    // Tambahkan timestamp untuk memastikan gambar fresh
                    const timestamp = new Date().getTime();
                    kosMarkers.forEach(marker => marker.remove());
                    kosMarkers = [];

                    // Fetch data baru dengan timestamp
                    const response = await fetch(`{{ route('api.points') }}?t=${timestamp}`);
                    const data = await response.json();
                    addKosPoints(data);
                } else {
                    throw new Error(response.data.message || 'Gagal memperbarui data');
                }
            } catch (error) {
                console.error('Error details:', error.response?.data || error.message);
                let errorMessage = 'Gagal memperbarui data kos';

                if (error.response?.data?.message) {
                    errorMessage += ': ' + error.response.data.message;
                } else if (error.message) {
                    errorMessage += ': ' + error.message;
                }

                showToast(errorMessage);
            }
        }

        // Update fungsi addKosPoints untuk menambahkan tombol edit di popup
        function addKosPoints(data) {
            // Hapus marker lama
            kosMarkers.forEach(marker => marker.remove());
            kosMarkers = [];

            data.features.forEach((feature) => {
                // Dapatkan user yang sedang login
                const currentUser = '{{ auth()->user()->email }}';

                // Cek apakah user bisa edit
                const canEdit = feature.properties.user_name === currentUser;

                const el = document.createElement('div');
                el.className = 'kos-pin';

                const jenis = feature.properties.jenis ? feature.properties.jenis.toLowerCase() : '';
                let color = '#6C4F51'; // Default color

                if (jenis.includes('putri')) color = '#ff69b4';
                else if (jenis.includes('putra')) color = '#1e90ff';
                else if (jenis.includes('campuran')) color = '#ffd700';

                el.innerHTML = `<i class="fas fa-location-dot" style="color: ${color}; font-size: 26px;"></i>`;

                // Buat konten popup dengan tombol edit
                const timestamp = new Date().getTime();
                const fotoUrl = feature.properties.foto ?
                    (feature.properties.foto.startsWith('http') ?
                        `${feature.properties.foto}?${timestamp}` :
                        `/storage/images/${feature.properties.foto}?${timestamp}`) :
                    null;

                const popupContent = `
                    <div style="max-width: 250px;">
                        <h3 style="margin-bottom: 5px; color: #6C4F51;">${feature.properties.nama || '-'}</h3>
                        <div style="font-weight: bold; color: #6C4F51; margin-bottom: 5px;">
                            Rp${feature.properties.harga ? Number(feature.properties.harga).toLocaleString('id-ID') : '0'}/bulan
                        </div>
                        <div><strong>Jenis:</strong> ${feature.properties.jenis || '-'}</div>
                        <div><strong>Alamat:</strong> ${feature.properties.alamat || '-'}</div>
                        <div><strong>Telepon:</strong> ${feature.properties.telepon || '-'}</div>
                        ${fotoUrl ? `<img src="${fotoUrl}" class="img-thumbnail mt-2" style="width: 200px; height: 200px;">` : ''}
                        <div class="mt-2 d-flex justify-content-between">
                            ${canEdit ? `<button onclick="showEditModal(${feature.properties.id})" style="background-color:#5D3A00;color:white;padding:8px 16px;font-size:14px;border:none;border-radius:6px;cursor:pointer;">Edit</button>` : ''}
                        </div>
                    </div>
                `;

                const marker = new maplibregl.Marker(el)
                    .setLngLat(feature.geometry.coordinates)
                    .setPopup(new maplibregl.Popup({
                            offset: 25
                        })
                        .setHTML(popupContent))
                    .addTo(map);

                kosMarkers.push(marker);
            });
        }

        // Event Listener saat Peta Load
        map.on('load', () => {
            fetchPoints();
            initModal();
            initEditModal();

            // Event Listener untuk tombol tambah point
            document.getElementById('add-point-btn').addEventListener('click', function() {
                if (isAddingPoint) {
                    deactivateAddPointMode();
                } else {
                    activateAddPointMode();
                }
            });

            // Event Listener untuk modal hidden
            document.getElementById('addPointModal').addEventListener('hidden.bs.modal', function() {
                resetAddPointMode();
            });
        });

        function showToast(message, type = 'info') {
            const icons = {
                info: 'info-circle',
                warning: 'exclamation-circle',
                error: 'times-circle',
                success: 'check-circle'
            };

            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.innerHTML = `
                <i class="fas fa-${icons[type] || 'info-circle'}"></i>
                <span>${message}</span>
            `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    </script>
@endsection
