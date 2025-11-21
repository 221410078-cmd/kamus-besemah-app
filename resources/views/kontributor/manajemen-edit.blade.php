<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Edit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        /* ========================================================== */
        /* == PENGATURAN DASAR & LAYOUT ============================= */
        /* ========================================================== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff; 
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            display: flex;
            flex-direction: column;
            width: 95%;
            max-width: 1200px;
            height: 90vh;
            background-color: #f5f5f5;
            border-radius: 6px; 
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .main-content {
            display: flex;
            flex-grow: 1;
            overflow: hidden;
        }

        /* ========================================================== */
        /* == HEADER ================================================ */
        /* ========================================================== */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #508ba0; 
            border-bottom: 1px solid #ccc;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-info i.fa-book-open {
            font-size: 1.5rem;
            color: #ffffff;
        }

        .user-name {
            font-weight: 600;
            font-size: 1.1rem;
             color: #ffffff;
        }

        .user-title {
            font-size: 0.9rem;
            color: #ffffff;
        }

        .header .logout-btn {
            padding: 8px 15px;
            border: 1px solid #999;
            background-color: #f0f0f0;
            color: #333;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .header .logout-btn:hover {
            background-color: #ddd;
        }

        /* ========================================================== */
        /* == SIDEBAR =============================================== */
        /* ========================================================== */
        .sidebar {
            width: 185px;
            background-color: #508ba0; 
            border-right: 1px solid #B0B0B0;
            flex-shrink: 0;
            overflow-y: auto;
        }

        .sidebar ul {
            list-style: none;
             color: #ffffff;
        }
        
        .sidebar a {
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            transition: all 0.2s;
        }
        
        .sidebar li {
            font-size: 0.95rem;
            font-weight: 500;
            border-bottom: 1px solid #C0C0C0;
            cursor: pointer;
        }

        .sidebar li.active {
            background-color: #A9A9A9;
            font-weight: bold;
            border-left: 5px solid #ffffff; 
        }
        
        .sidebar li:not(.active):hover {
            background-color: #C0C0C0;
        }

        .sidebar .menu-icon {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }
        
        /* ========================================================== */
        /* == KONTEN UTAMA / AREA FORM ============================== */
        /* ========================================================== */
        .table-area {
            flex-grow: 1;
            padding: 20px;
            background-color: #F5F5F5;
            overflow-y: auto;
        }

        /* ========================================================== */
        /* == VARIABLES & RESET ==================================== */
        /* ========================================================== */
        :root {
            --primary-color: #508ba0;
            --primary-hover: #4a6c7c;
            --secondary-color: #3498db;
            --success-color: #4CAF50;
            --danger-color: #e74c3c;
            --warning-color: #FFC107;
            --light-gray: #f5f5f5;
            --medium-gray: #ddd;
            --dark-gray: #333;
            --border-radius: 4px;
            --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        /* ========================================================== */
        /* == LAYOUT & COMPONENTS =================================== */
        /* ========================================================== */
        .content-card {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: var(--box-shadow);
            width: 100%;
            max-width: 1200px;
        }
        
        .status-header {
            font-size: 1.6em;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--primary-color);
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .table-controls {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .filter-container {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            flex-grow: 1;
        }

        .select-filter {
            padding: 8px 12px;
            border: 1px solid var(--medium-gray);
            border-radius: var(--border-radius);
            font-size: 1rem;
            min-width: 150px;
            transition: var(--transition);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .select-filter:focus {
            border-color: var(--primary-color);
            outline: none;
        }
        
        .search-input-container {
            position: relative;
            flex-grow: 1;
            min-width: 200px;
            max-width: none; 
            display: flex; 
            gap: 0;
        }
        
        .search-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--medium-gray);
            border-radius: var(--border-radius) 0 0 var(--border-radius);
            font-size: 1rem;
            flex-grow: 1;
            transition: var(--transition);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .search-input:focus {
            border-color: var(--primary-color);
            outline: none;
        }
        
        .search-button {
            padding: 10px 15px;
            border: 1px solid var(--primary-color);
            background-color: var(--primary-color);
            color: #fff;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
            height: 40px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .search-button:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        .action-button {
            padding: 8px 15px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: var(--transition);
            border: 1px solid;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .publish-massal {
            background-color: #E6FFE6;
            color: var(--success-color);
            border-color: #8BC34A;
        }

        .publish-massal:hover {
            background-color: #D4FFD4;
        }

        .hapus-massal {
            background-color: #FFEDED;
            color: var(--danger-color);
            border-color: #F44336;
        }

        .hapus-massal:hover {
            background-color: #FFDADA;
        }
        
        /* ========================================================== */
        /* == TABLE STYLING ========================================= */
        /* ========================================================== */
        .table-container {
            overflow-x: auto;
            margin-bottom: 20px;
            border: 1px solid var(--medium-gray);
            border-radius: var(--border-radius);
        }

        .management-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .management-table th, .management-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--medium-gray);
            font-size: 0.9rem;
            color: #333;
        }

        .management-table th {
             background-color: var(--primary-color);
             color: #fff;
             font-size: 0.9rem;
             position: sticky;
             top: 0;
        }

        .management-table tr:hover {
            background-color: #f9f9f9;
        }
        
        .cara-baca {
            white-space: nowrap;
        }
        
        .aksi-kolom {
            width: 120px;
            text-align: center;
            white-space: nowrap;
        }

        .action-icon {
            margin: 0 4px;
            padding: 5px;
            border: 1px solid var(--medium-gray);
            border-radius: var(--border-radius);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            transition: var(--transition);
        }

        .action-icon.edit-icon {
            color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .action-icon.edit-icon:hover {
            background-color: #eaf6fc;
        }

        .action-icon.delete-icon {
            color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .action-icon.delete-icon:hover {
            background-color: #fceaea;
        }
        
        .status-chip {
            display: inline-block;
            padding: 4px 8px;
            border-radius: var(--border-radius);
            font-weight: bold;
            font-size: 0.8rem;
            text-align: center;
            min-width: 80px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .status-pending {
            background-color: #FFFDE7;
            color: var(--warning-color);
            border: 1px solid var(--warning-color);
        }
        
        /* ========================================================== */
        /* == FILTER GROUP ========================================== */
        /* ========================================================== */
        .filter-group-top {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 20px;
        }

        .filter-row {
            display: flex;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-type-data {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .rows-per-page-control {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .rows-per-page-control select {
            padding: 5px;
            border: 1px solid var(--medium-gray);
            border-radius: var(--border-radius);
            transition: var(--transition);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .rows-per-page-control select:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .search-and-button {
            display: flex;
            flex-grow: 1;
        }
        
        /* ========================================================== */
        /* == PAGINATION ============================================ */
        /* ========================================================== */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 15px 0;
            border-top: 1px solid var(--medium-gray);
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-info {
            font-size: 0.9rem;
            color: #666;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .pagination {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .pagination-btn {
            padding: 8px 12px;
            border: 1px solid var(--medium-gray);
            background-color: white;
            color: var(--dark-gray);
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 0.9rem;
            transition: var(--transition);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .pagination-btn:hover:not(:disabled) {
            background-color: #f0f0f0;
        }

        .pagination-btn:disabled {
            background-color: #f5f5f5;
            color: #999;
            cursor: not-allowed;
        }

        .pagination-btn.active {
            background-color: var(--primary-hover);
            color: white;
            border-color: var(--primary-hover);
        }

        .pagination-ellipsis {
            padding: 8px 12px;
            color: #666;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* ========================================================== */
        /* == MODAL EDIT ============================================ */
        /* ========================================================== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-gray);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #777;
            transition: var(--transition);
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .close-modal:hover {
            color: var(--dark-gray);
            background-color: #f0f0f0;
            border-radius: 50%;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--medium-gray);
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        
        .form-row {
            display: flex;
            gap: 15px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            border: 1px solid transparent;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .btn-secondary {
            background-color: #f0f0f0;
            color: var(--dark-gray);
            border-color: #ccc;
        }
        
        .btn-secondary:hover {
            background-color: #e0e0e0;
        }
        
        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
        }
        
        /* ========================================================== */
        /* == SEARCHABLE DROPDOWN STYLES ============================ */
        /* ========================================================== */
        .searchable-dropdown {
            position: relative;
        }
        
        .searchable-dropdown input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--medium-gray);
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .searchable-dropdown input:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        
        .dropdown-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid var(--medium-gray);
            border-top: none;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            max-height: 200px;
            overflow-y: auto;
            z-index: 100;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: none;
        }
        
        .dropdown-option {
            padding: 10px 12px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: var(--transition);
        }
        
        .dropdown-option:hover {
            background-color: #f5f5f5;
        }
        
        .dropdown-option:last-child {
            border-bottom: none;
        }
        
        .dropdown-option.highlighted {
            background-color: #e6f7ff;
        }
        
        /* ========================================================== */
        /* == UTILITY: CSS UNTUK MENYEMBUNYIKAN/MENAMPILKAN ========== */
        /* ========================================================== */
        .hidden {
            display: none !important;
        }

        /* ========================================================== */
        /* == STYLES UNTUK NOTIFIKASI =============================== */
        /* ========================================================== */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 4px;
            color: white;
            font-weight: 500;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateX(120%);
            transition: transform 0.3s ease;
            max-width: 400px;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            background-color: #4CAF50;
        }

        .notification.error {
            background-color: #f44336;
        }

        .notification.info {
            background-color: #2196F3;
        }

        /* ========================================================== */
        /* == RESPONSIVE ============================================ */
        /* ========================================================== */
        @media (max-width: 768px) {
            body {
                padding: 10px;
                align-items: flex-start;
            }
            
            .container {
                height: 95vh;
                width: 100%;
            }
            
            .main-content {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                max-height: none;
                overflow-x: auto;
                border-right: none;
                border-bottom: 1px solid #B0B0B0;
            }

            .table-area {
                padding: 15px;
            }

            .content-card {
                padding: 15px;
            }
            
            .filter-group-top {
                 flex-direction: column;
            }
            
            .filter-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                width: 100%;
            }
            
            .search-input-container {
                 min-width: unset;
                 width: 100%;
            }
            
            .search-and-button {
                flex-direction: column;
                width: 100%;
            }
            
            .search-button {
                border-radius: var(--border-radius);
                margin-top: 10px;
                justify-content: center;
            }
            
            .table-container {
                font-size: 0.8rem;
            }
            
            .management-table th, 
            .management-table td {
                padding: 8px 10px;
            }
            
            .management-table th:nth-child(6), 
            .management-table td:nth-child(6),
            .management-table th:nth-child(7), 
            .management-table td:nth-child(7) {
                display: none;
            }
            
            .modal-content {
                padding: 20px;
                width: 100%;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .pagination-container {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .pagination {
                justify-content: center;
            }
            
            .notification {
                top: 10px;
                right: 10px;
                left: 10px;
                transform: translateY(-100px);
                max-width: none;
            }

            .notification.show {
                transform: translateY(0);
            }
            
            .dropdown-options {
                max-height: 150px;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }
            
            .user-info {
                width: 100%;
            }
            
            .header .logout-btn {
                align-self: flex-end;
            }
            
            .sidebar ul {
                display: flex;
                overflow-x: auto;
            }
            
            .sidebar li {
                flex-shrink: 0;
                border-bottom: none;
                border-right: 1px solid #C0C0C0;
            }
            
            .sidebar li.active {
                border-left: none;
                border-bottom: 3px solid #4CAF50;
            }
            
            .management-table th:nth-child(2), 
            .management-table td:nth-child(2),
            .management-table th:nth-child(4), 
            .management-table td:nth-child(4) {
                display: none;
            }
            
            .aksi-kolom {
                width: 80px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <x-header-admin />
        <div class="main-content">  
            <x-sidebar-kontributor />
            
            <div class="table-area">
                <div class="content-card">
                    <h2 class="status-header">Manajemen Edit Kontribusi</h2>
                    <div class="filter-group-top">
                        <div class="filter-row">
                            <div class="filter-type-data dropdown-filter">
                                <label for="data-type-filter">Filter Tipe Data:</label>
                                <select id="data-type-filter" class="select-filter">
                                    <option value="all">Semua Data</option>
                                    <option value="kata">Kata</option>
                                    <option value="kalimat">Kalimat</option>
                                </select>
                            </div>
                            
                            <div class="rows-per-page-control">
                                <span>Tampilkan:</span>
                                <select id="rowsPerPage">
                                    <option value="5">5 baris</option>
                                    <option value="10">10 baris</option>
                                    <option value="25" selected>25 baris</option>
                                    <option value="50">50 baris</option>
                                    <option value="75">75 baris</option>
                                    <option value="100">100 baris</option>
                                </select>
                            </div>
                        </div>

                        <div class="search-and-button">
                            <div class="search-input-container">
                                <input type="text" placeholder="Cari kata/kalimat, arti, ID, atau Sub ID..." class="search-input" id="searchInput">
                            </div>
                            <button class="search-button">
                                <i class="fa-solid fa-magnifying-glass"></i> Cari
                            </button>
                        </div>
                    </div>

                    <div class="table-container">
                        <table class="management-table">
                            <thead>
                                <tr>
                                    <th>ID DATA</th>
                                    <th>SUB ID</th>
                                    <th>KONTEN/KATA</th>
                                    <th class="cara-baca-header">CARA BACA</th>
                                    <th>ARTI</th>
                                    <th>TIPE</th>
                                    <th class="jenis-header">JENIS</th>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <!-- Data akan diisi oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="pagination-container">
                        <div class="pagination-info" id="paginationInfo">Menampilkan 0 dari 0 entri</div>
                        <div class="pagination" id="pagination">
                            <!-- Tombol pagination akan diisi oleh JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data Kontribusi Kata -->
    <div class="modal-overlay" id="editModalKata">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Data Kontribusi Kata</h3>
                <button class="close-modal" data-modal="editModalKata">&times;</button>
            </div>
            <form id="editFormKata">
                <div class="form-row">
                    <div class="form-group">
                        <label for="editJenisKata">Jenis</label>
                        <select id="editJenisKata" class="form-control" required>
                            <option value="Verba">Verba</option>
                            <option value="Nomina">Nomina</option>
                            <option value="Adjektiva">Adjektiva</option>
                            <option value="Adverbia">Adverbia</option>
                            <option value="Pronomina">Pronomina</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="editIdDataKata">ID Data</label>
                        <input type="text" id="editIdDataKata" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editSubIdKata">Sub ID</label>
                        <div class="searchable-dropdown">
                            <input type="text" id="editSubIdKata" class="form-control" placeholder="Cari atau pilih kata..." required>
                            <div class="dropdown-options" id="subIdOptionsKata">
                                <!-- Opsi akan diisi oleh JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="editKontenKata">Kata</label>
                    <input type="text" id="editKontenKata" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="editCaraBacaKata">Cara Baca</label>
                    <input type="text" id="editCaraBacaKata" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="editArtiKata">Arti</label>
                    <textarea id="editArtiKata" class="form-control" rows="3" required></textarea>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-modal="editModalKata">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Data Kontribusi Kalimat -->
    <div class="modal-overlay" id="editModalKalimat">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Data Kontribusi Kalimat</h3>
                <button class="close-modal" data-modal="editModalKalimat">&times;</button>
            </div>
            <form id="editFormKalimat">
                <div class="form-row">
                    <div class="form-group">
                        <label for="editJenisKalimat">Jenis</label>
                        <input type="text" id="editJenisKalimat" class="form-control" value="-" readonly>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="editIdDataKalimat">ID Data</label>
                        <input type="text" id="editIdDataKalimat" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editSubIdKalimat">Sub ID</label>
                        <div class="searchable-dropdown">
                            <input type="text" id="editSubIdKalimat" class="form-control" placeholder="Cari atau pilih kalimat..." required>
                            <div class="dropdown-options" id="subIdOptionsKalimat">
                                <!-- Opsi akan diisi oleh JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="editKontenKalimat">Kalimat</label>
                    <textarea id="editKontenKalimat" class="form-control" rows="2" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="editArtiKalimat">Arti</label>
                    <textarea id="editArtiKalimat" class="form-control" rows="3" required></textarea>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-modal="editModalKalimat">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let kontribusiData = @json($dataGabungan);
        console.log(kontribusiData);

        // Variabel untuk pagination
        let currentPage = 1;
        let rowsPerPage = 25;

        // Fungsi untuk inisialisasi
        function initializePage() {
            // Setup event listeners
            document.getElementById('data-type-filter').addEventListener('change', filterTable);
            document.querySelector('.search-button').addEventListener('click', searchTable);
            document.getElementById('rowsPerPage').addEventListener('change', updateRowsPerPage);
            
            // Tambahkan event listener untuk pencarian dengan Enter
            document.getElementById('searchInput').addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    searchTable();
                }
            });
            
            // Setup event listeners untuk modal
            setupModalEvents();
            
            // Render tabel awal
            renderTable();
        }

        // Fungsi untuk setup modal events
        function setupModalEvents() {
            // Setup untuk modal Kata
            const modalKata = document.getElementById('editModalKata');
            const closeModalKataBtn = document.querySelector('#editModalKata .close-modal');
            const cancelEditKataBtn = document.querySelector('#editModalKata .btn-secondary');
            const editFormKata = document.getElementById('editFormKata');
            
            // Setup untuk modal Kalimat
            const modalKalimat = document.getElementById('editModalKalimat');
            const closeModalKalimatBtn = document.querySelector('#editModalKalimat .close-modal');
            const cancelEditKalimatBtn = document.querySelector('#editModalKalimat .btn-secondary');
            const editFormKalimat = document.getElementById('editFormKalimat');
            
            // Function to close modal
            function closeEditModal(modalId) {
                document.getElementById(modalId).style.display = 'none';
            }
            
            // Event listeners for modal Kata
            closeModalKataBtn.addEventListener('click', () => closeEditModal('editModalKata'));
            cancelEditKataBtn.addEventListener('click', () => closeEditModal('editModalKata'));
            
            // Event listeners for modal Kalimat
            closeModalKalimatBtn.addEventListener('click', () => closeEditModal('editModalKalimat'));
            cancelEditKalimatBtn.addEventListener('click', () => closeEditModal('editModalKalimat'));
            
            // Close modal when clicking outside
            document.querySelectorAll('.modal-overlay').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeEditModal(modal.id);
                    }
                });
            });
            
            // Form submission untuk Kata
            editFormKata.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form values
    const idData = document.getElementById('editIdDataKata').value;
    let subId = document.getElementById('editSubIdKata').value;
    const konten = document.getElementById('editKontenKata').value;
    const caraBaca = document.getElementById('editCaraBacaKata').value;
    const arti = document.getElementById('editArtiKata').value;
    const jenis = document.getElementById('editJenisKata').value;

    // Ubah format Sub ID kembali ke format asli (huruf kecil) untuk penyimpanan
    if (subId.startsWith('K')) {
        subId = 'k' + subId.substring(1);
    }

    // Validasi data
    if (!validateFormData({ idData, subId, konten, arti, jenis, caraBaca }, 'kata')) {
        return;
    }

    // Update data lokal
    const index = kontribusiData.findIndex(item => item.idData === idData);
    if (index !== -1) {
        kontribusiData[index] = {
            ...kontribusiData[index],
            subId,
            konten,
            caraBaca,
            arti,
            jenis
        };

        // === Kirim perubahan ke server ===
        fetch(`/kontributor/validasi/kata`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                kata_id: idData,
                sub_id: subId,
                jenis: jenis,
                kata: konten,
                arti: arti,
                cara_baca: caraBaca,
                status: 'menunggu'
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('✅ Update kata sukses:', data);
            showNotification(`Perubahan untuk kata "${konten}" berhasil disimpan ke server!`, 'success');

            // Tutup modal dan render ulang
            closeEditModal('editModalKata');
            renderTable();
        })
        .catch(error => {
            console.error('❌ Error update kata:', error);
            showNotification('Terjadi kesalahan saat memperbarui kata ke server!', 'error');
        });

    } else {
        showNotification('Data tidak ditemukan', 'error');
    }
});

            
            // Form submission untuk Kalimat
editFormKalimat.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form values
    const idData = document.getElementById('editIdDataKalimat').value;
    let subId = document.getElementById('editSubIdKalimat').value;
    const konten = document.getElementById('editKontenKalimat').value;
    const arti = document.getElementById('editArtiKalimat').value;
    const jenis = '-'; // Jenis selalu "-" untuk kalimat

    // Ubah format Sub ID kembali ke format asli (huruf kecil) untuk penyimpanan
    if (subId.startsWith('KL')) {
        subId = 'kl' + subId.substring(2);
    }

    if (subId.includes(' - ')) {
    subId = subId.split(' - ')[0].trim();
}

    // Jika Sub ID kosong atau "-", kirim null agar tidak melanggar foreign key
    if (subId === '-' || subId === '' || subId === 'Pilih Sub ID...') {
        subId = null;
    }

    // Validasi data lokal
    if (!validateFormData({ idData, subId, konten, arti, jenis }, 'kalimat')) {
        return;
    }

    // Update data lokal
    const index = kontribusiData.findIndex(item => item.idData === idData);
    if (index !== -1) {
        kontribusiData[index] = {
            ...kontribusiData[index],
            subId,
            konten,
            arti,
            jenis
        };

        // === Kirim perubahan ke server ===
        fetch(`/kontributor/validasi/kalimat`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                kalimat_id: idData,
                sub_id: subId,
                kalimat: konten,
                arti: arti,
                status: 'menunggu'
            }),
        })
        .then(async (response) => {
            const data = await response.json();

            if (!response.ok) {
                console.error('❌ Validasi gagal:', data);
                showNotification('Validasi gagal: ' + JSON.stringify(data.errors), 'error');
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            console.log('✅ Update kalimat sukses:', data);
            showNotification(`Kalimat dengan ID "${idData}" berhasil disimpan ke server!`, 'success');

            // Tutup modal & render ulang tabel
            closeEditModal('editModalKalimat');
            renderTable();
        })
        .catch((error) => {
            console.error('❌ Error update kalimat:', error);
            showNotification('Terjadi kesalahan saat memperbarui kalimat ke server!', 'error');
        });

    } else {
        showNotification('Data tidak ditemukan', 'error');
    }
});

            
            // Setup searchable dropdown untuk Sub ID di modal Kata dan Kalimat
            setupSearchableDropdownKata();
            setupSearchableDropdownKalimat();
        }

        // Fungsi untuk setup searchable dropdown untuk modal Kata
        function setupSearchableDropdownKata() {
            const subIdInput = document.getElementById('editSubIdKata');
            const dropdownOptions = document.getElementById('subIdOptionsKata');
            
            // Fungsi untuk mengisi dropdown dengan opsi
            function populateDropdownOptions() {
                dropdownOptions.innerHTML = '';
                
                // Ambil semua data kata (bukan kalimat)
                const kataData = kontribusiData.filter(item => item.tipe === 'Kata');
                
                // Buat opsi untuk setiap kata - Format: "K00001 - ancang ancang" (K huruf besar)
                kataData.forEach(item => {
                    const option = document.createElement('div');
                    option.className = 'dropdown-option';
                    
                    // Ubah format Sub ID: ubah "k" menjadi "K" (huruf besar)
                    let displaySubId = item.idData;
                    if (displaySubId.startsWith('k')) {
                        displaySubId = 'K' + displaySubId.substring(1);
                    }
                    
                    option.textContent = displaySubId + ' - ' + item.konten; // Format: "K00001 - ancang ancang"
                    option.setAttribute('data-value', displaySubId);
                    
                    option.addEventListener('click', function() {
                        subIdInput.value = this.getAttribute('data-value');
                        dropdownOptions.style.display = 'none';
                    });
                    
                    dropdownOptions.appendChild(option);
                });
            }
            
            // Event listener untuk input
            subIdInput.addEventListener('focus', function() {
                populateDropdownOptions();
                dropdownOptions.style.display = 'block';
            });
            
            subIdInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const options = dropdownOptions.querySelectorAll('.dropdown-option');
                
                options.forEach(option => {
                    const text = option.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
                
                dropdownOptions.style.display = 'block';
            });
            
            // Sembunyikan dropdown ketika klik di luar
            document.addEventListener('click', function(e) {
                if (!subIdInput.contains(e.target) && !dropdownOptions.contains(e.target)) {
                    dropdownOptions.style.display = 'none';
                }
            });
            
            // Navigasi dengan keyboard
            let highlightedIndex = -1;
            
            subIdInput.addEventListener('keydown', function(e) {
                const options = dropdownOptions.querySelectorAll('.dropdown-option:not([style*="display: none"])');
                
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    highlightedIndex = (highlightedIndex + 1) % options.length;
                    updateHighlightedOption(options);
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    highlightedIndex = (highlightedIndex - 1 + options.length) % options.length;
                    updateHighlightedOption(options);
                } else if (e.key === 'Enter' && highlightedIndex >= 0) {
                    e.preventDefault();
                    options[highlightedIndex].click();
                }
            });
            
            function updateHighlightedOption(options) {
                options.forEach((option, index) => {
                    if (index === highlightedIndex) {
                        option.classList.add('highlighted');
                    } else {
                        option.classList.remove('highlighted');
                    }
                });
            }
        }

        // Fungsi untuk setup searchable dropdown untuk modal Kalimat
        function setupSearchableDropdownKalimat() {
            const subIdInput = document.getElementById('editSubIdKalimat');
            const dropdownOptions = document.getElementById('subIdOptionsKalimat');
            
            // Fungsi untuk mengisi dropdown dengan opsi
            function populateDropdownOptions() {
                dropdownOptions.innerHTML = '';
                
                // Ambil semua data kalimat (bukan kata)
                const kalimatData = kontribusiData.filter(item => item.tipe === 'Kalimat');
                
                // Buat opsi untuk setiap kalimat - Format: "KL00001 - aningi ancang ancang aku" (KL huruf besar)
                kalimatData.forEach(item => {
                    const option = document.createElement('div');
                    option.className = 'dropdown-option';
                    
                    // Ubah format Sub ID: ubah "kl" menjadi "KL" (huruf besar)
                    let displaySubId = item.subId;
                    if (displaySubId.startsWith('kl')) {
                        displaySubId = 'KL' + displaySubId.substring(2);
                    }
                    
                    option.textContent = displaySubId; // Format: "KL00001 - aningi ancang ancang aku"
                    option.setAttribute('data-value', displaySubId);
                    
                    option.addEventListener('click', function() {
                        subIdInput.value = this.getAttribute('data-value');
                        dropdownOptions.style.display = 'none';
                    });

                    console.log(displaySubId);
                    
                    dropdownOptions.appendChild(option);
                });
            }
            
            // Event listener untuk input
            subIdInput.addEventListener('focus', function() {
                populateDropdownOptions();
                dropdownOptions.style.display = 'block';
            });
            
            subIdInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const options = dropdownOptions.querySelectorAll('.dropdown-option');
                
                options.forEach(option => {
                    const text = option.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
                
                dropdownOptions.style.display = 'block';
            });
            
            // Sembunyikan dropdown ketika klik di luar
            document.addEventListener('click', function(e) {
                if (!subIdInput.contains(e.target) && !dropdownOptions.contains(e.target)) {
                    dropdownOptions.style.display = 'none';
                }
            });
            
            // Navigasi dengan keyboard
            let highlightedIndex = -1;
            
            subIdInput.addEventListener('keydown', function(e) {
                const options = dropdownOptions.querySelectorAll('.dropdown-option:not([style*="display: none"])');
                
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    highlightedIndex = (highlightedIndex + 1) % options.length;
                    updateHighlightedOption(options);
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    highlightedIndex = (highlightedIndex - 1 + options.length) % options.length;
                    updateHighlightedOption(options);
                } else if (e.key === 'Enter' && highlightedIndex >= 0) {
                    e.preventDefault();
                    options[highlightedIndex].click();
                }
            });
            
            function updateHighlightedOption(options) {
                options.forEach((option, index) => {
                    if (index === highlightedIndex) {
                        option.classList.add('highlighted');
                    } else {
                        option.classList.remove('highlighted');
                    }
                });
            }
        }

        // Fungsi validasi form
        function validateFormData(data, type) {
            if (type === 'kata') {
                // Validasi untuk kata (termasuk jenis dan caraBaca)
                if (!data.idData || !data.subId || !data.konten || !data.arti || !data.jenis || !data.caraBaca) {
                    showNotification('Semua field wajib diisi', 'error');
                    return false;
                }
            } else {
                // Validasi untuk kalimat (tanpa jenis)
                if (!data.idData || !data.subId || !data.konten || !data.arti) {
                    showNotification('Semua field wajib diisi', 'error');
                    return false;
                }
            }
            
            if (data.konten.length < 2) {
                showNotification('Konten harus memiliki minimal 2 karakter', 'error');
                return false;
            }
            
            // Validasi khusus untuk kata
            if (type === 'kata' && !data.caraBaca) {
                showNotification('Cara baca wajib diisi untuk data kata', 'error');
                return false;
            }
            
            return true;
        }

        // Fungsi untuk menampilkan notifikasi
        function showNotification(message, type = 'info') {
            // Hapus notifikasi sebelumnya jika ada
            const existingNotification = document.querySelector('.notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Buat elemen notifikasi
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.textContent = message;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 4px;
                color: white;
                font-weight: 500;
                z-index: 1001;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                animation: slideIn 0.3s ease;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            `;
            
            // Set warna berdasarkan tipe
            if (type === 'success') {
                notification.style.backgroundColor = '#4CAF50';
            } else if (type === 'error') {
                notification.style.backgroundColor = '#f44336';
            } else {
                notification.style.backgroundColor = '#2196F3';
            }
            
            // Tambahkan ke body
            document.body.appendChild(notification);
            
            // Hapus notifikasi setelah 3 detik
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.remove();
                        }
                    }, 300);
                }
            }, 3000);
        }

        // Fungsi untuk render tabel
        function renderTable() {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';
            
            // Filter data berdasarkan pencarian dan filter tipe
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const filterValue = document.getElementById('data-type-filter').value;
            
            const filteredData = kontribusiData.filter(item => {
                // Filter berdasarkan tipe data
                if (filterValue !== 'all') {
                    const itemType = item.tipe.toLowerCase();
                    if (filterValue !== itemType) {
                        return false;
                    }
                }
                
                // Filter berdasarkan pencarian
                if (searchValue) {
                    const searchMatch = 
                        item.idData.toLowerCase().includes(searchValue) || 
                        item.subId.toLowerCase().includes(searchValue) || 
                        item.konten.toLowerCase().includes(searchValue) || 
                        item.arti.toLowerCase().includes(searchValue);
                    
                    if (!searchMatch) {
                        return false;
                    }
                }
                
                return true;
            });
            
            // Hitung pagination
            const totalPages = Math.ceil(filteredData.length / rowsPerPage);
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = Math.min(startIndex + rowsPerPage, filteredData.length);
            const pageData = filteredData.slice(startIndex, endIndex);
            
            // Sembunyikan atau tampilkan kolom cara baca berdasarkan filter
            toggleCaraBacaColumn(filterValue);
            
            // Render baris tabel
            if (pageData.length === 0) {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td colspan="9" style="text-align: center; padding: 20px;">
                        Tidak ada data yang ditemukan
                    </td>
                `;
                tableBody.appendChild(row);
            } else {
                pageData.forEach(item => {
                    const row = document.createElement('tr');
                    row.setAttribute('data-type', item.tipe.toLowerCase());
                    
                    // Tentukan apakah akan menampilkan kolom cara baca
                    const showCaraBaca = filterValue !== 'kalimat';
                    
                    // Tentukan nilai cara baca yang akan ditampilkan
                    let displayCaraBaca = item.caraBaca;
                    if (filterValue === 'all' && item.tipe === 'Kalimat') {
                        displayCaraBaca = '-';
                    }
                    
                    row.innerHTML = `
                        <td>${item.idData}</td>
                        <td>${item.subId}</td>
                        <td>${item.konten}</td>
                        ${showCaraBaca ? `<td class="cara-baca">${displayCaraBaca}</td>` : ''}
                        <td>${item.arti}</td>
                        <td>${item.tipe}</td>
                        <td class="jenis-kolom">${item.jenis}</td>
                        <td><span class="status-chip status-pending">${item.status}</span></td>
                        <td class="aksi-kolom">
                            <span class="action-icon edit-icon" title="Edit" data-id="${item.idData}"><i class="fa-solid fa-pen"></i></span>
                            <span class="action-icon delete-icon" title="Hapus" data-tipe="${item.tipe}" data-id="${item.idData}"><i class="fa-solid fa-trash-can"></i></span>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            }
            
            // Update informasi pagination
            updatePaginationInfo(filteredData.length, startIndex + 1, endIndex);
            
            // Render kontrol pagination
            renderPagination(totalPages);
            
            // Setup event listeners untuk tombol aksi
            setupActionButtons();
        }

        // Fungsi untuk menyembunyikan/menampilkan kolom cara baca
        function toggleCaraBacaColumn(filterValue) {
            const caraBacaHeaders = document.querySelectorAll('.cara-baca-header');
            const caraBacaCells = document.querySelectorAll('.cara-baca');
            
            if (filterValue === 'kalimat') {
                // Sembunyikan kolom cara baca untuk filter kalimat
                caraBacaHeaders.forEach(header => header.style.display = 'none');
                caraBacaCells.forEach(cell => cell.style.display = 'none');
            } else {
                // Tampilkan kolom cara baca untuk filter lainnya
                caraBacaHeaders.forEach(header => header.style.display = 'table-cell');
                caraBacaCells.forEach(cell => cell.style.display = 'table-cell');
            }
        }

        // Fungsi untuk update informasi pagination
        function updatePaginationInfo(totalItems, start, end) {
            const paginationInfo = document.getElementById('paginationInfo');
            if (totalItems === 0) {
                paginationInfo.textContent = `Tidak ada data yang ditemukan`;
            } else {
                paginationInfo.textContent = `Menampilkan ${start}-${end} dari ${totalItems} entri`;
            }
        }

        // Fungsi untuk render kontrol pagination
        function renderPagination(totalPages) {
            const paginationContainer = document.getElementById('pagination');
            paginationContainer.innerHTML = '';
            
            if (totalPages <= 1) return;
            
            // Tombol sebelumnya
            const prevButton = document.createElement('button');
            prevButton.className = 'pagination-btn';
            prevButton.textContent = '‹';
            prevButton.disabled = currentPage === 1;
            prevButton.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderTable();
                }
            });
            paginationContainer.appendChild(prevButton);
            
            // Tombol halaman
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
            
            // Sesuaikan jika halaman awal terlalu jauh
            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }
            
            // Tombol halaman pertama jika perlu
            if (startPage > 1) {
                const firstPageButton = document.createElement('button');
                firstPageButton.className = 'pagination-btn';
                firstPageButton.textContent = '1';
                firstPageButton.addEventListener('click', () => {
                    currentPage = 1;
                    renderTable();
                });
                paginationContainer.appendChild(firstPageButton);
                
                if (startPage > 2) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'pagination-ellipsis';
                    ellipsis.textContent = '...';
                    paginationContainer.appendChild(ellipsis);
                }
            }
            
            // Tombol halaman
            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement('button');
                pageButton.className = `pagination-btn ${i === currentPage ? 'active' : ''}`;
                pageButton.textContent = i;
                pageButton.addEventListener('click', () => {
                    currentPage = i;
                    renderTable();
                });
                paginationContainer.appendChild(pageButton);
            }
            
            // Tombol halaman terakhir jika perlu
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'pagination-ellipsis';
                    ellipsis.textContent = '...';
                    paginationContainer.appendChild(ellipsis);
                }
                
                const lastPageButton = document.createElement('button');
                lastPageButton.className = 'pagination-btn';
                lastPageButton.textContent = totalPages;
                lastPageButton.addEventListener('click', () => {
                    currentPage = totalPages;
                    renderTable();
                });
                paginationContainer.appendChild(lastPageButton);
            }
            
            // Tombol berikutnya
            const nextButton = document.createElement('button');
            nextButton.className = 'pagination-btn';
            nextButton.textContent = '›';
            nextButton.disabled = currentPage === totalPages || totalPages === 0;
            nextButton.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable();
                }
            });
            paginationContainer.appendChild(nextButton);
        }

        // Fungsi untuk setup tombol aksi (edit dan hapus)
        function setupActionButtons() {
            // Event listener untuk edit icons
            document.querySelectorAll('.action-icon.edit-icon').forEach(icon => {
                icon.addEventListener('click', function() {
                    const idData = this.getAttribute('data-id');
                    openEditModal(idData);
                });
            });

            // Event listener untuk delete icons
            document.querySelectorAll('.action-icon.delete-icon').forEach(icon => {
                icon.addEventListener('click', function() {
                    const idData = this.getAttribute('data-id');
                    const tipe = this.getAttribute('data-tipe');
                    hapusSingle(idData, tipe);
                });
            });
        }

        // Fungsi untuk membuka modal edit
        function openEditModal(idData) {
            const item = kontribusiData.find(item => item.idData === idData);
            if (!item) {
                showNotification('Data tidak ditemukan', 'error');
                return;
            }
            
            if (item.tipe === 'Kata') {
                // Populate form Kata dengan data saat ini
                document.getElementById('editIdDataKata').value = item.idData;
                
                // Ubah format Sub ID: ubah "k" menjadi "K" (huruf besar)
                let displaySubId = item.subId;
                if (displaySubId.startsWith('k')) {
                    displaySubId = 'K' + displaySubId.substring(1);
                }
                
                document.getElementById('editSubIdKata').value = displaySubId; // Format: "K00001 - ancang ancang"
                document.getElementById('editKontenKata').value = item.konten;
                document.getElementById('editCaraBacaKata').value = item.caraBaca;
                document.getElementById('editArtiKata').value = item.arti;
                document.getElementById('editJenisKata').value = item.jenis;
                
                // Tampilkan modal Kata
                document.getElementById('editModalKata').style.display = 'flex';
            } else {
                // Populate form Kalimat dengan data saat ini
                // Ubah format ID Data: dari "KL00001" menjadi "K00001" (menghilangkan huruf L)
                let displayIdData = item.idData;
                if (displayIdData.startsWith('KL')) {
                    displayIdData = 'K' + displayIdData.substring(2);
                }
                
                document.getElementById('editIdDataKalimat').value = displayIdData; // Format: "K00001"
                
                // Ubah format Sub ID: ubah "kl" menjadi "KL" (huruf besar)
                let displaySubId = item.subId;
                if (displaySubId.startsWith('kl')) {
                    displaySubId = 'KL' + displaySubId.substring(2);
                }
                
                document.getElementById('editSubIdKalimat').value = displaySubId; // Format: "KL00001 - aningi ancang ancang aku"
                document.getElementById('editKontenKalimat').value = item.konten;
                document.getElementById('editArtiKalimat').value = item.arti;
                document.getElementById('editJenisKalimat').value = '-'; // Jenis selalu "-" untuk kalimat
                
                // Tampilkan modal Kalimat
                document.getElementById('editModalKalimat').style.display = 'flex';
            }
        }

        // Fungsi untuk hapus single item
        async function hapusSingle(idData, type = 'Kalimat') {
    const item = kontribusiData.find(item => item.idData === idData);
    if (!item) {
        showNotification('Data tidak ditemukan', 'error');
        return;
    }

    // Konfirmasi dulu
    if (!confirm(`Apakah Anda yakin ingin menghapus ${type} dengan ID: ${idData}?`)) {
        return;
    }

    // Tentukan endpoint berdasarkan tipe
    const url = type === 'Kata'
        ? `/kontributor/validasi/kata`
        : `/kontributor/validasi/kalimat`;

    try {
        // Kirim request DELETE ke server
        const response = await fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ id: idData })
        });

        const result = await response.json();

        if (response.ok && result.success) {
            // Hapus dari data array lokal
            kontribusiData = kontribusiData.filter(item => item.idData !== idData);

            // Render ulang tabel
            renderTable();

            // Notifikasi berhasil
            showNotification(`✅ ${result.message}`, 'success');
        } else {
            console.error(result.error || 'Unknown error');
            showNotification(result.message || '❌ Gagal menghapus item.', 'error');
        }

    } catch (error) {
        console.error('Fetch error:', error);
        showNotification('❌ Terjadi kesalahan jaringan saat menghapus item.', 'error');
    }
}

        // Event listener untuk filter
        function filterTable() {
            currentPage = 1; // Reset ke halaman pertama saat filter
            renderTable();
        }

        // Event listener untuk search
        function searchTable() {
            currentPage = 1; // Reset ke halaman pertama saat mencari
            renderTable();
        }

        // Event listener untuk update rows per page
        function updateRowsPerPage() {
            rowsPerPage = parseInt(this.value);
            currentPage = 1; // Reset ke halaman pertama
            renderTable();
        }

        // Tambahkan animasi CSS untuk notifikasi
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        // Inisialisasi halaman saat DOM siap
        document.addEventListener('DOMContentLoaded', initializePage);
    </script>
</body>
</html>