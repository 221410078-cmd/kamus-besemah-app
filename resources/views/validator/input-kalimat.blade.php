<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entry Kalimat</title>
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
        /* == FORM ENTRY KALIMAT ==================================== */
        /* ========================================================== */
        .form-card {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .form-card h2 {
            color: #508ba0;
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .entry-kalimat-form {
            display: flex;
            flex-direction: column;
        }
        
        .form-group {
            margin-bottom: 22px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
        }
        
        .form-control, .form-select, .form-textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 15px;
            transition: all 0.2s;
        }
        
        .form-control:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        
        .readonly {
            background-color: #f8f9fa;
            color: #6c757d;
        }
        
        .form-text {
            font-size: 13px;
            color: #6c757d;
            margin-top: 6px;
            font-style: italic;
        }
        
        .radio-group {
            display: flex;
            gap: 20px;
        }
        
        .radio-option {
            display: flex;
            align-items: center;
        }
        
        .radio-option input {
            width: auto;
            margin-right: 8px;
        }
        
        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .btn {
            padding: 10px 22px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .btn-save {
            background-color: #3498db;
            color: white;
        }
        
        .btn-save:hover {
            background-color: #2980b9;
        }
        
        .btn-cancel {
            background-color: #e74c3c;
            color: white;
        }
        
        .btn-cancel:hover {
            background-color: #c0392b;
        }

        /* ========================================================== */
        /* == SEARCHABLE DROPDOWN STYLES ============================ */
        /* ========================================================== */

        .dropdown-container {
            position: relative;
            width: 100%;
        }
        
        .dropdown-input {
            width: 100%;
            padding: 10px 40px 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 15px;
            background-color: white;
            cursor: pointer;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        .dropdown-input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        
        .dropdown-arrow {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            pointer-events: none;
            transition: transform 0.3s ease;
        }
        
        .dropdown-container.active .dropdown-arrow {
            transform: translateY(-50%) rotate(180deg);
        }
        
        .dropdown-list {
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
        
        .dropdown-list.active {
            display: block;
        }
        
        .dropdown-item {
            padding: 10px 12px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s;
        }
        
        .dropdown-item:hover {
            background-color: #f0f8ff;
        }
        
        .dropdown-item.selected {
            background-color: #e3f2fd;
            font-weight: 500;
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
        }
        
        .search-input {
            padding: 10px 12px;
            width: 100%;
            box-sizing: border-box;
            border: none;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
            background-color: #f9f9f9;
        }
        
        .search-input:focus {
            outline: none;
            background-color: white;
            border-bottom-color: #3498db;
        }
        
        .no-results {
            padding: 10px 12px;
            color: #666;
            font-style: italic;
            text-align: center;
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
            
            .form-card {
                padding: 20px;
            }

            .form-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }

            .radio-group {
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
                <div class="form-card">
                    <h2>Entry Kalimat</h2>
                    <form id="inputKalimatForm">
                        <div class="form-group">
                            <label for="id_kalimat">Id Kalimat</label>
                            <input type="text" id="id_kalimat" value="{{ $autoId }} (Auto Generated)"  class="form-control readonly" readonly>
                            <span class="form-text">Contoh: LO001, LO002...</span>
                        </div>
                        
                        <div class="form-group">
    <label for="sub_id">Sub Id</label>
    <div class="dropdown-container" id="subIdDropdown">
        <input type="text" id="sub_id" class="dropdown-input" placeholder="Cari atau pilih" readonly>
        <div class="dropdown-arrow">
            <i class="fas fa-chevron-down"></i>
        </div>
        <div class="dropdown-list" id="dropdownList">
            <input type="text" class="search-input" placeholder="Cari sub id..." id="searchInputKalimat">
            @foreach($kata as $k)
                <div class="dropdown-item" data-value="{{ $k->id_kata }}">{{ $k->id_kata }} - {{ $k->kata }}</div>
            @endforeach
        </div>
    </div>
    <input type="hidden" id="selectedSubId" name="selectedSubId">
</div>

                        
                        <div class="form-group">
                            <label for="kalimat">Kalimat</label>
                            <textarea id="kalimat" class="form-textarea" rows="3" placeholder="Masukkan kalimat" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="arti_kalimat">Arti Kalimat</label>
                            <textarea id="arti_kalimat" class="form-textarea" rows="3" placeholder="Masukkan arti atau terjemahan kalimat" required></textarea>
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
                        
                        <div class="form-buttons">
                            <button type="button" class="btn btn-cancel" id="cancelBtnKalimat">Batal</button>
                            <button type="submit" class="btn btn-save">Simpan</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {

    // ==========================================================
    // == SIDEBAR NAVIGATION ===================================
    // ==========================================================
    const kelolaKamusToggle = document.getElementById('kelolaKamusToggle');
    if (kelolaKamusToggle) {
        kelolaKamusToggle.addEventListener('click', function () {
            this.classList.toggle('open');
            this.classList.toggle('closed');

            const submenu = this.nextElementSibling;
            submenu.style.display = this.classList.contains('closed') ? 'none' : 'block';
        });
    }

    const menuItems = document.querySelectorAll('.sidebar .menu-item');
    menuItems.forEach(item => {
        item.addEventListener('click', function () {
            menuItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');

            const targetId = this.getAttribute('data-target');
            if (targetId) {
                document.querySelectorAll('.table-area').forEach(content => {
                    content.style.display = 'none';
                });
                const targetContent = document.getElementById(targetId);
                if (targetContent) targetContent.style.display = 'block';
            }
        });
    });

    // Set item aktif sesuai halaman
    const currentPage = window.location.pathname.split('/').pop();
    let activeMenuItem = null;
    if (currentPage === 'InputKalimat.html') {
        activeMenuItem = document.querySelector('[data-target="input-kalimat-content"]');
    }
    if (activeMenuItem) activeMenuItem.classList.add('active');

    // ==========================================================
    // == INISIALISASI SEARCHABLE DROPDOWN ======================
    // ==========================================================
    initSubIdDropdown();
});


/* ==========================================================
   == SEARCHABLE DROPDOWN FUNCTIONALITY =====================
   ========================================================== */
function initSubIdDropdown() {
    const dropdownContainer = document.getElementById('subIdDropdown');
        const dropdownInput = document.getElementById('sub_id');
        const dropdownList = document.getElementById('dropdownList');
        const searchInput = document.getElementById('searchInputKalimat');
        const dropdownItems = document.querySelectorAll('#dropdownList .dropdown-item');
        const hiddenInput = document.getElementById('selectedSubId');
        const cancelBtn = document.getElementById('cancelBtnKalimat');
        const inputForm = document.getElementById('inputKalimatForm');
        
        if (dropdownInput) {
            // Toggle dropdown
            dropdownInput.addEventListener('click', function() {
                dropdownContainer.classList.toggle('active');
                dropdownList.classList.toggle('active');
                
                if (dropdownList.classList.contains('active')) {
                    searchInput.focus();
                    // Reset pencarian saat dropdown dibuka
                    searchInput.value = '';
                    filterDropdownItems('');
                }
            });
            
            // Search functionality
            searchInput.addEventListener('input', function(e) {
                filterDropdownItems(e.target.value);
            });
            
            // Fungsi untuk memfilter item dropdown
            function filterDropdownItems(searchTerm) {
                let hasVisibleItems = false;
                
                dropdownItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    if (text.includes(searchTerm.toLowerCase())) {
                        item.style.display = 'block';
                        hasVisibleItems = true;
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                // Tampilkan pesan jika tidak ada hasil
                const noResults = dropdownList.querySelector('.no-results');
                if (!hasVisibleItems) {
                    if (!noResults) {
                        const noResultsMsg = document.createElement('div');
                        noResultsMsg.className = 'no-results';
                        noResultsMsg.textContent = 'Tidak ada hasil yang cocok';
                        dropdownList.appendChild(noResultsMsg);
                    }
                } else if (noResults) {
                    noResults.remove();
                }
            }
            
            // Pilih item dari dropdown
            dropdownItems.forEach(item => {
                item.addEventListener('click', function() {
                    const selectedText = this.textContent;
                    const selectedValue = this.getAttribute('data-value');
                    
                    dropdownInput.value = selectedText;
                    hiddenInput.value = selectedValue;
                    
                    // Highlight item yang dipilih
                    dropdownItems.forEach(i => i.classList.remove('selected'));
                    this.classList.add('selected');
                    
                    // Tutup dropdown
                    dropdownContainer.classList.remove('active');
                    dropdownList.classList.remove('active');
                    
                    // Beri feedback visual
                    dropdownInput.style.borderColor = '#4CAF50';
                    dropdownInput.style.boxShadow = '0 0 0 2px rgba(76, 175, 80, 0.2)';
                });
            });
            
            // Close dropdown ketika klik di luar
            document.addEventListener('click', function(e) {
                if (!dropdownContainer.contains(e.target)) {
                    dropdownContainer.classList.remove('active');
                    dropdownList.classList.remove('active');
                }
            });
            
            // Tombol batal
            cancelBtn.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin membatalkan pengisian form?')) {
                    inputForm.reset();
                    dropdownInput.value = '';
                    hiddenInput.value = '';
                    dropdownItems.forEach(i => i.classList.remove('selected'));
                    dropdownInput.style.borderColor = '#ddd';
                    dropdownInput.style.boxShadow = 'none';
                }
            });
        }

    // === Submit Form (Kirim ke Server) ===
    document.getElementById('inputKalimatForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const kalimatInput = document.getElementById('kalimat');
        const artiInput = document.getElementById('arti_kalimat');
        const idKalimatInput = document.getElementById('id_kalimat');
        const statusInput = document.querySelector('input[name="status"]:checked');

        // ✅ Validasi input
        if (!hiddenInput.value) {
            alert('Harap pilih Sub Id!');
            dropdownInput.style.borderColor = '#e74c3c';
            dropdownInput.style.boxShadow = '0 0 0 2px rgba(231, 76, 60, 0.2)';
            return;
        }

        if (!kalimatInput.value.trim()) {
            alert('Harap masukkan kalimat!');
            kalimatInput.focus();
            return;
        }

        // Ambil hanya kode Sub ID (tanpa teks tambahan)
        const match = hiddenInput.value.trim().match(/^([A-Za-z0-9]+)/);
        const subId = match ? match[1] : '';

        const match2 = idKalimatInput.value.trim().match(/^([A-Za-z0-9]+)/);
        const kalimatId = match2 ? match2[1] : '';

        const data = {
            id_kalimat: kalimatId,
            sub_id: subId,
            kalimat: kalimatInput.value.trim(),
            arti_kalimat: artiInput.value.trim(),
            status: statusInput ? statusInput.value : 'Menunggu'
        };

        try {
            const response = await fetch(`/validator/entry-kalimat/tambah`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok && result.success) {
                // alert('✅ Kalimat berhasil disimpan!');
                setTimeout(() => {
                    inputForm.reset();
                    dropdownInput.value = '';
                    hiddenInput.value = '';
                    dropdownItems.forEach(i => i.classList.remove('selected'));
                    dropdownInput.style.borderColor = '#ddd';
                    dropdownInput.style.boxShadow = 'none';
                }, 400);
            } else {
                alert(result.message || 'Terjadi kesalahan saat menyimpan kalimat.');
                console.error(result.error);
            }
        } catch (error) {
            console.error('Fetch error:', error);
            alert('Gagal mengirim data. Periksa koneksi atau server.');
        }
    });
}
</script>

</body>
</html>