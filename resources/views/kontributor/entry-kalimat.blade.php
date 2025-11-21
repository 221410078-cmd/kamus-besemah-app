<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Input Kalimat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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
        }
        
        .user-info i.fa-book-open {
            font-size: 1.5rem;
            margin-right: 10px;
            color: #333;
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

        /* ========================================================== */
        /* == SIDEBAR STYLES YANG DIPERBAIKI ======================== */
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
        
        .table-area {
            flex-grow: 1;
            padding: 20px;
            background-color: #F5F5F5;
            overflow-y: auto;
        }
        
        .input-kalimat-form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .input-kalimat-form h2 {
            color: #508ba0;
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        
        .form-group {
            margin-bottom: 22px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
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
        
        .readonly {
            background-color: #f8f9fa;
            color: #6c757d;
        }
        
        .example {
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
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .form-buttons button {
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
        /* == SEARCHABLE DROPDOWN STYLES YANG DIPERBAIKI ============ */
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
            color: #777;
            font-style: italic;
            text-align: center;
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
            
            .header {
                flex-direction: column;
                gap: 10px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <x-header-admin />
    <div class="main-content">
        <x-sidebar-kontributor />
        <div class="table-area" id="input-kalimat-content">
            <div class="input-kalimat-form">
                <h2>Input Kalimat</h2>
                <form id="inputKalimatForm">
                <div class="form-group">
                    <label for="id_kalimat">Id Kalimat</label>
    <input type="text" id="id_kalimat" value="{{ $autoId }} (Auto Generated)" readonly class="readonly">
    <div class="example">Contoh: L0001, L0002, ...</div>
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
                        <textarea id="kalimat" rows="3" placeholder="Masukkan kalimat"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="arti_kalimat">Arti Kalimat</label>
                        <textarea id="arti_kalimat" rows="3" placeholder="Masukkan arti atau terjemahan kalimat"></textarea>
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
                        <button type="button" class="btn-cancel" id="cancelBtnKalimat">Batal</button>
                        <button type="submit" class="btn-save">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>

<script>

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
        } else if (currentPage === 'DrafKata.html') {
            activeMenuItem = document.querySelector('[data-target="draft-kata-content"]');
        } else if (currentPage === 'DrafKalimat.html') {
            activeMenuItem = document.querySelector('[data-target="draf-kalimat-content"]');
        } else if (currentPage === 'InputKata.html') {
            activeMenuItem = document.querySelector('[data-target="input-kata-content"]');
        } else if (currentPage === 'InputKalimat.html') {
            activeMenuItem = document.querySelector('[data-target="input-kalimat-content"]');
        } else if (currentPage === 'AdminValidasi.html') {
            activeMenuItem = document.querySelector('[data-target="validasi-content"]');
        }
        
        if (activeMenuItem) {
            activeMenuItem.classList.add('active');
        }
        
        // Inisialisasi dropdown pencarian
        initSubIdDropdown();
    });

    // ==========================================================
    // == SEARCHABLE DROPDOWN FUNCTIONALITY =====================
    // ==========================================================
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
            
            // Form submission
            document.getElementById('inputKalimatForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const dropdownInput = document.querySelector('.dropdown-input');
    const hiddenInput = document.getElementById('sub_id');
    const kalimatInput = document.getElementById('kalimat');
    const artiInput = document.getElementById('arti_kalimat');
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
        return;
    }

        const match = hiddenInput.value.trim().match(/^([A-Za-z0-9]+)/);
        const subId = match ? match[1] : '';
        const match2 =document.getElementById('id_kalimat').value.trim().match(/^([A-Za-z0-9]+)/);
        const kalimatId = match2 ? match2[1] : '';
    const data = {
        id_kalimat: kalimatId,
        sub_id: subId,
        kalimat: kalimatInput.value,
        arti_kalimat: artiInput.value,
        status: statusInput ? statusInput.value : ''
    };
    
    try {
        const response = await fetch(`/admin/entry-kalimat/tambah`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    body: JSON.stringify(data)
});

        const result = await response.json();

        if (response.ok && result.success) {
            // alert('✅ Kalimat berhasil disimpan!');
            
            // Reset form setelah berhasil disimpan
            setTimeout(() => {
                e.target.reset();
                dropdownInput.value = '';
                hiddenInput.value = '';
                document.querySelectorAll('.dropdown-option').forEach(i => i.classList.remove('selected'));
                dropdownInput.style.borderColor = '#ddd';
                dropdownInput.style.boxShadow = 'none';
            }, 500);
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
    }
</script>

</body>
</html>