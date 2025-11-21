<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kelola Kamus</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS untuk Sidebar */
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
         
        .sidebar li.active .menu-icon {
            color: #ffffff;
        }

        /* CSS lainnya */
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

        .user-name {
            font-weight: 600;
            font-size: 1.1rem;
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

        .table-area {
            flex-grow: 1;
            padding: 20px;
            background-color: #F5F5F5;
            overflow-y: auto;
        }
        
        /* Styles untuk Data Kamus Besemah */
        .main-container {
            background-color: #fff;
            padding: 25px;
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
            margin-bottom: 25px;
        }

        .main-header h2 {
            color: #508ba0;
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
            border: 1px solid #508ba0;
            border-radius: 30px;
            width: 100%;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(80, 139, 160, 0.2);
        }

        .search-box i {
            position: absolute;
            left: 12px;
            color: #508ba0;
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
            border: 1px solid #508ba0;
            border-radius: 30px;
            font-size: 0.85rem;
            background-color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 110px;
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
            border: 1px solid #508ba0;
            border-radius: 30px;
            background-color: white;
            font-size: 0.85rem;
            cursor: pointer;
            min-width: 80px;
        }

        .filter-info {
            margin-bottom: 20px;
            color: #666666;
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
            flex-grow: 1;
        }

        .word-item {
            display: flex;
            align-items: flex-start;
            padding: 25px;
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
            gap: 12px;
        }

        .word-main {
            display: flex;
            align-items: baseline;
            gap: 15px;
            flex-wrap: wrap;
        }

        /* PERUBAHAN: Ukuran font kata utama disamakan dengan kata turunan */
        .word-name {
            font-size: 1rem; /* Sama dengan .derived-word-name */
            font-weight: bold;
            color: #508ba0;
            margin: 0;
        }

        .word-phonetic {
            font-size: 0.85rem; /* Sama dengan .derived-word-phonetic */
            color: #666666;
            font-style: italic;
            margin: 0;
        }

        .word-type {
            background-color: #e8f5f0;
            color: #508ba0;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            display: inline-block;
        }

        .word-definition {
            color: #333333;
            line-height: 1.5;
            margin: 0;
            font-size: 0.85rem; /* Sama dengan .derived-word-definition */
        }

        .word-examples {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #eaeaea;
        }

        .example-item {
            margin-bottom: 12px;
        }

        .example-Besemah {
            font-weight: bold;
            color: #508ba0;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .example-indonesia {
            color: #666666;
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

        .word-status {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            min-width: 100px;
        }

        .valid-badge {
            background-color: #2ecc71;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(46, 204, 113, 0.3);
        }

        .pending-badge {
            background-color: #f39c12;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(243, 156, 18, 0.3);
        }

        .rejected-badge {
            background-color: #e74c3c;
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
            border-top: 1px solid #eaeaea;
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-info {
            font-size: 0.9rem;
            color: #666666;
        }

        .pagination {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .pagination-btn {
            padding: 8px 12px;
            border: 1px solid #eaeaea;
            background-color: white;
            color: #333333;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .pagination-btn:hover:not(:disabled) {
            background-color: #e8f5f0;
            border-color: #508ba0;
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
            
            .word-item {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }
            
            .word-status {
                align-self: flex-start;
            }
            
            .pagination-container {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
            
            .pagination {
                order: -1;
            }

            .derived-words {
                margin-left: 20px;
                padding-left: 0;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <x-header-admin />
    <div class="main-content">
        <x-sidebar-admin />
        <div class="table-area" id="kelola-kamus-content">
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
                
                <div class="filter-info" id="filterInfo">Menampilkan 10 kata</div>
                
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
    // JavaScript untuk navigasi sidebar
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi logout
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function() {
                const confirmed = confirm('Apakah Anda yakin ingin logout?');
                
                if (confirmed) {
                    localStorage.setItem('isLoggedIn', 'false');
                    window.location.href = 'login.html';
                }
            });
        }

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
                const targetId = this.getAttribute('data-target');
                if (targetId) {
                    // Sembunyikan semua konten
                    document.querySelectorAll('.table-area').forEach(content => {
                        content.style.display = 'none';
                    });
                    
                    // Tampilkan konten yang sesuai
                    const targetContent = document.getElementById(targetId);
                    if (targetContent) {
                        targetContent.style.display = 'block';
                    }
                }
            });
        });
        
        // Set item aktif berdasarkan halaman saat ini
        const currentPage = window.location.pathname.split('/').pop();
        let activeMenuItem = null;
        
        if (currentPage === 'KelolaKamus.html' || currentPage === 'index.html' || currentPage === '') {
            activeMenuItem = document.querySelector('[data-target="kelola-kamus-content"]');
        } else if (currentPage === 'EntryKata.html') {
            activeMenuItem = document.querySelector('[data-target="entry-kata-content"]');
        } else if (currentPage === 'EntryKalimat.html') {
            activeMenuItem = document.querySelector('[data-target="entry-kalimat-content"]');
        } else if (currentPage === 'AdminValidasi.html') {
            activeMenuItem = document.querySelector('[data-target="validasi-content"]');
        }
        
        if (activeMenuItem) {
            activeMenuItem.classList.add('active');
        }
    });

    let wordData = @json($result);

let currentPage = 1;
let entriesPerPage = parseInt(document.getElementById('rows-per-page').value);
let currentData = [];

currentData = [...wordData].sort((a, b) =>
    new Date(b.tanggalDitambahkan) - new Date(a.tanggalDitambahkan)
);


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
        
        document.getElementById('filterInfo').textContent = `Menampilkan ${filteredData.length} kata`;
        
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
                        
                        let turunanBadgeClass = 'valid-badge';
                        if (turunan.status === 'Pending') turunanBadgeClass = 'pending-badge';
                        if (turunan.status === 'Rejected') turunanBadgeClass = 'rejected-badge';
                        
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
</script>

</body>
</html>