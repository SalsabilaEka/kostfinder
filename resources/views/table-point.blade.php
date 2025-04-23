@extends('layouts.template')

@section('content')
    <style>
        body {
            margin-top: 5%;
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 2%;

        }

        .main-content {
            flex: 1;
            /* Penting agar isi utama mengisi ruang kosong */
            padding: 20px;
        }

        .footer {
            background-color: #efcdab;
            text-align: center;
            padding: 15px;
        }


        .kos-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-top: 100px;
            margin-bottom: 40px;
        }

        .kos-header {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .kos-header h2 {
            color: #2c3e50;
            font-weight: 700;
            margin: 0;
            font-size: 1.8rem;
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

        .search-container {
            position: relative;
            width: 100%;
            max-width: 400px;
        }

        #searchInput {
            width: 100%;
            padding: 12px 20px;
            padding-left: 45px;
            border-radius: 30px;
            border: 1px solid #e0e0e0;
            font-size: 0.95rem;
            transition: all 0.3s;
            background-color: #f8f9fa;
        }

        #searchInput:focus {
            outline: none;
            border-color: #673E42;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.15);
            background-color: #ffffff;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #7a7a7a;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            margin-top: 25px;
            border: 1px solid #673E42;
            /* Tambahkan border untuk container */
        }

        .table {
            width: 100%;
            min-width: 600px;
            border-collapse: collapse;
            background-color: white;
        }

        .table thead th {
            background-color: #673E42;
            color: white;
            padding: 15px;
            font-weight: 600;
            position: sticky;
            top: 0;
            border-right: 1px solid #8D6E63;
            text-align: left;
        }

        .table thead th:first-child {
            border-top-left-radius: 9px;
        }

        .table thead th:last-child {
            border-top-right-radius: 9px;
            border-right: none;
        }

        .table td {
            padding: 14px 16px;
            vertical-align: middle;
            border-top: 1px solid #673E42;
            border-right: 1px solid #673E42;
            color: #2c3e50;
        }

        .table td:last-child {
            border-right: none;
        }

        .table tbody tr:last-child td:first-child {
            border-bottom-left-radius: 9px;
        }

        .table tbody tr:last-child td:last-child {
            border-bottom-right-radius: 9px;
        }

        .table tbody tr:hover {
            background-color: #f8faff;
        }

        .table td {
            padding: 14px 16px;
            vertical-align: middle;
            border-top: 1px solid #673E42;
        }

        .btn-detail {
            background-color: #673E42;
            color: white;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: inline-block;
        }

        .btn-detail:hover {
            background-color: #3a5bd9;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(78, 115, 223, 0.2);
        }

        .badge-putri {
            background-color: #f8e1ee;
            color: #c2185b;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .badge-putra {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .badge-campur {
            background-color: #ffa502;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .price-highlight {
            font-weight: 600;
            color: #2c3e50;
        }

        .no-results {
            text-align: center;
            padding: 30px;
            color: #7f8c8d;
            font-style: italic;
        }



        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-controls {
            display: flex;
            gap: 10px;
        }

        .page-size-selector {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-size-selector select {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
        }

        .page-info {
            font-size: 0.9rem;
            color: #555;
        }

        .page-btn {
            padding: 8px 15px;
            border-radius: 6px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: all 0.2s;
        }

        .page-btn:hover:not(:disabled) {
            background-color: #673E42;
            color: white;
            border-color: #673E42;
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .page-btn.active {
            background-color: #673E42;
            color: white;
            border-color: #673E42;
        }

        @media (max-width: 768px) {
            .kos-container {
                padding: 20px;
            }

            .kos-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-container {
                max-width: 100%;
                margin-top: 15px;
            }

            .table td {
                padding: 12px 10px;
            }

            .pagination-container {
                flex-direction: column;
                align-items: stretch;
            }

            .pagination-controls {
                justify-content: center;
                order: 2;
            }

            .page-size-selector {
                justify-content: center;
                order: 1;
            }

            .page-info {
                text-align: center;
                order: 3;
                margin-top: 10px;
            }
        }
        @media (max-width: 480px) {
            .kos-container {
                padding: 20px;
            }

            .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }


            .kos-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-container {
                max-width: 100%;
                margin-top: 15px;
            }

            .table td {
                padding: 12px 10px;
            }

            .pagination-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 25px;
    gap: 15px;
    flex-wrap: nowrap; /* Pastikan tidak wrap ke baris baru */
    width: 100%;
    overflow-x: auto; /* Untuk mobile jika konten terlalu panjang */
    padding-bottom: 5px; /* Ruang untuk scrollbar */
}

.page-size-selector {
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap; /* Teks tidak wrap */
    flex-shrink: 0; /* Tidak menyusut */
}

.page-size-selector select {
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #ddd;
    background-color: #f8f9fa;
    cursor: pointer;
}

.pagination-controls {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: nowrap;
}

.page-info {
    white-space: nowrap;
    flex-shrink: 0;
    margin: 0 10px;
}
        }
    </style>

    <body>
        <div class="page-container">
            <div class="kos-container">
                <div class="kos-header">
                    <h2>Daftar Kos</h2>
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari nama kos...">
                    </div>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kos</th>
                                <th>Lokasi</th>
                                <th>Jenis</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="kosTableBody">
                            @foreach ($points as $index => $kos)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kos->nama }}</td>
                                    <td>{{ Str::limit($kos->alamat, 30) }}</td>
                                    <td>
                                        <span
                                            class="badge
                            @if ($kos->jenis == 'Putra') badge-putra
                            @elseif($kos->jenis == 'Putri') badge-putri
                            @else badge-campur @endif">
                                            {{ $kos->jenis }}
                                        </span>
                                    </td>
                                    <td class="price-highlight">Rp {{ number_format($kos->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('kos-detail', $kos->id) }}" class="btn-detail">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    <div class="page-size-selector">
                        <span>Tampilkan:</span>
                        <select id="pageSizeSelect">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                        <span>data per halaman</span>
                    </div>

                    <div class="pagination-controls">
                        <button id="firstPage" class="page-btn" title="Halaman Pertama">
                            <i class="fas fa-angle-double-left"></i>
                        </button>
                        <button id="prevPage" class="page-btn" title="Halaman Sebelumnya">
                            <i class="fas fa-angle-left"></i>
                        </button>
                        <div id="pageNumbers" class="pagination-numbers"></div>
                        <button id="nextPage" class="page-btn" title="Halaman Berikutnya">
                            <i class="fas fa-angle-right"></i>
                        </button>
                        <button id="lastPage" class="page-btn" title="Halaman Terakhir">
                            <i class="fas fa-angle-double-right"></i>
                        </button>
                    </div>

                    <div class="page-info" id="pageInfo"></div>
                </div>
            </div>
        </div>
    </body>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const kosTableBody = document.getElementById('kosTableBody');
            const pageSizeSelect = document.getElementById('pageSizeSelect');
            const firstPageBtn = document.getElementById('firstPage');
            const prevPageBtn = document.getElementById('prevPage');
            const nextPageBtn = document.getElementById('nextPage');
            const lastPageBtn = document.getElementById('lastPage');
            const pageNumbers = document.getElementById('pageNumbers');
            const pageInfo = document.getElementById('pageInfo');

            let originalData = {!! json_encode($points) !!};
            let filteredData = [...originalData];
            let currentPage = 1;
            let pageSize = 10;
            let totalPages = 1;

            // Inisialisasi
            initPagination();

            // Event listeners
            searchInput.addEventListener('input', performSearch);
            pageSizeSelect.addEventListener('change', function() {
                pageSize = parseInt(this.value);
                currentPage = 1;
                updatePagination();
                renderTable();
            });

            firstPageBtn.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage = 1;
                    updatePagination();
                    renderTable();
                }
            });

            prevPageBtn.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    updatePagination();
                    renderTable();
                }
            });

            nextPageBtn.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    updatePagination();
                    renderTable();
                }
            });

            lastPageBtn.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage = totalPages;
                    updatePagination();
                    renderTable();
                }
            });

            // Fungsi untuk inisialisasi pagination
            function initPagination() {
                updatePagination();
                renderTable();
            }

            // Fungsi untuk melakukan pencarian
            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase();
                filteredData = originalData.filter(kos =>
                    kos.nama.toLowerCase().includes(searchTerm)
                );

                currentPage = 1;
                updatePagination();
                renderTable();
            }

            // Fungsi untuk update pagination controls
            function updatePagination() {
                totalPages = Math.ceil(filteredData.length / pageSize);

                // Update tombol navigasi
                firstPageBtn.disabled = currentPage === 1;
                prevPageBtn.disabled = currentPage === 1;
                nextPageBtn.disabled = currentPage === totalPages;
                lastPageBtn.disabled = currentPage === totalPages;

                // Update page numbers
                renderPageNumbers();

                // Update info halaman
                const startItem = (currentPage - 1) * pageSize + 1;
                const endItem = Math.min(currentPage * pageSize, filteredData.length);
                pageInfo.textContent =
                    `Menampilkan ${startItem} sampai ${endItem} dari ${filteredData.length} data`;
            }

            // Fungsi untuk render nomor halaman
            function renderPageNumbers() {
                pageNumbers.innerHTML = '';

                const maxVisiblePages = 5;
                let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                if (endPage - startPage + 1 < maxVisiblePages) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }

                // Tombol halaman pertama jika diperlukan
                if (startPage > 1) {
                    const pageBtn = document.createElement('button');
                    pageBtn.textContent = '1';
                    pageBtn.className = 'page-btn';
                    pageBtn.addEventListener('click', () => {
                        currentPage = 1;
                        updatePagination();
                        renderTable();
                    });
                    pageNumbers.appendChild(pageBtn);

                    if (startPage > 2) {
                        const ellipsis = document.createElement('span');
                        ellipsis.textContent = '...';
                        ellipsis.style.padding = '0 10px';
                        pageNumbers.appendChild(ellipsis);
                    }
                }

                // Tombol halaman
                for (let i = startPage; i <= endPage; i++) {
                    const pageBtn = document.createElement('button');
                    pageBtn.textContent = i;
                    pageBtn.className = i === currentPage ? 'page-btn active' : 'page-btn';
                    pageBtn.addEventListener('click', () => {
                        currentPage = i;
                        updatePagination();
                        renderTable();
                    });
                    pageNumbers.appendChild(pageBtn);
                }

                // Tombol halaman terakhir jika diperlukan
                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) {
                        const ellipsis = document.createElement('span');
                        ellipsis.textContent = '...';
                        ellipsis.style.padding = '0 10px';
                        pageNumbers.appendChild(ellipsis);
                    }

                    const pageBtn = document.createElement('button');
                    pageBtn.textContent = totalPages;
                    pageBtn.className = 'page-btn';
                    pageBtn.addEventListener('click', () => {
                        currentPage = totalPages;
                        updatePagination();
                        renderTable();
                    });
                    pageNumbers.appendChild(pageBtn);
                }
            }

            // Fungsi untuk merender tabel
            function renderTable() {
                const startIndex = (currentPage - 1) * pageSize;
                const endIndex = Math.min(startIndex + pageSize, filteredData.length);
                const currentData = filteredData.slice(startIndex, endIndex);

                kosTableBody.innerHTML = '';

                if (currentData.length === 0) {
                    kosTableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="no-results">Tidak ada data ditemukan</td>
                    </tr>
                `;
                    return;
                }

                currentData.forEach((kos, index) => {
                    const row = document.createElement('tr');
                    const itemNumber = startIndex + index + 1;

                    // Determine badge class and icon based on jenis
                    let badgeClass = 'badge-campur';
                    let icon = '';

                    if (kos.jenis.toLowerCase().includes('putri')) {
                        badgeClass = 'badge-putri';
                        icon = '<i class="fas fa-female"></i> ';
                    } else if (kos.jenis.toLowerCase().includes('putra')) {
                        badgeClass = 'badge-putra';
                        icon = '<i class="fas fa-male"></i> ';
                    }

                    // Format price with thousand separators
                    const formattedPrice = kos.harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                    row.innerHTML = `
        <td>${itemNumber}</td>
        <td>${kos.nama}</td>
        <td>${kos.alamat}</td>
        <td><span class="${badgeClass}">${icon}${kos.jenis}</span></td>
        <td class="price-highlight">Rp ${formattedPrice}</td>
        <td>
            <a href="/detail/${kos.id}" class="btn-detail">Detail</a>
        </td>
    `;

                    kosTableBody.appendChild(row);
                });
            }
        });
    </script>
@endsection
