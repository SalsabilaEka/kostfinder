@extends('layouts.template')

@section('styles')
    <link href="https://unpkg.com/maplibre-gl@2.1.9/dist/maplibre-gl.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        :root {
            --default-font: "Poppins", sans-serif;
            --heading-font: "Poppins", sans-serif;
            --brand-font: "Righteous", sans-serif;
            --background-color: #F9EDE3;
            --default-color: #ffffff;
            --heading-color: #ffffff;
            --accent-color: #673E42;
            --surface-color: #6B4145;
            --contrast-color: #ffffff;
            --text-color: #4F5153;
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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

        #map {
            position: absolute;
            top: 70px;
            bottom: 0;
            width: 100%;
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
            width: 140px;
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

        #buffer-control {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        #location-control {
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

        #map-controls #buffer-button,
        #map-controls #location-button,
        #map-controls #filter-button,
        #map-controls #start-routing-button {
            background-color: #6C4F51;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        #map-controls #buffer-button:hover,
        #map-controls #location-button:hover,
        #map-controls #filter-button:hover,
        #map-controls #start-routing-button:hover {
            background-color: #1e1717;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        #map-controls #delete-buffer-button {
            background-color: #dc3545;
            color: white;
            display: none;
            border-radius: 5px;
        }

        #map-controls #reset-filter-modal {
            background-color: #dc3545;
            color: white;
            display: none;
            border-radius: 5px;
            margin-top: 5px;
        }

        #map-controls #delete-buffer-button:hover {
            background-color: #c82333;
            border-radius: 5px;
        }

        #map-controls #reset-filter-modal:hover {
            background-color: #dc3545;
            color: white;
            display: none;
            border-radius: 5px;
            margin-top: 5px;
        }

        .kos-pin {
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.5);
            border-radius: 50%;
        }

        .buffer-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }

        .buffer-modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            max-width: 90%;
        }

        .buffer-modal h3 {
            margin-top: 0;
            color: #6C4F51;
        }

        .buffer-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin: 15px 0;
        }

        .buffer-option {
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.2s;
        }

        .buffer-option:hover {
            background-color: #ddd;
        }

        .buffer-option.active {
            background-color: #6C4F51;
            color: white;
        }

        .buffer-modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .buffer-modal-buttons button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .buffer-modal-buttons .cancel {
            background-color: #f0f0f0;
        }

        .buffer-modal-buttons .apply {
            background-color: #6C4F51;
            color: white;
        }

        .current-location-marker {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #4285F4;
            border: 3px solid white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .loading-indicator {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 3000;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 18px;
            flex-direction: column;
        }

        .loading-spinner {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #6C4F51;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin-bottom: 15px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .route-controls {
            display: none;
            position: absolute;
            top: 60px;
            right: 10px;
            background: white;
            padding: 8px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            flex-direction: column;
            gap: 8px;
            margin-top: 250px;
            max-height: 400px;
        }

        .route-controls.active {
            display: flex;
        }

        .route-info {
            font-size: 14px;
            color: #6C4F51;
            margin-bottom: 5px;
        }

        #route-distance {
            font-weight: bold;
        }

        #route-duration {
            font-weight: bold;
        }

        .route-instructions-container {
            max-height: 200px;
            overflow-y: auto;
            margin-top: 5px;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 5px;
            border: 1px solid #eee;
        }

        .route-instructions-container h4 {
            color: #6C4F51;
            margin-top: 0;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;

        }

        .transport-mode {
            background: #6C4F51;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            margin-bottom: 10px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .steps-list {
            padding-left: 20px;
            margin: 0;
        }

        .step-item {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #ddd;
        }

        .step-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .step-instruction {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .step-details {
            display: flex;
            gap: 10px;
            font-size: 12px;
            color: #666;
        }


        .step-details span {
            display: flex;
            align-items: center;
            gap: 3px;
        }

        #clear-route {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        #clear-route:hover {
            background-color: #c82333;
        }

        .filter-controls {
            position: absolute;
            top: 60px;
            right: 10px;
            background: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            width: 300px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .filter-section {
            margin-bottom: 15px;
        }

        .filter-section label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #6C4F51;
        }

        .filter-options {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px 15px;
        }

        .filter-options label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: normal;
            cursor: pointer;
            white-space: normal;
            overflow: visible;
            word-break: break-word;
            min-width: 0;
        }


        .price-range {
            padding: 10px 0;
        }

        .price-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }

        #price-slider {
            width: 100%;
        }

        #apply-filter,
        #reset-filter {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        #apply-filter {
            background-color: #6C4F51;
            color: white;
        }

        #reset-filter {
            background-color: #f0f0f0;
        }

        .filter-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }

        .filter-modal-content {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            width: 700px;
            max-width: 95%;
            max-height: 80vh;
            overflow-y: auto;
        }

        @media (max-width: 600px) {
            .filter-modal-content {
                width: 100%;
                padding: 15px;
            }

            .filter-options {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .filter-modal-content {
                width: 100%;
                padding: 15px;
            }

            .filter-options {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 400px) {
            .filter-options {
                grid-template-columns: 1fr;
            }
        }

        .filter-modal h3 {
            margin-top: 0;
            color: #6C4F51;
        }

        .filter-modal-buttons {
            display: flex;
            gap: 10px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            margin-top: auto;
        }

        .filter-modal-buttons button {
            flex: 1;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .filter-modal-buttons .cancel {
            background-color: #f0f0f0;
        }

        .filter-modal-buttons .apply {
            background-color: #6C4F51;
            color: white;
        }

        .direction-button,
        .detail-button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            transition: all 0.2s;
            width: 100%;
            box-sizing: border-box;
        }

        .direction-button {
            background-color: #6C4F51;
            color: white;
        }

        .direction-button:hover {
            background-color: #1e1717;
        }

        .detail-button {
            background-color: #6C4F51;
            color: white;
            text-align: center;
        }

        .detail-button:hover {
            background-color: #1e1717;
        }

        #layer-controls {
            position: absolute;
            top: 100px;
            right: 10px;
            background: white;
            padding: 8px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            font-family: sans-serif;
            margin-top: 100px;
            transition: all 0.3s ease;
        }

        #layer-controls.mobile-collapsed {
            top: 30%;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        #layer-controls.mobile-collapsed .layer-controls-title,
        #layer-controls.mobile-collapsed .layer-controls-options {
            display: none;
        }

        #layer-controls.mobile-collapsed::before {
            content: '\f0c9';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-size: 18px;
            color: #6C4F51;
        }

        #layer-controls-toggle {
            display: none;
            position: absolute;
            top: 15%;
            right: 10px;
            z-index: 1001;
            background: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            border: none;
        }

        #layer-controls-toggle i {
            color: #6C4F51;
            font-size: 18px;
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

        .layer-controls-title {
            font-size: 14px;
            font-weight: bold;
            color: #6C4F51;
            margin-bottom: 5px;
            border-bottom: 1px solid #eee;
            padding-bottom: 3px;
        }

        .layer-controls-options {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .layer-controls-options label {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            font-size: 13px;
        }

        /* Mobile controls */
        @media (max-width: 768px) {
            #layer-controls {
                position: fixed;
                right: 10px;
                top: 30%;
                left: auto;
                margin-top: 0;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
            }

            #layer-controls .layer-controls-title,
            #layer-controls .layer-controls-options {
                display: none;
            }

            #layer-controls::before {
                content: '\f0c9';
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
                font-size: 18px;
                color: #6C4F51;
            }

            #layer-controls.mobile-expanded {
                width: 150px;
                height: auto;
                border-radius: 5px;
                padding: 8px;
                display: block;
            }

            #layer-controls.mobile-expanded::before {
                display: none;
            }

            #layer-controls.mobile-expanded .layer-controls-title,
            #layer-controls.mobile-expanded .layer-controls-options {
                display: block;
            }

            #map-controls {
                display: none;
                margin-top: 5%;
                max-width: 30%
            }

            #route-controls {
                position: fixed !important;
                bottom: 80px !important;
                left: 10px !important;
                right: 10px !important;
                top: auto !important;
                width: calc(100% - 40px) !important;
                max-width: 340px !important;
                margin: 0 auto !important;
                max-height: 60vh !important;
                margin-top: 0 !important;
                border-radius: 12px !important;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15) !important;
            }

            #route-controls.active {
                display: flex;
                flex-direction: column;
                padding: 15px !important;
            }

            .route-instructions-container {
                max-height: 235px;
                height: auto;
                overflow-y: auto;
                padding: 10px !important;
            }

            .mobile-control-button {
                position: fixed;
                z-index: 1000;
                background: white;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                cursor: pointer;
            }

            #toggle-tools {
                top: 15%;
                left: 10px;
                z-index: 999 !important;
            }

            #toggle-route {
                position: fixed;
                bottom: 15% !important;
                right: 10px;
                z-index: 9999 !important;
                background: white;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                cursor: pointer;
            }

            #map-controls.mobile-active {
                display: block;
                position: absolute;
                top: 110px;
                left: 10px;
                z-index: 1001;
                max-height: 70vh;
                overflow-y: auto;
            }
        }

        @media (min-width: 769px) {
            .mobile-control-button {
                display: none !important;
            }
        }

        .map-legend {
            font-family: Arial, sans-serif;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
            max-width: 200px;
        }

        .map-legend h4 {
            margin: 0 0 8px 0;
            font-size: 11px;
            font-weight: bold;
            color: #333;
        }

        .legend-gradient {
            height: 15px;
            width: 100%;
            margin-bottom: 5px;
            border-radius: 3px;
            overflow: hidden;
        }

        .legend-labels {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: #555;
        }


        #layer-controls-mobile {
            position: absolute;
            top: 30%;
            right: 20px;
            width: 200px;
            z-index: 1000;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        .mobile-controls-toggle {
            width: 100%;
            padding: 12px 16px;
            background: #6C4F51;
            color: white;
            border: none;
            font-weight: 600;
            font-size: 14px;
            text-align: left;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }

        .toggle-icon {
            font-size: 14px;
            transition: transform 0.3s;
        }

        .mobile-controls-content {
            padding: 12px 16px;
        }

        .mobile-controls-options label {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            font-size: 13px;
            color: #333;
        }

        .mobile-controls-options label input[type="checkbox"] {
            margin-right: 8px;
        }

        .map-legend {
            margin-top: 12px;
        }

        .map-legend h4 {
            font-size: 13px;
            margin-bottom: 6px;
            color: #555;
        }

        .legend-gradient {
            height: 10px;
            border-radius: 5px;
            margin-bottom: 4px;
        }

        .legend-labels {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #777;
        }

        .mobile-controls-content[style*="display: block"] {
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #layer-controls.mobile-collapsed .layer-controls-title,
        #layer-controls.mobile-collapsed .layer-controls-options {
            display: none;
        }

        #layer-controls.mobile-collapsed::before {
            content: '\f0c9';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-size: 18px;
            color: #6C4F51;
        }

        #layer-controls-toggle {
            display: none;
            position: absolute;
            top: 15%;
            right: 10px;
            z-index: 1001;
            background: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            border: none;
        }

        #layer-controls-toggle i {
            color: #6C4F51;
            font-size: 18px;
        }
    </style>
