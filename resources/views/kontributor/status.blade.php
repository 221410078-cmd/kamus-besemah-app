<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kamus Besemah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            color: #ffffff;
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
        /* == STYLES DATA KAMUS BESEMAH ============================= */
        /* ========================================================== */
        :root {
            --primary-color: #508ba0;
            --primary-light: #e8f5f0;
            --secondary-color: #2c3e50;
            --accent-color: #3498db;
            --text-color: #333333;
            --text-light: #666666;
            --bg-color: #f5f7fa;
            --card-bg: #ffffff;
            --border-color: #eaeaea;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --error-color: #e74c3c;
            --shadow: 0 2px 10px rgba(0,0,0,0.05);
            --shadow-hover: 0 5px 15px rgba(0,0,0,0.1);
            --border-radius: 10px;
            --transition: all 0.3s ease;
        }

        .main-container {
            background-color: var(--card-bg);
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            height: 100%;
            overflow-y: auto;
        }

        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .main-header h2 {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin: 0;
        }

        .filter-container {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
            display: flex;
            align-items: center;
            flex: 1;
            min-width: 180px;
        }

        .search-box input {
            padding: 10px 12px 10px 35px;
            border: 1px solid var(--primary-color);
            border-radius: 30px;
            width: 100%;
            font-size: 0.9rem;
            transition: var(--transition);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .search-box input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(80, 139, 160, 0.2);
        }

        .search-box i {
            position: absolute;
            left: 12px;
            color: var(--primary-color);
            font-size: 0.9rem;
        }

        .filter-controls {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-controls select {
            padding: 8px 12px;
            border: 1px solid var(--primary-color);
            border-radius: 30px;
            font-size: 0.85rem;
            background-color: white;
            cursor: pointer;
            transition: var(--transition);
            min-width: 110px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .filter-controls select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(80, 139, 160, 0.2);
        }

        .row-filter {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .row-filter select {
            padding: 8px 12px;
            border: 1px solid var(--primary-color);
            border-radius: 30px;
            background-color: white;
            font-size: 0.85rem;
            cursor: pointer;
            min-width: 80px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .filter-info {
            margin-bottom: 20px;
            color: var(--text-light);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .word-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 25px;
        }

        .word-item {
            display: flex;
            align-items: flex-start;
            padding: 25px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
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
            background-color: var(--primary-color);
            transition: var(--transition);
        }

        .word-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .word-item:hover::before {
            width: 8px;
        }

        .word-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .word-main {
            display: flex;
            align-items: baseline;
            gap: 15px;
            flex-wrap: wrap;
        }

        /* PERUBAHAN: Ukuran font kata utama diperkecil dari 1.5rem ke 1rem */
        .word-name {
            font-size: 1rem;
            font-weight: bold;
            color: var(--primary-color);
            margin: 0;
        }

        /* PERUBAHAN: Ukuran font phonetic kata utama diperkecil dari 1.1rem ke 0.85rem */
        .word-phonetic {
            font-size: 0.85rem;
            color: var(--text-light);
            font-style: italic;
            margin: 0;
        }

        .word-type {
            background-color: var(--primary-light);
            color: var(--primary-color);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            display: inline-block;
        }

        /* PERUBAHAN: Ukuran font definisi kata utama diperkecil dari 1.05rem ke 0.85rem */
        .word-definition {
            color: var(--text-color);
            line-height: 1.5;
            margin: 0;
            font-size: 0.85rem;
        }

        .word-examples {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed var(--border-color);
        }

        .example-item {
            margin-bottom: 12px;
        }

        /* PERUBAHAN: Ukuran font contoh kalimat Besemah diperkecil dari 1.05rem ke 0.9rem */
        .example-Besemah {
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        /* PERUBAHAN: Ukuran font contoh kalimat Indonesia diperkecil dari 1rem ke 0.85rem */
        .example-indonesia {
            color: var(--text-light);
            font-style: italic;
            margin-left: 15px;
            font-size: 0.85rem;
        }

        /* Derived Words Styles */
        .derived-words {
            margin-top: 12px;
            margin-left: 80px;
            padding-left: 0;
        }

        .derived-word-item {
            margin-bottom: 12px;
            padding-bottom: 12px;
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
            color: var(--primary-color);
            margin: 0;
        }

        .derived-word-phonetic {
            font-size: 0.85rem;
            color: var(--text-light);
            font-style: italic;
            margin: 0;
        }

        .derived-word-type {
            background-color: var(--primary-light);
            color: var(--primary-color);
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: bold;
            display: inline-block;
        }

        .derived-word-definition {
            color: var(--text-color);
            line-height: 1.5;
            margin: 0;
            font-size: 0.85rem;
        }

        .word-status {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            min-width: 100px;
        }

        .valid-badge {
            background-color: var(--success-color);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(46, 204, 113, 0.3);
        }

        .pending-badge {
            background-color: var(--warning-color);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(243, 156, 18, 0.3);
        }

        .rejected-badge {
            background-color: var(--error-color);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(231, 76, 60, 0.3);
        }
        
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 15px 0;
            border-top: 1px solid var(--border-color);
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-info {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .pagination {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .pagination-btn {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            background-color: white;
            color: var(--text-color);
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: var(--transition);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .pagination-btn:hover:not(:disabled) {
            background-color: var(--primary-light);
            border-color: var(--primary-color);
        }

        .pagination-btn:disabled {
            background-color: #f5f5f5;
            color: #999;
            cursor: not-allowed;
        }

        .pagination-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        /* ========================================================== */
        /* == RESPONSIVE ============================================ */
        /* ========================================================== */
        @media (max-width: 768px) {
            body {
                padding: 10px;
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

            .main-container {
                padding: 15px;
            }
            
            .word-item {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }
            
            .word-status {
                align-self: flex-start;
            }
            
            .derived-words {
                margin-left: 20px;
                padding-left: 0;
            }
            
            .pagination-container {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
            
            .pagination {
                order: -1;
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
        }
    </style>
</head>
<body>
    <div class="container">
        <x-header-admin />
        
        <div class="main-content">  
            <x-sidebar-kontributor />
            
            <div class="table-area">
                <div class="main-container">
                    <div class="main-header">
                        <h2>Daftar Kamus Bahasa Besemah</h2>
                    </div>
                    
                    <div class="filter-container">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchInput" placeholder="Cari kata...">
                        </div>
                        
                        <div class="filter-controls">
                            <select id="statusFilter">
                                <option value="semua">Semua Status</option>
                                <option value="valid">Valid</option>
                                <option value="pending">Menunggu</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                            <select id="typeFilter">
                                <option value="semua">Semua Jenis</option>
                                <option value="n">Kata Benda</option>
                                <option value="v">Kata Kerja</option>
                                <option value="adj">Kata Sifat</option>
                                <option value="pron">Kata Ganti</option>
                            </select>
                            <select id="sortFilter">
                                <option value="terbaru">Terbaru</option>
                                <option value="terlama">Terlama</option>
                            </select>
                            
                            <div class="row-filter">
                                <select id="rows-per-page">
                                    <option value="5">5 baris</option>
                                    <option value="10">10 baris</option>
                                    <option value="25" selected>25 baris</option>
                                    <option value="50">50 baris</option>
                                    <option value="75">75 baris</option>
                                    <option value="100">100 baris</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="word-list" id="wordList"></div>
                    
                    <div class="pagination-container">
                        <div class="pagination-info" id="pagination-info">Menampilkan 0-0 dari 0 data</div>
                        <div class="pagination" id="pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ==========================================================
        // == FUNGSI LOGOUT & REDIRECT KE LOGIN =====================
        // ==========================================================
        function setupLogout() {
            const logoutBtn = document.getElementById('logoutBtn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function() {
                    // Konfirmasi logout
                    const confirmed = confirm('Apakah Anda yakin ingin logout?');
                    
                    if (confirmed) {
                        // Simpan status logout di localStorage (opsional)
                        localStorage.setItem('isLoggedIn', 'false');
                        
                        // Coba beberapa path yang mungkin untuk file login
                        const loginPaths = [
                            'login.html',
                            '../login.html',
                            './login.html',
                            'KDBB/login.html',
                            '../KDBB/login.html',
                            '../../login.html'
                        ];
                        
                        let redirectSuccess = false;
                        
                        // Coba redirect ke setiap path
                        for (let path of loginPaths) {
                            try {
                                console.log('Mencoba redirect ke:', path);
                                // Coba akses file untuk memeriksa keberadaannya
                                fetch(path, { method: 'HEAD' })
                                    .then(response => {
                                        if (response.ok) {
                                            window.location.href = path;
                                            redirectSuccess = true;
                                            return;
                                        }
                                    })
                                    .catch(error => {
                                        console.log('Gagal mengakses:', path, error);
                                    });
                            } catch (error) {
                                console.log('Gagal redirect ke:', path, error);
                            }
                        }
                        
                        // Jika semua path gagal, coba redirect langsung setelah timeout
                        setTimeout(() => {
                            if (!redirectSuccess) {
                                // Coba redirect langsung ke login.html
                                window.location.href = 'login.html';
                            }
                        }, 100);
                    }
                });
            }
        }

        // Data kamus Besemah dari kodingan kedua
        const wordData = @json($result);
        let currentPage = 1;
        let entriesPerPage = parseInt(document.getElementById('rows-per-page').value);
        let currentData = [...wordData].sort((a, b) => new Date(b.tanggalDitambahkan) - new Date(a.tanggalDitambahkan));

        // Inisialisasi aplikasi
        function initializeApp() {
            setupLogout(); // Setup fungsi logout
            renderWordList(currentData, currentPage);

            document.getElementById('searchInput').addEventListener('input', filterWords);
            document.getElementById('statusFilter').addEventListener('change', filterWords);
            document.getElementById('typeFilter').addEventListener('change', filterWords);
            document.getElementById('sortFilter').addEventListener('change', filterWords);
            document.getElementById('rows-per-page').addEventListener('change', function() {
                entriesPerPage = parseInt(this.value);
                currentPage = 1;
                renderWordList(currentData, currentPage);
            });
        }

        function filterWords() {
            const searchText = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const typeFilter = document.getElementById('typeFilter').value;
            const sortValue = document.getElementById('sortFilter').value;
            
            let filteredData = [...wordData];
            
            if (searchText) {
                filteredData = filteredData.filter(word => 
                    word.kata.toLowerCase().includes(searchText) || 
                    word.caraBaca.toLowerCase().includes(searchText) || 
                    word.arti.toLowerCase().includes(searchText) ||
                    (word.contoh && word.contoh.some(contoh => 
                        contoh.Besemah.toLowerCase().includes(searchText) ||
                        contoh.indonesia.toLowerCase().includes(searchText)
                    )) ||
                    (word.turunan && word.turunan.some(turunan => 
                        turunan.kata.toLowerCase().includes(searchText) ||
                        turunan.arti.toLowerCase().includes(searchText) ||
                        (turunan.contoh && turunan.contoh.some(contoh => 
                            contoh.Besemah.toLowerCase().includes(searchText) ||
                            contoh.indonesia.toLowerCase().includes(searchText)
                        ))
                    ))
                );
            }
            
            if (statusFilter !== 'semua') {
                filteredData = filteredData.filter(word => 
                    word.status.toLowerCase() === statusFilter.toLowerCase()
                );
            }
            
            if (typeFilter !== 'semua') {
                filteredData = filteredData.filter(word => 
                    word.jenis === typeFilter
                );
            }
            
            switch(sortValue) {
                case 'terbaru':
                    filteredData.sort((a, b) => new Date(b.tanggalDitambahkan) - new Date(a.tanggalDitambahkan));
                    break;
                case 'terlama':
                    filteredData.sort((a, b) => new Date(a.tanggalDitambahkan) - new Date(b.tanggalDitambahkan));
                    break;
            }
            
            currentData = filteredData;
            currentPage = 1;
            
            renderWordList(currentData, currentPage);
        }

        function renderWordList(data, page = 1) {
            const list = document.getElementById('wordList');
            list.innerHTML = '';
            
            const startIndex = (page - 1) * entriesPerPage;
            const endIndex = startIndex + entriesPerPage;
            const paginatedData = data.slice(startIndex, endIndex);
            
            if (paginatedData.length === 0) {
                list.innerHTML = '<div class="word-item" style="text-align: center; padding: 40px;"><p style="color: #666; font-size: 1.1rem;"><i class="fas fa-search" style="margin-right: 10px;"></i>Tidak ada kata yang ditemukan</p></div>';
            } else {
                paginatedData.forEach(word => {
                    const item = document.createElement('div');
                    item.className = 'word-item';
                    
                    let badgeClass = 'valid-badge';
                    if (word.status === 'Pending') badgeClass = 'pending-badge';
                    if (word.status === 'Rejected') badgeClass = 'rejected-badge';
                    
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
                            let turunanBadgeClass = 'valid-badge';
                            if (turunan.status === 'Pending') turunanBadgeClass = 'pending-badge';
                            if (turunan.status === 'Rejected') turunanBadgeClass = 'rejected-badge';
                            
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
                                        <span class="${turunanBadgeClass}" style="font-size: 0.7rem; padding: 4px 8px;">${turunan.status}</span>
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
                        <div class="word-status">
                            <span class="${badgeClass}">${word.status}</span>
                        </div>
                    `;
                    list.appendChild(item);
                });
            }
            
            renderPagination(data, page);
        }

        function renderPagination(data, currentPage) {
            const totalPages = Math.ceil(data.length / entriesPerPage);
            const paginationContainer = document.getElementById('pagination');
            const paginationInfo = document.getElementById('pagination-info');
            
            const startIndex = (currentPage - 1) * entriesPerPage + 1;
            const endIndex = Math.min(currentPage * entriesPerPage, data.length);
            const total = data.length;
            
            if (total === 0) {
                paginationInfo.textContent = 'Tidak ada data yang ditampilkan';
            } else {
                paginationInfo.textContent = `Menampilkan ${startIndex}-${endIndex} dari ${total} data`;
            }
            
            paginationContainer.innerHTML = '';
            
            if (totalPages <= 1) return;
            
            const prevButton = document.createElement('button');
            prevButton.className = 'pagination-btn';
            prevButton.textContent = '‹';
            prevButton.disabled = currentPage === 1;
            prevButton.addEventListener('click', () => {
                if (currentPage > 1) changePage(currentPage - 1);
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
                firstButton.addEventListener('click', () => changePage(1));
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
                pageButton.addEventListener('click', () => changePage(i));
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
                lastButton.addEventListener('click', () => changePage(totalPages));
                paginationContainer.appendChild(lastButton);
            }
            
            const nextButton = document.createElement('button');
            nextButton.className = 'pagination-btn';
            nextButton.textContent = '›';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                if (currentPage < totalPages) changePage(currentPage + 1);
            });
            paginationContainer.appendChild(nextButton);
        }

        function changePage(page) {
            currentPage = page;
            renderWordList(currentData, currentPage);
        }

        // Inisialisasi aplikasi saat DOM siap
        document.addEventListener('DOMContentLoaded', initializeApp);
    </script>
</body>
</html>