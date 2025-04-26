@extends('layouts.template')
@section('styles')
    <style>
        .page-container {
            padding: 100px 20px 20px;
            max-width: 100%;
            margin: auto;
        }

        .kos-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        .kos-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 10px;
        }

        .kos-header h2 {
            font-size: 24px;
            margin: 0;
        }

        .search-container {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 5px 10px;
            background-color: #f9f9f9;
            flex: 1;
            max-width: 300px;
        }

        .search-icon {
            margin-right: 8px;
            color: #888;
        }

        #searchInput {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            margin-top: 25px;
            border: 1px solid #673E42;
            -webkit-overflow-scrolling: touch;
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

        .badge-putri {
            background-color: #f8e1ee;
            color: #c2185b;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
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
            white-space: nowrap;
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
            white-space: nowrap;
        }

        .price-highlight {
            font-weight: 600;
            color: #2c3e50;
            white-space: nowrap;
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
            white-space: nowrap;
        }

        .btn-detail:hover {
            background-color: #1e1213;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(78, 115, 223, 0.2);
        }

        .no-results {
            text-align: center;
            color: #999;
            padding: 20px;
            font-style: italic;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .page-size-selector select {
            padding: 4px 8px;
            border-radius: 6px;
        }

        .pagination-controls {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .page-btn {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .page-btn.active {
            background-color: #673E42;
            color: white;
        }

        .page-info {
            font-size: 13px;
            color: #666;
        }

        /* Responsif */
        @media screen and (max-width: 768px) {
            .kos-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-container {
                width: 100%;
            }

            .table-container {
                overflow-x: auto;
            }

            .pagination-container {
                flex-wrap: wrap;
                flex-direction: row;
                align-items: center;
                justify-content: center;
                gap: 8px;
            }

            .page-info {
                width: 100%;
                text-align: center;
                margin-top: 10px;
            }
        }

        @media screen and (max-width: 576px) {
            .page-container {
                padding-top: 120px;
            }

            .table th,
            .table td {
                font-size: 13px;
                padding: 8px;
            }

            .btn-detail {
                padding: 5px 10px;
                font-size: 12px;
            }
        }
    </style>
@endsection


@section('content')

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
@endsection

@section('scripts')
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

            initPagination();

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

            function initPagination() {
                updatePagination();
                renderTable();
            }

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase();
                filteredData = originalData.filter(kos =>
                    kos.nama.toLowerCase().includes(searchTerm)
                );

                currentPage = 1;
                updatePagination();
                renderTable();
            }

            function updatePagination() {
                totalPages = Math.ceil(filteredData.length / pageSize);

                firstPageBtn.disabled = currentPage === 1;
                prevPageBtn.disabled = currentPage === 1;
                nextPageBtn.disabled = currentPage === totalPages;
                lastPageBtn.disabled = currentPage === totalPages;

                renderPageNumbers();

                const startItem = (currentPage - 1) * pageSize + 1;
                const endItem = Math.min(currentPage * pageSize, filteredData.length);
                pageInfo.textContent =
                    `Menampilkan ${startItem} sampai ${endItem} dari ${filteredData.length} data`;
            }

            function renderPageNumbers() {
                pageNumbers.innerHTML = '';
                const isMobile = window.innerWidth < 576;

                if (isMobile) {
                    const pagesToShow = new Set();

                    if (currentPage > 1) {
                        pagesToShow.add(currentPage - 1);
                    }

                    pagesToShow.add(currentPage);

                    if (currentPage < totalPages) {
                        pagesToShow.add(currentPage + 1);
                    }

                    const visiblePages = Array.from(pagesToShow).sort((a, b) => a - b);

                    visiblePages.forEach(page => {
                        const pageBtn = document.createElement('button');
                        pageBtn.textContent = page;
                        pageBtn.className = page === currentPage ? 'page-btn active' : 'page-btn';
                        pageBtn.addEventListener('click', () => {
                            currentPage = page;
                            updatePagination();
                            renderTable();
                        });
                        pageNumbers.appendChild(pageBtn);
                    });
                } else {
                    const maxVisiblePages = 5;
                    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                    if (endPage - startPage + 1 < maxVisiblePages) {
                        startPage = Math.max(1, endPage - maxVisiblePages + 1);
                    }

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
                            ellipsis.style.padding = '0 5px';
                            ellipsis.style.display = 'flex';
                            ellipsis.style.alignItems = 'center';
                            pageNumbers.appendChild(ellipsis);
                        }
                    }

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

                    if (endPage < totalPages) {
                        if (endPage < totalPages - 1) {
                            const ellipsis = document.createElement('span');
                            ellipsis.textContent = '...';
                            ellipsis.style.padding = '0 5px';
                            ellipsis.style.display = 'flex';
                            ellipsis.style.alignItems = 'center';
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
            }

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

                    let badgeClass = 'badge-campur';
                    let icon = '';

                    if (kos.jenis.toLowerCase().includes('putri')) {
                        badgeClass = 'badge-putri';
                        icon = '<i class="fas fa-female"></i> ';
                    } else if (kos.jenis.toLowerCase().includes('putra')) {
                        badgeClass = 'badge-putra';
                        icon = '<i class="fas fa-male"></i> ';
                    }

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

            window.addEventListener('resize', function() {
                renderPageNumbers();
            });
        });
    </script>
@endsection