@endsection

@section('content')
    <main id="main-content">
        <div class="content-wrapper">
            {{-- Map Container --}}
            <div id="map">
            </div>

            {{-- Tools Control Grup --}}
            <div id="map-controls">
                <div class="control-group">
                    <div class="control-group-title">Jenis Peta</div>
                    <div id="basemap-control">
                        <button id="street" class="active-basemap">Default</button>
                        <button id="satellite">Satelit</button>
                    </div>
                </div>

                <div class="control-group">
                    <div class="control-group-title">Fitur Lokasi</div>
                    <div id="location-control">
                        <button id="location-button">Lokasi Pengguna</button>
                    </div>
                </div>

                <div class="control-group">
                    <div class="control-group-title">Fitur Buffer</div>
                    <div id="buffer-control">
                        <button id="buffer-button">Buat Buffer</button>
                        <button id="delete-buffer-button" style="display: none;">Hapus Buffer</button>
                    </div>
                </div>

                <div class="control-group">
                    <div class="control-group-title">Fitur Filter</div>
                    <div id="filter-control">
                        <button id="filter-button">Buat Filter</button>
                        <button id="reset-filter-modal" style="display: none;">Hapus Filter</button>
                    </div>
                </div>

                <div class="control-group">
                    <div class="control-group-title">Fitur Rute</div>
                    <div id="routing-control">
                        <button id="start-routing-button">Buat Rute</button>
                    </div>
                </div>
            </div>

            <div id="layer-controls">
                <div class="layer-controls-title">Legenda</div>
                <div class="layer-controls-options">
                    <label><input type="checkbox" id="toggle-kos-clusters" style="accent-color: #6C4F51;" checked> Titik
                        Kos</label>
                    <label><input type="checkbox" id="toggle-halte-points" style="accent-color: #6C4F51;"> Titik
                        Halte</label>
                    <label><input type="checkbox" id="toggle-univ-points" style="accent-color: #6C4F51;"> Titik
                        Fakultas</label>
                    <label><input type="checkbox" id="toggle-ndbi" style="accent-color: #6C4F51;"> Indeks Kepadatan
                        Bangunan</label>

                    <div class="map-legend">
                        <h4>Skala Kepadatan</h4>
                        <div class="legend-gradient"
                            style="background: linear-gradient(to right, #E8F5E9, #A5D6A7, #FFE082, #EF9A9A);"></div>
                        <div class="legend-labels">
                            <span>Rendah</span>
                            <span>Tinggi</span>
                        </div>
                    </div>

                    <label><input type="checkbox" id="toggle-lst" style="accent-color: #6C4F51;"> Suhu Permukaan</label>

                    <div class="map-legend">
                        <h4>Suhu Permukaan Tanah</h4>
                        <div class="legend-gradient"
                            style="background: linear-gradient(to right, #c0e6ff, #78aeff, #FFE082, #EF9A9A);"></div>
                        <div class="legend-labels">
                            <span>Rendah</span>
                            <span>Tinggi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Buffer Modal --}}
        <div id="buffer-modal" class="buffer-modal">
            <div class="buffer-modal-content">
                <h3 style="text-align: center;">Pilih Radius Buffer</h3>
                <p style="text-align: center; font-size:14px;">Pilih radius untuk menentukan seberapa jauh area di
                    sekitar titik yang ingin Anda lihat.</p>
                <div class="buffer-options">
                    <div class="buffer-option" data-distance="0.5">500 Meter</div>
                    <div class="buffer-option" data-distance="1">1 Kilometer</div>
                    <div class="buffer-option" data-distance="2">2 Kilometer</div>
                </div>
                <div class="buffer-modal-buttons">
                    <button class="cancel">Batal</button>
                    <button class="apply">Terapkan</button>
                </div>
            </div>
        </div>

        {{-- Filter Modal --}}
        <div id="filter-modal" class="filter-modal">
            <div class="filter-modal-content">
                <h3>Filter Kos</h3>

                <div class="filter-section">
                    <label>Jenis Kos:</label>
                    <div class="filter-options">
                        <label><input type="checkbox" name="kos-type" value="putri" checked> Putri</label>
                        <label><input type="checkbox" name="kos-type" value="putra" checked> Putra</label>
                        <label><input type="checkbox" name="kos-type" value="campuran" checked> Campuran</label>
                    </div>
                </div>

                <div class="filter-section">
                    <label>Harga per Bulan:</label>
                    <div class="price-range">
                        <input type="range" id="price-slider" min="0" max="5000000" step="50000"
                            value="5000000">
                        <div class="price-labels">
                            <span>Rp0</span>
                            <span id="max-price-display">Rp5.000.000</span>
                        </div>
                    </div>
                </div>

                <div class="filter-section">
                    <label>Fasilitas:</label>
                    <div class="filter-options">
                        <label><input type="checkbox" name="facility" value="kasur"> Kasur</label>
                        <label><input type="checkbox" name="facility" value="mejakursi"> Meja Kursi Belajar</label>
                        <label><input type="checkbox" name="facility" value="lemari"> Lemari</label>
                        <label><input type="checkbox" name="facility" value="ac"> AC</label>
                        <label><input type="checkbox" name="facility" value="kamarmandi"> Kamar Mandi Dalam</label>
                        <label><input type="checkbox" name="facility" value="wifi"> WiFi</label>
                        <label><input type="checkbox" name="facility" value="dapur"> Dapur</label>
                        <label><input type="checkbox" name="facility" value="kulkas"> Kulkas</label>
                        <label><input type="checkbox" name="facility" value="listrik"> Listrik</label>
                        <label><input type="checkbox" name="facility" value="air"> Air</label>
                        <label><input type="checkbox" name="facility" value="parkirmotor"> Parkir Motor</label>
                        <label><input type="checkbox" name="facility" value="parkirmobil"> Parkir Mobil</label>
                        <label><input type="checkbox" name="facility" value="keamanan"> Keamanan 24 Jam</label>
                    </div>
                </div>

                <div class="filter-modal-buttons">
                    <button class="cancel">Batal</button>
                    <button class="apply">Terapkan</button>
                </div>
            </div>
        </div>

        {{-- Route Info --}}
        <div id="route-controls" class="route-controls">
            <div class="route-info">
                Jarak: <span id="route-distance">-</span>
            </div>
            <div class="route-info">
                Durasi: <span id="route-duration">-</span>
            </div>
            <div id="route-instructions"></div>
            <button id="clear-route">Hapus Rute</button>
        </div>

        {{-- Loading --}}
        <div id="loading-indicator" class="loading-indicator">
            <div class="loading-spinner"></div>
            <div id="loading-text">Memuat...</div>
        </div>

        {{-- Mobile Control Buttons --}}
        <div id="toggle-tools" class="mobile-control-button" title="Tools">
            <i class="fas fa-tools"></i>
        </div>

        <div id="toggle-route" class="mobile-control-button" title="Route Info">
            <i class="fas fa-route"></i>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/maplibre-gl@2.1.9/dist/maplibre-gl.js"></script>
    <script src="https://unpkg.com/terraformer@1.0.7/terraformer.js"></script>
    <script src="https://unpkg.com/terraformer-wkt-parser@1.1.2/terraformer-wkt-parser.js"></script>
    <script src="https://unpkg.com/@turf/turf@6/turf.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

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

        //----------- Map initialization ---------------//
        const map = new maplibregl.Map({
            container: 'map',
            style: 'https://basemap.mapid.io/styles/street-2d-building/style.json?key=67d3bf388a760ad05471c4dd',
            center: [110.37832333533383, -7.765659878711547],
            zoom: 14
        });

        map.addControl(new maplibregl.NavigationControl());

        const basemaps = {
            'Street': 'https://basemap.mapid.io/styles/street-2d-building/style.json?key=67d3bf388a760ad05471c4dd',
            'Satellite': 'https://basemap.mapid.io/styles/satellite/style.json?key=67d3bf388a760ad05471c4dd'
        };


        //----------------- Basemap controls ----------------------//
        function setBasemap(styleUrl) {
            saveLayerStates();
            removeBuffers();

            const currentCenter = map.getCenter();
            const currentZoom = map.getZoom();
            const currentPitch = map.getPitch();
            const currentBearing = map.getBearing();

            map.setStyle(styleUrl);

            map.once('styledata', () => {
                setupMapLayers();

                map.once('idle', () => {
                    map.setCenter(currentCenter);
                    map.setZoom(currentZoom);
                    map.setPitch(currentPitch);
                    map.setBearing(currentBearing);

                    applyLayerStates();
                });

                fetch("{{ route('api.points') }}")
                    .then(response => response.json())
                    .then(data => {
                        addKosClusters(data);
                        applyLayerStates();
                    });

                fetch("{{ route('api.halte') }}")
                    .then(response => response.json())
                    .then(data => {
                        addHaltePoints(data);
                        applyLayerStates();
                    });

                fetch("{{ route('api.univ') }}")
                    .then(response => response.json())
                    .then(data => {
                        addUnivPoints(data);
                        applyLayerStates();
                    });

                if (isBufferActive && bufferCenter && selectedBufferDistance) {
                    createBuffer(bufferCenter, selectedBufferDistance);
                }

                if (currentLocationMarker && userLocation) {
                    const el = document.createElement('div');
                    el.className = 'current-location-marker';

                    currentLocationMarker = new maplibregl.Marker(el)
                        .setLngLat([userLocation.lng, userLocation.lat])
                        .setPopup(new maplibregl.Popup().setHTML('Lokasi Anda saat ini!'))
                        .addTo(map);
                }

                if (currentRoute) {
                    addRouteToMap(currentRoute.geometry);
                    document.getElementById('route-controls').classList.add('active');
                }

                if (layerStates.ndbi) toggleNdbilayer();
                if (layerStates.lst) togglelstlayer();
            });
        }

        function setupMapLayers() {
            if (!map.getSource('ndbi')) {
                map.addSource('ndbi', {
                    type: 'geojson',
                    data: "{{ asset('geojson/ndbi.geojson') }}"
                });
            }

            if (!map.getSource('lst')) {
                map.addSource('lst', {
                    type: 'geojson',
                    data: "{{ asset('geojson/lst.geojson') }}"
                });
            }
        }

        function setActiveButton(activeId) {
            const buttons = document.querySelectorAll('#basemap-control button');
            buttons.forEach(btn => btn.classList.remove('active-basemap'));
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


        //---------------------- Loading indicator -------------------------//
        function showLoading(message = 'Loading...') {
            document.getElementById('loading-text').textContent = message;
            document.getElementById('loading-indicator').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('loading-indicator').style.display = 'none';
        }


        //----------------------- Kost data visualization --------------------------//
        let kosClusterMarkers = [];

        function addKosClusters(data) {
            if (map.getSource('kos-clusters')) {
                map.removeLayer('kos-clusters');
                map.removeLayer('kos-cluster-count');
                map.removeLayer('kos-unclustered');
                map.removeSource('kos-clusters');
            }

            kosClusterMarkers.forEach(marker => marker.remove());
            kosClusterMarkers = [];

            allKosData = JSON.parse(JSON.stringify(data));

            data.features.forEach(feature => {
                if (!originalKosColors[feature.properties.id]) {
                    originalKosColors[feature.properties.id] = getDefaultColor(feature);
                }
            });

            map.addSource('kos-clusters', {
                type: 'geojson',
                data: data,
                cluster: true,
                clusterMaxZoom: 13,
                clusterRadius: 50
            });

            map.addLayer({
                id: 'kos-clusters',
                type: 'circle',
                source: 'kos-clusters',
                filter: ['has', 'point_count'],
                paint: {
                    'circle-color': [
                        'step',
                        ['get', 'point_count'],
                        '#b5a7a8',
                        5, '#988385',
                        10, '#7a6062',
                        50, '#6c4f51'
                    ],
                    'circle-radius': [
                        'step',
                        ['get', 'point_count'],
                        20,
                        10, 25,
                        50, 30,
                        100, 35
                    ],
                    'circle-stroke-width': 1,
                    'circle-stroke-color': '#fff'
                }
            });

            map.addLayer({
                id: 'kos-cluster-count',
                type: 'symbol',
                source: 'kos-clusters',
                filter: ['has', 'point_count'],
                layout: {
                    'text-field': ['get', 'point_count_abbreviated'],
                    "text-font": ["Open Sans Regular", "Arial Unicode MS Regular"],
                    'text-size': 12
                },
                paint: {
                    'text-color': '#fff'
                }
            });

            map.addLayer({
                id: 'kos-unclustered',
                type: 'circle',
                source: 'kos-clusters',
                filter: ['!', ['has', 'point_count']],
                paint: {
                    'circle-opacity': 0
                }
            });

            function createUnclusteredMarkers() {
                const source = map.getSource('kos-clusters');
                if (!source) return;

                kosClusterMarkers.forEach(marker => marker.remove());
                kosClusterMarkers = [];

                const features = map.queryRenderedFeatures({
                    layers: ['kos-unclustered']
                });

                features.forEach(feature => {
                    const properties = feature.properties;
                    const coordinates = feature.geometry.coordinates;

                    const kosData = allKosData.features.find(f =>
                        f.properties.id === properties.id
                    );

                    if (kosData) {
                        const el = document.createElement('div');
                        el.className = 'kos-pin';

                        const originalColor = originalKosColors[kosData.properties.id] || getDefaultColor(kosData);
                        el.innerHTML =
                            `<i class="fas fa-location-dot" style="color: ${originalColor}; font-size: 26px;"></i>`;

                        const facilities = [];
                        if (kosData.properties.ac) facilities.push('AC');
                        if (kosData.properties.kasur) facilities.push('Kasur');
                        if (kosData.properties.mejakursi) facilities.push('Meja & Kursi');
                        if (kosData.properties.kamarmandi) facilities.push('Kamar Mandi Dalam');
                        if (kosData.properties.lemari) facilities.push('Lemari');
                        if (kosData.properties.wifi) facilities.push('WiFi');
                        if (kosData.properties.dapur) facilities.push('Dapur');
                        if (kosData.properties.kulkas) facilities.push('Kulkas');
                        if (kosData.properties.ruangtamu) facilities.push('Ruang Tamu');
                        if (kosData.properties.parkirmotor) facilities.push('Parkir Motor');
                        if (kosData.properties.parkirmobil) facilities.push('Parkir Mobil');
                        if (kosData.properties.cctv) facilities.push('CCTV');
                        if (kosData.properties.keamanan) facilities.push('Keamanan 24 Jam');

                        const fasilitasHtml = facilities.map(f => `<li>${f}</li>`).join('');

                        const detailUrl = `/points/table?search=${encodeURIComponent(kosData.properties.nama)}`;

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
                            <h2>${kosData.properties.nama}</h2>
                            <div style="color: #6C4F51; font-weight: bold; font-size: 14px; margin-bottom: 5px; margin-top: 5px;">
                                Rp${Number(kosData.properties.harga).toLocaleString('id-ID')}/bulan
                            </div>
                            <div><strong>Jenis:</strong> ${kosData.properties.jenis}</div>
                            ${fotoUrl ? `
                                        <div style="margin-top: 10px; text-align: center;">
                                            <img src="${fotoUrl}"
                                                style="width: 220px; height: 220px; border-radius: 4px;"
                                                onerror="this.style.display='none'">
                                        </div>
                                    ` : ''}

                            <div style="margin-top: 10px; display: flex; flex-direction: column; gap: 8px;">
                            <button class="direction-button" data-lng="${kosData.geometry.coordinates[0]}" data-lat="${kosData.geometry.coordinates[1]}">
                                <i class="fas fa-route"></i> Petunjuk Arah
                            </button>
                            <a href="/detail/${kosData.properties.id}" class="detail-button">
                                <i class="fas fa-info-circle"></i> Lihat Detail Kos
                            </a>
                            </div>
                        `;

                        const marker = new maplibregl.Marker(el)
                            .setLngLat(coordinates)
                            .setPopup(new maplibregl.Popup({
                                offset: 25,
                                closeOnClick: false,
                                closeButton: true
                            }).setHTML(popupContent));

                        if (document.getElementById('toggle-kos-clusters').checked) {
                            marker.addTo(map);
                        }
                        kosClusterMarkers.push(marker);
                    }
                });
            }

            map.on('sourcedata', (e) => {
                if (e.sourceId === 'kos-clusters' && e.isSourceLoaded) {
                    createUnclusteredMarkers();
                }
            });

            map.on('data', (e) => {
                if (e.sourceId === 'kos-clusters' && e.isSourceLoaded) {
                    if (map.getZoom() > 13) {
                        createUnclusteredMarkers();
                    }
                }
            });

            map.on('moveend', () => {
                const currentZoom = map.getZoom();
                if (currentZoom > 13) {
                    createUnclusteredMarkers();
                } else {
                    kosClusterMarkers.forEach(marker => marker.remove());
                    kosClusterMarkers = [];
                }

                if (isBufferActive) {
                    updateMarkersInBuffer();
                }
            });

            map.on('click', 'kos-clusters', (e) => {
                const features = map.queryRenderedFeatures(e.point, {
                    layers: ['kos-clusters']
                });

                map.easeTo({
                    center: features[0].geometry.coordinates,
                    zoom: map.getZoom() + 2,
                    essential: true
                });
            });

            map.on('zoomend', () => {
                if (map.getZoom() > 13) {
                    createUnclusteredMarkers();
                } else {
                    kosClusterMarkers.forEach(marker => marker.remove());
                    kosClusterMarkers = [];
                }

                if (isBufferActive && map.getSource('buffer-source')) {
                    updateMarkersInBuffer();
                } else {
                    resetAllMarkersToOriginalColors();
                }
            });

            map.on('render', () => {
                if (isBufferActive && map.getZoom() > 13) {
                    updateMarkersInBuffer();
                }
            });

            map.on('mouseenter', 'kos-clusters', () => {
                map.getCanvas().style.cursor = 'pointer';
            });
            map.on('mouseleave', 'kos-clusters', () => {
                map.getCanvas().style.cursor = '';
            });

            map.on('click', 'kos-unclustered', (e) => {});

            map.on('mouseenter', 'kos-unclustered', () => {
                map.getCanvas().style.cursor = 'pointer';
            });
            map.on('mouseleave', 'kos-unclustered', () => {
                map.getCanvas().style.cursor = '';
            });
        }


        //----------------------- Halte data visualization --------------------------//
        function addHaltePoints(data) {
            if (map.getSource('haltePoints')) {
                map.getSource('haltePoints').setData(data);
            } else {
                map.addSource('haltePoints', {
                    type: 'geojson',
                    data: data
                });

                map.addLayer({
                    id: 'haltePoints',
                    type: 'circle',
                    source: 'haltePoints',
                    paint: {
                        'circle-radius': 5,
                        'circle-color': '#237420',
                        'circle-stroke-color': '#FFFFFF',
                        'circle-stroke-width': 2,
                        'circle-opacity': 0.9,
                    }
                });

                const tooltip = new maplibregl.Popup({
                    closeButton: false,
                    closeOnClick: false
                });

                map.on('click', 'haltePoints', (e) => {
                    const nama = e.features[0].properties.nama || "Nama tidak tersedia";
                    new maplibregl.Popup()
                        .setLngLat(e.lngLat)
                        .setHTML(`
                    <div>
                        <div style="color: #6C4F51; font-weight: bold; font-size: 16px; margin-bottom: 5px;">
                            Nama Halte: ${nama}
                        </div>
                        <div style="text-align: right;">
                        <a href="https://dishub.jogjaprov.go.id/trans-jogja"
                        target="_blank"
                        style="color: #d2a679; text-decoration: none;">
                        🔍 Informasi lebih lanjut
                        </a>
                        </div>
                    </div>
                `)
                        .addTo(map);
                });

                map.on('mouseenter', 'haltePoints', () => {
                    map.getCanvas().style.cursor = 'pointer';
                });
                map.on('mouseleave', 'haltePoints', () => {
                    map.getCanvas().style.cursor = '';
                });
            }
        }


        //----------------------- University data visualization --------------------------//
        const univFullName = {
            'UGM': 'Universitas Gadjah Mada',
            'UNY': 'Universitas Negeri Yogyakarta',
            '_default': 'Universitas'
        };

        function addUnivPoints(data) {
            if (map.getSource('univPoints')) {
                map.removeLayer('univPoints');
                map.removeSource('univPoints');
            }

            map.addSource('univPoints', {
                type: 'geojson',
                data: data
            });

            const colorMap = {
                'UGM': '#cd9564',
                'UNY': '#1813a4',
                '_default': '#E4FF5A'
            };

            map.addLayer({
                id: 'univPoints',
                type: 'circle',
                source: 'univPoints',
                paint: {
                    'circle-radius': 5,
                    'circle-color': [
                        'match',
                        ['get', 'universitas'],
                        'UGM', colorMap['UGM'],
                        'UNY', colorMap['UNY'],
                        colorMap['_default']
                    ],
                    'circle-stroke-width': 2,
                    'circle-stroke-color': '#FFF'
                }
            });

            map.on('click', 'univPoints', (e) => {
                const prop = e.features[0].properties;
                const namaLengkap = univFullName[prop.universitas] || univFullName['_default'];
                new maplibregl.Popup()
                    .setLngLat(e.lngLat)
                    .setHTML(`
                    <div style="color: #6C4F51; font-weight: bold; font-size: 16px; margin-bottom: 5px;">
                        ${prop.fakultas}
                    </div>
                    <div>${namaLengkap}</div>
            `)
                    .addTo(map);
            });

            map.on('mouseenter', 'univPoints', () => {
                map.getCanvas().style.cursor = 'pointer';
            });
            map.on('mouseleave', 'univPoints', () => {
                map.getCanvas().style.cursor = '';
            });
        }


        //--------------------- Buffering ------------------------//
        let bufferCenterMarker = null;
        let bufferLayerIds = [];
        let selectedBufferDistance = null;
        let bufferCenter = null;
        let originalKosColors = {};
        let bufferMode = false;
        let bufferClickHandler = null;
        let isBufferActive = false;
        let mapEventListeners = [];

        const bufferModal = document.getElementById('buffer-modal');
        const bufferButton = document.getElementById('buffer-button');
        const deleteBufferButton = document.getElementById('delete-buffer-button');
        const bufferOptions = document.querySelectorAll('.buffer-option');
        const cancelButton = document.querySelector('.buffer-modal-buttons .cancel');
        const applyButton = document.querySelector('.buffer-modal-buttons .apply');

        function createBuffer(center, distance) {
            removeBuffers();
            isBufferActive = true;

            const radius = distance * 1000;

            const buffer = turf.circle(center, radius, {
                steps: 64,
                units: 'meters'
            });

            if (map.getSource('buffer-source')) {
                map.getSource('buffer-source').setData(buffer);
            } else {
                map.addSource('buffer-source', {
                    type: 'geojson',
                    data: buffer
                });
            }

            const bufferLayerId = `buffer-${distance}km`;
            bufferLayerIds.push(bufferLayerId);

            map.addLayer({
                id: bufferLayerId,
                type: 'fill',
                source: 'buffer-source',
                paint: {
                    'fill-color': '#6C4F51',
                    'fill-opacity': 0.2,
                    'fill-outline-color': '#6C4F51'
                }
            });

            if (!bufferCenterMarker) {
                const el = document.createElement('div');
                el.className = 'kos-pin';
                el.innerHTML = `<i class="fas fa-crosshairs" style="color: #6C4F51; font-size: 26px;"></i>`;
                bufferCenterMarker = new maplibregl.Marker(el)
                    .setLngLat(center)
                    .addTo(map);
            }

            highlightKosInBuffer(buffer);

            document.getElementById('delete-buffer-button').style.display = 'block';
        }

        function highlightKosInBuffer(buffer) {
            resetKosMarkers();

            kosClusterMarkers.forEach(marker => {
                const lngLat = marker.getLngLat();
                const point = turf.point([lngLat.lng, lngLat.lat]);
                const isInside = turf.booleanPointInPolygon(point, buffer);

                if (isInside) {
                    const el = marker.getElement();
                    el.innerHTML = `<i class="fas fa-location-dot" style="color: #ff0000; font-size: 26px;"></i>`;
                }
            });

            if (map.getZoom() <= 13) {
                const source = map.getSource('kos-clusters');
                if (source) {
                    const features = source._data.features;

                    features.forEach(feature => {
                        if (!feature.properties.cluster) {
                            const point = turf.point(feature.geometry.coordinates);
                            const isInside = turf.booleanPointInPolygon(point, buffer);

                            if (isInside) {
                                if (!originalKosColors[feature.properties.id]) {
                                    const jenis = feature.properties.jenis.toLowerCase();
                                    let color = '#cccccc';

                                    if (jenis === 'kos putri') color = '#ff69b4';
                                    else if (jenis === 'kos putra') color = '#1e90ff';
                                    else if (jenis === 'kos campuran') color = '#ffd700';

                                    originalKosColors[feature.properties.id] = color;
                                }

                                feature.properties.forceRed = true;
                            } else {
                                feature.properties.forceRed = false;
                            }
                        }
                    });
                }
            }
        }

        function updateMarkersInBuffer() {
            if (!isBufferActive || !map.getSource('buffer-source')) {
                resetKosMarkers();
                return;
            }

            const bufferData = map.getSource('buffer-source')._data;

            kosClusterMarkers.forEach(marker => {
                const lngLat = marker.getLngLat();
                const point = turf.point([lngLat.lng, lngLat.lat]);
                const isInside = turf.booleanPointInPolygon(point, bufferData);

                const el = marker.getElement();
                if (isInside) {
                    el.innerHTML = `<i class="fas fa-location-dot" style="color: #ff0000; font-size: 26px;"></i>`;
                } else {
                    const feature = allKosData.features.find(f =>
                        f.geometry.coordinates[0] === lngLat.lng &&
                        f.geometry.coordinates[1] === lngLat.lat
                    );

                    if (feature) {
                        const jenis = feature.properties.jenis.toLowerCase();
                        let color = '#cccccc';
                        if (jenis === 'kos putri') color = '#ff69b4';
                        else if (jenis === 'kos putra') color = '#1e90ff';
                        else if (jenis === 'kos campuran') color = '#ffd700';

                        el.innerHTML =
                            `<i class="fas fa-location-dot" style="color: ${color}; font-size: 26px;"></i>`;
                    }
                }
            });

            const source = map.getSource('kos-clusters');
            if (source) {
                const features = source._data.features;
                features.forEach(feature => {
                    if (!feature.properties.cluster) {
                        const point = turf.point(feature.geometry.coordinates);
                        feature.properties.forceRed = turf.booleanPointInPolygon(point, bufferData);
                    }
                });
            }
        }

        function resetKosMarkers() {
            kosClusterMarkers.forEach(marker => {
                const lngLat = marker.getLngLat();
                const feature = allKosData.features.find(f =>
                    f.geometry.coordinates[0] === lngLat.lng &&
                    f.geometry.coordinates[1] === lngLat.lat
                );

                if (feature) {
                    const jenis = feature.properties.jenis.toLowerCase();
                    let color = '#cccccc';

                    if (jenis === 'kos putri') color = '#ff69b4';
                    else if (jenis === 'kos putra') color = '#1e90ff';
                    else if (jenis === 'kos campuran') color = '#ffd700';

                    const el = marker.getElement();
                    el.innerHTML = `<i class="fas fa-location-dot" style="color: ${color}; font-size: 26px;"></i>`;
                }
            });

            const source = map.getSource('kos-clusters');
            if (source) {
                const features = source._data.features;
                features.forEach(feature => {
                    if (feature.properties.forceRed) {
                        feature.properties.forceRed = false;
                    }
                });
            }

            if (map.getZoom() <= 13) {
                map.getSource('kos-clusters').setData(map.getSource('kos-clusters')._data);
            }
        }

        function removeBuffers() {
            bufferLayerIds.forEach(layerId => {
                if (map.getLayer(layerId)) map.removeLayer(layerId);
            });
            bufferLayerIds = [];

            if (map.getSource('buffer-source')) map.removeSource('buffer-source');
            if (bufferCenterMarker) {
                bufferCenterMarker.remove();
                bufferCenterMarker = null;
            }

            // Reset semua state terkait buffer
            bufferCenter = null;
            selectedBufferDistance = null;
            isBufferActive = false;
            bufferMode = false;

            resetAllMarkersToOriginalColors();
            document.getElementById('delete-buffer-button').style.display = 'none';

            mapEventListeners.forEach(listener => map.off(listener));
            mapEventListeners = [];
        }

        function resetAllMarkersToOriginalColors() {
            kosClusterMarkers.forEach(marker => {
                const lngLat = marker.getLngLat();
                const feature = allKosData.features.find(f =>
                    f.geometry.coordinates[0] === lngLat.lng &&
                    f.geometry.coordinates[1] === lngLat.lat
                );

                if (feature) {
                    const originalColor = originalKosColors[feature.properties.id] || getDefaultColor(feature);
                    const el = marker.getElement();
                    el.innerHTML =
                        `<i class="fas fa-location-dot" style="color: ${originalColor}; font-size: 26px;"></i>`;
                }
            });

            const source = map.getSource('kos-clusters');
            if (source) {
                const features = source._data.features;
                features.forEach(feature => {
                    if (feature.properties.forceRed) {
                        feature.properties.forceRed = false;
                    }
                });
                source.setData(source._data);
            }
        }

        function getDefaultColor(feature) {
            const jenis = feature.properties.jenis.toLowerCase();
            if (jenis === 'kos putri') return '#ff69b4';
            if (jenis === 'kos putra') return '#1e90ff';
            if (jenis === 'kos campuran') return '#ffd700';
            return '#cccccc';
        }

        bufferButton.addEventListener('click', () => {
            bufferMode = true;
            bufferModal.style.display = 'flex';
            selectedBufferDistance = null;
            bufferCenter = null;

            bufferOptions.forEach(opt => opt.classList.remove('active'));
        });

        deleteBufferButton.addEventListener('click', () => {
            removeBuffers();
        });

        bufferOptions.forEach(option => {
            option.addEventListener('click', () => {
                bufferOptions.forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');
                selectedBufferDistance = parseFloat(option.dataset.distance);
            });
        });

        cancelButton.addEventListener('click', () => {
            bufferModal.style.display = 'none';
        });

        applyButton.addEventListener('click', () => {
            if (!selectedBufferDistance) {
                showToast('Silakan pilih jarak buffer terlebih dahulu');
                return;
            }

            bufferModal.style.display = 'none';
            map.getCanvas().style.cursor = 'crosshair';

            if (bufferClickHandler) {
                map.off('click', bufferClickHandler);
            }

            bufferClickHandler = map.on('click', (e) => {
                if (!bufferMode) return;

                bufferCenter = [e.lngLat.lng, e.lngLat.lat];
                createBuffer(bufferCenter, selectedBufferDistance);
                map.off('click', bufferClickHandler);
                bufferClickHandler = null;
                map.getCanvas().style.cursor = '';
                bufferMode = false;
            });

            mapEventListeners.push(bufferClickHandler);
        });


        //-------------------- Current Location --------------------------//
        let currentLocationMarker = null;
        let userLocation = null;

        const locationButton = document.getElementById('location-button');

        function getUserLocation() {
            showLoading('Mendapatkan lokasi Anda...');

            if (!navigator.geolocation) {
                hideLoading();
                showToast('Browser tidak mendukung geolokasi', 'error');
                return;
            }

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    if (!currentLocationMarker) {
                        const el = document.createElement('div');
                        el.className = 'current-location-marker';

                        currentLocationMarker = new maplibregl.Marker(el)
                            .setLngLat([userLocation.lng, userLocation.lat])
                            .setPopup(new maplibregl.Popup().setHTML('Lokasi Anda saat ini!'))
                            .addTo(map);
                    } else {
                        currentLocationMarker.setLngLat([userLocation.lng, userLocation.lat]);
                    }

                    map.flyTo({
                        center: [userLocation.lng, userLocation.lat],
                        zoom: 15
                    });

                    hideLoading();
                    showToast('Lokasi Anda berhasil dideteksi', 'success');
                },
                (error) => {
                    hideLoading();
                    let errorMessage = 'Gagal mendapatkan lokasi';
                    if (error.code === error.PERMISSION_DENIED) {
                        errorMessage = 'Izin lokasi ditolak. Harap aktifkan izin lokasi';
                    } else if (error.code === error.POSITION_UNAVAILABLE) {
                        errorMessage = 'Informasi lokasi tidak tersedia';
                    } else if (error.code === error.TIMEOUT) {
                        errorMessage = 'Permintaan lokasi timeout';
                    }
                    showToast(errorMessage, 'error');
                }, {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                }
            );
        }

        locationButton.addEventListener('click', () => {
            getUserLocation();
        });


        //-------------------------- Routing ---------------------------//
        let routeLayerIds = [];
        let routingMode = false;
        let routeStartPoint = null;
        let routeEndPoint = null;
        let routeStartMarker = null;
        let routeEndMarker = null;
        let routingClickHandler = null;
        let currentRoute = null;

        const clearRouteButton = document.getElementById('clear-route');

        function validateRouteData(routeData) {
            if (!routeData ||
                typeof routeData.distance !== 'number' ||
                typeof routeData.duration !== 'number' ||
                !routeData.geometry ||
                !routeData.geometry.coordinates ||
                !Array.isArray(routeData.geometry.coordinates)) {
                return false;
            }
            return true;
        }

        function isValidCoordinate(coord) {
            if (!Array.isArray(coord) || coord.length !== 2) {
                return false;
            }

            const [lon, lat] = coord;

            if (typeof lon !== 'number' || typeof lat !== 'number') {
                return false;
            }

            if (lon < -180 || lon > 180 || lat < -90 || lat > 90) {
                return false;
            }

            return true;
        }

        async function getRoute(start, end) {
            if (!isValidCoordinate(start) || !isValidCoordinate(end)) {
                showToast('Koordinat tidak valid! Pastikan formatnya [longitude, latitude]');
                return;
            }

            showLoading('Menghitung rute...');

            try {
                const osrmEndpoint = 'https://router.project-osrm.org/route/v1/driving/';
                const url =
                    `${osrmEndpoint}${start[0]},${start[1]};${end[0]},${end[1]}?overview=full&geometries=geojson&steps=true`;

                const response = await fetch(url);

                if (!response.ok) {
                    throw new Error(`Gagal mendapatkan respons: ${response.status}`);
                }

                const data = await response.json();

                if (!data.routes || data.routes.length === 0) {
                    throw new Error('Tidak ada rute yang ditemukan');
                }

                currentRoute = data.routes[0];

                displayRoute(currentRoute);

            } catch (error) {
                showToast('Gagal menghitung rute: ' + error.message);
            } finally {
                hideLoading();
            }
        }

        function displayRoute(route) {
            if (!route || !route.geometry) {
                showToast('Data rute tidak valid');
                return;
            }

            try {
                removeRoute();
                addRouteToMap(route.geometry);

                const distance = route.distance ? (route.distance / 1000).toFixed(1) + ' km' : '-';
                const duration = route.duration ? Math.round(route.duration / 60) + ' menit' : '-';

                document.getElementById('route-distance').textContent = distance;
                document.getElementById('route-duration').textContent = duration;

                const steps = route.legs?.[0]?.steps || [];
                const instructionsHTML = generateRouteInstructions(steps);
                document.getElementById('route-instructions').innerHTML = instructionsHTML;

                const routeControls = document.getElementById('route-controls');
                routeControls.classList.add('active');

                updateRoutePanelPosition();

                document.getElementById('clear-route').style.display = 'block';
                zoomToRoute(route.geometry.coordinates);
            } catch (error) {
                showToast('Gagal menampilkan rute: ' + error.message);
            }
        }

        function visualizeRoute(route) {
            try {
                removeRoute();

                addRouteToMap(route.geometry);

                updateRouteInfoUI(route);

                zoomToRoute(route.geometry.coordinates);
            } catch (error) {
                throw new Error('Gagal menampilkan rute');
            }
        }

        function updateRouteInfo(route) {
            if (!route) {
                document.getElementById('route-distance').textContent = '0 km';
                document.getElementById('route-duration').textContent = '0 menit';
                document.getElementById('route-instructions').innerHTML = '';
                return;
            }

            try {
                document.getElementById('route-distance').textContent =
                    (route.distance / 1000).toFixed(1) + ' km';
                document.getElementById('route-duration').textContent =
                    Math.round(route.duration / 60) + ' menit';

                const steps = route.legs?.[0]?.steps || [];
                document.getElementById('route-instructions').innerHTML =
                    steps.length > 0 ? generateRouteInstructions(steps) : 'Tidak ada petunjuk rute tersedia';

            } catch (error) {
                document.getElementById('route-instructions').innerHTML =
                    'Gagal memuat petunjuk rute';
            }
        }

        function showError(message) {
            showToast(message);
        }

        function zoomToRoute(coordinates) {
            if (!coordinates || coordinates.length === 0) return;

            const bounds = coordinates.reduce((bounds, coord) => {
                return bounds.extend(coord);
            }, new maplibregl.LngLatBounds(coordinates[0], coordinates[0]));

            map.fitBounds(bounds, {
                padding: 50
            });
        }

        function addRouteToMap(routeGeometry) {
            removeRoute();

            map.addSource('route-source', {
                type: 'geojson',
                data: {
                    type: 'Feature',
                    properties: {},
                    geometry: routeGeometry
                }
            });

            map.addLayer({
                id: 'route-line',
                type: 'line',
                source: 'route-source',
                layout: {
                    'line-join': 'round',
                    'line-cap': 'round'
                },
                paint: {
                    'line-color': '#4285F4',
                    'line-width': 4,
                    'line-opacity': 0.75
                }
            });

            routeLayerIds.push('route-line');

            routeStartMarker = new maplibregl.Marker({
                    color: '#34A853'
                })
                .setLngLat(routeGeometry.coordinates[0])
                .setPopup(new maplibregl.Popup().setHTML('Lokasi Asal'))
                .addTo(map);

            routeEndMarker = new maplibregl.Marker({
                    color: '#EA4335'
                })
                .setLngLat(routeGeometry.coordinates[routeGeometry.coordinates.length - 1])
                .setPopup(new maplibregl.Popup().setHTML('Lokasi Tujuan'))
                .addTo(map);
        }

        function removeRoute() {
            routeLayerIds.forEach(layerId => {
                if (map.getLayer(layerId)) {
                    map.removeLayer(layerId);
                }
            });
            routeLayerIds = [];

            if (map.getSource('route-source')) {
                map.removeSource('route-source');
            }

            currentRoute = null;

            document.getElementById('route-controls').classList.remove('active');
            document.getElementById('route-distance').textContent = '-';
            document.getElementById('route-duration').textContent = '-';
            document.getElementById('route-instructions').innerHTML = '';

            document.getElementById('clear-route').style.display = 'none';

            if (window.innerWidth <= 768) {
                const routeControls = document.getElementById('route-controls');
                routeControls.style.position = '';
                routeControls.style.bottom = '';
                routeControls.style.left = '';
                routeControls.style.right = '';
            }
        }

        function resetRoutingState(completeReset = false) {
            if (routingClickHandler) {
                map.off('click', routingClickHandler);
                routingClickHandler = null;
            }

            routingMode = false;
            routeStartPoint = null;
            routeEndPoint = null;

            if (routeStartMarker) {
                routeStartMarker.remove();
                routeStartMarker = null;
            }
            if (routeEndMarker) {
                routeEndMarker.remove();
                routeEndMarker = null;
            }

            if (completeReset) {
                currentRoute = null;
                document.getElementById('route-controls').classList.remove('active');
            }
        }

        function handleDirectionButtonClick(lng, lat) {
            if (userLocation) {
                const destination = [lng, lat];
                getRoute([userLocation.lng, userLocation.lat], destination);

                document.getElementById('clear-route').style.display = 'block';
                return;
            }

            if (routingMode) {
                if (!routeStartPoint) {
                    routeStartPoint = [lng, lat];
                    routeStartMarker = new maplibregl.Marker({
                            color: '#34A853'
                        })
                        .setLngLat(routeStartPoint)
                        .setPopup(new maplibregl.Popup().setHTML('Lokasi Asal'))
                        .addTo(map);

                    showToast('Titik awal dipilih. Silakan klik lokasi tujuan', 'info');
                    return;
                } else {
                    routeEndPoint = [lng, lat];
                    routeEndMarker = new maplibregl.Marker({
                            color: '#EA4335'
                        })
                        .setLngLat(routeEndPoint)
                        .setPopup(new maplibregl.Popup().setHTML('Lokasi Tujuan'))
                        .addTo(map);

                    getRoute(routeStartPoint, routeEndPoint);
                    resetRoutingState();
                    return;
                }
            }

            showToast('Aktifkan fitur lokasi pengguna terlebih dahulu atau gunakan "Buat Rute"', 'warning');
        }

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

        document.getElementById('start-routing-button').addEventListener('click', function() {
            if (routingMode) {
                resetRoutingState(true);
                removeRoute();
            } else {
                resetRoutingState(true);
                removeRoute();

                routingMode = true;
                document.getElementById('start-routing-button').textContent = 'Buat Rute';
                document.getElementById('clear-route').style.display = 'block';
                map.getCanvas().style.cursor = 'crosshair';

                routingClickHandler = map.on('click', function(e) {
                    if (!routingMode) return;

                    if (!routeStartPoint) {
                        routeStartPoint = [e.lngLat.lng, e.lngLat.lat];
                        routeStartMarker = new maplibregl.Marker({
                            color: '#34A853'
                        }).setLngLat(routeStartPoint).addTo(map);

                        showToast('Titik awal dipilih. Silakan klik untuk memilih titik tujuan');

                        return;
                    }
                    const endPoint = [e.lngLat.lng, e.lngLat.lat];
                    if (turf.distance(turf.point(routeStartPoint), turf.point(endPoint)) > 0.001) {
                        routeEndPoint = endPoint;
                        routeEndMarker = new maplibregl.Marker({
                            color: '#EA4335'
                        }).setLngLat(routeEndPoint).addTo(map);

                        getRoute(routeStartPoint, routeEndPoint);

                        resetRoutingState(false);
                    }
                });
            }
        });


        function addMarker(coords, type) {
            const color = type === 'start' ? '#34A853' : '#EA4335';
            const popupText = type === 'start' ? 'Lokasi Asal' : 'Lokasi Tujuan';

            if (type === 'start' && routeStartMarker) {
                routeStartMarker.remove();
            }
            if (type === 'end' && routeEndMarker) {
                routeEndMarker.remove();
            }

            const marker = new maplibregl.Marker({
                    color
                })
                .setLngLat(coords)
                .setPopup(new maplibregl.Popup().setHTML(popupText))
                .addTo(map);

            if (type === 'start') {
                routeStartMarker = marker;
            } else {
                routeEndMarker = marker;
            }
        }

        function generateRouteInstructions(steps) {
            if (!steps || steps.length === 0) {
                return '<div class="no-instructions">Tidak ada petunjuk rute yang tersedia</div>';
            }

            let html = '<div class="route-instructions-container">';
            html += '<h4>Petunjuk Rute</h4>';
            html += '<ol class="steps-list">';

            steps.forEach((step, index) => {
                const instruction = step.maneuver ? translateInstruction(step.maneuver) : 'Lanjutkan';
                const distance = step.distance ? (step.distance / 1000).toFixed(1) + ' km' : '';
                const road = step.name || 'Jalan setempat';

                html += `<li class="step-item">
            <div class="step-content">
                <div class="instruction">${instruction}</div>
                <div class="details">
                    <span class="road">${road}</span>
                    ${distance ? `<span class="distance">${distance}</span>` : ''}
                </div>
            </div>
        </li>`;
            });

            html += '</ol></div>';
            return html;
        }

        function translateInstruction(maneuver) {
            if (!maneuver) return 'Lanjutkan perjalanan';

            const type = maneuver.type || 'continue';
            const modifier = maneuver.modifier || 'straight';

            let translatedType = '';
            switch (type) {
                case 'turn':
                    translatedType = 'Belok';
                    break;
                case 'new name':
                    translatedType = 'Lanjut ke';
                    break;
                case 'depart':
                    translatedType = 'Mulai perjalanan';
                    break;
                case 'arrive':
                    translatedType = 'Sampai tujuan';
                    break;
                case 'merge':
                    translatedType = 'Bergabung ke';
                    break;
                case 'on ramp':
                    translatedType = 'Masuk jalan tol';
                    break;
                case 'off ramp':
                    translatedType = 'Keluar jalan tol';
                    break;
                case 'fork':
                    translatedType = 'Ambil persimpangan';
                    break;
                case 'end of road':
                    translatedType = 'Ujung jalan';
                    break;
                case 'continue':
                    translatedType = 'Terus lurus';
                    break;
                case 'roundabout':
                    translatedType = 'Putaran bundaran';
                    break;
                default:
                    translatedType = type;
            }

            let translatedModifier = '';
            switch (modifier) {
                case 'left':
                    translatedModifier = 'kiri';
                    break;
                case 'right':
                    translatedModifier = 'kanan';
                    break;
                case 'slight left':
                    translatedModifier = 'agak ke kiri';
                    break;
                case 'slight right':
                    translatedModifier = 'agak ke kanan';
                    break;
                case 'sharp left':
                    translatedModifier = 'tajam ke kiri';
                    break;
                case 'sharp right':
                    translatedModifier = 'tajam ke kanan';
                    break;
                case 'straight':
                    translatedModifier = 'lurus';
                    break;
                case 'uturn':
                    translatedModifier = 'putar balik';
                    break;
                default:
                    translatedModifier = modifier;
            }

            if (type === 'continue' || type === 'depart' || type === 'arrive') {
                return translatedType;
            } else {
                return `${translatedType} ${translatedModifier}`;
            }
        }

        document.getElementById('clear-route').addEventListener('click', function() {
            removeRoute();
            resetRoutingState(true);
        });

        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('direction-button') || e.target.closest('.direction-button')) {
                const button = e.target.classList.contains('direction-button') ?
                    e.target : e.target.closest('.direction-button');
                const lng = parseFloat(button.dataset.lng);
                const lat = parseFloat(button.dataset.lat);
                handleDirectionButtonClick(lng, lat);
            }
        });

        clearRouteButton.addEventListener('click', () => {
            resetRoutingState();
            removeRoute();
        });


        //------------------------- Filtering ---------------------------//
        const filterModal = document.getElementById('filter-modal');
        const filterButton = document.getElementById('filter-button');
        const filterCancelButton = filterModal.querySelector('.cancel');
        const filterApplyButton = filterModal.querySelector('.apply');
        const resetFilterButton = document.getElementById('reset-filter-modal');

        document.getElementById('price-slider').addEventListener('input', function() {
            document.getElementById('max-price-display').textContent =
                `Rp${Number(this.value).toLocaleString('id-ID')}`;
        });

        filterButton.addEventListener('click', () => {
            filterModal.style.display = 'flex';
        });

        filterCancelButton.addEventListener('click', () => {
            filterModal.style.display = 'none';
        });

        filterApplyButton.addEventListener('click', () => {
            applyFilters();
            filterModal.style.display = 'none';
            resetFilterButton.style.display = 'inline-block';
        });

        const resetFilterInModal = () => {
            filterModal.querySelectorAll('input[name="kos-type"]').forEach(checkbox => {
                checkbox.checked = true;
            });

            filterModal.querySelector('#price-slider').value = 5000000;
            filterModal.querySelector('#max-price-display').textContent = 'Rp5.000.000';

            filterModal.querySelectorAll('input[name="facility"]').forEach(checkbox => {
                checkbox.checked = false;
            });

            applyFilters();
            resetFilterButton.style.display = 'none';
        };

        resetFilterButton?.addEventListener('click', resetFilterInModal);

        function applyFilters() {
            const modal = document.getElementById('filter-modal');
            const selectedTypes = Array.from(modal.querySelectorAll('input[name="kos-type"]:checked')).map(el => el
                .value);
            const maxPrice = modal.querySelector('#price-slider').value;
            const selectedFacilities = Array.from(modal.querySelectorAll('input[name="facility"]:checked')).map(el => el
                .value);

            modal.querySelector('#max-price-display').textContent = `Rp${Number(maxPrice).toLocaleString('id-ID')}`;

            const filteredData = {
                type: 'FeatureCollection',
                features: allKosData.features.filter(feature => {
                    const jenis = feature.properties.jenis.toLowerCase();
                    const typeMatch = selectedTypes.some(type => jenis.includes(type));

                    const harga = feature.properties.harga || 0;
                    const priceMatch = harga <= maxPrice;

                    let facilityMatch = true;
                    if (selectedFacilities.length > 0) {
                        facilityMatch = selectedFacilities.every(fac => {
                            if (fac === 'kasur') return feature.properties.kasur === true;
                            if (fac === 'mejakursi') return feature.properties.mejakursi === true;
                            if (fac === 'lemari') return feature.properties.lemari === true;
                            if (fac === 'wifi') return feature.properties.wifi === true;
                            if (fac === 'ac') return feature.properties.ac === true;
                            if (fac === 'kamarmandi') return feature.properties.kamarmandi === true;
                            if (fac === 'dapur') return feature.properties.dapur === true;
                            if (fac === 'kulkas') return feature.properties.kulkas === true;
                            if (fac === 'listrik') return feature.properties.listrik === true;
                            if (fac === 'air') return feature.properties.air === true;
                            if (fac === 'parkirmotor') return feature.properties.parkirmotor ===
                                true;
                            if (fac === 'parkirmobil') return feature.properties.parkirmobil ===
                                true;
                            if (fac === 'keamanan') return feature.properties.keamanan === true;
                            return false;
                        });
                    }

                    return typeMatch && priceMatch && facilityMatch;
                })
            };

            if (map.getSource('kos-clusters')) {
                map.getSource('kos-clusters').setData(filteredData);
            } else {
                addKosClusters(filteredData);
            }
        }


        //------------------------- Layer Controls ---------------------------//
        let layerStates = {
            kos: false,
            halte: false,
            univ: false,
            ndbi: false,
            lst: false
        };

        function saveLayerStates() {
            layerStates = {
                kos: document.getElementById('toggle-kos-clusters').checked,
                halte: document.getElementById('toggle-halte-points').checked,
                univ: document.getElementById('toggle-univ-points').checked,
                ndbi: document.getElementById('toggle-ndbi').checked,
                lst: document.getElementById('toggle-lst').checked
            };
        }

        function applyLayerStates() {
            if (map.getLayer('kos-clusters')) {
                map.setLayoutProperty('kos-clusters', 'visibility', layerStates.kos ? 'visible' : 'none');
                map.setLayoutProperty('kos-cluster-count', 'visibility', layerStates.kos ? 'visible' : 'none');
            }

            if (map.getLayer('haltePoints')) {
                map.setLayoutProperty('haltePoints', 'visibility', layerStates.halte ? 'visible' : 'none');
            }

            if (map.getLayer('univPoints')) {
                map.setLayoutProperty('univPoints', 'visibility', layerStates.univ ? 'visible' : 'none');
            }

            if (layerStates.kos) {
                kosClusterMarkers.forEach(marker => marker.addTo(map));
            } else {
                kosClusterMarkers.forEach(marker => marker.remove());
            }

            document.getElementById('toggle-ndbi').checked = layerStates.ndbi;
            document.getElementById('toggle-lst').checked = layerStates.lst;
        }


        //------------------------ Load map and fetch data ----------------------//
        map.on('load', () => {
            // Buat loading overlay
            const loadingOverlay = document.createElement('div');
            loadingOverlay.id = 'loading-overlay';
            loadingOverlay.style.position = 'fixed';
            loadingOverlay.style.top = '0';
            loadingOverlay.style.left = '0';
            loadingOverlay.style.width = '100%';
            loadingOverlay.style.height = '100%';
            loadingOverlay.style.backgroundColor = 'rgba(255, 255, 255, 0.7)';
            loadingOverlay.style.display = 'none';
            loadingOverlay.style.justifyContent = 'center';
            loadingOverlay.style.alignItems = 'center';
            loadingOverlay.style.zIndex = '9999';
            loadingOverlay.innerHTML = '<div class="loading-spinner"></div>';
            document.body.appendChild(loadingOverlay);

            fetch("{{ route('api.points') }}")
                .then(response => response.json())
                .then(data => {
                    addKosClusters(data);
                    allKosData = JSON.parse(JSON.stringify(data));

                    const coordinates = data.features.map(f => f.geometry.coordinates);
                    const bounds = coordinates.reduce((bounds, coord) => {
                        return bounds.extend(coord);
                    }, new maplibregl.LngLatBounds(coordinates[0], coordinates[0]));

                    map.fitBounds(bounds, {
                        padding: {
                            top: 100,
                            bottom: 100,
                            left: 100,
                            right: 100
                        },
                        maxZoom: 14
                    });

                    map.setLayoutProperty('kos-clusters', 'visibility', 'visible');
                    map.setLayoutProperty('kos-cluster-count', 'visibility', 'visible');

                    kosClusterMarkers.forEach(marker => marker.addTo(map));

                    document.querySelectorAll('.direction-button').forEach(button => {
                        button.addEventListener('click', (e) => {
                            const lng = parseFloat(button.dataset.lng);
                            const lat = parseFloat(button.dataset.lat);
                            handleDirectionButtonClick(lng, lat);
                        });
                    });
                })
                .catch(error => {
                    console.error('Error loading kos data:', error);
                });

            fetch("{{ route('api.halte') }}")
                .then(response => response.json())
                .then(data => {
                    addHaltePoints(data);
                    map.setLayoutProperty('haltePoints', 'visibility', 'none');
                });

            fetch("{{ route('api.univ') }}")
                .then(response => response.json())
                .then(data => {
                    addUnivPoints(data);
                    map.setLayoutProperty('univPoints', 'visibility', 'none');
                });

            map.addSource('ndbi', {
                type: 'geojson',
                data: "{{ asset('geojson/ndbi.geojson') }}"
            });

            map.addSource('lst', {
                type: 'geojson',
                data: "{{ asset('geojson/lst.geojson') }}"
            });

            document.getElementById('toggle-kos-clusters').checked = true;
            document.getElementById('toggle-halte-points').checked = false;
            document.getElementById('toggle-univ-points').checked = false;
            document.getElementById('toggle-ndbi').checked = false;
            document.getElementById('toggle-lst').checked = false;

            document.getElementById('toggle-kos-clusters').addEventListener('change', function(e) {
                layerStates.kos = e.target.checked;
                map.setLayoutProperty('kos-clusters', 'visibility', layerStates.kos ? 'visible' : 'none');
                map.setLayoutProperty('kos-cluster-count', 'visibility', layerStates.kos ? 'visible' :
                    'none');

                if (layerStates.kos) {
                    kosClusterMarkers.forEach(marker => marker.addTo(map));
                } else {
                    kosClusterMarkers.forEach(marker => marker.remove());
                }
            });

            document.getElementById('toggle-halte-points').addEventListener('change', function(e) {
                layerStates.halte = e.target.checked;
                map.setLayoutProperty('haltePoints', 'visibility', layerStates.halte ? 'visible' : 'none');
            });

            document.getElementById('toggle-univ-points').addEventListener('change', function(e) {
                layerStates.univ = e.target.checked;
                map.setLayoutProperty('univPoints', 'visibility', layerStates.univ ? 'visible' : 'none');
            });

            document.getElementById('toggle-ndbi').addEventListener('change', toggleNdbilayer);
            document.getElementById('toggle-lst').addEventListener('change', togglelstlayer);
        });


        //------------------------ Initialize NDBI Layer ----------------------//
        let ndbiLayerAdded = false;

        function toggleNdbilayer() {
            const checkbox = document.getElementById('toggle-ndbi');
            const loadingOverlay = document.getElementById('loading-overlay');

            if (!loadingOverlay) {
                console.error('Loading overlay not found');
                return;
            }

            if (checkbox.checked && !ndbiLayerAdded) {
                loadingOverlay.style.display = 'flex';

                if (!map.getSource('ndbi')) {
                    console.error('NDBI source not loaded');
                    loadingOverlay.style.display = 'none';
                    return;
                }

                map.addLayer({
                    id: 'ndbi-layer',
                    type: 'fill',
                    source: 'ndbi',
                    paint: {
                        'fill-color': [
                            'interpolate',
                            ['linear'],
                            ['get', 'nilai'],
                            1, '#E8F5E9',
                            5, '#A5D6A7',
                            10, '#FFE082',
                            15, '#EF9A9A'
                        ],
                        'fill-opacity': 0.7,
                        'fill-outline-color': 'rgba(0,0,0,0)'
                    }
                }, 'kos-clusters');

                ndbiLayerAdded = true;
                loadingOverlay.style.display = 'none';
            } else if (!checkbox.checked && ndbiLayerAdded) {
                if (map.getLayer('ndbi-layer')) {
                    map.removeLayer('ndbi-layer');
                }
                ndbiLayerAdded = false;
            }
        }


        //------------------------ Initialize LST Layer ----------------------//
        let lstLayerAdded = false;

        function togglelstlayer() {
            const checkbox = document.getElementById('toggle-lst');
            const loadingOverlay = document.getElementById('loading-overlay');

            if (!loadingOverlay) {
                console.error('Loading overlay not found');
                return;
            }

            if (checkbox.checked && !lstLayerAdded) {
                loadingOverlay.style.display = 'flex';

                if (!map.getSource('lst')) {
                    console.error('LST source not loaded');
                    loadingOverlay.style.display = 'none';
                    return;
                }

                map.addLayer({
                    id: 'lst-layer',
                    type: 'fill',
                    source: 'lst',
                    paint: {
                        'fill-color': [
                            'interpolate',
                            ['linear'],
                            ['get', 'nilai'],
                            1, '#c0e6ff',
                            5, '#78aeff',
                            10, '#FFE082',
                            15, '#EF9A9A'
                        ],
                        'fill-opacity': 0.7,
                        'fill-outline-color': 'rgba(0,0,0,0)'
                    }
                }, 'kos-clusters');

                lstLayerAdded = true;
                loadingOverlay.style.display = 'none';
            } else if (!checkbox.checked && lstLayerAdded) {
                if (map.getLayer('lst-layer')) {
                    map.removeLayer('lst-layer');
                }
                lstLayerAdded = false;
            }
        }


        //-------------------------- Toggle Map and Route ---------------------------//
        map.on('click', function(e) {
            if (window.innerWidth <= 768) {
                document.getElementById('map-controls').classList.remove('mobile-active');
                document.getElementById('route-controls').classList.remove('mobile-active');
            }
        });

        document.getElementById('map-controls').addEventListener('click', function(e) {
            e.stopPropagation();
        });

        const toggleRouteBtn = document.getElementById('toggle-route');
        toggleRouteBtn.removeEventListener('click', handleToggleRoute);
        toggleRouteBtn.addEventListener('click', handleToggleRoute);

        function handleToggleRoute() {
            const routeControls = document.getElementById('route-controls');

            const routeExists = map.getSource('route-source') || currentRoute;

            if (!routeExists && !routeControls.classList.contains('active')) {
                showToast('Tidak ada rute yang aktif', 'info');
                return;
            }

            routeControls.classList.toggle('active');
            updateRoutePanelPosition();

            console.log('Route exists:', routeExists, 'Panel active:', routeControls.classList.contains('active'));
        }

        function updateRoutePanelPosition() {
            const routeControls = document.getElementById('route-controls');
            const isMobile = window.innerWidth <= 768;

            if (isMobile) {
                routeControls.style.position = 'fixed';
                routeControls.style.bottom = '20px';
                routeControls.style.left = '10px';
                routeControls.style.right = '10px';
                routeControls.style.top = 'auto';
                routeControls.style.width = 'auto';
                routeControls.style.maxHeight = '50vh';
                routeControls.style.marginTop = '0';

                setTimeout(() => {
                    window.scrollTo({
                        top: document.body.scrollHeight,
                        behavior: 'smooth'
                    });
                }, 300);
            } else {
                routeControls.style.position = 'absolute';
                routeControls.style.top = '60px';
                routeControls.style.right = '10px';
                routeControls.style.bottom = 'auto';
                routeControls.style.left = 'auto';
                routeControls.style.width = '300px';
                routeControls.style.marginTop = '250px';
            }
        }
        window.addEventListener('resize', updateRoutePanelPosition);

        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.getElementById('route-controls').style.position = 'absolute';
                document.getElementById('route-controls').style.top = '60px';
                document.getElementById('route-controls').style.right = '10px';
                document.getElementById('route-controls').style.bottom = 'auto';
                document.getElementById('route-controls').style.left = 'auto';
                document.getElementById('route-controls').style.width = '300px';
            } else {
                if (document.getElementById('route-controls').classList.contains('active')) {
                    document.getElementById('route-controls').style.position = 'fixed';
                    document.getElementById('route-controls').style.bottom = '20px';
                    document.getElementById('route-controls').style.left = '10px';
                    document.getElementById('route-controls').style.right = '10px';
                    document.getElementById('route-controls').style.top = 'auto';
                    document.getElementById('route-controls').style.width = 'auto';
                }
            }
        });

        function handleResize() {
            const mapElement = document.getElementById('map');
            const headerHeight = document.querySelector('.header').offsetHeight;
            const footerHeight = document.querySelector('.footer').offsetHeight;

            mapElement.style.height = `calc(100vh - ${headerHeight + footerHeight}px)`;

            updateRoutePanelPosition();
        }

        window.addEventListener('load', handleResize);
        window.addEventListener('resize', handleResize);

        map.on('click', function() {
            if (window.innerWidth <= 768) {
                document.getElementById('map-controls').classList.remove('mobile-active');
                document.getElementById('route-controls').classList.remove('mobile-active');
            }
        });

        document.getElementById('map-controls').addEventListener('click', function(e) {
            e.stopPropagation();
        });

        const toggleToolsBtn = document.getElementById('toggle-tools');
        toggleToolsBtn.removeEventListener('click', handleToggleTools); // Hapus listener lama jika ada
        toggleToolsBtn.addEventListener('click', handleToggleTools);

        function handleToggleTools() {
            const mapControls = document.getElementById('map-controls');

            mapControls.classList.toggle('mobile-active');
            updateToolsPanelPosition();

            document.getElementById('route-controls').classList.remove('active');

            console.log('Map controls active:', mapControls.classList.contains('mobile-active'));
        }

        function updateToolsPanelPosition() {
            const mapControls = document.getElementById('map-controls');
            const isMobile = window.innerWidth <= 768;

            if (isMobile) {
                mapControls.style.position = 'fixed';
                mapControls.style.left = '10px';
                mapControls.style.right = '10px';
                mapControls.style.width = 'auto';
                mapControls.style.maxHeight = '60vh';
                mapControls.style.overflowY = 'auto';

                // Responsif top
                if (window.innerWidth <= 480) {
                    // untuk layar HP kecil
                    mapControls.style.top = '160px';
                } else {
                    // untuk layar HP agak besar (tablet kecil)
                    mapControls.style.top = '140px';
                }

                mapControls.style.bottom = 'auto'; // pastikan tidak keikat bawah
            } else {
                mapControls.style.position = 'absolute';
                mapControls.style.top = '20px';
                mapControls.style.left = '20px';
                mapControls.style.right = 'auto';
                mapControls.style.bottom = 'auto';
                mapControls.style.width = '300px';
                mapControls.style.maxHeight = 'none';
                mapControls.style.overflowY = 'visible';
            }
        }


        window.addEventListener('resize', updateToolsPanelPosition);

        map.on('click', function() {
            if (window.innerWidth <= 768) {
                document.getElementById('map-controls').classList.remove('mobile-active');
            }
        });

        document.getElementById('map-controls').addEventListener('click', function(e) {
            e.stopPropagation();
        });

        //-------------------------- Toggle Layer ---------------------------//
        const layerControls = document.getElementById('layer-controls');

        layerControls.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                this.classList.toggle('mobile-expanded');

                // Tutup panel lain jika terbuka
                document.getElementById('map-controls').classList.remove('mobile-active');
                document.getElementById('route-controls').classList.remove('active');
            }
        });

        map.on('click', function() {
            if (window.innerWidth <= 768) {
                layerControls.classList.remove('mobile-expanded');
            }
        });

        layerControls.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>
@endsection
