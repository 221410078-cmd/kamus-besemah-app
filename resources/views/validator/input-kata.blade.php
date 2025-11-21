<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Validasi Kata & Kalimat</title>
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
        /* == STYLES FORM ENTRY KATA BARU =========================== */
        /* ========================================================== */
        .form-card {
            background-color: white;
            padding: 25px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            max-width: 700px;
            margin: 0 auto;
        }
        
        .form-card h2 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #508ba0;
            margin-top: 0;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-column {
            flex: 1;
            min-width: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #555;
            font-size: 0.95rem;
        }

        .form-control, .form-select, .form-textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            color: #333;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
        }

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 15px;
            transition: all 0.2s;
        }
        
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        .form-control[readonly] {
            background-color: #f0f0f0;
            color: #777;
            cursor: default;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-text {
            display: block;
            margin-top: 5px;
            font-size: 0.85rem;
            color: #999;
        }

        .radio-group {
            display: flex;
            gap: 20px;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            font-weight: normal;
        }
        
        .radio-group input[type="radio"] {
            margin-right: 5px;
            width: auto;
            accent-color: #4CAF50;
        }

        /* Button Footer */
        .form-footer {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.2s;
        }

        .btn-batal {
            background-color: #f44336;
            color: white;
        }

        .btn-batal:hover {
            background-color: #d32f2f;
        }

        .btn-simpan {
            background-color: #2196F3;
            color: white;
        }

        .btn-simpan:hover {
            background-color: #1976D2;
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
        /* == SEARCHABLE DROPDOWN STYLES ============================ */
        /* ========================================================== */
        .custom-dropdown {
            position: relative;
            width: 100%;
        }
        
        .dropdown-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        .dropdown-select:after {
            content: '\f078';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-size: 12px;
            color: #666;
        }
        
        .dropdown-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 4px 4px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .dropdown-options.active {
            display: block;
        }
        
        .search-box {
            padding: 8px 12px;
            border-bottom: 1px solid #eee;
            background-color: #f8f9fa;
        }
        
        .search-box input {
            width: 100%;
            padding: 6px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .dropdown-option {
            padding: 10px 12px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s;
        }
        
        .dropdown-option:hover {
            background-color: #f0f8ff;
        }
        
        .dropdown-option.selected {
            background-color: #e3f2fd;
            font-weight: 500;
        }
        
        .no-results {
            padding: 10px 12px;
            color: #666;
            font-style: italic;
            text-align: center;
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
            margin-bottom: 20px;
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
            
            .form-card {
                padding: 15px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .form-footer {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
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

            <section class="content-area" id="content-area">
                <!-- Konten Input Kata (Default) -->
                <div class="page-content active" id="input-kata-content">
                    <div class="form-card">
                        <h2>Input Kata Baru</h2>
                        <form id="entryKataForm" >
                            
                            <div class="form-group">
                                <label for="id_kata">Id Kata</label>
                                <input type="text" id="id_kata" class="form-control readonly" value="{{ $autoId }} (Auto Generated)" readonly>
                            </div>
                            
                            <div class="form-group hidden" id="form-group-idSub">
                                <label for="idSub">Sub id (Kata Utama)</label>
                                <div class="custom-dropdown" id="idSub-dropdown">
                                    <div class="dropdown-select" id="idSub-select">
                                        <span class="selected-text">Cari atau pilih ID Sub</span>
                                    </div>
                                    <div class="dropdown-options" id="idSub-options">
                                        <div class="search-box">
                                            <input type="text" placeholder="Cari ID Sub..." id="idSub-search">
                                        </div>
                                        <div class="options-list" id="idSub-list">
                                            <!-- Options akan diisi oleh JavaScript -->
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="idSub" name="idSub">
                                <span class="form-text">Diisi jika Kategori adalah 'Kata Turunan'.</span>
                            </div>

                            <div class="form-row">
                                <div class="form-column">
                                    <label for="jenis_kata">Jenis Kata</label>
                                    <select id="jenis_kata" class="form-select" required>
                                        <option value="">Pilih Jenis Kata</option>
                                        <option value="nomina">Nomina (Kata Benda)</option>
                                        <option value="verba">Verba (Kata Kerja)</option>
                                        <option value="adjektiva">Adjektiva (Kata Sifat)</option>
                                    </select>
                                </div>

                                <div class="form-column">
                                    <label for="kategori_kata">Kategori Kata</label>
                                    <select id="kategori_kata" class="form-select" onchange="toggleSubId()" required>
                                        <option value="">Pilih Kategori Kata</option>
                                        <option value="utama">Kata Utama</option>
                                        <option value="turunan">Kata Turunan</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="kata">Kata</label>
                                <input type="text" id="kata" class="form-control" placeholder="Masukkan kata baru" required>
                            </div>

                            <div class="form-group">
                                <label for="cara_baca">Cara Baca</label>
                                <input type="text" id="cara_baca" class="form-control" placeholder="Contoh: {a-ba-a-ba}">
                                <span class="form-text">Format: [suku kata 1] suku kata 2]...</span>
                            </div>

                            <div class="form-group">
                <label for="definisi">Definisi</label>
                <textarea id="definisi" rows="4" placeholder="Masukkan definisi" required></textarea>
            </div>

                         <div class="form-group">
                        <label>Status</label>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" id="statusMenunggu" name="status" value="Menunggu" checked>
                                <label for="statusMenunggu">Menunggu</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="statusDitolak" name="status" value="Ditolak">
                                <label for="statusDitolak">Ditolak</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="statusDisetujui" name="status" value="Disetujui">
                                <label for="statusDisetujui">Disetujui</label>
                            </div>
                        </div>
                    </div>

                            <div class="form-footer">
                                <button type="button" class="btn btn-batal" onclick="resetForm()">Batal</button>
                                <button type="submit" class="btn btn-simpan">Simpan Kata</button>
                            </div>
                        </form>
                    </div>
                </div>

               
            </section>
        </div>
    </div>

    <script>

        // Data contoh untuk kata utama
        const kataUtamaList = [
        @foreach ($KataUtama as $ku)
            {
                id: "{{ $ku->id_kata }}",
                text: "{{ $ku->id_kata }} - {{ $ku->kata }}"
            },
        @endforeach
    ];
        // Mapping halaman ke file eksternal
        const pageFiles = {
            'input-kata': '', // Kosong karena konten sudah ada di halaman ini
            'input-kalimat': 'input-kalimat.html',
            'validasi-kata': 'validasi-kata.html',
            'validasi-kalimat': 'validasi-kalimat.html',
            'data-kamus-besemah': 'data-kamus-besemah.html'
        };

        // Variabel untuk menyimpan halaman yang sedang aktif
        let currentPage = 'input-kata';
        let currentFilePath = '';

        // ==========================================================
        // == FUNGSI UNTUK KOMUNIKASI DENGAN IFRAME ================
        // ==========================================================

        // Fungsi untuk memberi tahu iframe bahwa ini adalah aplikasi utama
        window.isMainApp = true;

        // Fungsi untuk beralih halaman (untuk dipanggil dari iframe)
        window.switchPage = function(pageId) {
            loadPage(pageId);
        };

        // Fungsi untuk menginisialisasi halaman dalam iframe
        function initIframePage(pageId) {
            const frame = document.getElementById('content-frame');
            if (frame.contentWindow && typeof frame.contentWindow.initInputKalimatPage === 'function') {
                frame.contentWindow.initInputKalimatPage();
            }
        }

        // Fungsi untuk memuat halaman
        function loadPage(pageId) {
            currentPage = pageId;
            
            // Update menu aktif
            document.querySelectorAll('.sidebar li').forEach(item => {
                item.classList.remove('active');
            });
            document.querySelector(`.sidebar li[data-target="${pageId}"]`).classList.add('active');

            // Tampilkan konten yang sesuai
            if (pageId === 'input-kata') {
                // Tampilkan form input kata dan sembunyikan iframe
                document.getElementById('input-kata-content').classList.remove('hidden');
            } else {
                // Sembunyikan form input kata dan tampilkan iframe
                document.getElementById('input-kata-content').classList.add('hidden');
                document.getElementById('iframe-container').classList.remove('hidden');
                
                // Sembunyikan pesan error jika ada
                document.getElementById('iframe-error').classList.add('hidden');
                
                // Tampilkan loading
                document.getElementById('iframe-loading').classList.remove('hidden');
                
                // Muat file yang sesuai ke dalam iframe
                const frame = document.getElementById('content-frame');
                currentFilePath = pageFiles[pageId];
                
                if (currentFilePath) {
                    frame.src = currentFilePath;
                } else {
                    // Jika tidak ada file yang ditentukan, tampilkan halaman placeholder
                    frame.src = 'about:blank';
                    showPlaceholderPage(pageId);
                }
            }
        }

        // Fungsi untuk menampilkan halaman placeholder jika file tidak ada
        function showPlaceholderPage(pageId) {
            const frame = document.getElementById('content-frame');
            const pageName = document.querySelector(`.sidebar li[data-target="${pageId}"]`).textContent.trim();
            
            const placeholderHTML = `
                <!DOCTYPE html>
                <html>
                <head>
                    <style>
                        body { 
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
                            display: flex; 
                            justify-content: center; 
                            align-items: center; 
                            height: 100vh; 
                            margin: 0; 
                            background-color: #f5f5f5;
                        }
                        .placeholder-container {
                            text-align: center;
                            padding: 40px;
                            background-color: white;
                            border-radius: 8px;
                            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                            max-width: 500px;
                        }
                        .placeholder-icon {
                            font-size: 64px;
                            color: #508ba0;
                            margin-bottom: 20px;
                        }
                        h1 {
                            color: #333;
                            margin-bottom: 15px;
                        }
                        p {
                            color: #666;
                            line-height: 1.6;
                            margin-bottom: 20px;
                        }
                    </style>
                </head>
                <body>
                    <div class="placeholder-container">
                        <div class="placeholder-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h1>Halaman ${pageName}</h1>
                        <p>Halaman ini sedang dalam pengembangan. File <strong>${currentFilePath}</strong> akan dibuat untuk menampilkan konten ini.</p>
                        <p>Untuk saat ini, Anda dapat menggunakan halaman <strong>Input Kata</strong> yang sudah tersedia.</p>
                    </div>
                </body>
                </html>
            `;
            
            // Tulis HTML langsung ke iframe
            frame.contentDocument.open();
            frame.contentDocument.write(placeholderHTML);
            frame.contentDocument.close();
            
            // Sembunyikan loading
            document.getElementById('iframe-loading').classList.add('hidden');
        }

        // Fungsi yang dipanggil ketika iframe selesai dimuat
        function iframeLoaded() {
            // Sembunyikan loading
            document.getElementById('iframe-loading').classList.add('hidden');
            
            // Inisialisasi halaman dalam iframe
            setTimeout(() => {
                initIframePage(currentPage);
            }, 100);
        }

        // Fungsi yang dipanggil ketika terjadi error pada iframe
        function iframeError() {
            // Sembunyikan loading
            document.getElementById('iframe-loading').classList.add('hidden');
            
            // Tampilkan pesan error
            document.getElementById('error-file-name').textContent = currentFilePath;
            document.getElementById('iframe-error').classList.remove('hidden');
        }

        // Fungsi untuk mencoba memuat ulang halaman
        function retryLoadPage() {
            loadPage(currentPage);
        }

        // Inisialisasi Searchable Dropdown untuk ID Sub
        function initSubIdDropdown() {
            const dropdown = document.getElementById('idSub-dropdown');
            const select = document.getElementById('idSub-select');
            const options = document.getElementById('idSub-options');
            const searchInput = document.getElementById('idSub-search');
            const optionsList = document.getElementById('idSub-list');
            const hiddenInput = document.getElementById('idSub');

            // Render options
            function renderOptions(filter = '') {
                const filteredOptions = kataUtamaList.filter(option => 
                    option.text.toLowerCase().includes(filter.toLowerCase())
                );

                optionsList.innerHTML = '';

                if (filteredOptions.length === 0) {
                    optionsList.innerHTML = '<div class="no-results">Tidak ada hasil ditemukan</div>';
                    return;
                }

                filteredOptions.forEach(option => {
                    const optionElement = document.createElement('div');
                    optionElement.className = 'dropdown-option';
                    optionElement.textContent = option.text;
                    optionElement.dataset.value = option.id;
                    
                    optionElement.addEventListener('click', () => {
                        select.querySelector('.selected-text').textContent = option.text;
                        hiddenInput.value = option.id;
                        options.classList.remove('active');
                        select.style.borderColor = '#4CAF50';
                        select.style.boxShadow = '0 0 0 2px rgba(76, 175, 80, 0.2)';
                        
                        // Hapus selected dari semua options
                        document.querySelectorAll('#idSub-list .dropdown-option').forEach(opt => {
                            opt.classList.remove('selected');
                        });
                        // Tambah selected ke option yang dipilih
                        optionElement.classList.add('selected');
                    });

                    optionsList.appendChild(optionElement);
                });
            }

            // Toggle dropdown
            select.addEventListener('click', (e) => {
                e.stopPropagation();
                options.classList.toggle('active');
                if (options.classList.contains('active')) {
                    searchInput.focus();
                    renderOptions();
                }
            });

            // Search functionality
            searchInput.addEventListener('input', (e) => {
                renderOptions(e.target.value);
            });

            // Close dropdown ketika klik di luar
            document.addEventListener('click', (e) => {
                if (!dropdown.contains(e.target)) {
                    options.classList.remove('active');
                }
            });

            // Highlight selected option saat dropdown dibuka
            select.addEventListener('click', () => {
                if (hiddenInput.value) {
                    const selectedOption = optionsList.querySelector(`[data-value="${hiddenInput.value}"]`);
                    if (selectedOption) {
                        document.querySelectorAll('#idSub-list .dropdown-option').forEach(opt => {
                            opt.classList.remove('selected');
                        });
                        selectedOption.classList.add('selected');
                    }
                }
            });

            // Render initial options
            renderOptions();
        }

        // Fungsi JavaScript untuk mengontrol tampilan Sub Id berdasarkan Kategori Kata
        function toggleSubId() {
            const kategoriSelect = document.getElementById('kategori_kata');
            const subIdGroup = document.getElementById('form-group-idSub');
            const selectedValue = kategoriSelect.value;

            if (selectedValue === 'turunan') {
                // Jika memilih 'Kata Turunan', tampilkan Sub Id
                subIdGroup.classList.remove('hidden');
                document.getElementById('idSub').setAttribute('required', 'required');
            } else {
                // Jika memilih 'Kata Utama' atau kosong, sembunyikan Sub Id
                subIdGroup.classList.add('hidden');
                document.getElementById('idSub').removeAttribute('required');
                // Reset dropdown
                document.getElementById('idSub-select').querySelector('.selected-text').textContent = 'Cari atau pilih ID Sub';
                document.getElementById('idSub').value = '';
            }
        }

        // Fungsi untuk reset form
        function resetForm() {
            document.getElementById('entryKataForm').reset();
            // Reset dropdown
            document.getElementById('idSub-select').querySelector('.selected-text').textContent = 'Cari atau pilih ID Sub';
            document.getElementById('idSub').value = '';
            toggleSubId();
            
            alert('Form telah direset');
        }

        // Event listener untuk form submission
        document.getElementById('entryKataForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const kategoriKata = document.getElementById('kategori_kata').value;
    let isValid = true;

    // === Validasi khusus untuk kata turunan ===
    if (kategoriKata === 'turunan') {
        const subIdValue = document.getElementById('idSub').value;
        if (!subIdValue) {
            isValid = false;
            // Highlight dropdown yang error
            const select = document.getElementById('idSub-select');
            if (select) {
                select.style.borderColor = '#e74c3c';
                select.style.boxShadow = '0 0 0 2px rgba(231, 76, 60, 0.2)';
            }
        }
    }

    const kata = document.getElementById('kata').value.trim();
    const jenisKata = document.getElementById('jenis_kata').value.trim();

    if (!kata || !jenisKata) {
        isValid = false;
    }

    // === Jika valid, kirim data ke server ===
    if (isValid) {
        let jenisKata = document.getElementById('jenisKata').value;
        const data = {
    id_kata: document.getElementById('id_kata')?.value || '',
    id_sub: jenisKata === 'turunan' ? document.getElementById('idSub').value : document.getElementById('idKata').value.split(' ')[0],
    jenis_kata: kategoriKata || '',
    kategori_kata: jenisKata || '',
    kata: kata || '',
    cara_baca: document.getElementById('cara_baca')?.value || '',
    definisi: document.getElementById('definisi').value,
    status: document.querySelector('input[name="status"]:checked')?.value || 'Menunggu',
};


        try {
            const response = await fetch(`/validator/entry-kata/tambah`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                // alert("✅ Kata berhasil disimpan!");
                e.target.reset();

                // Simulasi update ID baru
                const currentId = data.id_kata;
                const idNumber = parseInt(currentId.match(/\d+/)[0]);
                document.getElementById('id_kata').value = `KD${(idNumber + 1).toString().padStart(3, '0')} (Auto Generated)`;
            } else {
                alert(result.message || "❌ Terjadi kesalahan saat menyimpan data.");
            }
        } catch (error) {
            console.error(error);
            alert("⚠️ Gagal mengirim data. Periksa koneksi atau server.");
        }
    } else {
        alert('⚠️ Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.');
    }
});

        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            toggleSubId();
            initSubIdDropdown();
            loadPage('input-kata');
            document.querySelectorAll('.sidebar li').forEach(item => {
                item.addEventListener('click', function() {
                    const pageId = this.getAttribute('data-target');
                    loadPage(pageId);
                });
            });
        });
    </script>
</body>
</html>