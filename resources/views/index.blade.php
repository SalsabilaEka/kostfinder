@extends('layouts.template')

@section('styles')
    <link href="https://unpkg.com/maplibre-gl@2.1.9/dist/maplibre-gl.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        #main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
            position: relative;
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
        }

        .modal.show {
            display: block;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .modal-dialog {
            z-index: 1101;
            margin: 1.75rem auto;
            max-width: 600px;
            position: relative;
            pointer-events: none;
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

        #map {
            height: calc(90vh - 56px);
            width: 100%;
            margin: 0;
            position: absolute;
            top: 70px;
            bottom: 0;
        }

        #map-controls {
            position: absolute;
            left: 10px;
            background: white;
            padding: 8px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 100px;
            width: 150px;
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
            color: white;
            padding: 12px 24px;
            border-radius: 5px;
            z-index: 10000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s;
            max-width: 80%;
            min-width: 300px;
        }

        .toast-close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-left: 10px;
            padding: 0;
        }

        .toast-notification.error {
            background-color: #dc3545;
        }

        .toast-notification.success {
            background-color: #6C4F51;
        }

        .toast-notification.warning {
            background-color: #ffc107;
            color: #212529;
        }

        .toast-notification.info {
            background-color: #17a2b8;
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

        .modal-footer .btn-secondary {
            background-color: #f0f0f0;
            border-color: #f0f0f0;
            color: #333;
        }

        .modal-footer .btn-primary {
            background-color: #6C4F51;
            border-color: #6C4F51;
            color: white;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #e0e0e0;
            border-color: #e0e0e0;
            color: #333;
        }

        .modal-footer .btn-primary:hover {
            background-color: #5a3f40;
            border-color: #5a3f40;
            color: white;
        }

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

        /* Add this to your existing styles */
        .modal-confirm {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1100;
        }

        .modal-confirm-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .modal-confirm-header {
            background-color: #6C4F51;
            color: white;
            padding: 12px 20px;
            border-radius: 8px 8px 0 0;
            font-weight: 600;
        }

        .modal-confirm-body {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .modal-confirm-footer {
            padding: 12px 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .modal-confirm-btn {
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
        }

        .modal-confirm-btn-cancel {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            color: #333;
        }

        .modal-confirm-btn-delete {
            background-color: #6C4F51;
            color: white;
            border: none;
        }

        .modal-confirm-btn-cancel:hover {
            background-color: #e9ecef;
        }

        .modal-confirm-btn-delete:hover {
            background-color: #5a3f40;
        }
    </style>
@endsection

@section('content')

    <body>
        <main class="main-content">
            <div class="content-wrapper">
                <div id="map"></div>

                <div id="map-controls">
                    <div class="control-group">
                        <div class="control-group-title">Basemap</div>
                        <div id="basemap-control">
                            <button id="street" class="active-basemap">Default</button>
                            <button id="satellite">Satelit</button>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-group-title">Digitasi</div>
                        <button id="add-point-btn" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-plus"></i> Tambah Titik Kos
                        </button>
                    </div>
                </div>

                <!-- Modal Add Point -->
                <div class="modal fade" id="addPointModal" tabindex="-1" aria-labelledby="addPointModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPointModalLabel">Tambah Data Kos</h5>
                            </div>
                            <form id="add-point-form" method="POST" action="{{ route('point.storeGeoJSON') }}" enctype="multipart/form-data" novalidate>
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
                                                        <input type="checkbox" id="ewallet" name="ewallet"
                                                            value="1"
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
                                                    Bangunan (ha)</label>
                                                <input type="number" id="lbangunan" name="lbangunan" step="0.01"
                                                    style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                            </div>

                                            <div style="margin-bottom: 16px;">
                                                <label for="ltanah"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Luas
                                                    Tanah (ha)</label>
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
                                                        <input type="checkbox" id="ac" name="ac"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>AC</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="kasur" name="kasur"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Kasur</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="mejakursi" name="mejakursi"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Meja & Kursi</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="kamarmandi" name="kamarmandi"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Kamar Mandi Dalam</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="lemari" name="lemari"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Lemari</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="wifi" name="wifi"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>WiFi</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="dapur" name="dapur"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Dapur</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="kulkas" name="kulkas"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Kulkas</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="ruangtamu" name="ruangtamu"
                                                            value="1"
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
                                                        <input type="checkbox" id="cctv" name="cctv"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>CCTV</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="keamanan" name="keamanan"
                                                            value="1"
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
                                                        <input type="checkbox" id="listrik" name="listrik"
                                                            value="Ada"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Listrik</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="air" name="air"
                                                            value="Ada"
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

                                            <div style="font-size: 13px; color: #6c757d;"><span
                                                    style="color: #dc3545;">*</span>
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

                <!-- Modal Edit Point -->
                <div class="modal fade" id="editPointModal" tabindex="-1" aria-labelledby="editPointModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPointModalLabel">Edit Data Kos</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="edit-point-form" method="POST" action="{{ route('point.storeGeoJSON') }}" enctype="multipart/form-data" novalidate>
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
                                                <label for="edit-nama"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Nama
                                                    Kos <span style="color: #dc3545;">*</span></label>
                                                <input type="text" id="edit-nama" name="nama"
                                                    style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;"
                                                    required>
                                            </div>

                                            <div style="margin-bottom: 16px;">
                                                <label for="edit-alamat"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Alamat
                                                    <span style="color: #dc3545;">*</span></label>
                                                <textarea id="edit-alamat" name="alamat" rows="2"
                                                    style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; resize: vertical; min-height: 80px;"
                                                    required></textarea>
                                            </div>

                                            <div style="margin-bottom: 16px;">
                                                <label for="edit-pemilik"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Nama
                                                    Pemilik</label>
                                                <input type="text" id="edit-pemilik" name="pemilik"
                                                    style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                            </div>

                                            <div style="margin-bottom: 16px;">
                                                <label for="edit-telepon"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Telepon</label>
                                                <input type="text" id="edit-telepon" name="telepon"
                                                    style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                            </div>

                                            <div style="margin-bottom: 16px;">
                                                <label for="edit-jenis"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Jenis
                                                    Kos <span style="color: #dc3545;">*</span></label>
                                                <select id="edit-jenis" name="jenis"
                                                    style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; background-color: white; cursor: pointer;"
                                                    required>
                                                    <option value="">Pilih Jenis</option>
                                                    <option value="Kos Putri">Kos Putri</option>
                                                    <option value="Kos Putra">Kos Putra</option>
                                                    <option value="Kos Campuran">Kos Campuran</option>
                                                </select>
                                            </div>

                                            <div style="margin-bottom: 16px;">
                                                <label for="edit-harga"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Harga
                                                    per Bulan <span style="color: #dc3545;">*</span></label>
                                                <input type="number" id="edit-harga" name="harga"
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
                                                        <input type="checkbox" id="edit-tunai" name="tunai"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Tunai</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-transfer" name="transfer"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Transfer</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-ewallet" name="ewallet"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>E-Wallet</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right Column -->
                                        <div style="flex: 1;">
                                            <div style="margin-bottom: 16px;">
                                                <label for="edit-lbangunan"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Luas
                                                    Bangunan (ha)</label>
                                                <input type="number" id="edit-lbangunan" name="lbangunan"
                                                    step="0.01"
                                                    style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                            </div>

                                            <div style="margin-bottom: 16px;">
                                                <label for="edit-ltanah"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Luas
                                                    Tanah (ha)</label>
                                                <input type="number" id="edit-ltanah" name="ltanah" step="0.01"
                                                    style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                            </div>

                                            <div style="margin-bottom: 16px;">
                                                <label for="edit-jenissertifikat"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Jenis
                                                    Sertifikat</label>
                                                <select id="edit-jenissertifikat" name="jenissertifikat"
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
                                                        <input type="checkbox" id="edit-ac" name="ac"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>AC</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-kasur" name="kasur"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Kasur</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-mejakursi" name="mejakursi"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Meja & Kursi</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-kamarmandi" name="kamarmandi"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Kamar Mandi Dalam</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-lemari" name="lemari"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Lemari</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-wifi" name="wifi"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>WiFi</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-dapur" name="dapur"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Dapur</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-kulkas" name="kulkas"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Kulkas</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-ruangtamu" name="ruangtamu"
                                                            value="1"
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
                                                        <input type="checkbox" id="edit-parkirmotor" name="parkirmotor"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Parkir Motor</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-parkirmobil" name="parkirmobil"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Parkir Mobil</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-cctv" name="cctv"
                                                            value="1"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>CCTV</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-keamanan" name="keamanan"
                                                            value="1"
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
                                                        <input type="checkbox" id="edit-listrik" name="listrik"
                                                            value="Ada"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Listrik</span>
                                                    </label>
                                                    <label
                                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px;">
                                                        <input type="checkbox" id="edit-air" name="air"
                                                            value="Ada"
                                                            style="width: 16px; height: 16px; accent-color: #6C4F51;">
                                                        <span>Air</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div style="margin-bottom: 16px;">
                                                <label for="edit-jammalam"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Jam
                                                    Malam</label>
                                                <select id="edit-jammalam" name="jammalam"
                                                    style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px; background-color: white; cursor: pointer;">
                                                    <option value="">Pilih Jam Malam</option>
                                                    <option value="Ada">Ada</option>
                                                    <option value="Tidak">Tidak Ada</option>
                                                </select>
                                            </div>

                                            <div style="margin-bottom: 16px;">
                                                <label for="edit-ketjammalam"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Keterangan
                                                    Jam Malam</label>
                                                <input type="text" id="edit-ketjammalam" name="ketjammalam"
                                                    style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                            </div>

                                            <div style="margin-bottom: 16px;">
                                                <label for="edit-foto"
                                                    style="display: block; margin-bottom: 6px; font-weight: 500; color: #333;">Foto
                                                    Kos</label>
                                                <input type="file" id="edit-foto" name="foto" accept="image/*"
                                                    style="width: 100%; padding: 8px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                                                <div id="edit-foto-preview" style="margin-top: 8px;">
                                                    <img id="edit-foto-preview-img" src=""
                                                        style="max-width: 200px; border: 1px solid #ddd; border-radius: 4px; display: none;">
                                                </div>
                                            </div>

                                            <div style="font-size: 13px; color: #6c757d;"><span
                                                    style="color: #dc3545;">*</span>
                                                Wajib diisi</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"
                                        style="padding: 8px 16px; background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 4px; cursor: pointer; margin-right:20px">Batal</button>
                                    <button type="submit" class="btn btn-submit"
                                        style="padding: 8px 16px; background-color: #6C4F51; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan
                                        Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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


        //----------------- Add Point ----------------------//
        let kosMarkers = [];
        let isAddingPoint = false;
        let clickMarker = null;
        let addPointModal = null;

        function initModal() {
            addPointModal = new bootstrap.Modal(document.getElementById('addPointModal'), {
                backdrop: 'static',
                keyboard: false,
            });

            document.getElementById('add-point-form').addEventListener('submit', function(e) {
                e.preventDefault();

                // Hapus pemanggilan savePoint() yang duplikat
                if (validateForm('add-point-form')) {
                    savePoint();
                }
                // Hapus savePoint() yang ada di sini
            });

            document.getElementById('addPointModal').addEventListener('hidden.bs.modal', function() {
                document.getElementById('add-point-form').reset();
                resetAddPointMode();
            });
        }

        async function savePoint() {
            const formElement = document.getElementById('add-point-form');
            const formData = new FormData(formElement);

            formData.append('user_name', '{{ auth()->user()->name }}');

            // Konversi harga ke integer sebelum dikirim
            const harga = formData.get('harga');
            if (harga.includes('.')) {
                formData.set('harga', Math.round(parseFloat(harga)));
            }

            try {
                const response = await axios.post("{{ route('point.storeGeoJSON') }}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                if (response.data.success) {
                    showToast('Data kos berhasil disimpan!', 'success');
                    addPointModal.hide();
                    resetAddPointMode();
                    fetchPoints();
                } else {
                    throw new Error(response.data.message || 'Gagal menyimpan data');
                }
            } catch (error) {
                console.error('Error details:', error);
                let errorMessage = 'Gagal menyimpan data kos';

                // Handle validation errors
                if (error.response?.data?.errors) {
                    const errors = error.response.data.errors;
                    errorMessage = '';

                    // Format each error message in Indonesian
                    for (const field in errors) {
                        const fieldName = formatFieldName(field);
                        const messages = errors[field].map(msg => {
                            // Translate common validation messages
                            if (msg.includes('required')) return 'harus diisi';
                            if (msg.includes('integer')) return 'harus berupa angka bulat (tanpa desimal)';
                            if (msg.includes('numeric')) return 'harus berupa angka';
                            if (msg.includes('min')) return 'nilai terlalu kecil';
                            if (msg.includes('max')) return 'nilai terlalu besar';
                            return msg;
                        });

                        errorMessage += `<b>${fieldName}</b>: ${messages.join(', ')}<br>`;
                    }
                }
                // Handle specific error cases
                else if (error.response?.data?.message) {
                    errorMessage = translateErrorMessage(error.response.data.message);
                } else if (error.message) {
                    errorMessage = translateErrorMessage(error.message);
                }

                showToast(errorMessage, 'error');
            }
        }

        async function fetchPoints() {
            try {
                const response = await fetch("{{ route('api.points') }}");
                const data = await response.json();
                addKosPoints(data);
            } catch (error) {
                console.error('Error fetching points:', error);
            }
        }

        function activateAddPointMode() {
            isAddingPoint = true;
            document.getElementById('add-point-btn').classList.add('digitasi-active');
            map.getCanvas().style.cursor = 'crosshair';
            map.on('click', handleMapClick);
        }

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

        function resetAddPointMode() {
            deactivateAddPointMode();
            document.getElementById('add-point-form').reset();
        }

        function handleMapClick(e) {
            const coordinates = e.lngLat;

            if (clickMarker) {
                clickMarker.remove();
            }

            const el = document.createElement('div');
            el.className = 'kos-pin';
            el.innerHTML = `<i class="fas fa-map-marker-alt" style="color: #6C4F51; font-size: 26px;"></i>`;

            clickMarker = new maplibregl.Marker(el)
                .setLngLat(coordinates)
                .addTo(map);

            const pointGeoJSON = {
                type: 'Point',
                coordinates: [coordinates.lng, coordinates.lat]
            };

            document.getElementById('point-geom').value = JSON.stringify(pointGeoJSON);

            addPointModal.show();

            deactivateAddPointMode();
        }


        //----------------- Edit Point ----------------------//
        function initEditModal() {
            editPointModal = new bootstrap.Modal(document.getElementById('editPointModal'));

            document.getElementById('edit-point-form').addEventListener('submit', function(e) {
                e.preventDefault();

                // Hapus pemanggilan updatePoint() yang duplikat
                if (validateForm('edit-point-form')) {
                    updatePoint();
                }
                // Hapus updatePoint() yang ada di sini
            });

            document.getElementById('edit-foto').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const previewImg = document.getElementById('edit-foto-preview-img');
                        previewImg.src = event.target.result;
                        previewImg.style.display = 'block';

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

                        const geom = {
                            type: 'Point',
                            coordinates: [point.longitude, point.latitude]
                        };
                        document.getElementById('edit-point-geom').value = JSON.stringify(geom);

                        const fotoPreview = document.getElementById('edit-foto-preview-img');
                        if (point.foto) {
                            fotoPreview.src = point.foto;
                            fotoPreview.style.display = 'block';
                            document.getElementById('edit-image-old').value = point.foto.split('/').pop();
                        } else {
                            fotoPreview.style.display = 'none';
                            document.getElementById('edit-image-old').value = '';
                        }

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

        async function updatePoint() {
            const formElement = document.getElementById('edit-point-form');
            const formData = new FormData(formElement);
            const pointId = document.getElementById('edit-point-id').value;

            // Validasi client-side sebelum mengirim
            const hargaInput = document.getElementById('edit-harga');
            if (hargaInput.value.includes('.')) {
                showToast('Harga harus berupa angka bulat (tanpa desimal)', 'warning');
                hargaInput.focus();
                return;
            }

            const checkboxes = [
                'tunai', 'transfer', 'ewallet', 'ac', 'kasur', 'mejakursi',
                'kamarmandi', 'lemari', 'wifi', 'dapur', 'kulkas', 'ruangtamu',
                'parkirmotor', 'parkirmobil', 'cctv', 'keamanan', 'listrik', 'air'
            ];

            checkboxes.forEach(name => {
                const checkbox = document.querySelector(`#edit-${name}`);
                formData.set(name, checkbox.checked ? '1' : '0');
            });

            try {
                const response = await axios.post(`/update-point/${pointId}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-HTTP-Method-Override': 'PATCH'
                    }
                });

                if (response.data.success) {
                    showToast('Data kos berhasil diperbarui!', 'success');
                    editPointModal.hide();

                    // Refresh data points
                    kosMarkers.forEach(marker => marker.remove());
                    kosMarkers = [];
                    fetchPoints();
                } else {
                    throw new Error(response.data.message || 'Gagal memperbarui data');
                }
            } catch (error) {
                console.error('Error details:', error);
                let errorMessage = 'Gagal memperbarui data kos';

                // Handle validation errors
                if (error.response?.data?.errors) {
                    errorMessage = formatValidationErrors(error.response.data.errors);
                }
                // Handle specific error cases
                else if (error.response?.data?.message) {
                    errorMessage = translateErrorMessage(error.response.data.message);
                } else if (error.message) {
                    errorMessage = translateErrorMessage(error.message);
                }

                showToast(errorMessage, 'error');
            }
        }


        //----------------- Initialize Point Kost ---------------------//
        function addKosPoints(data) {
            kosMarkers.forEach(marker => marker.remove());
            kosMarkers = [];

            data.features.forEach((feature) => {
                const currentUser = '{{ auth()->user()->email }}'; // Email pengguna yang login
                const isAdmin = currentUser === 'adminkostfinder@gmail.com'; // Cek apakah admin
                const isOwner = feature.properties.user_name === currentUser; // Cek apakah pemilik data
                const canEdit = isAdmin || isOwner; // Bisa edit jika admin atau pemilik

                const el = document.createElement('div');
                el.className = 'kos-pin';

                const jenis = feature.properties.jenis ? feature.properties.jenis.toLowerCase() : '';
                let color = '#6C4F51';

                if (jenis.includes('putri')) color = '#ff69b4';
                else if (jenis.includes('putra')) color = '#1e90ff';
                else if (jenis.includes('campuran')) color = '#ffd700';

                el.innerHTML = `<i class="fas fa-location-dot" style="color: ${color}; font-size: 26px;"></i>`;

                const timestamp = new Date().getTime();
                const getFotoUrl = (fotoPath) => {
                    if (!fotoPath) return null;

                    // Jika sudah URL lengkap
                    if (fotoPath.startsWith('http')) {
                        return `${fotoPath}?${new Date().getTime()}`;
                    }

                    // Jika path relatif (format lama)
                    // Ubah ke URL lengkap dengan domain Anda
                    return `https://edgize.mapid.co.id/${fotoPath.replace(/^\/?uploads\//, 'uploads/')}?${new Date().getTime()}`;
                };

                const fotoUrl = getFotoUrl(feature.properties.foto);

                const popupContent = `
            <div style="max-width: 250px;">
                <h3 style="margin-bottom: 5px; color: #6C4F51;">${feature.properties.nama || '-'}</h3>
                <div style="font-weight: bold; color: #6C4F51; margin-bottom: 5px;">
                    Rp${feature.properties.harga ? Number(feature.properties.harga).toLocaleString('id-ID') : '0'}/bulan
                </div>
                <div><strong>Jenis:</strong> ${feature.properties.jenis || '-'}</div>
                <div><strong>Alamat:</strong> ${feature.properties.alamat || '-'}</div>
                <div><strong>Telepon:</strong> ${feature.properties.telepon || '-'}</div>
                ${fotoUrl ? `
                                                                    <div style="margin-top: 10px; text-align: center;">
                                                                        <img src="${fotoUrl}"
                                                                            style="width: 220px; height: 220px; border-radius: 4px;"
                                                                            onerror="this.style.display='none'">
                                                                    </div>
                                                                ` : ''}
                <div class="mt-2 d-flex justify-content-between">
                    ${canEdit ? `
                                                                                    <button onclick="showEditModal(${feature.properties.id})" style="background-color:#5D3A00;color:white;padding:8px 16px;font-size:14px;border:none;border-radius:6px;cursor:pointer;">Edit</button>
                                                                                    <button onclick="confirmDelete(${feature.properties.id})" style="background-color:#dc3545;color:white;padding:8px 16px;font-size:14px;border:none;border-radius:6px;cursor:pointer;">Delete</button>
                                                                                ` : ''}
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


        //----------------- Delete Point ---------------------//
        function confirmDelete(pointId) {
            // Create a custom modal for delete confirmation
            const modalHtml = `
        <div id="deleteConfirmModal" class="modal" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #6C4F51; color: white;">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data kos ini?</p>
                        <p style="font-size: 0.9em; color: #6c757d;">Data yang dihapus tidak dapat dikembalikan.</p>
                    </div>
                    <div class="modal-footer">
                        <button id="cancelDelete" style="background-color: #f8f9fa; color: #333; border: 1px solid #ddd; padding: 6px 12px; border-radius: 4px; cursor: pointer;">Batal</button>
                        <button id="confirmDelete" style="background-color: #6C4F51; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    `;

            // Create and append the modal to the body
            const modalDiv = document.createElement('div');
            modalDiv.innerHTML = modalHtml;
            document.body.appendChild(modalDiv);

            // Add event listeners
            document.getElementById('cancelDelete').addEventListener('click', function() {
                document.body.removeChild(modalDiv);
            });

            document.getElementById('confirmDelete').addEventListener('click', function() {
                document.body.removeChild(modalDiv);
                deletePoint(pointId);
            });

            // Close modal when clicking outside
            modalDiv.addEventListener('click', function(e) {
                if (e.target.id === 'deleteConfirmModal') {
                    document.body.removeChild(modalDiv);
                }
            });
        }

        async function deletePoint(pointId) {
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

                if (!csrfToken) {
                    throw new Error('CSRF token tidak ditemukan');
                }

                const response = await axios.delete(`/points/${pointId}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (response.data.success) {
                    showToast('Data berhasil dihapus!', 'success');
                    kosMarkers.forEach(marker => marker.remove());
                    kosMarkers = [];
                    fetchPoints();
                } else {
                    throw new Error(response.data.message || 'Gagal menghapus data');
                }
            } catch (error) {
                console.error('Error:', error);
                showToast(error.response?.data?.message || error.message || 'Gagal menghapus data', 'error');
            }
        }

        map.on('load', () => {
            fetchPoints();
            initModal();
            initEditModal();

            document.getElementById('add-point-btn').addEventListener('click', function() {
                if (isAddingPoint) {
                    deactivateAddPointMode();
                } else {
                    activateAddPointMode();
                }
            });

            document.getElementById('addPointModal').addEventListener('hidden.bs.modal', function() {
                resetAddPointMode();
            });
        });

        function showToast(message, type = 'info') {
            const icons = {
                info: 'info-circle',
                warning: 'exclamation-triangle',
                error: 'times-circle',
                success: 'check-circle'
            };

            const colors = {
                info: '#17a2b8',
                warning: '#ffc107',
                error: '#dc3545',
                success: '#28a745'
            };

            // Remove existing toasts to prevent stacking
            document.querySelectorAll('.toast-notification').forEach(toast => toast.remove());

            const toast = document.createElement('div');
            toast.className = `toast-notification ${type}`;
            toast.style.backgroundColor = colors[type] || colors.info;

            // Create close button
            const closeBtn = document.createElement('button');
            closeBtn.innerHTML = '&times;';
            closeBtn.className = 'toast-close-btn';
            closeBtn.onclick = () => toast.remove();

            toast.innerHTML = `
        <i class="fas fa-${icons[type] || 'info-circle'}" style="font-size: 18px;"></i>
        <div style="flex: 1; margin: 0 10px;">${message}</div>
    `;

            toast.appendChild(closeBtn);
            document.body.appendChild(toast);

            // Auto remove after 5 seconds
            setTimeout(() => {
                toast.remove();
            }, 5000);
        }

        function formatFieldName(field) {
            const fieldNames = {
                'nama': 'Nama Kos',
                'alamat': 'Alamat',
                'jenis': 'Jenis Kos',
                'harga': 'Harga',
                'geom': 'Lokasi',
                'foto': 'Foto',
                'pemilik': 'Nama Pemilik',
                'telepon': 'Telepon',
                'lbangunan': 'Luas Bangunan',
                'ltanah': 'Luas Tanah',
                'jenissertifikat': 'Jenis Sertifikat'
            };

            return fieldNames[field] || field;
        }

        // Fungsi untuk menerjemahkan pesan error (digunakan bersama untuk create dan update)
        function translateErrorMessage(message) {
            const translations = {
                'Invalid text representation': 'Format data tidak valid',
                'invalid input syntax for type integer': 'Nilai harus berupa angka bulat (tanpa desimal)',
                'Failed to save data': 'Gagal menyimpan data',
                'Network Error': 'Koneksi jaringan bermasalah',
                'Request failed with status code 500': 'Terjadi kesalahan di server',
                'The given data was invalid': 'Data yang dimasukkan tidak valid',
                'not found': 'Data tidak ditemukan',
                'Unauthorized': 'Anda tidak memiliki izin'
            };

            // Cari terjemahan yang cocok
            for (const [key, value] of Object.entries(translations)) {
                if (message.toLowerCase().includes(key.toLowerCase())) {
                    return value;
                }
            }

            return message; // Kembalikan pesan asli jika tidak ada terjemahan
        }

        // Fungsi untuk memformat pesan error dari validasi
        function formatValidationErrors(errors) {
            let errorMessage = '';

            for (const field in errors) {
                const fieldName = formatFieldName(field);
                const messages = errors[field].map(msg => {
                    // Translate common validation messages
                    if (msg.includes('required')) return 'harus diisi';
                    if (msg.includes('integer')) return 'harus berupa angka bulat (tanpa desimal)';
                    if (msg.includes('numeric')) return 'harus berupa angka';
                    if (msg.includes('min')) return 'nilai terlalu kecil';
                    if (msg.includes('max')) return 'nilai terlalu besar';
                    if (msg.includes('image')) return 'harus berupa gambar';
                    if (msg.includes('uploaded')) return 'gagal diunggah';
                    return msg;
                });

                errorMessage += `<b>${fieldName}</b>: ${messages.join(', ')}<br>`;
            }

            return errorMessage;
        }

        // Fungsi format nama field dalam bahasa Indonesia
        function formatFieldName(field) {
            const fieldNames = {
                'nama': 'Nama Kos',
                'alamat': 'Alamat',
                'jenis': 'Jenis Kos',
                'harga': 'Harga',
                'geom': 'Lokasi',
                'foto': 'Foto',
                'pemilik': 'Nama Pemilik',
                'telepon': 'Telepon',
                'lbangunan': 'Luas Bangunan',
                'ltanah': 'Luas Tanah',
                'jenissertifikat': 'Jenis Sertifikat',
                'user_name': 'Nama Pengguna'
            };

            return fieldNames[field] || field;
        }

        function validateForm(formId) {
            const form = document.getElementById(formId);
            const requiredFields = form.querySelectorAll('[required]');

            for (const field of requiredFields) {
                if (!field.value.trim()) {
                    const fieldName = field.labels[0]?.textContent || field.placeholder || field.name;
                    showToast(`${fieldName} harus diisi`, 'error');
                    field.focus();
                    return false;
                }
            }

            // Validasi khusus untuk harga
            const hargaInput = form.querySelector('[name="harga"]');
            if (hargaInput && hargaInput.value.includes('.')) {
                showToast('Harga harus berupa angka bulat (tanpa desimal)', 'error');
                hargaInput.focus();
                return false;
            }

            return true;
        }
    </script>
@endsection
