<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Kalimat</title>
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
            max-width: 700px;
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
        
        .horizontal-details {
            display: flex;
            gap: 15px;
            margin-bottom: 18px;
        }
        
        .horizontal-item {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .horizontal-label {
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 0.9rem;
            color: #555;
        }
        
        .horizontal-value {
            padding: 10px 12px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            color: #333;
            min-height: 42px;
            display: flex;
            align-items: center;
        }
        
        .status-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            background-color: #f8f9fa;
            font-size: 0.95rem;
            color: #333;
            cursor: pointer;
            transition: border-color 0.3s;
            min-height: 42px;
        }
        
        .status-select:focus {
            outline: none;
            border-color: #508ba0;
            box-shadow: 0 0 0 2px rgba(80, 139, 160, 0.2);
        }
        
        .status-select.menunggu {
            background-color: #f8f9fa;
            border-color: #e0e0e0;
            color: #333;
        }
        
        .status-select.disetujui {
            background-color: #f8f9fa;
            border-color: #e0e0e0;
            color: #333;
        }
        
        .status-select.ditolak {
            background-color: #f8f9fa;
            border-color: #e0e0e0;
            color: #333;
        }
        
        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
            justify-content: flex-end;
        }

        .input-modal-overlay {
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
        
        .input-modal-overlay.show {
            display: flex;
        }

        .input-modal-content {
            background-color: #ffffff;
            margin: auto;
            border: none;
            width: 80%;
            max-width: 700px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
            border-radius: 8px;
            overflow: hidden;
        }

        .input-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #508ba0;
            color: white;
            font-weight: bold;
        }

        .input-modal-body {
            padding: 25px;
            background-color: #ffffff;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            color: #333;
            transition: border-color 0.3s;
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: #508ba0;
            box-shadow: 0 0 0 2px rgba(80, 139, 160, 0.2);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
            justify-content: flex-end;
        }

        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-submit:hover {
            background-color: #45a049;
            transform: translateY(-1px);
        }

        .btn-cancel {
            background-color: #f44336;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background-color: #d32f2f;
            transform: translateY(-1px);
        }

        .searchable-dropdown {
            position: relative;
            width: 100%;
        }

        .dropdown-header {
            padding: 10px 12px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 42px;
        }

        .dropdown-header.open {
            border-color: #508ba0;
            box-shadow: 0 0 0 2px rgba(80, 139, 160, 0.2);
        }

        .dropdown-header .placeholder {
            color: #888;
        }

        .dropdown-arrow {
            transition: transform 0.3s;
        }

        .dropdown-arrow.open {
            transform: rotate(180deg);
        }

        .dropdown-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: white;
            border: 1px solid #e0e0e0;
            border-top: none;
            border-radius: 0 0 4px 4px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 10;
            display: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .dropdown-options.show {
            display: block;
        }

        .dropdown-search {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        .dropdown-search input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .dropdown-search input:focus {
            outline: none;
            border-color: #508ba0;
        }

        .dropdown-list {
            max-height: 150px;
            overflow-y: auto;
        }

        .dropdown-option {
            padding: 10px 12px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
        }

        .dropdown-option:hover {
            background-color: #f5f5f5;
        }

        .dropdown-option.selected {
            background-color: #e6f7ff;
            color: #508ba0;
        }

        .no-results {
            padding: 10px 12px;
            color: #888;
            text-align: center;
            font-style: italic;
        }

        .hidden {
            display: none !important;
        }

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

        .editable-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            color: #333;
            transition: border-color 0.3s;
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
            background-color: #f8f9fa;
        }

        .editable-textarea:focus {
            outline: none;
            border-color: #508ba0;
            box-shadow: 0 0 0 2px rgba(80, 139, 160, 0.2);
            background-color: white;
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
            }
            
            .search-box {
                max-width: 100%;
            }
            
            .row-filter {
                justify-content: space-between;
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
            }
            
            .modal-actions {
                flex-direction: column;
            }

            .input-modal-content {
                width: 95%;
            }

            .form-actions {
                flex-direction: column;
            }

            .horizontal-details {
                flex-direction: column;
                gap: 10px;
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
        }
    </style>
