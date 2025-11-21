<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kelola Publikasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            color: #ffffff;
        }
        
        .user-info img {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .user-name {
            font-weight: 600;
            font-size: 1.1rem; 
            color: #ffffff;
        }

        .user-title {
            font-weight: 700;
            font-size: 1.2em;
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
        /* == SIDEBAR YANG DIPERBAIKI =============================== */
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
            padding: 0;
            margin: 0;
        }
        
        .sidebar a {
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            transition: all 0.2s;
            width: 100%;
        }
        
        .sidebar li {
            font-size: 0.95rem;
            font-weight: 500;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            color: #ffffff;
        }
        
        .sidebar li.menu-title {
            font-weight: bold;
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.2);
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            cursor: pointer;
        }

        .sidebar li.menu-title.open {
            background-color: rgba(0, 0, 0, 0.3);
        }

        .submenu {
            display: block;
            background-color: rgba(0, 0, 0, 0.1);
        }
        
        .menu-title i {
            transition: transform 0.3s ease;
        }
        
        .menu-title.closed + .submenu {
            display: none;
        }
        
        .menu-title.closed i {
            transform: rotate(-90deg);
        }
        
        .menu-title.open i {
            transform: rotate(0deg);
        }

        /* Perbaikan utama: styling untuk item aktif */
        .sidebar li.menu-item.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: bold;
            border-left: 5px solid #ffffff;
        }
        
        .sidebar li.menu-item.active a {
            padding-left: 15px;
        }
        
        .sidebar li.menu-item:not(.active):hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar li.menu-title a {
            padding: 0;
        }

        .sidebar .menu-icon {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }
        
        /* ========================================================== */
        /* == KONTEN UTAMA (AREA TABEL) ============================= */
        /* ========================================================== */
        .table-area {
            flex-grow: 1;
            padding: 20px;
            background-color: #F5F5F5;
            overflow-y: auto;
            display: none;
        }
        
        .table-area.active {
            display: block;
            animation: fadeIn 0.4s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .content-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .status-header {
            font-size: 1.6em;
            font-weight: 700;
            margin-bottom: 20px;
        }

        /* Kontrol atas tabel (Select, Tombol Aksi) */
        .table-controls {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        /* Container untuk filter dan search */
        .filter-container {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            flex-grow: 1;
        }

        .select-filter {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            min-width: 150px;
        }
        
        /* Styling untuk Search Input */
        .search-input-container {
            position: relative;
            flex-grow: 1;
            min-width: 200px;
            max-width: 300px;
        }
        
        .search-input {
            width: 100%;
            padding: 8px 12px 8px 35px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .search-input-container i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 0.9rem;
        }

        .action-button {
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: background-color 0.3s;
        }

        .publish-massal {
            background-color: #E6FFE6;
            color: #4CAF50;
            border: 1px solid #8BC34A;
        }

        .publish-massal:hover {
            background-color: #D4FFD4;
        }

        .hapus-massal {
            background-color: #FFEDED;
            color: #e74c3c;
            border: 1px solid #F44336;
        }

        .hapus-massal:hover {
            background-color: #FFDADA;
        }
        
        /* Styling Tabel */
        .management-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        .management-table th, .management-table td {
            padding: 10px 15px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 0.9rem;
        }

        .management-table th {
             background-color: #4a6c7c;
             color: #fff;
             padding: 12px 15px;
             font-size: 0.9rem;
        }

        .management-table tr:hover {
            background-color: #f9f9f9;
        }
        
        /* Kolom Cara Baca */
        .cara-baca {
            font-family: monospace;
            font-size: 0.85rem;
            background-color: #eee;
            padding: 3px 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
            white-space: nowrap;
        }
        
        /* Kolom Jenis - DIUBAH: font normal, tidak bold */
        .jenis-kolom {
            font-size: 0.9rem;
            padding: 4px 8px;
            text-align: left;
            font-weight: normal; /* Diubah dari 500 menjadi normal */
        }
        
        /* Kolom Aksi */
        .aksi-kolom {
            width: 120px;
            text-align: center;
            white-space: nowrap;
        }

        .action-icon {
            margin: 0 4px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            transition: all 0.2s;
        }

        .action-icon.edit-icon {
            color: #3498db;
            border-color: #3498db;
        }
        
        .action-icon.edit-icon:hover {
            background-color: #eaf6fc;
        }

        .action-icon.delete-icon {
            color: #e74c3c;
            border-color: #e74c3c;
        }
        
        .action-icon.delete-icon:hover {
            background-color: #fceaea;
        }
        
        /* Label Status */
        .status-chip {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.8rem;
            text-align: center;
            min-width: 80px;
        }
        
        .status-disetujui {
            background-color: #E6FFE6;
            color: #4CAF50;
            border: 1px solid #4CAF50;
        }
        
        .status-menunggu {
            background-color: #FFFDE7;
            color: #FFC107;
            border: 1px solid #FFC107;
        }

        .status-ditolak {
            background-color: #FFEDED;
            color: #e74c3c;
            border: 1px solid #e74c3c;
        }
        
        /* ========================================================== */
        /* == FILTER GROUP ========================================== */
        /* ========================================================== */
        .filter-group {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .dropdown-filter {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .dropdown-filter .search-input {
            width: 150px;
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #ced4da;
            font-size: 0.9em;
            transition: border-color 0.2s;
        }
        
        .dropdown-filter .search-input:focus { 
            border-color: #3498db; 
            outline: none; 
        }

        .dropdown-filter select {
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #ced4da;
            font-size: 0.9em;
            min-width: 150px;
            transition: border-color 0.2s;
        }
        
        .dropdown-filter select:focus { 
            border-color: #3498db; 
            outline: none; 
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
            border-top: 1px solid #ddd;
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
            background-color: #4a6c7c;
            color: white;
            border-color: #4a6c7c;
        }

        .pagination-ellipsis {
            padding: 8px 12px;
            color: #666;
        }
        
        /* ========================================================== */
        /* == ROWS PER PAGE ========================================= */
        /* ========================================================== */
        .row-filter {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .row-filter label {
            font-size: 0.9rem;
            color: #666;
            white-space: nowrap;
        }

        .row-filter select {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            font-size: 0.9rem;
            cursor: pointer;
        }

        /* ========================================================== */
        /* == MODAL DETAIL KATA YANG DIPERBAIKI ===================== */
        /* ========================================================== */
        .modal-overlay {
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
            display: none;
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

        textarea.detail-input {
            resize: vertical;
            min-height: 80px;
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

        /* ========================================================== */
        /* == STYLES UNTUK LAYOUT HORIZONTAL KALIMAT ================ */
        /* ========================================================== */
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
        
        /* ========================================================== */
        /* == STYLES UNTUK STATUS SELECT DI MODAL DETAIL ============ */
        /* ========================================================== */
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

        /* ========================================================== */
        /* == RESPONSIVE ============================================ */
        /* ========================================================== */
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
                display: none; 
            }
            
            .header {
                flex-direction: column;
                gap: 10px;
            }
            
            .modal-content {
                width: 95%;
                max-width: 95%;
            }
            
            .modal-actions {
                flex-direction: column;
            }

            .id-container,
            .jenis-status-container,
            .tanggal-container,
            .horizontal-details {
                flex-direction: column;
                gap: 10px;
            }

            .dropdown-options {
                max-height: 150px;
            }
            
            .filter-group {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .dropdown-filter {
                width: 100%;
                justify-content: space-between;
            }
            
            .dropdown-filter .search-input, .dropdown-filter select {
                min-width: unset;
                width: 60%;
            }
            
            .management-table th, .management-table td {
                font-size: 0.75em;
                padding: 8px 6px;
                white-space: normal;
            }
            
            .aksi-kolom {
                width: 80px;
            }
            
            .filter-container {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-input-container {
                max-width: 100%;
            }
            
            .pagination-container {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
            
            .pagination {
                order: -1;
            }
            
            .management-table th:nth-child(6), 
            .management-table td:nth-child(6) {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <x-header-admin />
    <div class="main-content">
        <x-sidebar-admin />
        
        <!-- Konten Validasi -->
        <div class="table-area active" id="validasi-content">
            <h2 class="status-header">Kelola Publikasi</h2>
            
            <div class="filter-group">
                <div class="dropdown-filter">
                    <i class="fa fa-check-square"></i>
                    <select id="validationFilter">
                        <option value="kata">Validasi Kata</option>
                        <option value="kalimat">Validasi Kalimat</option>
                    </select>
                </div>
                
                <div class="dropdown-filter">
                    <input type="text" placeholder="cari kata" id="searchInput" class="search-input">
                    <i class="fa fa-search"></i>
                </div>
                
                <div class="dropdown-filter">
                    <label for="statusFilter">Status:</label>
                    <select id="statusFilter">
                        <option value="all">Semua Status</option>
                        <option value="Disetujui">Disetujui</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
                
                <!-- Baris per halaman -->
                <div class="row-filter">
                    <label for="rows-per-page">Tampilkan:</label>
                    <select id="rows-per-page">
                        <option value="5">5 baris</option>
                        <option value="10" selected>10 baris</option>
                        <option value="25">25 baris</option>
                        <option value="50">50 baris</option>
                    </select>
                </div>
            </div>
            
            <table class="management-table">
                <thead>
                    <tr id="table-header">
                    </tr>
                </thead>
                <tbody id="publikasi-list">
                </tbody>
            </table>
            
            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination-info" id="pagination-info">Menampilkan 0-0 dari 0 data</div>
                <div class="pagination" id="pagination"></div>
            </div>
        </div>

        <!-- Konten lainnya -->
        <div class="table-area" id="kelola-user-content">
            <h2 class="status-header">Kelola User</h2>
            <div class="no-data">
                <i class="fas fa-users"></i>
                <p>Konten Kelola User akan ditampilkan di sini</p>
            </div>
        </div>
        
        <div class="table-area" id="kelola-kamus-content">
            <h2 class="status-header">Kelola Kamus</h2>
            <div class="no-data">
                <i class="fas fa-book"></i>
                <p>Konten Kelola Kamus akan ditampilkan di sini</p>
            </div>
        </div>
        
        <div class="table-area" id="draft-kata-content">
            <h2 class="status-header">Draft Kata</h2>
            <div class="no-data">
                <i class="fas fa-file-alt"></i>
                <p>Konten Draft Kata akan ditampilkan di sini</p>
            </div>
        </div>

        <div class="table-area" id="draf-kalimat-content">
            <h2 class="status-header">Draf Kalimat</h2>
            <div class="no-data">
                <i class="fas fa-file-alt"></i>
                <p>Konten Draf Kalimat akan ditampilkan di sini</p>
            </div>
        </div>

        <div class="table-area" id="entry-kata-content">
            <h2 class="status-header">Entry Kata</h2>
            <div class="no-data">
                <i class="fas fa-plus-circle"></i>
                <p>Konten Entry Kata akan ditampilkan di sini</p>
            </div>
        </div>

        <div class="table-area" id="entry-kalimat-content">
            <h2 class="status-header">Entry Kalimat</h2>
            <div class="no-data">
                <i class="fas fa-plus-circle"></i>
                <p>Konten Entry Kalimat akan ditampilkan di sini</p>
            </div>
        </div>
        
    </div>
</div>

<!-- Modal Detail Kata yang Diperbaiki -->
<div class="modal-overlay" id="detail-kata-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Detail Kata</h3>
            <button class="close-btn">&times;</button>
        </div>
        @csrf
        @method('PUT')
        <div class="modal-body">
            <!-- Container untuk ID Kata dan Sub ID samping-sampingan -->
            <div class="id-container">
                <div class="id-item">
                    <span class="id-label">ID Kata</span>
                    <div class="detail-value" id="modal-kata-id">-</div>
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
                        <option value="Menunggu">Menunggu</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Disetujui">Disetujui</option>
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

<!-- Modal Detail Kalimat yang Diperbaiki -->
<div class="modal-overlay" id="detail-kalimat-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Detail Kalimat</h3>
            <button class="close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <!-- Container untuk ID Kalimat dan Sub ID samping-sampingan -->
            <div class="horizontal-details">
                <div class="horizontal-item">
                    <span class="horizontal-label">ID Kalimat</span>
                    <div class="horizontal-value" id="modal-kalimat-id">-</div>
                </div>
                <div class="horizontal-item">
                    <span class="horizontal-label">Sub ID</span>
                    <div class="searchable-dropdown" id="subid-dropdown-kalimat">
                        <div class="dropdown-selected" id="subid-selected-kalimat">
                            <span id="subid-value-kalimat">Pilih Sub ID...</span>
                            <span class="dropdown-arrow">
                                <i class="fas fa-chevron-down"></i>
                            </span>
                        </div>
                        <div class="dropdown-options" id="subid-options-kalimat">
                            <div class="dropdown-search">
                                <input type="text" class="dropdown-search-input" id="subid-search-kalimat" placeholder="Cari Sub ID...">
                            </div>
                            <div id="subid-options-list-kalimat">
                                <!-- Options akan diisi oleh JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="detail-item">
                <span class="detail-label">Kalimat</span>
                <textarea class="detail-input" id="modal-kalimat" placeholder="Masukkan kalimat..." rows="3"></textarea>
            </div>
            <div class="detail-item">
                <span class="detail-label">Arti</span>
                <textarea class="detail-input" id="modal-arti-kalimat" placeholder="Masukkan arti..." rows="3"></textarea>
            </div>
            
            <!-- Container untuk tanggal input dan validasi samping-sampingan -->
            <div class="horizontal-details">
                <div class="horizontal-item">
                    <span class="horizontal-label">Tanggal Input</span>
                    <div class="horizontal-value" id="modal-tanggal-input-kalimat">-</div>
                    <div class="date-info">Diisi otomatis saat kalimat ditambahkan</div>
                </div>
                <div class="horizontal-item">
                    <span class="horizontal-label">Tanggal Validasi</span>
                    <div class="horizontal-value" id="modal-tanggal-validasi-kalimat">-</div>
                    <div class="date-info">Diisi otomatis saat status diubah</div>
                </div>
            </div>
            
            <!-- Container untuk status -->
            <div class="detail-item">
                <span class="detail-label">Status</span>
                <select class="status-select" id="modal-status-select-kalimat">
                    <option value="Menunggu">Menunggu</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
            </div>
            
            <div class="modal-actions">
                <button class="action-btn btn-setuju" id="modal-setuju-kalimat">Simpan Perubahan</button>
                <button class="action-btn btn-tolak" id="modal-tutup-kalimat">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    const dataPublikasi = @json($result);

    // Daftar Sub ID yang tersedia untuk dropdown
    const availableSubIds = @json($availableSubIds);

    // Variabel untuk pagination
    let currentPage = 1;
    let rowsPerPage = 10;
    let currentPublikasiItem = null;
    let currentFilteredData = [];

    // ELEMENTS
    const validationFilter = document.getElementById('validationFilter');
    const searchInput = document.getElementById('searchInput');
    const tableHeader = document.getElementById('table-header');
    const publikasiList = document.getElementById('publikasi-list');
    const statusFilter = document.getElementById('statusFilter');
    const detailKataModal = document.getElementById('detail-kata-modal');
    const detailKalimatModal = document.getElementById('detail-kalimat-modal');
    const rowsPerPageSelect = document.getElementById('rows-per-page');
    const paginationInfo = document.getElementById('pagination-info');
    const paginationContainer = document.getElementById('pagination');

    // Modal Detail Kata Elements
    const closeBtns = document.querySelectorAll('.close-btn');
    const modalKataId = document.getElementById('modal-kata-id');
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
    
    // Modal Detail Kalimat Elements
    const modalKalimatId = document.getElementById('modal-kalimat-id');
    const subidSelectedKalimat = document.getElementById('subid-selected-kalimat');
    const subidValueKalimat = document.getElementById('subid-value-kalimat');
    const subidOptionsKalimat = document.getElementById('subid-options-kalimat');
    const subidSearchKalimat = document.getElementById('subid-search-kalimat');
    const subidOptionsListKalimat = document.getElementById('subid-options-list-kalimat');
    const modalKalimat = document.getElementById('modal-kalimat');
    const modalArtiKalimat = document.getElementById('modal-arti-kalimat');
    const modalStatusSelectKalimat = document.getElementById('modal-status-select-kalimat');
    const modalTanggalInputKalimat = document.getElementById('modal-tanggal-input-kalimat');
    const modalTanggalValidasiKalimat = document.getElementById('modal-tanggal-validasi-kalimat');
    const modalSetujuKalimat = document.getElementById('modal-setuju-kalimat');
    const modalTutupKalimat = document.getElementById('modal-tutup-kalimat');
    
    let isDropdownOpen = false;
    let isDropdownOpenKalimat = false;

    // ==========================================================
    // == SIDEBAR NAVIGATION ===================================
    // ==========================================================
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi toggle untuk menu Kelola Kamus
        const kelolaKamusToggle = document.getElementById('kelolaKamusToggle');
        if (kelolaKamusToggle) {
            kelolaKamusToggle.addEventListener('click', function() {
                this.classList.toggle('open');
                this.classList.toggle('closed');
                
                const submenu = this.nextElementSibling;
                if (this.classList.contains('closed')) {
                    submenu.style.display = 'none';
                } else {
                    submenu.style.display = 'block';
                }
            });
        }
        
        // Menangani klik pada item menu
        const menuItems = document.querySelectorAll('.sidebar .menu-item');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                // Hapus kelas active dari semua item
                menuItems.forEach(i => i.classList.remove('active'));
                
                // Tambahkan kelas active ke item yang diklik
                this.classList.add('active');
                
                // Dapatkan target konten
                const targetId = this.querySelector('a').getAttribute('href').replace('.html', '-content');
                
                // Sembunyikan semua konten
                document.querySelectorAll('.table-area').forEach(content => {
                    content.style.display = 'none';
                    content.classList.remove('active');
                });
                
                // Tampilkan konten yang sesuai
                const targetContent = document.getElementById(targetId);
                if (targetContent) {
                    targetContent.style.display = 'block';
                    targetContent.classList.add('active');
                }
            });
        });
        
       
        
        // Inisialisasi konten utama
        renderPublikasiTable();
        
        // Inisialisasi modal detail kata dan kalimat
        loadSubIdOptions();
        loadSubIdOptionsKalimat();
        
    });

    // FUNGSI UTAMA
    function getStatusChip(status) {
        let statusClass = '';
        let statusText = '';
        if (status === 'Disetujui') {
            statusClass = 'status-disetujui';
            statusText = 'Disetujui';
        } else if (status === 'Menunggu') {
            statusClass = 'status-menunggu';
            statusText = 'Menunggu';
        } else if (status === 'Ditolak') {
            statusClass = 'status-ditolak';
            statusText = 'Ditolak';
        }
        return `<span class="status-chip ${statusClass}">${statusText}</span>`;
    }

    function filterData() {
        const currentFilter = validationFilter.value;
        const data = dataPublikasi[currentFilter];
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        
        return data.filter(item => {
            const matchesSearch = item.konten.toLowerCase().includes(searchTerm) || 
                                 item.id.toLowerCase().includes(searchTerm) ||
                                 item.arti.toLowerCase().includes(searchTerm) ||
                                 (item.jenis && item.jenis.toLowerCase().includes(searchTerm)) ||
                                 (item.cara_baca && item.cara_baca.toLowerCase().includes(searchTerm));
            const matchesStatus = statusValue === 'all' || item.status === statusValue;
            return matchesSearch && matchesStatus;
        });
    }

    function renderPublikasiTable() {
        currentFilteredData = filterData();
        const currentFilter = validationFilter.value;
        const isKataMode = currentFilter === 'kata';
        
        // Header tabel - DIPINDAHKAN KOLOM JENIS SETELAH ARTI
        const headers = [
            `<th>ID ${isKataMode ? 'Kata' : 'Kalimat'}</th>`,
            '<th>Sub ID</th>',
            '<th>Tanggal Entri</th>',
            `<th>${isKataMode ? 'Kata' : 'Kalimat'}</th>`
        ];
        
        // Tambahkan kolom Cara Baca hanya untuk kata
        if (isKataMode) {
            headers.push('<th>Cara Baca</th>');
        }
        
        headers.push('<th>Arti</th>');
        
        // Tambahkan kolom Jenis hanya untuk kata - DIPINDAHKAN SETELAH ARTI
        if (isKataMode) {
            headers.push('<th>Jenis</th>');
        }
        
        headers.push('<th>Status</th>');
        headers.push('<th class="aksi-kolom">Aksi</th>');
        
        tableHeader.innerHTML = headers.join('');

        searchInput.placeholder = isKataMode ? 'cari kata' : 'cari kalimat';
        
        // Render data dengan pagination
        renderTableData();
        
        // Update pagination
        updatePaginationInfo();
        renderPagination();
    }

    function renderTableData() {
        const currentFilter = validationFilter.value;
        const isKataMode = currentFilter === 'kata';
        
        publikasiList.innerHTML = '';
        
        if (currentFilteredData.length === 0) {
            const colspan = isKataMode ? 8 : 6; // Diubah dari 7 menjadi 8 karena ada tambahan kolom Jenis
            publikasiList.innerHTML = `<tr><td colspan="${colspan}" style="text-align:center; padding: 20px; color: #555;">
                <i class="fas fa-info-circle"></i> Tidak ada data ${currentFilter} untuk ditampilkan.
                </td></tr>`;
            return;
        }

        // Hitung data yang akan ditampilkan di halaman ini
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        const currentData = currentFilteredData.slice(startIndex, endIndex);

        currentData.forEach(item => {
            const row = document.createElement('tr');
            
            // Baris data
            let rowContent = `
                <td>${item.id}</td>
                <td>${item.subId}</td>
                <td>${item.tanggal}</td>
                <td>${item.konten}</td>
            `;
            
            // Tambahkan kolom Cara Baca hanya untuk kata
            if (isKataMode) {
                rowContent += `<td><span class="cara-baca">${item.cara_baca || '-'}</span></td>`;
            }
            
            rowContent += `
                <td>${item.arti}</td>
            `;
            
            // Tambahkan kolom Jenis hanya untuk kata - DIPINDAHKAN SETELAH ARTI
            if (isKataMode) {
                rowContent += `<td><span class="jenis-kolom">${item.jenis || '-'}</span></td>`;
            }
            
            rowContent += `
                <td>${getStatusChip(item.status)}</td>
                <td class="aksi-kolom">
                    <i class="fas fa-edit action-icon edit-icon" onclick="showDetailModal('${item.id}', '${item.subId}', '${item.tanggal}', '${item.konten}', '${item.cara_baca || ''}', '${item.arti}', '${item.jenis || ''}', '${item.status}')" title="Edit"></i>
                    <i class="fas fa-trash-alt action-icon delete-icon" onclick="hapusItem('${item.id}', '${currentFilter}')" title="Hapus"></i>
                </td>
            `;
            
            row.innerHTML = rowContent;
            publikasiList.appendChild(row);
        });
    }

   async function hapusItem(id, type) {
    if (!confirm(`Apakah Anda yakin ingin menghapus item ${id}?`)) {
        return;
    }

    const url = type === 'kata'
        ? `/admin/validasi/kata`
        : `/admin/validasi/kalimat`;

    try {
        const response = await fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ id: id })
        });

        const result = await response.json();

        if (response.ok && result.success) {
            // Hapus dari array frontend
            const dataArray = dataPublikasi[type];
            const index = dataArray.findIndex(item => item.id === id);
            if (index !== -1) {
                dataArray.splice(index, 1);
                renderPublikasiTable();
            }

            alert(`✅ ${result.message}`);
        } else {
            console.error(result.error || 'Unknown error');
            alert(result.message || '❌ Gagal menghapus item.');
        }

    } catch (error) {
        console.error('Fetch error:', error);
        alert('❌ Terjadi kesalahan jaringan saat menghapus item.');
    }
}


    // ==========================================================
    // == FUNGSI MODAL DETAIL KATA DAN KALIMAT =================
    // ==========================================================
    function showDetailModal(id, subId, tanggal, konten, cara_baca, arti, jenis, status) {
        const currentFilter = validationFilter.value;
        const isKataMode = currentFilter === 'kata';

        if (isKataMode) {
            // Tampilkan modal kata
            document.querySelector('#detail-kata-modal .modal-header h3').textContent = 'Detail Kata';
            
            modalKataId.textContent = id;
            subidValue.textContent = subId || 'Pilih Sub ID...';
            modalKata.value = konten;
            modalCaraBaca.value = cara_baca || '';
            modalArti.value = arti;
            modalTanggalInput.textContent = tanggal;
            
            // Set jenis kata
            if (jenis) {
                modalJenisSelect.value = jenis;
            }
            
            // Set tanggal validasi berdasarkan status
            if (status === 'Disetujui' || status === 'Ditolak') {
                modalTanggalValidasi.textContent = new Date().toLocaleDateString('id-ID');
            } else {
                modalTanggalValidasi.textContent = '-';
            }
            
            // Set status select
            if (status === 'Disetujui') {
                modalStatusSelect.value = 'Disetujui';
            } else if (status === 'Menunggu') {
                modalStatusSelect.value = 'Menunggu';
            } else if (status === 'Ditolak') {
                modalStatusSelect.value = 'Ditolak';
            } else {
                modalStatusSelect.value = status;
            }
            
            currentPublikasiItem = { id, subId, tanggal, konten, cara_baca, arti, jenis, status, type: currentFilter };
            
            detailKataModal.classList.add('show');
        } else {
            // Tampilkan modal kalimat
            document.querySelector('#detail-kalimat-modal .modal-header h3').textContent = 'Detail Kalimat';
            
            modalKalimatId.textContent = id;
            subidValueKalimat.textContent = subId || 'Pilih Sub ID...';
            modalKalimat.value = konten;
            modalArtiKalimat.value = arti;
            modalTanggalInputKalimat.textContent = tanggal;
            
            // Set tanggal validasi berdasarkan status
            if (status === 'Disetujui' || status === 'Ditolak') {
                modalTanggalValidasiKalimat.textContent = new Date().toLocaleDateString('id-ID');
            } else {
                modalTanggalValidasiKalimat.textContent = '-';
            }
            
            // Set status select
            modalStatusSelectKalimat.value = status;
            
            currentPublikasiItem = { id, subId, tanggal, konten, arti, status, type: currentFilter };
            
            detailKalimatModal.classList.add('show');
        }
    }

    function hideDetailModal() {
        detailKataModal.classList.remove('show');
        detailKalimatModal.classList.remove('show');
    }

    // Fungsi untuk memuat opsi Sub ID ke dropdown kata
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

    // Fungsi untuk memuat opsi Sub ID ke dropdown kalimat
    function loadSubIdOptionsKalimat() {
        subidOptionsListKalimat.innerHTML = '';
        
        const searchTerm = subidSearchKalimat.value.toLowerCase();
        const filteredSubIds = availableSubIds.filter(subId => 
            subId.toLowerCase().includes(searchTerm)
        );
        
        if (filteredSubIds.length === 0) {
            const noResult = document.createElement('div');
            noResult.className = 'no-options';
            noResult.textContent = 'Tidak ada hasil ditemukan';
            subidOptionsListKalimat.appendChild(noResult);
        } else {
            filteredSubIds.forEach(subId => {
                const option = document.createElement('div');
                option.className = 'dropdown-option';
                option.textContent = subId;
                option.addEventListener('click', () => {
                    selectSubIdKalimat(subId);
                });
                subidOptionsListKalimat.appendChild(option);
            });
        }
    }

    // Fungsi untuk memilih Sub ID pada modal kata
    function selectSubId(subId) {
        subidValue.textContent = subId;
        toggleDropdown(false);
        subidSearch.value = '';
        loadSubIdOptions();
    }

    // Fungsi untuk memilih Sub ID pada modal kalimat
    function selectSubIdKalimat(subId) {
        subidValueKalimat.textContent = subId;
        toggleDropdownKalimat(false);
        subidSearchKalimat.value = '';
        loadSubIdOptionsKalimat();
    }

    // Fungsi untuk toggle dropdown kata
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

    // Fungsi untuk toggle dropdown kalimat
    function toggleDropdownKalimat(show) {
        isDropdownOpenKalimat = show;
        const arrow = subidSelectedKalimat.querySelector('.dropdown-arrow');
        
        if (show) {
            subidOptionsKalimat.classList.add('show');
            arrow.classList.add('rotate');
            // Fokus ke input pencarian saat dropdown dibuka
            setTimeout(() => {
                subidSearchKalimat.focus();
            }, 100);
        } else {
            subidOptionsKalimat.classList.remove('show');
            arrow.classList.remove('rotate');
        }
    }

    function simpanPerubahan() {
    const currentFilter = validationFilter.value;
    const isKataMode = currentFilter === 'kata';

    if (isKataMode) {
        // ================== VALIDASI INPUT KATA ==================
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

        // ================== UPDATE DATA DI FRONTEND ==================
        if (currentPublikasiItem) {
            const dataArray = dataPublikasi[currentPublikasiItem.type];
            const itemIndex = dataArray.findIndex(item => item.id === currentPublikasiItem.id);
            if (itemIndex !== -1) {
                dataArray[itemIndex].konten = modalKata.value;
                dataArray[itemIndex].cara_baca = modalCaraBaca.value;
                dataArray[itemIndex].arti = modalArti.value;
                dataArray[itemIndex].jenis = modalJenisSelect.value;
                dataArray[itemIndex].subId =
                    subidValue.textContent !== 'Pilih Sub ID...'
                        ? subidValue.textContent
                        : currentPublikasiItem.subId;

                const newStatus = modalStatusSelect.value;
                dataArray[itemIndex].status =
                    newStatus === 'Disetujui'
                        ? 'Disetujui'
                        : newStatus === 'Ditolak'
                        ? 'Ditolak'
                        : 'Menunggu';
            }
        }
        // ================== UPDATE KE DATABASE ==================
        const match = subidValue.textContent.trim().match(/^([A-Za-z0-9]+)/);
        const subId = match ? match[1] : '';
        fetch(`/admin/validasi/kata`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                kata_id: currentPublikasiItem.id,
                sub_id: subidValue.textContent !== 'Pilih Sub ID...' ? subId : currentPublikasiItem.subId,
                jenis: modalJenisSelect.value,
                kata: modalKata.value,
                arti: modalArti.value,
                cara_baca: modalCaraBaca.value,
                status: modalStatusSelect.value.toLowerCase(),
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log('✅ Update kata sukses:', data);
                alert(`Perubahan untuk kata "${modalKata.value}" berhasil disimpan!`);
                hideDetailModal();
                renderPublikasiTable();
            })
            .catch((error) => {
                console.error('❌ Error update kata:', error);
                alert('Terjadi kesalahan saat memperbarui kata!');
            });
    } else {
        // ================== VALIDASI INPUT KALIMAT ==================
        if (!modalKalimat.value.trim()) {
            alert('Kalimat tidak boleh kosong!');
            modalKalimat.focus();
            return;
        }

        if (!modalArtiKalimat.value.trim()) {
            alert('Arti tidak boleh kosong!');
            modalArtiKalimat.focus();
            return;
        }

        // ================== UPDATE DATA DI FRONTEND ==================
        if (currentPublikasiItem) {
            const dataArray = dataPublikasi[currentPublikasiItem.type];
            const itemIndex = dataArray.findIndex(item => item.id === currentPublikasiItem.id);
            if (itemIndex !== -1) {
                dataArray[itemIndex].konten = modalKalimat.value;
                dataArray[itemIndex].arti = modalArtiKalimat.value;
                dataArray[itemIndex].subId =
                    subidValueKalimat.textContent !== 'Pilih Sub ID...'
                        ? subidValueKalimat.textContent
                        : currentPublikasiItem.subId;

                const newStatus = modalStatusSelectKalimat.value;
                dataArray[itemIndex].status = newStatus;

                if (newStatus === 'Disetujui' || newStatus === 'Ditolak') {
                    dataArray[itemIndex].tanggal = new Date().toLocaleDateString('id-ID');
                }
            }
        }

        const match = subidValueKalimat.textContent.trim().match(/^([A-Za-z0-9]+)/);
        const subId = match ? match[1] : '';
        // ================== UPDATE KE DATABASE ==================
        fetch(`/admin/validasi/kalimat`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                kalimat_id: currentPublikasiItem.id,
                sub_id: subidValueKalimat.textContent !== 'Pilih Sub ID...' ? subId : currentPublikasiItem.subId,
                kalimat: modalKalimat.value,
                arti: modalArtiKalimat.value,
                status: modalStatusSelectKalimat.value.toLowerCase(),
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log('✅ Update kalimat sukses:', data);
                alert(`Perubahan untuk kalimat berhasil disimpan!`);
                hideDetailModal();
                renderPublikasiTable();
            })
            .catch((error) => {
                console.error('❌ Error update kalimat:', error);
                alert('Terjadi kesalahan saat memperbarui kalimat!');
            });
    }
}

    // FUNGSI PAGINATION
    function updatePaginationInfo() {
        const startIndex = (currentPage - 1) * rowsPerPage + 1;
        const endIndex = Math.min(currentPage * rowsPerPage, currentFilteredData.length);
        const total = currentFilteredData.length;
        
        if (total === 0) {
            paginationInfo.textContent = 'Tidak ada data yang ditampilkan';
        } else {
            paginationInfo.textContent = `Menampilkan ${startIndex}-${endIndex} dari ${total} data`;
        }
    }

    function renderPagination() {
        paginationContainer.innerHTML = '';
        
        const totalPages = Math.ceil(currentFilteredData.length / rowsPerPage);
        
        if (totalPages <= 1) return;
        
        // Tombol Previous
        const prevButton = document.createElement('button');
        prevButton.className = 'pagination-btn';
        prevButton.textContent = '‹';
        prevButton.disabled = currentPage === 1;
        prevButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                renderTableData();
                updatePaginationInfo();
                renderPagination();
            }
        });
        paginationContainer.appendChild(prevButton);
        
        // Tombol halaman
        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        
        if (endPage - startPage + 1 < maxVisiblePages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }
        
        // Tombol halaman pertama
        if (startPage > 1) {
            const firstButton = document.createElement('button');
            firstButton.className = 'pagination-btn';
            firstButton.textContent = '1';
            firstButton.addEventListener('click', () => {
                currentPage = 1;
                renderTableData();
                updatePaginationInfo();
                renderPagination();
            });
            paginationContainer.appendChild(firstButton);
            
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
                renderTableData();
                updatePaginationInfo();
                renderPagination();
            });
            paginationContainer.appendChild(pageButton);
        }
        
        // Tombol halaman terakhir
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
                renderTableData();
                updatePaginationInfo();
                renderPagination();
            });
            paginationContainer.appendChild(lastButton);
        }
        
        // Tombol Next
        const nextButton = document.createElement('button');
        nextButton.className = 'pagination-btn';
        nextButton.textContent = '›';
        nextButton.disabled = currentPage === totalPages;
        nextButton.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                renderTableData();
                updatePaginationInfo();
                renderPagination();
            }
        });
        paginationContainer.appendChild(nextButton);
    }

    // FILTER FUNCTIONALITY
    validationFilter.addEventListener('change', function() {
        currentPage = 1;
        renderPublikasiTable();
    });
    
    searchInput.addEventListener('input', function() {
        currentPage = 1;
        renderPublikasiTable();
    });
    
    statusFilter.addEventListener('change', function() {
        currentPage = 1;
        renderPublikasiTable();
    });

    // ROWS PER PAGE FUNCTIONALITY
    rowsPerPageSelect.addEventListener('change', function() {
        rowsPerPage = parseInt(this.value);
        currentPage = 1;
        renderPublikasiTable();
    });

    // MODAL DETAIL KATA EVENT LISTENERS
    closeBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            hideDetailModal();
        });
    });
    
    detailKataModal.addEventListener('click', function(e) {
        if (e.target === this) {
            hideDetailModal();
        }
    });
    
    detailKalimatModal.addEventListener('click', function(e) {
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
    
    modalSetujuKalimat.addEventListener('click', function() {
        simpanPerubahan();
    });
    
    modalTutupKalimat.addEventListener('click', function() {
        hideDetailModal();
    });

    // Event listeners untuk dropdown Sub ID kata
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

    // Event listeners untuk dropdown Sub ID kalimat
    subidSelectedKalimat.addEventListener('click', () => {
        toggleDropdownKalimat(!isDropdownOpenKalimat);
    });

    subidSearchKalimat.addEventListener('input', () => {
        loadSubIdOptionsKalimat();
    });

    subidSearchKalimat.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            toggleDropdownKalimat(false);
        }
    });

    // Tutup dropdown ketika klik di luar
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.searchable-dropdown')) {
            toggleDropdown(false);
        }
        if (!e.target.closest('#subid-dropdown-kalimat')) {
            toggleDropdownKalimat(false);
        }
    });

    // Navigasi keyboard untuk dropdown kata
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

    // Navigasi keyboard untuk dropdown kalimat
    document.addEventListener('keydown', (e) => {
        if (!isDropdownOpenKalimat) return;
        
        const options = subidOptionsListKalimat.querySelectorAll('.dropdown-option');
        if (options.length === 0) return;
        
        const currentActive = subidOptionsListKalimat.querySelector('.dropdown-option.active');
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
                selectSubIdKalimat(currentActive.textContent);
            }
        }
    });

</script>

</body>
</html>