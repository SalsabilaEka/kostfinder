@extends('layouts.template')

@section('content')
<main class="main-content">
    <div class="container-fluid mt-3">
        <div class="row">
            <!-- Kolom Informasi (Kanan) -->
            <div class="col-md-8" style="margin-left: auto;">
                <div class="info-card" style="background-color: white; border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); overflow: hidden; height: 100%;">
                    <a href="{{ route('map') }}" class="btn btn-back" style="background-color: white; color: #6C4F51; border: 1px solid #6C4F51; border-radius: 5px; padding: 8px 15px; margin-top: 10px; margin-bottom: 10px; margin-left: 10px;  font-weight: 500; transition: all 0.3s; display: inline-block; text-decoration: none;">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Peta
                    </a>
                    <div class="card-header" style="background-color: #6C4F51; color: white; padding: 20px; position: relative;">

                        <h2 style="margin: 0; font-size: 1.8rem; font-weight: 700;">{{ $kos->nama }}</h2>
                        <div class="price-badge" style="position: absolute; top: 20px; right: 20px; background-color: white; color: #6C4F51; padding: 5px 15px; border-radius: 20px; font-weight: bold; font-size: 1.1rem;">
                            Rp {{ number_format($kos->harga, 0, ',', '.') }} / bulan
                        </div>


                    </div>

                    <div class="card-body" style="padding: 25px;">
                        <div class="col-md-4" style="float: left; width: 33.333%; padding-right: 15px;">
                            <div class="small-photo-container mb-4" style="width: 100%; max-width: 350px; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                                @if ($kos->foto)
                                    @if (filter_var($kos->foto, FILTER_VALIDATE_URL))
                                        <img src="{{ $kos->foto }}" class="small-photo" style="width: 100%; height: auto; display: block;" alt="Foto Kos">
                                    @else
                                        <img src="{{ asset('storage/images/' . $kos->foto) }}" class="small-photo" style="width: 100%; height: 100%; display: block;" alt="Foto Kos">
                                    @endif
                                @else
                                    <img src="https://via.placeholder.com/400?text=No+Photo" class="small-photo" style="width: 100%; height: auto; display: block;" alt="Foto Kos">
                                @endif
                            </div>


                        </div>

                        <!-- Informasi Utama -->
                        <div class="info-section" style="margin-bottom: 25px; overflow: hidden;">
                            <h3 style="color: #6C4F51; font-size: 1.3rem; margin-bottom: 15px; display: flex; align-items: center;">
                                <i class="fas fa-info-circle" style="margin-right: 10px; font-size: 1.1rem;"></i> Informasi Utama
                            </h3>
                            <div class="info-content" style="padding-left: 25px;">
                                <p style="margin-bottom: 10px;"><strong>Alamat:</strong> {{ $kos->alamat }}</p>
                                <p style="margin-bottom: 10px;"><strong>Jenis:</strong>
                                    @if (str_contains(strtolower($kos->jenis), 'putri'))
                                        <span style="background-color: #f8e1ee; color: #c2185b; padding: 3px 8px; border-radius: 4px; font-weight: 500;">
                                            <i class="fas fa-female"></i> {{ $kos->jenis }}
                                        </span>
                                    @elseif(str_contains(strtolower($kos->jenis), 'putra'))
                                        <span style="background-color: #e3f2fd; color: #1976d2; padding: 3px 8px; border-radius: 4px; font-weight: 500;">
                                            <i class="fas fa-male"></i> {{ $kos->jenis }}
                                        </span>
                                    @else
                                        <span>{{ $kos->jenis }}</span>
                                    @endif
                                </p>
                            </div>

                            <div class="info-section" style="margin-bottom: 25px; clear: both;">
                                <h3 style="color: #6C4F51; font-size: 1.3rem; margin-bottom: 15px; display: flex; align-items: center;">
                                    <i class="fas fa-user" style="margin-right: 10px; font-size: 1.1rem;"></i> Kontak Pemilik
                                </h3>
                                <div class="info-content" style="padding-left: 25px;">
                                    <p style="margin-bottom: 10px;"><strong>Nama:</strong> {{ $kos->pemilik }}</p>
                                    <p style="margin-bottom: 10px;"><strong>Telepon:</strong>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kos->telepon) }}" style="color: #25D366; text-decoration: none; font-weight: 500;">
                                            <i class="fab fa-whatsapp"></i> {{ $kos->telepon }}
                                        </a>
                                    </p>
                                    <p style="margin-bottom: 10px;"><strong>Pembayaran:</strong> {{ implode(', ', $pembayaran) }}</p>
                                </div>
                            </div>

                            <!-- Fasilitas -->
                            <div class="info-section" style="margin-bottom: 25px;">
                                <h3 style="color: #6C4F51; font-size: 1.3rem; margin-bottom: 15px; display: flex; align-items: center;">
                                    <i class="fas fa-list-check" style="margin-right: 10px; font-size: 1.1rem;"></i> Fasilitas
                                </h3>
                                <div class="facilities-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 10px; padding-left: 25px;">
                                    @if (count($fasilitas) > 0)
                                        @foreach ($fasilitas as $fasilitas)
                                            <div class="facility-item" style="background-color: #EFEBE9; border-radius: 6px; padding: 10px; display: flex; align-items: center;">
                                                <i class="fas {{ $fasilitas['icon'] }}" style="color: #8D6E63; margin-right: 8px; width: 20px; text-align: center;"></i>
                                                <span>{{ $fasilitas['label'] }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <p style="color: #777; font-style: italic;">Tidak ada fasilitas yang tercatat</p>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <!-- Kontak Pemilik -->
                                            </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('styles')
    <style>

        .main-content {
            margin-top: 7%;
            margin-left: 3%;
            margin-right: 3%;
            margin-bottom: 3%;
            background-color: var(--background-color);
        }
        :root {
            --primary-color: #6C4F51;
            --secondary-color: #8D6E63;
            --light-color: #EFEBE9;
            --text-color: #333;
            --background-color: #f9f9f9;
        }



        /* Container Foto Kecil */
        .small-photo-container {
            width: 100%;
            max-width: 350px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .small-photo {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Tombol Kembali */
        .btn-back {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: 5px;
            padding: 8px 15px;
            margin-top: 20px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
        }

        /* Card Informasi */
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
            padding: 20px;
            position: relative;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .price-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: white;
            color: var(--primary-color);
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .card-body {
            padding: 25px;
        }

        /* Section Informasi */
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

        /* Badge Jenis Kos */
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

        /* Fasilitas */
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

        /* Responsive Design */
        @media (max-width: 992px) {
            .small-photo-container {
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }

            .col-md-4, .col-md-8 {
                width: 100%;
                max-width: 100%;
            }

            .info-card {
                margin-top: 20px;
            }

            .price-badge {
                position: static;
                display: inline-block;
                margin-top: 10px;
            }

            .facilities-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
        }

        @media (max-width: 576px) {
            .card-header {
                padding: 15px;
            }

            .card-header h2 {
                font-size: 1.5rem;
            }

            .card-body {
                padding: 15px;
            }

            .info-section h3 {
                font-size: 1.1rem;
            }

            .facilities-grid {
                grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
                padding-left: 0;
            }
        }
    </style>
@endsection