</head>
<body>
    <div class="container">
        <x-header-admin />
        <div class="main-content">
            <x-sidebar-validator />
            <main class="content-area">
                <div class="page-content active" id="validasi-kalimat">
                    <h1 class="page-title">Validasi Kalimat (Menunggu)</h1>
                    
                    <div class="search-section">
                        <div class="search-box">
                            <span class="search-icon"><i class="fas fa-search"></i></span>
                            <input type="text" class="search-input" id="search-input" placeholder="Cari kalimat, ID, arti, atau sub ID...">
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
                                    <th>ID KALIMAT</th>
                                    <th>SUB ID</th>
                                    <th>KALIMAT</th>
                                    <th>ARTI KALIMAT</th>
                                    <th>STATUS</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="table-body"></tbody>
                        </table>
                    </div>
                    
                    <div class="empty-state" id="empty-state">
                        <i class="fas fa-search"></i>
                        <h3>Tidak ada kalimat yang ditemukan</h3>
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
                <h3>Detail Kalimat</h3>
                <button class="close-btn">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-item">
                    <span class="detail-label">ID Kalimat</span>
                    <div class="detail-value" id="modal-id">-</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Sub ID</span>
                    <div class="searchable-dropdown" id="subid-dropdown">
                        <div class="dropdown-header">
                            <span class="selected-text placeholder">Pilih Sub ID</span>
                            <span class="dropdown-arrow"><i class="fas fa-chevron-down"></i></span>
                        </div>
                        <div class="dropdown-options">
                            <div class="dropdown-search">
                                <input type="text" placeholder="Cari Sub ID atau Kalimat...">
                            </div>
                            <div class="dropdown-list">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Kalimat</span>
                    <textarea class="editable-textarea" id="modal-kalimat-textarea">-</textarea>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Arti Kalimat</span>
                    <textarea class="editable-textarea" id="modal-arti-textarea">-</textarea>
                </div>
                
                <div class="horizontal-details">
                    <div class="horizontal-item">
                        <span class="horizontal-label">Tanggal Input</span>
                        <div class="horizontal-value" id="modal-tanggal-input">-</div>
                    </div>
                    <div class="horizontal-item">
                        <span class="horizontal-label">Tanggal Validasi</span>
                        <div class="horizontal-value" id="modal-tanggal-validasi">-</div>
                    </div>
                    <div class="horizontal-item">
                        <span class="horizontal-label">Status</span>
                        <select class="status-select" id="modal-status-select">
                            <option value="menunggu">Menunggu</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                </div>
                
                <div class="modal-actions">
                    <button class="action-btn btn-cancel" id="modal-batal">Batal</button>
                    <button class="action-btn btn-submit" id="modal-simpan">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="input-modal-overlay" id="input-modal">
        <div class="input-modal-content">
            <div class="input-modal-header">
                <h3>Input Kalimat Baru</h3>
                <button class="close-btn" id="close-input-modal">&times;</button>
            </div>
            <div class="input-modal-body">
                <form id="input-kalimat-form">
                    <div class="form-group">
                        <label class="form-label" for="input-id">ID Kalimat</label>
                        <input type="text" class="form-input" id="input-id" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="input-subid">Sub ID</label>
                        <input type="text" class="form-input" id="input-subid" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="input-kalimat">Kalimat</label>
                        <textarea class="form-textarea" id="input-kalimat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="input-arti">Arti Kalimat</label>
                        <textarea class="form-textarea" id="input-arti" required></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-cancel" id="cancel-input">Batal</button>
                        <button type="submit" class="btn-submit">Simpan Kalimat</button>
                    </div>
                </form>
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


        function formatTanggal(date) {
            const options = { 
                day: '2-digit', 
                month: '2-digit', 
                year: 'numeric'
            };
            return new Intl.DateTimeFormat('id-ID', options).format(date);
        }

        function generateId() {
            const lastId = kalimatData.length > 0 ? 
                parseInt(kalimatData[kalimatData.length - 1].id.replace('KL', '')) : 0;
            return 'KL' + String(lastId + 1).padStart(5, '0');
        }

        let kalimatData = @json($kalimat);
        
        const searchInput = document.getElementById('search-input');
        const tableBody = document.getElementById('table-body');
        const emptyState = document.getElementById('empty-state');
        const detailModal = document.getElementById('detail-modal');
        const inputModal = document.getElementById('input-modal');
        const closeBtns = document.querySelectorAll('.close-btn');
        const modalId = document.getElementById('modal-id');
        const modalKalimatTextarea = document.getElementById('modal-kalimat-textarea');
        const modalArtiTextarea = document.getElementById('modal-arti-textarea');
        const modalTanggalInput = document.getElementById('modal-tanggal-input');
        const modalTanggalValidasi = document.getElementById('modal-tanggal-validasi');
        const modalStatusSelect = document.getElementById('modal-status-select');
        const modalBatal = document.getElementById('modal-batal');
        const modalSimpan = document.getElementById('modal-simpan');
        const rowsPerPageSelect = document.getElementById('rows-per-page');
        const paginationInfo = document.getElementById('pagination-info');
        const paginationContainer = document.getElementById('pagination');
        const inputKalimatForm = document.getElementById('input-kalimat-form');
        const closeInputModal = document.getElementById('close-input-modal');
        const cancelInput = document.getElementById('cancel-input');
        const inputId = document.getElementById('input-id');
        
        const subidDropdown = document.getElementById('subid-dropdown');
        
        let currentPage = 1;
        let rowsPerPage = parseInt(rowsPerPageSelect.value);
        let filteredData = [...kalimatData];
        let currentKalimatData = null;
        
        function initSearchableDropdown() {
            const header = subidDropdown.querySelector('.dropdown-header');
            const optionsContainer = subidDropdown.querySelector('.dropdown-options');
            const searchInput = subidDropdown.querySelector('.dropdown-search input');
            const optionsList = subidDropdown.querySelector('.dropdown-list');
            const selectedText = subidDropdown.querySelector('.selected-text');
            
            header.addEventListener('click', function(e) {
                e.stopPropagation();
                
                const isOpen = optionsContainer.classList.toggle('show');
                header.classList.toggle('open', isOpen);
                subidDropdown.querySelector('.dropdown-arrow').classList.toggle('open', isOpen);
                
                if (isOpen) {
                    searchInput.focus();
                }
            });
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const options = optionsList.querySelectorAll('.dropdown-option');
                let hasResults = false;
                
                options.forEach(option => {
                    const text = option.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        option.style.display = 'block';
                        hasResults = true;
                    } else {
                        option.style.display = 'none';
                    }
                });
                
                const noResults = optionsList.querySelector('.no-results');
                if (!hasResults) {
                    if (!noResults) {
                        const noResultsMsg = document.createElement('div');
                        noResultsMsg.className = 'no-results';
                        noResultsMsg.textContent = 'Tidak ada hasil yang ditemukan';
                        optionsList.appendChild(noResultsMsg);
                    }
                } else if (noResults) {
                    noResults.remove();
                }
            });
            
            optionsList.addEventListener('click', function(e) {
                if (e.target.classList.contains('dropdown-option')) {
                    const selectedValue = e.target.getAttribute('data-value');
                    const selectedTextContent = e.target.textContent;
                    
                    if (currentKalimatData) {
                        const subId = selectedValue;
                        currentKalimatData.subId = subId;
                        
                        const selectedKalimat = kalimatData.find(item => item.subId === subId);
                        if (selectedKalimat) {
                            currentKalimatData.kalimat = selectedKalimat.kalimat;
                            currentKalimatData.arti = selectedKalimat.arti;
                            modalKalimatTextarea.value = selectedKalimat.konten;
                            modalArtiTextarea.value = selectedKalimat.arti;
                        }
                    }
                    
                    selectedText.textContent = selectedTextContent;
                    selectedText.classList.remove('placeholder');
                    
                    optionsContainer.classList.remove('show');
                    header.classList.remove('open');
                    subidDropdown.querySelector('.dropdown-arrow').classList.remove('open');
                }
            });
            
            document.addEventListener('click', function() {
                optionsContainer.classList.remove('show');
                header.classList.remove('open');
                subidDropdown.querySelector('.dropdown-arrow').classList.remove('open');
            });
        }
        
        function populateSubIdOptions() {
            const subIdOptions = [];
            const seenSubIds = new Set();
            
            kalimatData.forEach(item => {
                if (!seenSubIds.has(item.subId)) {
                    seenSubIds.add(item.subId);
                    subIdOptions.push({
                        subId: item.subId,
                        kalimat: item.konten
                    });
                }
            });
            
            const subIdList = subidDropdown.querySelector('.dropdown-list');
            subIdList.innerHTML = '';
            
            subIdOptions.forEach(option => {
                const optionElement = document.createElement('div');
                optionElement.className = 'dropdown-option';
                optionElement.setAttribute('data-value', option.subId);

                optionElement.textContent = `${option.subId} - ${option.kalimat}`;
                subIdList.appendChild(optionElement);
            });
        }
        
        function setupInputModal() {
            inputId.value = generateId();
        }
        
        function tambahKalimatBaru(formData) {
            const newKalimat = {
                id: formData.id,
                subId: formData.subId,
                kalimat: formData.kalimat,
                arti: formData.arti,
                status: 'menunggu',
                tanggalInput: new Date(),
                tanggalValidasi: null
            };
            
            kalimatData.push(newKalimat);
            filteredData = [...kalimatData];
            currentPage = 1;
            renderTable();
            
            populateSubIdOptions();
            
            alert(`Kalimat "${newKalimat.kalimat}" berhasil ditambahkan!`);
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
                console.log(currentData);
                currentData.forEach(item => {
                    const row = document.createElement('tr');
                    
                    let statusClass = 'status-menunggu';
                    let statusText = 'MENUNGGU';
                    
                    if (item.status.toLowerCase() === 'disetujui') {
                        statusClass = 'status-disetujui';
                        statusText = 'DISETUJUI';
                    } else if (item.status.toLowerCase() === 'ditolak') {
                        statusClass = 'status-ditolak';
                        statusText = 'DITOLAK';
                    }
                    // let subIdBaru = 'KL' + item.subId.substring(1);
                    
                    row.innerHTML = `
                        <td>${item.id}</td>
                        <td>${item.subId}</td>
                        <td>${item.konten}</td>
                        <td>${item.arti}</td>
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
            
            document.querySelectorAll('#table-body .btn-detail').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const id = this.getAttribute('data-id');
                    showDetailModal(id);
                });
            });
            
            document.querySelectorAll('#table-body .btn-setuju, #table-body .btn-tolak').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const id = this.getAttribute('data-id');
                    const action = this.classList.contains('btn-setuju') ? 'setuju' : 'tolak';
                    
                    updateKalimatStatus(id, action);
                });
            });
            
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
        
        function updateKalimatStatus(id, status) {
    const index = kalimatData.findIndex(item => item.id === id);
    
    if (index === -1) {
        alert('Data Kalimat tidak ditemukan di daftar.');
        return;
    }

    const statusBaru = status === 'setuju' ? 'disetujui' : 'ditolak';
    const statusSebelumnya = kalimatData[index].status;

    fetch('/validator/validasi/update-status', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            id_kata: null,
            id_kalimat: id,
            status: statusBaru
        })
    })
  
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            // Update status di data lokal
            kalimatData[index].status = statusBaru;

            // Tambahkan tanggal validasi kalau status berubah
            if (statusSebelumnya !== statusBaru) {
                kalimatData[index].tanggalValidasi = getHariIni();
            }

            renderTable();
            alert(`Status kalimat "${kalimatData[index].konten}" berhasil diubah menjadi ${statusBaru.toUpperCase()}`);
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
        
        function updateStatusFromSelect(id, newStatus) {
            const index = kalimatData.findIndex(item => item.id === id);
            
            if (index !== -1) {
                const oldStatus = kalimatData[index].status;
                kalimatData[index].status = newStatus;
                
                if (oldStatus === 'menunggu' && (newStatus === 'disetujui' || newStatus === 'ditolak')) {
                    kalimatData[index].tanggalValidasi = new Date();
                }
                else if ((oldStatus === 'disetujui' || oldStatus === 'ditolak') && newStatus === 'menunggu') {
                    kalimatData[index].tanggalValidasi = null;
                }
                
                const filteredIndex = filteredData.findIndex(item => item.id === id);
                if (filteredIndex !== -1) {
                    filteredData[filteredIndex].status = kalimatData[index].status;
                    filteredData[filteredIndex].tanggalValidasi = kalimatData[index].tanggalValidasi;
                }
                
                if (kalimatData[index].status !== 'menunggu') {
                    filteredData = filteredData.filter(item => item.id !== id);
                }
                
                renderTable();
                alert(`Status kalimat "${kalimatData[index].konten}" berhasil diubah menjadi ${newStatus.toUpperCase()}`);
            }
        }
        const availableSubIds = @json($availableSubIds);
        function showDetailModal(id) {
            const kalimat = kalimatData.find(item => item.id === id);
            
            if (kalimat) {
                currentKalimatData = kalimat;
                
                modalId.textContent = kalimat.id;
                
                const subIdSelected = subidDropdown.querySelector('.selected-text');
                subIdSelected.textContent = `${kalimat.subId}`;
                subIdSelected.classList.remove('placeholder');
                
                modalKalimatTextarea.value = kalimat.konten;
                modalArtiTextarea.value = kalimat.arti;
                
                modalTanggalInput.textContent = formatTanggal(kalimat.tanggalInput);
                
                if (kalimat.tanggalValidasi) {
                    modalTanggalValidasi.textContent = formatTanggal(kalimat.tanggalValidasi);
                } else {
                    modalTanggalValidasi.textContent = 'Belum divalidasi';
                }
                
                modalStatusSelect.value = kalimat.status.toLowerCase();
                
                updateStatusSelectStyle();
                
                detailModal.classList.add('show');
            }
        }
        
        function updateStatusSelectStyle() {
            modalStatusSelect.classList.remove('menunggu', 'disetujui', 'ditolak');
            modalStatusSelect.style.backgroundColor = '#f8f9fa';
            modalStatusSelect.style.borderColor = '#e0e0e0';
            modalStatusSelect.style.color = '#333';
        }
        
        function hideDetailModal() {
            detailModal.classList.remove('show');
        }
        
        function showInputModal() {
            setupInputModal();
            inputModal.classList.add('show');
        }
        
        function hideInputModal() {
            inputModal.classList.remove('show');
            inputKalimatForm.reset();
        }
        
        function searchKalimat() {
            const searchTerm = searchInput.value.toLowerCase();
            
            if (searchTerm === '') {
                filteredData = [...kalimatData];
            } else {
                filteredData = kalimatData.filter(item => 
                    item.konten.toLowerCase().includes(searchTerm) ||
                    item.id.toLowerCase().includes(searchTerm) ||
                    item.subId.toLowerCase().includes(searchTerm) ||
                    item.arti.toLowerCase().includes(searchTerm)
                );
            }
            
            currentPage = 1;
            renderTable();
        }
        
        searchInput.addEventListener('input', searchKalimat);
        
        closeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                hideDetailModal();
                hideInputModal();
            });
        });
        
        detailModal.addEventListener('click', function(e) {
            if (e.target === this) {
                hideDetailModal();
            }
        });
        
        inputModal.addEventListener('click', function(e) {
            if (e.target === this) {
                hideInputModal();
            }
        });
        
        modalBatal.addEventListener('click', function() {
            hideDetailModal();
        });
        
        modalSimpan.addEventListener('click', function() {
    console.log(currentKalimatData);

    if (!currentKalimatData) {
        alert('Data kalimat tidak ditemukan!');
        return;
    }

    // Ambil data terbaru dari modal
    currentKalimatData.kalimat = modalKalimatTextarea.value;
    currentKalimatData.arti = modalArtiTextarea.value;

    const newStatus = modalStatusSelect.value;
    console.log(newStatus);

    // Update status di tampilan
    updateStatusFromSelect(currentKalimatData.id, newStatus);

    // Kirim data ke server
    fetch(`/validator/validasi/kalimat`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({
            kalimat_id: currentKalimatData.id,
            sub_id: currentKalimatData.subId,
            kalimat: currentKalimatData.kalimat,
            arti: currentKalimatData.arti,
            status: newStatus.toLowerCase(),
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('✅ Update kalimat sukses:', data);
        alert(`Perubahan untuk kalimat "${currentKalimatData.kalimat}" berhasil disimpan!`);
        // Tutup modal
        hideDetailModal();
    })
    .catch(error => {
        console.error('❌ Error update kalimat:', error);
        alert('Terjadi kesalahan saat memperbarui kalimat!');
    });
});

        
        modalStatusSelect.addEventListener('change', function() {
            updateStatusSelectStyle();
        });
        
        rowsPerPageSelect.addEventListener('change', function() {
            rowsPerPage = parseInt(this.value);
            currentPage = 1;
            renderTable();
        });
        
        inputKalimatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                id: document.getElementById('input-id').value,
                subId: document.getElementById('input-subid').value,
                kalimat: document.getElementById('input-kalimat').value,
                arti: document.getElementById('input-arti').value
            };
            
            tambahKalimatBaru(formData);
            hideInputModal();
        });
        
        cancelInput.addEventListener('click', function() {
            hideInputModal();
        });
        
        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi data dan tampilan
            filteredData = [...kalimatData];
            initSearchableDropdown();
            populateSubIdOptions();
            renderTable();
        });
    </script>
</body>
</html>