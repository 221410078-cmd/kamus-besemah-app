<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamus Digital Bahasa Melayu Besemah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* ===== RESET & GLOBAL STYLES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-image: url('img/2.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #333;
            line-height: 1.6;
            position: relative;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.541);
            z-index: -1;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 5px;
        }
        
        /* ===== NAVIGATION STYLES ===== */
        nav {
            background-color: #508ba0;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .logo i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 20px;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
        }
        
        .nav-links a i {
            margin-right: 8px;
        }
        
        .nav-links a:hover, .nav-links a.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        /* ===== PAGE STYLES ===== */
        .page {
            display: none;
        }
        
        .page.active {
            display: block;
        }
        
        /* ===== HEADER STYLES ===== */
        header {
            background-color: #508ba0;
            color: white;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            margin-bottom: 10px;
            position: relative;
        }
        
        header h1 {
            font-size: 2.2rem;
            margin-bottom: 8px;
            margin-top: 8px;
        }
        
        header h2 {
            font-size: 1.3rem;
            font-weight: 400;
            margin-bottom: 12px;
        }
        
        /* ===== HOME PAGE STYLES ===== */
        .home-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 30px 20px;
        }
        
        /* Bagian Kota Pagar Alam - DIUBAH */
        .pagar-alam-container {
            display: flex;
            gap: 30px;
            align-items: flex-start;
            max-width: 100%;
            margin-bottom: 30px;
        }
        
        .pagar-alam-image {
            flex: 1;
            min-width: 300px;
            max-width: 400px;
        }
        
        .pagar-alam-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .pagar-alam-section {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            flex: 2;
            text-align: left;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .pagar-alam-section h3 {
            color: #508ba0;
            margin-bottom: 20px;
            font-size: 1.8rem;
            text-align: center;
        }
        
        .pagar-alam-section p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 15px;
            text-align: justify;
        }
        
        /* Search Box Styles for Home */
        .home-search-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            width: 100%;
        }
        
        .home-search-box {
            display: flex;
            background-color: white;
            border-radius: 50px;
            padding: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .home-search-box:focus-within {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }
        
        .home-search-box input {
            flex: 1;
            border: none;
            outline: none;
            padding: 15px 25px;
            font-size: 1.1rem;
            border-radius: 50px;
            background: transparent;
        }
        
        .home-search-box button {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 15px 30px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .home-search-box button:hover {
            background: linear-gradient(135deg, #2980b9, #2471a3);
            transform: scale(1.05);
        }
        
        .quick-stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            min-width: 150px;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        
        /* ===== PROFILE PAGE STYLES ===== */
        .profile-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0;
        }
        
        /* ISRG Section Styles */
        .isrg-section {
            margin-top: 0;
            text-align: center;
            width: 100%;
        }
        
        .isrg-container {
            display: flex;
            gap: 30px;
            align-items: flex-start;
            max-width: 100%;
            margin: 0 auto;
        }
        
        .isrg-image {
            flex: 1;
            min-width: 300px;
            max-width: 400px;
        }
        
        .isrg-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .isrg-info {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            flex: 2;
            text-align: left;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .isrg-info h3 {
            color: #508ba0;
            margin-bottom: 15px;
            font-size: 1.5rem;
            text-align: center;
        }
        
        .isrg-info h4 {
            color: #508ba0;
            margin-bottom: 15px;
            font-size: 1.5rem;
            text-align: center;
        }
        
        .isrg-info p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 15px;
            text-align: justify;
        }
        
        /* Bagian Peta Pagar Alam - DIPERBAIKI */
        .map-section {
            text-align: center;
            width: 100%;
            margin-top: 30px;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(253, 250, 250, 0.1);
        }
        
        .map-section h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }
        
        .map-description {
            max-width: 800px;
            margin: 0 auto 15px;
            text-align: center;
            font-size: 1rem;
            line-height: 1.6;
        }
        
        .map-container {
            height: 400px;
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 3px solid #508ba0;
        }
        
        .map-legend {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
        }
        
        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
        }
        
        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .team-section {
            margin-top: 30px;
            text-align: center;
            width: 100%;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .team-section h3 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        
        .team-members {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .team-member {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            width: 200px;
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
        }
        
        .team-member h4 {
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .team-member p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        
        /* ===== DICTIONARY PAGE STYLES ===== */
        .search-filters-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            gap: 15px;
            max-width: 900px;
            margin: 0 auto 15px;
            position: relative;
            z-index: 10;
        }
        
        /* Filter Styles */
        .filter-group {
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .filter-group label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #2c3e50;
            font-size: 0.9rem;
        }
        
        .filter-select {
            padding: 10px 35px 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 1rem;
            min-width: 120px;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 5;
        }
        
        .filter-select:focus {
            outline: none;
            border-color: #508ba0;
            box-shadow: 0 0 0 2px rgba(80, 139, 160, 0.2);
        }
        
        .filter-select:hover {
            border-color: #508ba0;
        }
        
        /* Untuk browser tertentu */
        .filter-select::-ms-expand {
            display: none;
        }
        
        /* Styling untuk opsi dropdown */
        .filter-select option {
            padding: 8px 12px;
            background-color: white;
            color: #333;
            position: relative;
            z-index: 1000;
        }
        
        .filter-select option:hover {
            background-color: #508ba0;
            color: white;
        }
        
        /* Pastikan dropdown container tidak terpotong */
        .search-filters-container {
            overflow: visible;
        }
        
        .search-container {
            display: flex;
            flex: 1;
            max-width: 400px;
        }
        
        .search-box {
            flex: 1;
            background-color: white;
            border-radius: 10px;
            display: flex;
            padding: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .search-box input {
            flex: 1;
            border: none;
            outline: none;
            padding: 0 15px;
            font-size: 1.1rem;
            border-radius: 10px;
        }
        
        .search-box button {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        
        .search-box button:hover {
            background-color: #2980b9;
        }
        
        /* ===== DICTIONARY DATA STYLES ===== */
        .main-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .main-header h2 {
            color: #508ba0;
            font-size: 1.5rem;
            margin: 0;
        }

        .word-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
            flex-grow: 1;
        }

        .word-item {
            display: flex;
            align-items: flex-start;
            padding: 18px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: 1px solid #eaeaea;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .word-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background-color: #508ba0;
            transition: all 0.3s ease;
        }

        .word-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .word-item:hover::before {
            width: 8px;
        }

        .word-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .word-main {
            display: flex;
            align-items: baseline;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* PERUBAHAN: Ukuran font kata utama diperkecil dari 1.2rem ke 1rem */
        .word-name {
            font-size: 1rem;
            font-weight: bold;
            color: #508ba0;
            margin: 0;
        }

        /* PERUBAHAN: Ukuran font phonetic kata utama diperkecil dari 0.9rem ke 0.85rem */
        .word-phonetic {
            font-size: 0.85rem;
            color: #666666;
            font-style: italic;
            margin: 0;
        }

        .word-type {
            background-color: #e8f5f0;
            color: #508ba0;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            display: inline-block;
        }

        /* PERUBAHAN: Ukuran font definisi kata utama diperkecil dari 0.9rem ke 0.85rem */
        .word-definition {
            color: #333333;
            line-height: 1.5;
            margin: 0;
            font-size: 0.85rem;
        }

        .word-examples {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #eaeaea;
        }

        .example-item {
            margin-bottom: 8px;
        }

        /* PERUBAHAN: Ukuran font contoh kalimat Besemah diperkecil dari 0.9rem ke 0.9rem (tetap) */
        .example-Besemah {
            font-weight: bold;
            color: #508ba0;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        /* PERUBAHAN: Ukuran font contoh kalimat Indonesia diperkecil dari 0.85rem ke 0.85rem (tetap) */
        .example-indonesia {
            color: #666666;
            font-style: italic;
            margin-left: 15px;
            font-size: 0.85rem;
        }

        /* Derived Words Styles */
        .derived-words {
            margin-top: 10px;
            margin-left: 80px;
            padding-left: 0;
        }

        .derived-word-item {
            margin-bottom: 10px;
            padding-bottom: 10px;
            position: relative;
        }

        .derived-word-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .derived-word-main {
            display: flex;
            align-items: baseline;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 6px;
        }

        .derived-word-name {
            font-size: 1rem;
            font-weight: bold;
            color: #508ba0;
            margin: 0;
        }

        .derived-word-phonetic {
            font-size: 0.85rem;
            color: #666666;
            font-style: italic;
            margin: 0;
        }

        .derived-word-type {
            background-color: #e8f5f0;
            color: #508ba0;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: bold;
            display: inline-block;
        }

        .derived-word-definition {
            color: #333333;
            line-height: 1.5;
            margin: 0;
            font-size: 0.85rem;
        }

        /* ===== PAGINATION STYLES ===== */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 15px 0;
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

        .pagination-ellipsis {
            padding: 8px 5px;
            color: #666;
        }
        
        /* ===== FOOTER STYLES ===== */
        footer {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            color: #7f8c8d;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 0 0 10px 10px;
        }
        
        /* ===== RESPONSIVE STYLES ===== */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                padding: 15px;
            }
            
            .nav-links {
                margin-top: 15px;
                width: 100%;
                justify-content: space-between;
            }
            
            .nav-links li {
                margin-left: 0;
            }
            
            .search-filters-container {
                flex-direction: column;
                align-items: center;
            }
            
            .filter-group {
                width: 100%;
                max-width: 250px;
            }
            
            .search-container {
                width: 100%;
                max-width: 100%;
            }
            
            .word-item {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }
            
            .pagination-container {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
            
            .pagination {
                order: -1;
            }
            
            .quick-stats {
                flex-direction: column;
                align-items: center;
            }
            
            .team-members {
                flex-direction: column;
                align-items: center;
            }
            
            .home-search-box {
                flex-direction: column;
                border-radius: 15px;
            }
            
            .home-search-box input {
                border-radius: 15px 15px 0 0;
            }
            
            .home-search-box button {
                border-radius: 0 0 15px 15px;
            }
            
            .filter-select {
                width: 100%;
            }
            
            .pagar-alam-container {
                flex-direction: column;
                align-items: center;
            }
            
            .pagar-alam-image {
                min-width: 100%;
                margin-bottom: 20px;
            }
            
            .pagar-alam-image img {
                height: 180px;
            }
            
            .pagar-alam-section {
                min-height: auto;
            }
            
            .isrg-container {
                flex-direction: column;
                align-items: center;
            }
            
            .isrg-image {
                min-width: 100%;
                margin-bottom: 20px;
            }
            
            .isrg-image img {
                height: 180px;
            }
            
            .isrg-info {
                min-height: auto;
            }
            
            .map-container {
                height: 300px;
            }
            
            /* Sesuaikan indentasi untuk tampilan mobile */
            .derived-words {
                margin-left: 20px;
                padding-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navigation Bar -->
        <nav>
            <div class="nav-container">
                <div class="logo">
                    <img src="img/55.png" alt="logo" class="img-fluid rounde-cirlce" style="width: 50px; height: 50px; margin-right: 10px; border-radius: 50%">
                    <span>Kamus Besemah</span>
                </div>
                <ul class="nav-links">
                    <li><a href="#" class="nav-link active" data-page="home"><i class="fas fa-home"></i> Beranda</a></li>
                    <li><a href="#" class="nav-link" data-page="profile"><i class="fas fa-user"></i> Profil</a></li>
                    <li><a href="#" class="nav-link" data-page="dictionary"><i class="fas fa-book"></i> Kamus</a></li>
                </ul>
            </div>
        </nav>
        
        <!-- Home Page -->
        <div id="home" class="page active">
            <header>
                <h1>KAMUS DIGITAL BAHASA BESEMAH</h1>
                <h2>Selamat Datang di Kamus Digital Bahasa Besemah</h2>
                
                <!-- Search Box di Beranda -->
                <div class="home-search-container">
                    <div class="home-search-box">
                        <input type="text" id="homeSearchInput" placeholder="Cari kata dalam bahasa Besemah...">
                        <button onclick="searchFromHome()">
                            <i class="fas fa-search"></i>
                            Cari
                        </button>
                    </div>
                </div>
            </header>
            
            <div class="home-content">
                <!-- Bagian Kota Pagar Alam dengan gambar -->
                <div class="pagar-alam-container">
                    <div class="pagar-alam-image">
                       <img src="img/aku.png" alt="Kota Pagar Alam">
                    </div>
                    <div class="pagar-alam-section">
                        <h3>Tentang Kota Pagar Alam</h3>
                        <p>Kota Pagar Alam adalah sebuah kota yang terletak di dataran tinggi Provinsi Sumatera Selatan, dikelilingi oleh keindahan Gunung Dempo dan hamparan perkebunan teh yang menghijau. Sejarahnya yang kaya dimulai dari masa megalitikum, yang terbukti dari berbagai peninggalan arca batu dan menhir yang tersebar di wilayahnya, menunjukkan peradaban tua yang telah berdiri jauh sebelum Indonesia merdeka.</p>
                        <p>Kota ini resmi berdiri sebagai daerah otonom pada tahun 2001, memisahkan diri dari Kabupaten Lahat setelah melalui perjuangan panjang. Nama "Pagar Alam" yang berarti "Benteng Alam" sangat sesuai dengan karakter geografisnya yang dikelilingi oleh pegunungan, seolah menjadi pelindung bagi warisan budayanya yang paling berharga.</p>
                        <p>Warisan tersebut hidup dan bernapas melalui Bahasa Melayu Besemah, atau Baso Besemah, yang menjadi jiwa dari komunitasnya. Layaknya benteng yang kokoh, Baso Besemah dengan logat 'o'-nya yang khas—seperti dalam "apo" dan "mano"—serta kosakata unik seperti "lomang" dan "kemui", tidak hanya menjadi alat komunikasi sehari-hari tetapi juga berfungsi sebagai penjaga identitas, pemersatu sosial, dan kronik hidup dari kebijakan lokal masyarakat Pagar Alam.</p>
                        <p>Dengan demikian, hubungan antara kota dan bahasanya adalah simbiosis yang erat; benteng alam Pagar Alam melindungi kebudayaannya, sementara Baso Besemah menjadi suara yang mengisahkan sejarah, nilai, dan semangat orang Besemah dari generasi ke generasi.</p>
                    </div>
                </div>
                
                <div class="quick-stats">
                    <div class="stat-card">
                        <div class="stat-number">29</div>
                        <div class="stat-label">Kata Tersedia</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">5</div>
                        <div class="stat-label">Jenis Kata</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Gratis</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Profile Page -->
        <div id="profile" class="page">
            <header>
                <h1>PROFIL</h1>
                <h2>Informasi tentang Kamus Digital Bahasa Besemah</h2>
            </header>
            
            <div class="profile-content">
                <!-- Bagian ISRG -->
                <div class="isrg-section">
                    <div class="isrg-container">
                        <div class="isrg-image">
                            <img src="img/ISRG.jpeg" alt="Intelligent Systems Research Group">
                        </div>
                        <div class="isrg-info">
                            <h3><i class="fas fa-university"></i> Tempat Pengembangan</h3>
                            <h4>Intelligent Systems Research Group (ISRG)</h4>
                            <p>ISRG (Intelligent System Research Group) merupakan salah satu kelompok penelitian unggulan di Universitas Bina Darma yang berfokus pada pengembangan sistem cerdas dan teknologi kecerdasan buatan (AI). Kelompok ini aktif mengeksplorasi berbagai bidang riset seperti data mining, machine learning, computer vision, natural language processing (NLP), dan komputasi soft. Komitmen nyata ISRG dalam mengaplikasikan keahliannya dapat dilihat dari salah satu proyek konkretnya, yaitu pengembangan Kamus Digital Bahasa Melayu Besemah. Dalam proyek ini, ISRG memanfaatkan keahlian di bidang natural language processing dan komputasi linguistik untuk membangun sebuah sistem yang dapat melestarikan dan memudahkan akses terhadap kosakata bahasa daerah Palembang yang terancam punah ini. Melalui berbagai proyek penelitian seperti ini, ISRG tidak hanya berkontribusi pada perkembangan ilmu pengetahuan dan teknologi, tetapi juga menjadi wadah yang sangat baik bagi dosen dan mahasiswa Universitas Bina Darma untuk terlibat langsung dalam penelitian teknologi mutakhir yang memiliki dampak sosial dan budaya yang signifikan.</p>
                        </div>
                    </div>
                    
                    <!-- Bagian Peta Pagar Alam - DIPERBAIKI -->
                    <div class="map-section">
                        <h3><i class="fas fa-map-marked-alt"></i> Peta Kota Pagar Alam</h3>
                        <p class="map-description">
                            Lokasi geografis Kota Pagar Alam, pusat budaya dan bahasa Besemah.
                        </p>
                        
                        <div id="besemahMap" class="map-container"></div>
                        
                        <div class="map-legend">
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #508ba0;"></div>
                                <span>Kota Pagar Alam</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #2ecc71;"></div>
                                <span>Wilayah Perkotaan</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #e74c3c;"></div>
                                <span>Lokasi Penting</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="team-section">
                    <h3>Tim Pengembang</h3>
                    <div class="team-members">
                        <div class="team-member">
                            <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #2c3e50; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; margin: 0 auto 10px;">AB</div>
                            <h4>KALDERA</h4>
                            <p>Admin</p>
                        </div>
                        <div class="team-member">
                            <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #2c3e50; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; margin: 0 auto 10px;">SD</div>
                            <h4>ANDELKY</h4>
                            <p>Konributor</p>
                        </div>
                        <div class="team-member">
                            <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #2c3e50; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; margin: 0 auto 10px;">RF</div>
                            <h4>HENTA</h4>
                            <p>Validator</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Dictionary Page -->
        <div id="dictionary" class="page">
            <header>
                <h1>Kamus Digital</h1>
                <h2>Bahasa Melayu Besemah</h2>
                
                <div class="search-filters-container">
                    <div class="search-container">
                        <div class="search-box">
                            <input type="text" id="searchInput" placeholder="Cari Kata Atau Kalimat">
                            <button id="searchButton"><i class="fas fa-search"></i></button>                                     
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <select class="filter-select" id="alphabet-select">
                            <option value="">Huruf A-Z</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                            <option value="G">G</option>
                            <option value="H">H</option>
                            <option value="I">I</option>
                            <option value="J">J</option>
                            <option value="K">K</option>
                            <option value="L">L</option>
                            <option value="M">M</option>
                            <option value="N">N</option>
                            <option value="O">O</option>
                            <option value="P">P</option>
                            <option value="Q">Q</option>
                            <option value="R">R</option>
                            <option value="S">S</option>
                            <option value="T">T</option>
                            <option value="U">U</option>
                            <option value="V">V</option>
                            <option value="W">W</option>
                            <option value="X">X</option>
                            <option value="Y">Y</option>
                            <option value="Z">Z</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <select class="filter-select" id="type-select">
                            <option value="">Jenis Kata</option>
                            <option value="kata benda">Kata Benda</option>
                            <option value="kata kerja">Kata Kerja</option>
                            <option value="kata sifat">Kata Sifat</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <select class="filter-select" id="rows-per-page-header">
                            <option value="5">5 baris</option>
                            <option value="10">10 baris</option>
                            <option value="25" selected>25 baris</option>
                            <option value="50">50 baris</option>
                        </select>
                    </div>
                </div>
            </header>
            
            <!-- Dictionary Content -->
            <div class="main-container">
                <div class="main-header">
                    <h2>Daftar Kamus Bahasa Besemah</h2>
                </div>
                
                <div class="word-list" id="wordList"></div>
                
                <!-- Pagination Controls -->
                <div class="pagination-container">
                    <div class="pagination-info" id="pagination-info">Menampilkan 0-0 dari 0 data</div>
                    <div class="pagination" id="pagination"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // ===== DATA KAMUS BESEMAH =====
        const wordData = {!! $wordData !!};

        // ===== VARIABEL GLOBAL =====
        let currentPage = 1;
        let entriesPerPage = parseInt(document.getElementById('rows-per-page-header').value);
        let currentData = [...wordData];
        
        // Simpan referensi peta di window untuk akses global
        window.besemahMap = null;
        window.besemahMapInitialized = false;

        // ===== FUNGSI PETA =====
        /**
         * Inisialisasi peta Kota Pagar Alam
         */
        function initializeMap() {
            // Koordinat Pagar Alam, Sumatera Selatan
            const pagarAlamCoords = [-4.025, 103.246];
            
            // Inisialisasi peta
            window.besemahMap = L.map('besemahMap').setView(pagarAlamCoords, 12);
            
            // Tambahkan tile layer (peta dasar)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(window.besemahMap);
            
            // Tambahkan marker untuk Kota Pagar Alam
            const pagarAlamMarker = L.marker(pagarAlamCoords).addTo(window.besemahMap);
            pagarAlamMarker.bindPopup(`
                <div style="text-align: center;">
                    <h3 style="margin: 0 0 10px; color: #508ba0;">Kota Pagar Alam</h3>
                    <p style="margin: 0;"><strong>Bahasa Besemah:</strong> Kuto Pagar Alam</p>
                    <p style="margin: 5px 0;">Pusat budaya dan bahasa Besemah</p>
                </div>
            `).openPopup();
            
            // Tambahkan batas wilayah Kota Pagar Alam (contoh)
            const pagarAlamBoundary = L.polygon([
                [-3.98, 103.20],
                [-4.00, 103.28],
                [-4.07, 103.27],
                [-4.06, 103.22]
            ], {
                color: '#508ba0',
                fillColor: '#508ba0',
                fillOpacity: 0.1,
                weight: 3
            }).addTo(window.besemahMap);
            
            pagarAlamBoundary.bindPopup('Batas Wilayah Kota Pagar Alam');
            
            // Tambahkan area perkotaan Pagar Alam (contoh)
            const urbanArea = L.polygon([
                [-4.015, 103.24],
                [-4.020, 103.25],
                [-4.030, 103.255],
                [-4.035, 103.245],
                [-4.025, 103.235]
            ], {
                color: '#2ecc71',
                fillColor: '#2ecc71',
                fillOpacity: 0.2,
                weight: 2
            }).addTo(window.besemahMap);
            
            urbanArea.bindPopup('Wilayah Perkotaan Pagar Alam');
            
            // Tambahkan beberapa lokasi penting di Pagar Alam
            const importantLocations = [
                {
                    coords: [-4.015, 103.26],
                    name: "Gunung Dempo",
                    besemahName: "Gunung Dempo",
                    type: "gunung"
                },
                {
                    coords: [-4.03, 103.23],
                    name: "Pusat Kota Pagar Alam",
                    besemahName: "Pusat Kuto Pagar Alam",
                    type: "kota"
                },
                {
                    coords: [-4.04, 103.25],
                    name: "Air Terjun Curup Maung",
                    besemahName: "Curup Maung",
                    type: "wisata"
                }
            ];
            
            importantLocations.forEach(location => {
                let iconColor = '#e74c3c';
                let iconHtml = '<i class="fas fa-mountain"></i>';
                
                if (location.type === "kota") {
                    iconColor = '#f39c12';
                    iconHtml = '<i class="fas fa-city"></i>';
                } else if (location.type === "wisata") {
                    iconColor = '#3498db';
                    iconHtml = '<i class="fas fa-water"></i>';
                }
                
                const customIcon = L.divIcon({
                    html: `<div style="background-color: ${iconColor}; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 10px;">${iconHtml}</div>`,
                    className: 'custom-div-icon',
                    iconSize: [20, 20],
                    iconAnchor: [10, 10]
                });
                
                const marker = L.marker(location.coords, {icon: customIcon}).addTo(window.besemahMap);
                marker.bindPopup(`
                    <div style="text-align: center;">
                        <h4 style="margin: 0 0 5px; color: #508ba0;">${location.name}</h4>
                        <p style="margin: 0;"><strong>Bahasa Besemah:</strong> ${location.besemahName}</p>
                    </div>
                `);
            });
            
            window.besemahMapInitialized = true;
        }

        // ===== FUNGSI NAVIGASI =====
        /**
         * Navigasi antar halaman aplikasi
         * @param {string} pageId - ID halaman yang akan ditampilkan
         */
        function navigateToPage(pageId) {
            // Sembunyikan semua halaman
            document.querySelectorAll('.page').forEach(page => {
                page.classList.remove('active');
            });
            
            // Tampilkan halaman yang dipilih
            document.getElementById(pageId).classList.add('active');
            
            // Update status aktif di navigasi
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            
            document.querySelector(`.nav-link[data-page="${pageId}"]`).classList.add('active');
            
            // Jika navigasi ke halaman kamus, render data
            if (pageId === 'dictionary') {
                renderWordList(currentData, currentPage);
            }
            
            // Jika navigasi ke halaman profil, inisialisasi peta
            if (pageId === 'profile') {
                // Tunggu sedikit agar DOM selesai dirender
                setTimeout(() => {
                    if (!window.besemahMapInitialized) {
                        initializeMap();
                        window.besemahMapInitialized = true;
                    } else {
                        // Jika peta sudah diinisialisasi, invalidate ukuran untuk menyesuaikan dengan container
                        if (window.besemahMap) {
                            setTimeout(() => {
                                window.besemahMap.invalidateSize();
                            }, 100);
                        }
                    }
                }, 300);
            }
        }

        // ===== FUNGSI PENCARIAN =====
        /**
         * Pencarian dari halaman beranda
         */
        function searchFromHome() {
            const searchTerm = document.getElementById('homeSearchInput').value.trim();
            if (searchTerm) {
                // Navigasi ke halaman kamus
                navigateToPage('dictionary');
                
                // Set nilai search input di halaman kamus
                setTimeout(() => {
                    document.getElementById('searchInput').value = searchTerm;
                    searchWords();
                }, 100);
            }
        }

        /**
         * Menangani event keypress di search beranda
         * @param {Event} event - Event keypress
         */
        function handleHomeSearchKeyPress(event) {
            if (event.key === 'Enter') {
                searchFromHome();
            }
        }

        /**
         * Pencarian kata di halaman kamus
         */
        function searchWords() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const alphabetFilter = document.getElementById('alphabet-select').value;
            const typeFilter = document.getElementById('type-select').value;
            
            let filteredData = [...wordData];
            
            // Filter berdasarkan kata kunci
            if (searchTerm) {
                filteredData = filteredData.filter(word => 
                    word.kata.toLowerCase().includes(searchTerm) || 
                    word.caraBaca.toLowerCase().includes(searchTerm) || 
                    word.arti.toLowerCase().includes(searchTerm) ||
                    (word.contoh && word.contoh.some(contoh => 
                        contoh.Besemah.toLowerCase().includes(searchTerm) ||
                        contoh.indonesia.toLowerCase().includes(searchTerm)
                    )) ||
                    (word.turunan && word.turunan.some(turunan => 
                        turunan.kata.toLowerCase().includes(searchTerm) ||
                        turunan.caraBaca.toLowerCase().includes(searchTerm) ||
                        turunan.arti.toLowerCase().includes(searchTerm) ||
                        (turunan.contoh && turunan.contoh.some(contoh => 
                            contoh.Besemah.toLowerCase().includes(searchTerm) ||
                            contoh.indonesia.toLowerCase().includes(searchTerm)
                        ))
                    ))
                );
            }
            
            // Filter berdasarkan huruf awal
            if (alphabetFilter) {
                filteredData = filteredData.filter(word => 
                    word.kata.charAt(0).toUpperCase() === alphabetFilter
                );
            }
            
            // Filter berdasarkan jenis kata
            if (typeFilter) {
                let jenisFilter = '';
                switch(typeFilter) {
                    case 'kata benda': jenisFilter = 'n'; break;
                    case 'kata kerja': jenisFilter = 'v'; break;
                    case 'kata sifat': jenisFilter = 'adj'; break;
                }
                filteredData = filteredData.filter(word => 
                    word.jenis === jenisFilter || 
                    (word.turunan && word.turunan.some(turunan => turunan.jenis === jenisFilter))
                );
            }
            
            currentData = filteredData;
            currentPage = 1;
            
            renderWordList(currentData, currentPage);
        }

        // ===== FUNGSI RENDER DATA =====
        /**
         * Render daftar kata ke halaman
         * @param {Array} data - Data kata yang akan dirender
         * @param {number} page - Halaman yang akan ditampilkan
         */
        function renderWordList(data, page = 1) {
            const list = document.getElementById('wordList');
            list.innerHTML = '';
            
            const startIndex = (page - 1) * entriesPerPage;
            const endIndex = startIndex + entriesPerPage;
            const paginatedData = data.slice(startIndex, endIndex);
            
            // Tampilkan pesan jika tidak ada data
            if (paginatedData.length === 0) {
                list.innerHTML = '<div class="word-item" style="text-align: center; padding: 40px;"><p style="color: #666; font-size: 1.1rem;"><i class="fas fa-search" style="margin-right: 10px;"></i>Tidak ada kata yang ditemukan</p></div>';
            } else {
                // Render setiap kata
                paginatedData.forEach(word => {
                    const item = document.createElement('div');
                    item.className = 'word-item';
                    
                    let examplesHTML = '';
                    if (word.contoh && word.contoh.length > 0) {
                        examplesHTML = '<div class="word-examples">';
                        word.contoh.forEach(contoh => {
                            examplesHTML += `
                                <div class="example-item">
                                    <div class="example-Besemah">${contoh.Besemah}</div>
                                    <div class="example-indonesia">${contoh.indonesia}</div>
                                </div>
                            `;
                        });
                        examplesHTML += '</div>';
                    }
                    
                    let turunanHTML = '';
                    if (word.turunan && word.turunan.length > 0) {
                        turunanHTML = '<div class="derived-words">';
                        word.turunan.forEach(turunan => {
                            let turunanExamplesHTML = '';
                            if (turunan.contoh && turunan.contoh.length > 0) {
                                turunanExamplesHTML = '<div class="word-examples">';
                                turunan.contoh.forEach(contoh => {
                                    turunanExamplesHTML += `
                                        <div class="example-item">
                                            <div class="example-Besemah">${contoh.Besemah}</div>
                                            <div class="example-indonesia">${contoh.indonesia}</div>
                                        </div>
                                    `;
                                });
                                turunanExamplesHTML += '</div>';
                            }
                            
                            turunanHTML += `
                                <div class="derived-word-item">
                                    <div class="derived-word-main">
                                        <h4 class="derived-word-name">${turunan.kata}</h4>
                                        <p class="derived-word-phonetic">${turunan.caraBaca}</p>
                                        <span class="derived-word-type">${turunan.jenis}</span>
                                    </div>
                                    <p class="derived-word-definition">${turunan.arti}</p>
                                    ${turunanExamplesHTML}
                                </div>
                            `;
                        });
                        turunanHTML += '</div>';
                    }
                    
                    item.innerHTML = `
                        <div class="word-content">
                            <div class="word-main">
                                <h3 class="word-name">${word.kata}</h3>
                                <p class="word-phonetic">${word.caraBaca}</p>
                                <span class="word-type">${word.jenis}</span>
                            </div>
                            <p class="word-definition">${word.arti}</p>
                            ${examplesHTML}
                            ${turunanHTML}
                        </div>
                    `;
                    list.appendChild(item);
                });
            }
            
            renderPagination(data, page);
        }

        /**
         * Render kontrol pagination
         * @param {Array} data - Data yang akan dipaginasi
         * @param {number} currentPage - Halaman saat ini
         */
        function renderPagination(data, currentPage) {
            const totalPages = Math.ceil(data.length / entriesPerPage);
            const paginationContainer = document.getElementById('pagination');
            const paginationInfo = document.getElementById('pagination-info');
            
            const startIndex = (currentPage - 1) * entriesPerPage;
            const startEntry = data.length > 0 ? startIndex + 1 : 0;
            const endEntry = Math.min(startIndex + entriesPerPage, data.length);
            
            paginationInfo.textContent = `Menampilkan ${startEntry}-${endEntry} dari ${data.length} data`;
            
            paginationContainer.innerHTML = '';
            
            // Tidak perlu pagination jika hanya ada 1 halaman
            if (totalPages <= 1) {
                return;
            }
            
            // Tombol Previous
            const prevButton = document.createElement('button');
            prevButton.className = 'pagination-btn';
            prevButton.textContent = '‹';
            prevButton.disabled = currentPage === 1;
            prevButton.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderWordList(data, currentPage);
                }
            });
            paginationContainer.appendChild(prevButton);
            
            // Tentukan halaman yang akan ditampilkan
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
            
            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }
            
            // Tombol halaman pertama jika diperlukan
            if (startPage > 1) {
                const firstButton = document.createElement('button');
                firstButton.className = 'pagination-btn';
                firstButton.textContent = '1';
                firstButton.addEventListener('click', () => {
                    currentPage = 1;
                    renderWordList(data, currentPage);
                });
                paginationContainer.appendChild(firstButton);
                
                // Ellipsis jika ada halaman yang tidak ditampilkan
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
                    renderWordList(data, currentPage);
                });
                paginationContainer.appendChild(pageButton);
            }
            
            // Tombol halaman terakhir jika diperlukan
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
                    renderWordList(data, currentPage);
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
                    renderWordList(data, currentPage);
                }
            });
            paginationContainer.appendChild(nextButton);
        }

        // ===== EVENT LISTENERS =====
        // Navigasi utama
        document.querySelectorAll('.nav-links .nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const pageId = this.getAttribute('data-page');
                navigateToPage(pageId);
            });
        });

        // ===== INISIALISASI APLIKASI =====
        document.addEventListener('DOMContentLoaded', function() {
            // Render data kamus saat pertama kali dimuat
            renderWordList(currentData, currentPage);
            
            // Event listener untuk mengubah jumlah baris per halaman di header
            document.getElementById('rows-per-page-header').addEventListener('change', function() {
                entriesPerPage = parseInt(this.value);
                currentPage = 1;
                renderWordList(currentData, currentPage);
            });
            
            // Event listener untuk Enter key di search beranda
            document.getElementById('homeSearchInput').addEventListener('keypress', handleHomeSearchKeyPress);
            
            // Event listener untuk Enter key di search kamus
            document.getElementById('searchInput').addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    searchWords();
                }
            });
            
            // Event listener untuk tombol search di kamus
            document.getElementById('searchButton').addEventListener('click', searchWords);
            
            // Event listener untuk filter huruf
            document.getElementById('alphabet-select').addEventListener('change', searchWords);
            
            // Event listener untuk filter jenis kata
            document.getElementById('type-select').addEventListener('change', searchWords);
        });
    </script>
</body>
</html>