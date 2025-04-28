@extends('layouts.template')

@section('content')
    <main class="main-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Information Column -->
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="info-card">
                        <a href="{{ route('map') }}" class="btn btn-back">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Peta
                        </a>
                        <div class="card-header">
                            <h2>{{ $kos->nama }}</h2>
                            <div class="price-badge">
                                Rp {{ number_format($kos->harga, 0, ',', '.') }} / bulan
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="content-wrapper">
                                <!-- Photo Column -->
                                <div class="photo-column">
                                    <div class="small-photo-container">
                                        @if ($kos->foto)
                                            @php
                                                function getDriveLink($url)
                                                {
                                                    if (strpos($url, 'drive.google.com') !== false) {
                                                        if (
                                                            preg_match(
                                                                '/\/file\/d\/([a-zA-Z0-9_-]+)/',
                                                                $url,
                                                                $matches,
                                                            ) ||
                                                            preg_match('/id=([a-zA-Z0-9_-]+)/', $url, $matches) ||
                                                            preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)
                                                        ) {
                                                            $fileId = $matches[1];
                                                            return 'https://drive.google.com/uc?export=view&id=' .
                                                                $fileId;
                                                        }
                                                    }
                                                    return $url;
                                                }
                                            @endphp

                                            @if (filter_var($kos->foto, FILTER_VALIDATE_URL))
                                                <img src="{{ getDriveLink($kos->foto) }}" class="small-photo"
                                                    alt="Foto Kos">
                                            @else
                                                <img src="{{ asset('storage/images/' . $kos->foto) }}" class="small-photo"
                                                    alt="Foto Kos">
                                            @endif
                                        @else
                                            <img src="https://via.placeholder.com/400?text=No+Photo" class="small-photo"
                                                alt="Foto Kos">
                                        @endif

                                    </div>
                                </div>

                                <!-- Info Column -->
                                <div class="info-column">
                                    <div class="info-section">
                                        <h3>
                                            <i class="fas fa-info-circle"></i>
                                            Informasi Utama
                                        </h3>
                                        <div class="info-content">
                                            <p><strong>Alamat:</strong> {{ $kos->alamat }}</p>
                                            <p><strong>Jenis:</strong>
                                                @if (str_contains(strtolower($kos->jenis), 'putri'))
                                                    <span class="female-badge">
                                                        <i class="fas fa-female"></i> {{ $kos->jenis }}
                                                    </span>
                                                @elseif(str_contains(strtolower($kos->jenis), 'putra'))
                                                    <span class="male-badge">
                                                        <i class="fas fa-male"></i> {{ $kos->jenis }}
                                                    </span>
                                                @else
                                                    <span>{{ $kos->jenis }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="info-section">
                                        <h3>
                                            <i class="fas fa-user"></i> Kontak Pemilik
                                        </h3>
                                        <div class="info-content">
                                            <p><strong>Nama:</strong> {{ $kos->pemilik }}</p>
                                            <p><strong>Telepon:</strong>
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kos->telepon) }}"
                                                    class="whatsapp-link">
                                                    <i class="fab fa-whatsapp"></i> {{ $kos->telepon }}
                                                </a>
                                            </p>
                                            <p><strong>Pembayaran:</strong> {{ implode(', ', $pembayaran) }}</p>
                                        </div>
                                    </div>

                                    <div class="info-section">
                                        <h3>
                                            <i class="fas fa-list-check"></i>
                                            Fasilitas
                                        </h3>
                                        <div class="facilities-grid">
                                            @if (count($fasilitas) > 0)
                                                @foreach ($fasilitas as $fasilitas)
                                                    <div class="facility-item">
                                                        <i class="fas {{ $fasilitas['icon'] }}"></i>
                                                        <span>{{ $fasilitas['label'] }}</span>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="no-facilities">Tidak ada fasilitas yang tercatat</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('styles')
    <style>
        :root {
            --primary-color: #6C4F51;
            --secondary-color: #8D6E63;
            --light-color: #EFEBE9;
            --text-color: #333;
            --background-color: #f9f9f9;
        }

        .main-content {
            padding: 100px 20px 40px;
            background-color: var(--background-color);
            min-height: 100vh;
        }

        /* Layout Structure */
        .content-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .photo-column {
            flex: 0 0 300px;
        }

        .info-column {
            flex: 1;
            min-width: 300px;
            padding: 20px;
        }

        /* Container Photo */
        .small-photo-container {
            width: 100%;
            max-width: 350px;
            border-radius: 10px;
            overflow: hidden;
            margin-left: 0;
        }

        .small-photo {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 10px;
        }

        /* Back Button */
        .btn-back {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: 5px;
            padding: 8px 15px;
            margin: 15px 15px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-block;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
        }

        /* Card Information */
        .info-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            height: 100%;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.25rem 1.5rem;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            word-break: break-word;
        }

        .price-badge {
            background-color: white;
            color: var(--primary-color);
            padding: 0.375rem 1rem;
            border-radius: 10px;
            font-weight: bold;
            font-size: 1rem;
            margin-top: 0.5rem;
            display: inline-block;
        }

        .card-body {
            padding: 1.2rem;
        }

        /* Section Information  */
        .info-section {
            margin-bottom: 25px;
        }

        .info-section h3 {
            color: var(--primary-color);
            font-size: 1.3rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .info-section h3 i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .info-content {
            padding-left: 25px;
        }

        .info-content p {
            margin-bottom: 10px;
        }

        /* Badge */
        .female-badge {
            background-color: #f8e1ee;
            color: #c2185b;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 500;
        }

        .male-badge {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 500;
        }

        /* Facility */
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            padding-left: 25px;
        }

        .facility-item {
            background-color: var(--light-color);
            border-radius: 6px;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        .facility-item i {
            color: var(--secondary-color);
            margin-right: 8px;
            width: 20px;
            text-align: center;
        }

        .no-facilities {
            color: #777;
            font-style: italic;
        }

        /* Link WhatsApp */
        .whatsapp-link {
            color: #25D366;
            text-decoration: none;
            font-weight: 500;
        }

        .whatsapp-link:hover {
            text-decoration: underline;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .main-content {
                padding: 90px 15px 30px;
            }

            .card-header h2 {
                font-size: 1.4rem;
            }

            .price-badge {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 80px 15px 30px;
            }

            .facilities-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                padding-left: 0;
            }

            .info-content {
                padding-left: 0;
            }
        }

        /* Special adjustment for very small screens (below 480px) */
        @media (max-width: 480px) {
            .main-content {
                padding: 80px 15px 15px;
            }

            .content-wrapper {
                flex-direction: column;
                gap: 20px;
            }

            .photo-column {
                display: flex;
                justify-content: center;
            }

            .small-photo-container {
                margin-left: auto;
                margin-right: 20px;
            }

            .card-header h2 {
                font-size: 1.25rem;
            }

            .price-badge {
                font-size: 0.85rem;
            }

            .info-section h3 {
                font-size: 1rem;
            }

            .facilities-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                gap: 6px;
            }
        }

        @media (max-width: 350px) {
            .main-content {
                padding: 80px 15px 15px;
            }

            .content-wrapper {
                flex-direction: column;
                gap: 20px;
            }

            .photo-column {
                display: flex;
                justify-content: center;
            }

            .small-photo-container {
                width: 280px;
                height: auto;
            }

            .card-header h2 {
                font-size: 1.25rem;
            }

            .price-badge {
                font-size: 0.85rem;
            }

            .info-section h3 {
                font-size: 1rem;
            }

            .facilities-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                gap: 6px;
            }
        }
    </style>
@endsection
