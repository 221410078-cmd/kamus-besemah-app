<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Validasi Kata</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
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
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .main-content {
            display: flex;
            flex-grow: 1;
            overflow: hidden;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #508ba0;
            border-bottom: 1px solid #ccc;
            color: #ffffff;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .user-title {
            font-size: 0.9rem;
            color: #f8f6f6;
        }

        .logout-btn {
            padding: 8px 15px;
            border: 1px solid #999;
            background-color: #f0f0f0;
            color: #333;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background-color: #ddd;
        }

        .sidebar {
            width: 185px;
            background-color: #508ba0;
            border-right: 1px solid #B0B0B0;
            flex-shrink: 0;
            overflow-y: auto;
            color: #ffffff;
        }

        .sidebar ul {
            list-style: none;
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
            color: #4a5568;
        }
        
        .sidebar li.active .menu-icon {
            color: #ffffff;
        }
        
        .content-area {
            flex-grow: 1;
            padding: 20px;
            background-color: #F5F5F5;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            color: #333;
        }

        /* ========================================================== */
        /* == STYLES UNTUK VALIDASI KATA ============================ */
        /* ========================================================== */
        .page-title {
            margin-bottom: 20px;
            font-size: 1.6rem;
            color: #2c3e50;
            border-bottom: 2px solid #508ba0;
            padding-bottom: 10px;
        }

        .search-section {
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
        }
        
        .search-box {
            position: relative;
            max-width: 400px;
            flex-grow: 1;
        }
        
        .search-input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            color: #333;
            transition: border-color 0.3s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #508ba0;
            box-shadow: 0 0 0 2px rgba(80, 139, 160, 0.2);
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }
        
        .filter-group {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-item label {
            font-weight: 600;
            color: #333;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .filter-select {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: white;
            font-size: 0.9rem;
            cursor: pointer;
            color: #333;
            transition: border-color 0.3s;
            min-width: 150px;
        }

        .filter-select:focus {
            outline: none;
            border-color: #508ba0;
        }

        .row-filter {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #333;
        }

        .row-filter select {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: white;
            font-size: 0.9rem;
            cursor: pointer;
            color: #333;
            transition: border-color 0.3s;
        }

        .row-filter select:focus {
            outline: none;
            border-color: #508ba0;
        }

        .table-container {
            overflow-x: auto;
            flex-grow: 1;
            width: 100%;
            overflow-y: auto;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            background-color: white;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th, .data-table td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            font-size: 0.95rem;
        }

        .data-table th {
             background-color: #508ba0;
             color: #fff;
             font-weight: 600;
             position: sticky;
             top: 0;
        }

        .data-table td {
            color: #333;
        }

        .data-table tr:hover {
            background-color: #f5f7fa;
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.8rem;
            text-align: center;
            display: inline-block;
            min-width: 100px;
        }
        
        .status-menunggu {
            background-color: #FFFDE7;
            color: #FFC107;
            border: 1px solid #FFC107;
        }
        
        .status-disetujui {
            background-color: #E6FFE6;
            color: #4CAF50;
            border: 1px solid #4CAF50;
        }
        
        .status-ditolak {
            background-color: #FFEDED;
            color: #e74c3c;
            border: 1px solid #F44336;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            padding: 8px 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-setuju {
            background-color: #4CAF50;
            color: white;
        }
        
        .btn-setuju:hover {
            background-color: #45a049;
            transform: translateY(-1px);
        }
        
        .btn-tolak {
            background-color: #f44336;
            color: white;
        }
        
        .btn-tolak:hover {
            background-color: #d32f2f;
            transform: translateY(-1px);
        }
        
        .btn-detail {
            background-color: #2196F3;
            color: white;
        }
        
        .btn-detail:hover {
            background-color: #1976D2;
            transform: translateY(-1px);
        }
        
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            display: none;
            color: #666;
        }
        
        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #bbb;
        }
        
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            padding: 20px 0;
            border-top: 1px solid #e0e0e0;
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-info {
            font-size: 0.9rem;
            color: #666;
        }

        .pagination {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .pagination-btn {
            padding: 8px 12px;
            border: 1px solid #ddd;
            background-color: white;
            color: #333;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.2s;
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
            background-color: #508ba0;
            color: white;
            border-color: #508ba0;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 1000; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }
        
        .modal-overlay.show {
            display: flex;
        }

        .modal-content {
            background-color: #ffffff;
            margin: auto;
            border: none;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
            border-radius: 8px;
            overflow: hidden;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #508ba0;
            color: white;
            font-weight: bold;
        }

        .close-btn {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            padding: 5px;
            line-height: 1;
            transition: color 0.3s;
            background: none;
            border: none;
        }

        .close-btn:hover {
            color: #e0e0e0;
        }
        
        .modal-body {
            padding: 25px;
            background-color: #ffffff;
            color: #333;
            max-height: 80vh;
            overflow-y: auto;
        }
        
        .detail-item {
            margin-bottom: 18px;
            display: flex;
            flex-direction: column;
        }
        
        .detail-label {
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 0.95rem;
            color: #555;
        }
        
        .detail-value {
            padding: 10px 12px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            color: #333;
        }
        
        .detail-input {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: white;
            font-size: 0.9rem;
            color: #333;
            transition: border-color 0.3s;
            width: 100%;
        }

        .detail-input:focus {
            outline: none;
            border-color: #508ba0;
            box-shadow: 0 0 0 2px rgba(80, 139, 160, 0.2);
        }

        .detail-select {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: white;
            font-size: 0.9rem;
            cursor: pointer;
            color: #333;
            transition: border-color 0.3s;
            width: 100%;
        }

        .detail-select:focus {
            outline: none;
            border-color: #508ba0;
            box-shadow: 0 0 0 2px rgba(80, 139, 160, 0.2);
        }

        /* ========================================================== */
        /* == STYLES UNTUK SEARCHABLE DROPDOWN SUB ID =============== */
        /* ========================================================== */
        .searchable-dropdown {
            position: relative;
            width: 100%;
        }

        .dropdown-selected {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: white;
            font-size: 0.9rem;
            color: #333;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: border-color 0.3s;
        }

        .dropdown-selected:hover {
            border-color: #508ba0;
        }

        .dropdown-selected:focus {
            outline: none;
            border-color: #508ba0;
            box-shadow: 0 0 0 2px rgba(80, 139, 160, 0.2);
        }

        .dropdown-arrow {
            color: #777;
            transition: transform 0.3s;
        }

        .dropdown-arrow.rotate {
            transform: rotate(180deg);
        }

        .dropdown-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 6px 6px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 100;
            display: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .dropdown-options.show {
            display: block;
        }

        .dropdown-search {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
            background-color: #f8f9fa;
        }

        .dropdown-search-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
            color: #333;
        }

        .dropdown-search-input:focus {
            outline: none;
            border-color: #508ba0;
        }

        .dropdown-option {
            padding: 10px 12px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s;
        }

        .dropdown-option:hover {
            background-color: #f5f5f5;
        }

        .dropdown-option:last-child {
            border-bottom: none;
        }

        .dropdown-option.active {
            background-color: #508ba0;
            color: white;
        }

        .no-options {
            padding: 10px 12px;
            color: #999;
            text-align: center;
            font-style: italic;
        }

        /* ========================================================== */
        /* == STYLES UNTUK ID DAN SUB ID SAMPING-SAMPINGAN ========== */
        /* ========================================================== */
        .id-container {
            display: flex;
            gap: 15px;
            margin-bottom: 18px;
        }

        .id-item {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .id-label {
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 0.95rem;
            color: #555;
        }

        /* ========================================================== */
        /* == STYLES UNTUK JENIS DAN STATUS SAMPING-SAMPINGAN ======= */
        /* ========================================================== */
        .jenis-status-container {
            display: flex;
            gap: 15px;
            margin-bottom: 18px;
        }

        .jenis-status-item {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .jenis-status-label {
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 0.95rem;
            color: #555;
        }

        /* ========================================================== */
        /* == STYLES UNTUK TANGGAL SAMPING-SAMPINGAN ================ */
        /* ========================================================== */
        .tanggal-container {
            display: flex;
            gap: 15px;
            margin-bottom: 18px;
        }

        .tanggal-item {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .tanggal-label {
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 0.95rem;
            color: #555;
        }

        .tanggal-value {
            padding: 10px 12px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            color: #333;
            min-height: 42px;
            display: flex;
            align-items: center;
        }

        .date-info {
            font-size: 0.85rem;
            color: #666;
            margin-top: 5px;
            font-style: italic;
        }
        
        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
            justify-content: flex-end;
        }
        
        /* ========================================================== */
        /* == UTILITY: CSS UNTUK MENYEMBUNYIKAN/MENAMPILKAN ========== */
        /* ========================================================== */
        .hidden {
            display: none !important;
        }

        /* ========================================================== */
        /* == STYLES UNTUK VALIDATION MESSAGE ======================= */
        /* ========================================================== */
        .validation-message {
            display: block;
            margin-top: 5px;
            font-size: 0.85rem;
            padding: 5px 8px;
            border-radius: 3px;
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
        }

        .validation-message.error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .validation-message.success {
            background-color: #d1edff;
            border-color: #b3d9ff;
            color: #155724;
        }

        /* ========================================================== */
        /* == STYLES UNTUK HALAMAN KOSONG =========================== */
        /* ========================================================== */
        .empty-page {
            text-align: center;
            padding: 50px;
            color: #666;
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .empty-page i {
            font-size: 48px;
            margin-bottom: 20px;
            color: #508ba0;
        }

        .empty-page h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .empty-page p {
            color: #666;
            line-height: 1.5;
        }

        /* ========================================================== */
        /* == LOADING SPINNER ======================================= */
        /* ========================================================== */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            font-size: 18px;
            color: #508ba0;
        }

        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #508ba0;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ========================================================== */
        /* == IFRAME STYLES ========================================= */
        /* ========================================================== */
        .iframe-container {
            width: 100%;
            height: 100%;
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
            position: relative;
        }
        
        .content-frame {
            width: 100%;
            height: 100%;
            border: none;
        }

        .iframe-loading {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 10;
        }

        .iframe-error {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: white;
            z-index: 10;
            padding: 20px;
            text-align: center;
        }

        .iframe-error i {
            font-size: 48px;
            color: #f44336;
            margin-bottom: 15px;
        }

        .iframe-error h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .iframe-error p {
            color: #666;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                height: 100vh;
                border-radius: 0;
            }
            
            .main-content {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                max-height: 80px;
                overflow-x: auto;
                border-right: none;
                border-bottom: 1px solid #B0B0B0;
            }
            
            .sidebar ul {
                display: flex;
            }
            
            .sidebar li {
                border-bottom: none;
                border-right: 1px solid #C0C0C0;
                flex: 1;
                text-align: center;
            }
            
            .sidebar a {
                justify-content: center;
                padding: 10px 5px;
                flex-direction: column;
            }
            
            .sidebar .menu-icon {
                margin-right: 0;
                margin-bottom: 5px;
                font-size: 1.2rem;
            }
            
            .sidebar li.active {
                border-left: none;
                border-bottom: 3px solid #4CAF50;
            }
            
            .content-area {
                padding: 15px;
            }
            
            .data-table th, .data-table td {
                padding: 10px 12px;
                font-size: 0.85rem;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
            
            .action-btn {
                padding: 6px 10px;
                font-size: 0.8rem;
            }
            
            .search-section {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }
            
            .search-box {
                max-width: 100%;
            }
            
            .filter-group {
                width: 100%;
                justify-content: space-between;
            }
            
            .filter-item {
                flex: 1;
                min-width: 120px;
            }
            
            .filter-select {
                min-width: 100px;
                width: 100%;
            }
            
            .row-filter {
                justify-content: space-between;
                width: 100%;
            }
            
            .pagination-container {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
            
            .pagination {
                order: -1;
            }
            
            .modal-content {
                width: 95%;
                max-width: 95%;
            }
            
            .modal-actions {
                flex-direction: column;
            }

            .user-info {
                gap: 10px;
            }
            
            .user-name {
                font-size: 1rem;
            }
            
            .user-title {
                font-size: 0.8rem;
            }

            .id-container,
            .jenis-status-container,
            .tanggal-container {
                flex-direction: column;
                gap: 10px;
            }

            .dropdown-options {
                max-height: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <x-header-admin />
        <div class="main-content">
            <x-sidebar-validator />
            <main class="content-area">
                <!-- Halaman Validasi Kata -->
                <div class="page-content active" id="validasi-kata">
                    <h1 class="page-title">Validasi Kata (Menunggu)</h1>
                    
                    <div class="search-section">
                        <div class="search-box">
                            <span class="search-icon"><i class="fas fa-search"></i></span>
                            <input type="text" class="search-input" id="search-input" placeholder="Cari kata, ID, arti, atau cara baca...">
                        </div>
                        
                        <div class="filter-group">
                            <div class="filter-item">
                                <label for="jenis-filter">Jenis:</label>
                                <select id="jenis-filter" class="filter-select">
                                    <option value="semua">Semua Jenis</option>
                                    <option value="Nomina">Nomina</option>
                                    <option value="Verba">Verba</option>
                                    <option value="Adjektiva">Adjektiva</option>
                                    <option value="Adverbia">Adverbia</option>
                                    <option value="Pronomina">Pronomina</option>
                                </select>
                            </div>
                            
                            <div class="filter-item">
                                <label for="status-filter">Status:</label>
                                <select id="status-filter" class="filter-select">
                                    <option value="semua">Semua Status</option>
                                    <option value="menunggu">Menunggu</option>
                                    <option value="disetujui">Disetujui</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row-filter">
                            <label for="rows-per-page">Tampilkan:</label>
                            <select id="rows-per-page">
                                <option value="5">5 baris</option>
                                <option value="10">10 baris</option>
                                <option value="25" selected>25 baris</option>
                                <option value="50">50 baris</option>
                                <option value="100">100 baris</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="table-container">
                        <table class="data-table" id="data-table">
                            <thead>
                                <tr>
                                    <th>ID KATA</th>
                                    <th>SUB ID</th>
                                    <th>KATA</th>
                                    <th>CARA BACA</th>
                                    <th>ARTI</th>
                                    <th>JENIS</th>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="table-body"></tbody>
                        </table>
                    </div>
                    
                    <div class="empty-state" id="empty-state">
                        <i class="fas fa-search"></i>
                        <h3>Tidak ada kata yang ditemukan</h3>
                        <p>Coba ubah kata kunci pencarian atau filter</p>
                    </div>

                    <div class="pagination-container">
                        <div class="pagination-info" id="pagination-info">Menampilkan 0-0 dari 0 data</div>
                        <div class="pagination" id="pagination"></div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="modal-overlay" id="detail-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Detail Kata</h3>
                <button class="close-btn">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Container untuk ID Kata dan Sub ID samping-sampingan -->
                <div class="id-container">
                    <div class="id-item">
                        <span class="id-label">ID Kata</span>
                        <div class="detail-value" id="modal-id">-</div>
                    </div>
                    <div class="id-item">
                        <span class="id-label">Sub ID</span>
                        <div class="searchable-dropdown" id="subid-dropdown">
                            <div class="dropdown-selected" id="subid-selected">
                                <span id="subid-value">Pilih Sub ID...</span>
                                <span class="dropdown-arrow">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </div>
                            <div class="dropdown-options" id="subid-options">
                                <div class="dropdown-search">
                                    <input type="text" class="dropdown-search-input" id="subid-search" placeholder="Cari Sub ID...">
                                </div>
                                <div id="subid-options-list">
                                    <!-- Options akan diisi oleh JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Kata</span>
                    <input type="text" class="detail-input" id="modal-kata" placeholder="Masukkan kata...">
                </div>
                <div class="detail-item">
                    <span class="detail-label">Cara Baca</span>
                    <input type="text" class="detail-input" id="modal-cara-baca" placeholder="Masukkan cara baca...">
                </div>
                <div class="detail-item">
                    <span class="detail-label">Arti</span>
                    <input type="text" class="detail-input" id="modal-arti" placeholder="Masukkan arti...">
                </div>
                
                <!-- Container untuk jenis dan status samping-sampingan -->
                <div class="jenis-status-container">
                    <div class="jenis-status-item">
                        <span class="jenis-status-label">Jenis</span>
                        <select class="detail-select" id="modal-jenis-select">
                            <option value="Nomina">Kata Benda</option>
                            <option value="Verba">Kata Kerja</option>
                            <option value="Adjektiva">Kata Sifat</option>
                            <option value="Adverbia">Kata Keterangan</option>
                            <option value="Pronomina">Kata Ganti</option>
                        </select>
                    </div>
                    <div class="jenis-status-item">
                        <span class="jenis-status-label">Status</span>
                        <select class="detail-select" id="modal-status-select">
                            <option value="menunggu">Menunggu</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="disetujui">Disetujui</option>
                        </select>
                    </div>
                </div>
                
                <!-- Container untuk tanggal input dan validasi samping-sampingan -->
                <div class="tanggal-container">
                    <div class="tanggal-item">
                        <span class="tanggal-label">Tanggal Input</span>
                        <div class="tanggal-value" id="modal-tanggal-input">-</div>
                        <div class="date-info">Diisi otomatis saat kata ditambahkan</div>
                    </div>
                    <div class="tanggal-item">
                        <span class="tanggal-label">Tanggal Validasi</span>
                        <div class="tanggal-value" id="modal-tanggal-validasi">-</div>
                        <div class="date-info">Diisi otomatis saat status diubah</div>
                    </div>
                </div>
                
                <div class="modal-actions">
                    <button class="action-btn btn-setuju" id="modal-setuju">Simpan Perubahan</button>
                    <button class="action-btn btn-tolak" id="modal-tutup">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mendapatkan tanggal hari ini dalam format YYYY-MM-DD
        function getHariIni() {
            const sekarang = new Date();
            const tahun = sekarang.getFullYear();
            const bulan = String(sekarang.getMonth() + 1).padStart(2, '0');
            const hari = String(sekarang.getDate()).padStart(2, '0');
            return `${tahun}-${bulan}-${hari}`;
        }

        // Fungsi untuk memformat tanggal dari format YYYY-MM-DD ke DD/MM/YYYY
        function formatTanggal(tanggal) {
            if (!tanggal) return '-';
            const [tahun, bulan, hari] = tanggal.split('-');
            return `${hari}/${bulan}/${tahun}`;
        }

        // Daftar Sub ID yang tersedia untuk dropdown
        const availableSubIds = @json($availableSubIds);
        const kataData = @json($kataValidator)
        
        const searchInput = document.getElementById('search-input');
        const tableBody = document.getElementById('table-body');
        const emptyState = document.getElementById('empty-state');
        const detailModal = document.getElementById('detail-modal');
        const closeBtns = document.querySelectorAll('.close-btn');
        const modalId = document.getElementById('modal-id');
        const subidSelected = document.getElementById('subid-selected');
        const subidValue = document.getElementById('subid-value');
        const subidOptions = document.getElementById('subid-options');
        const subidSearch = document.getElementById('subid-search');
        const subidOptionsList = document.getElementById('subid-options-list');
        const modalKata = document.getElementById('modal-kata');
        const modalCaraBaca = document.getElementById('modal-cara-baca');
        const modalArti = document.getElementById('modal-arti');
        const modalJenisSelect = document.getElementById('modal-jenis-select');
        const modalStatusSelect = document.getElementById('modal-status-select');
        const modalTanggalInput = document.getElementById('modal-tanggal-input');
        const modalTanggalValidasi = document.getElementById('modal-tanggal-validasi');
        const modalSetuju = document.getElementById('modal-setuju');
        const modalTutup = document.getElementById('modal-tutup');
        const rowsPerPageSelect = document.getElementById('rows-per-page');
        const paginationInfo = document.getElementById('pagination-info');
        const paginationContainer = document.getElementById('pagination');
        const jenisFilter = document.getElementById('jenis-filter');
        const statusFilter = document.getElementById('status-filter');
        
        let currentPage = 1;
        let rowsPerPage = parseInt(rowsPerPageSelect.value);
        let filteredData = [...kataData];
        let currentKataData = null;
        let isDropdownOpen = false;

        // Fungsi untuk memuat opsi Sub ID ke dropdown
        function loadSubIdOptions() {
            subidOptionsList.innerHTML = '';
            
            const searchTerm = subidSearch.value.toLowerCase();
            const filteredSubIds = availableSubIds.filter(subId => 
                subId.toLowerCase().includes(searchTerm)
            );
            
            if (filteredSubIds.length === 0) {
                const noResult = document.createElement('div');
                noResult.className = 'no-options';
                noResult.textContent = 'Tidak ada hasil ditemukan';
                subidOptionsList.appendChild(noResult);
            } else {
                filteredSubIds.forEach(subId => {
                    const option = document.createElement('div');
                    option.className = 'dropdown-option';
                    option.textContent = subId;
                    option.addEventListener('click', () => {
                        selectSubId(subId);
                    });
                    subidOptionsList.appendChild(option);
                });
            }
        }

        // Fungsi untuk memilih Sub ID
        function selectSubId(subId) {
            subidValue.textContent = subId;
            toggleDropdown(false);
            subidSearch.value = '';
            loadSubIdOptions();
        }

        // Fungsi untuk toggle dropdown
        function toggleDropdown(show) {
            isDropdownOpen = show;
            const arrow = subidSelected.querySelector('.dropdown-arrow');
            
            if (show) {
                subidOptions.classList.add('show');
                arrow.classList.add('rotate');
                // Fokus ke input pencarian saat dropdown dibuka
                setTimeout(() => {
                    subidSearch.focus();
                }, 100);
            } else {
                subidOptions.classList.remove('show');
                arrow.classList.remove('rotate');
            }
        }

        // Event listeners untuk dropdown Sub ID
        subidSelected.addEventListener('click', () => {
            toggleDropdown(!isDropdownOpen);
        });

        subidSearch.addEventListener('input', () => {
            loadSubIdOptions();
        });

        subidSearch.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                toggleDropdown(false);
            }
        });

        // Tutup dropdown ketika klik di luar
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.searchable-dropdown')) {
                toggleDropdown(false);
            }
        });

        // Navigasi keyboard untuk dropdown
        document.addEventListener('keydown', (e) => {
            if (!isDropdownOpen) return;
            
            const options = subidOptionsList.querySelectorAll('.dropdown-option');
            if (options.length === 0) return;
            
            const currentActive = subidOptionsList.querySelector('.dropdown-option.active');
            let nextIndex = 0;
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if (currentActive) {
                    const currentIndex = Array.from(options).indexOf(currentActive);
                    nextIndex = (currentIndex + 1) % options.length;
                }
                
                options.forEach(opt => opt.classList.remove('active'));
                options[nextIndex].classList.add('active');
                options[nextIndex].scrollIntoView({ block: 'nearest' });
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                if (currentActive) {
                    const currentIndex = Array.from(options).indexOf(currentActive);
                    nextIndex = (currentIndex - 1 + options.length) % options.length;
                } else {
                    nextIndex = options.length - 1;
                }
                
                options.forEach(opt => opt.classList.remove('active'));
                options[nextIndex].classList.add('active');
                options[nextIndex].scrollIntoView({ block: 'nearest' });
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (currentActive) {
                    selectSubId(currentActive.textContent);
                }
            }
        });
        
        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedJenis = jenisFilter.value;
            const selectedStatus = statusFilter.value;
            
            filteredData = kataData.filter(item => {
                // Filter pencarian
                const searchMatch = 
                    item.konten.toLowerCase().includes(searchTerm) ||
                    item.id.toLowerCase().includes(searchTerm) ||
                    item.subId.toLowerCase().includes(searchTerm) ||
                    item.arti.toLowerCase().includes(searchTerm) ||
                    item.cara_baca.toLowerCase().includes(searchTerm) ||
                    item.jenis.toLowerCase().includes(searchTerm);
                
                // Filter jenis
                const jenisMatch = selectedJenis === 'semua' || item.jenis === selectedJenis;
                
                // Filter status
                const statusMatch = selectedStatus === 'semua' || item.status.toLowerCase() === selectedStatus.toLowerCase();
                return searchMatch && jenisMatch && statusMatch;
            });
            
            currentPage = 1;
            renderTable();
        }
        
        function renderTable() {
            tableBody.innerHTML = '';
            
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;
            const currentData = filteredData.slice(startIndex, endIndex);
            
            if (currentData.length === 0) {
                emptyState.style.display = 'block';
            } else {
                emptyState.style.display = 'none';
                
                currentData.forEach(item => {
                    const row = document.createElement('tr');
                    
                    let statusClass = 'status-menunggu';
                    let statusText = 'MENUNGGU';
                    
                    if (item.status === 'disetujui') {
                        statusClass = 'status-disetujui';
                        statusText = 'DISETUJUI';
                    } else if (item.status === 'ditolak') {
                        statusClass = 'status-ditolak';
                        statusText = 'DITOLAK';
                    }
                    
                    row.innerHTML = `
                        <td>${item.id}</td>
                        <td>${item.subId}</td>
                        <td>${item.konten}</td>
                        <td>${item.cara_baca}</td>
                        <td>${item.arti}</td>
                        <td>${item.jenis}</td>
                        <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn btn-detail" data-id="${item.id}">Detail</button>
                                <button class="action-btn btn-setuju" data-id="${item.id}">Setuju</button>
                                <button class="action-btn btn-tolak" data-id="${item.id}">Tolak</button>
                            </div>
                        </td>
                    `;
                    
                    tableBody.appendChild(row);
                });
            }
            
            updatePaginationInfo();
            renderPagination();
            
            // Event listener untuk tombol detail
            document.querySelectorAll('#table-body .btn-detail').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const id = this.getAttribute('data-id');
                    showDetailModal(id);
                });
            });
            
            // Event listener untuk tombol setuju dan tolak
            document.querySelectorAll('#table-body .btn-setuju, #table-body .btn-tolak').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const id = this.getAttribute('data-id');
                    const action = this.classList.contains('btn-setuju') ? 'setuju' : 'tolak';
                    updateKataStatus(id, action);
                });
            });
            
            // Event listener untuk klik pada baris (untuk membuka detail)
            document.querySelectorAll('#table-body tr').forEach(row => {
                row.addEventListener('click', function(e) {
                    if (!e.target.classList.contains('action-btn')) {
                        const id = this.querySelector('.action-btn').getAttribute('data-id');
                        showDetailModal(id);
                    }
                });
            });
        }
        
        function updatePaginationInfo() {
            const startIndex = (currentPage - 1) * rowsPerPage + 1;
            const endIndex = Math.min(currentPage * rowsPerPage, filteredData.length);
            const total = filteredData.length;
            
            if (total === 0) {
                paginationInfo.textContent = 'Tidak ada data yang ditampilkan';
            } else {
                paginationInfo.textContent = `Menampilkan ${startIndex}-${endIndex} dari ${total} data`;
            }
        }
        
        function renderPagination() {
            paginationContainer.innerHTML = '';
            
            const totalPages = Math.ceil(filteredData.length / rowsPerPage);
            
            if (totalPages <= 1) return;
            
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
            
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
            
            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }
            
            if (startPage > 1) {
                const firstButton = document.createElement('button');
                firstButton.className = 'pagination-btn';
                firstButton.textContent = '1';
                firstButton.addEventListener('click', () => {
                    currentPage = 1;
                    renderTable();
                });
                paginationContainer.appendChild(firstButton);
                
                if (startPage > 2) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'pagination-ellipsis';
                    ellipsis.textContent = '...';
                    paginationContainer.appendChild(ellipsis);
                }
            }
            
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
            
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'pagination-ellipsis';
                    ellipsis.textContent = '...';
                    paginationContainer.appendChild(ellipsis);
                }
                
                const lastButton = document.createElement('button');
                lastButton.className = 'pagination-btn';
                lastButton.textContent = totalPages;
                lastButton.addEventListener('click', () => {
                    currentPage = totalPages;
                    renderTable();
                });
                paginationContainer.appendChild(lastButton);
            }
            
            const nextButton = document.createElement('button');
            nextButton.className = 'pagination-btn';
            nextButton.textContent = '›';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable();
                }
            });
            paginationContainer.appendChild(nextButton);
        }
        
        function updateKataStatus(id, status) {
    const index = kataData.findIndex(item => item.id === id);
    
    if (index === -1) {
        alert('Data kata tidak ditemukan di daftar.');
        return;
    }

    const statusBaru = status === 'setuju' ? 'disetujui' : 'ditolak';
    const statusSebelumnya = kataData[index].status;

    fetch('/validator/validasi/update-status', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            id_kata: id,
            status: statusBaru
        })
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            // Update status di data lokal
            kataData[index].status = statusBaru;

            // Tambahkan tanggal validasi kalau status berubah
            if (statusSebelumnya !== statusBaru) {
                kataData[index].tanggalValidasi = getHariIni();
            }

            // Terapkan ulang filter (jika ada)
            applyFilters();
            console.log(kataData[index]);
            alert(`Status kata "${kataData[index].konten}" berhasil diubah menjadi ${statusBaru.toUpperCase()}`);
        } else {
            alert(`Gagal memperbarui status: ${result.message}`);
            console.error(result);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memperbarui status.');
    });
}

        function showDetailModal(id) {
            const kata = kataData.find(item => item.id === id);
            
            if (kata) {
                currentKataData = kata;
                
                modalId.textContent = kata.id;
                subidValue.textContent = kata.subId;
                modalKata.value = kata.konten;
                modalCaraBaca.value = kata.cara_baca;
                modalArti.value = kata.arti;
                
                // Set nilai dropdown jenis kata
                modalJenisSelect.value = kata.jenis;
                
                // Set nilai dropdown status
                modalStatusSelect.value = kata.status.toLowerCase();
                
                // Set nilai tanggal input (format: DD/MM/YYYY)
                modalTanggalInput.textContent = kata.tanggal;
                
                // Set nilai tanggal validasi (format: DD/MM/YYYY)
                modalTanggalValidasi.textContent = formatTanggal(kata.tanggalValidasi);
                
                // Load opsi Sub ID
                loadSubIdOptions();
                
                // Tutup dropdown jika terbuka
                toggleDropdown(false);
                
                detailModal.classList.add('show');
            }
        }
        
        function hideDetailModal() {
            detailModal.classList.remove('show');
        }
        
        function simpanPerubahan() {
            if (currentKataData) {
                // Validasi input
                if (!modalKata.value.trim()) {
                    alert('Kata tidak boleh kosong!');
                    modalKata.focus();
                    return;
                }
                
                if (!modalCaraBaca.value.trim()) {
                    alert('Cara baca tidak boleh kosong!');
                    modalCaraBaca.focus();
                    return;
                }
                
                if (!modalArti.value.trim()) {
                    alert('Arti tidak boleh kosong!');
                    modalArti.focus();
                    return;
                }
                
                // Update data kata dari form
                const index = kataData.findIndex(item => item.id === currentKataData.id);
                if (index !== -1) {
                    const statusSebelumnya = kataData[index].status;
                    
                    // Update data
                    kataData[index].konten = modalKata.value.trim();
                    kataData[index].cara_baca = modalCaraBaca.value.trim();
                    kataData[index].arti = modalArti.value.trim();
                    kataData[index].jenis = modalJenisSelect.value;
                    kataData[index].status = modalStatusSelect.value;
                    kataData[index].subId = subidValue.textContent;
                    
                    // Jika status berubah menjadi disetujui atau ditolak dan tanggal validasi kosong, set ke hari ini
                    if ((kataData[index].status === 'disetujui' || kataData[index].status === 'ditolak') && 
                        !kataData[index].tanggalValidasi && 
                        statusSebelumnya !== kataData[index].status) {
                        kataData[index].tanggalValidasi = getHariIni();
                    }
                }
                
                // Terapkan ulang filter setelah mengubah data
                // ================== UPDATE KE DATABASE ==================
        const match = subidValue.textContent.trim().match(/^([A-Za-z0-9]+)/);
        const subId = match ? match[1] : '';
        console.log(currentKataData.id);
        fetch(`/validator/validasi/kata`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                kata_id: currentKataData.id,
                sub_id: subidValue.textContent !== 'Pilih Sub ID...' ? subId : currentKataData.subId,
                jenis: modalJenisSelect.value,
                kata: modalKata.value,
                arti: modalArti.value,
                cara_baca: modalCaraBaca.value,
                status: modalStatusSelect.value.toLowerCase(),
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log('Update kata sukses:', data);
                alert(`Perubahan untuk kata "${kataData[index].konten}" berhasil disimpan!`);
                hideDetailModal();
            })
            .catch((error) => {
                console.error('❌ Error update kata:', error);
                alert('Terjadi kesalahan saat memperbarui kata!');
            });
                applyFilters();
                alert(`Perubahan untuk kata "${kataData[index].konten}" berhasil disimpan!`);
                hideDetailModal();
            }
        }
        
        // Event Listeners
        searchInput.addEventListener('input', applyFilters);
        jenisFilter.addEventListener('change', applyFilters);
        statusFilter.addEventListener('change', applyFilters);
        
        closeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                hideDetailModal();
            });
        });
        
        detailModal.addEventListener('click', function(e) {
            if (e.target === this) {
                hideDetailModal();
            }
        });
        
        modalSetuju.addEventListener('click', function() {
            simpanPerubahan();
        });
        
        modalTutup.addEventListener('click', function() {
            hideDetailModal();
        });
        
        rowsPerPageSelect.addEventListener('change', function() {
            rowsPerPage = parseInt(this.value);
            currentPage = 1;
            renderTable();
        });
        
        // Inisialisasi
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi data dan tampilan
            filteredData = [...kataData];
            renderTable();
        });
    </script>
</body>
</html>