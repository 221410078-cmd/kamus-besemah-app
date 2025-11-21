<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kelola Kamus</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS untuk sidebar dan input kata saja */
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
        
        .input-kata-form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .input-kata-form h2 {
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
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 22px;
        }
        
        .form-column {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .form-column label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
        }
        
        .form-column select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 15px;
            transition: all 0.2s;
            height: 42px;
        }
        
        .form-column select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        
        #form-group-idSub {
            display: none;
            transition: all 0.3s ease;
        }
        
        #form-group-idSub.show {
            display: block;
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
        <div class="table-area" id="input-kata-content">
    <div class="input-kata-form">
        <h2>Input Kata Baru</h2>

        <form id="inputKataForm">

            <div class="form-group">
                <label for="idKata">Id Kata</label>
                <input type="text" id="idKata" class="readonly" value="{{ $autoId }} (Auto Generated)" readonly>
            </div>

            <div class="form-group" id="form-group-idSub">
                <label for="idSub">ID Sub (Kata Utama)</label>

                <div class="custom-dropdown" id="idSub-dropdown">
                    <div class="dropdown-select" id="idSub-select">
                        <span class="selected-text">Cari atau pilih ID Sub</span>
                    </div>
                    <div class="dropdown-options" id="idSub-options">
                        <div class="search-box">
                            <input type="text" placeholder="Cari ID Sub..." id="idSub-search">
                        </div>
                        <div class="options-list" id="idSub-list">
    @if ($KataUtama) 
        @foreach ($KataUtama as $item)
            <div class="dropdown-option" data-value="{{ $item->idKata }}">
                {{ $item->idKata }} - {{ $item->kata }}
            </div>
        @endforeach
    @endif
</div>


                    </div>
                </div>

                <input type="hidden" id="idSub" name="idSub">
                <div class="example">Diisi jika Jenis Kata adalah 'Kata Turunan'.</div>
            </div>

            <div class="form-row">
                <div class="form-column">
                    <label for="jenisKata">Jenis Kata</label>
                    <select name="jenis_kata" id="jenisKata" required>
                        <option value="">Pilih Jenis Kata</option>
                        <option value="utama">Kata Utama</option>
                        <option value="turunan">Kata Turunan</option>
                    </select>
                </div>

                <div class="form-column">
                    <label for="kategoriKata">Kategori Kata</label>
                    <select name="kategori_kata" id="kategoriKata" required>
                        <option value="">Pilih Kategori Kata</option>
                        <option value="kata_benda">Kata Benda (noun)</option>
                        <option value="kata_kerja">Kata Kerja (verb)</option>
                        <option value="kata_sifat">Kata Sifat (adjective)</option>
                        <option value="kata_keterangan">Kata Keterangan (adverb)</option>
                        <option value="kata_ganti">Kata Ganti (pronoun)</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="kata">Kata</label>
                <input type="text" id="kata" placeholder="Masukkan kata baru" required>
            </div>

            <div class="form-group">
                <label for="caraBaca">Cara Baca</label>
                <input type="text" id="caraBaca" placeholder="Contoh: {a-ba-a-ba}" required>
                <div class="example">Format: {suku-kata-1-suku-kata-2}</div>
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

            <div class="form-buttons">
                <button type="reset" class="btn-cancel">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
            </div>

        </form>

    </div>
</div>

    </div>
</div>
<script>
    const kataUtamaList = [
        @foreach ($KataUtama as $ku)
            {
                id: "{{ $ku->id_kata }}",
                text: "{{ $ku->id_kata }} - {{ $ku->kata }}"
            },
        @endforeach
    ];
</script>

<script>
    
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
        const jenisKata = document.getElementById('jenisKata').value;
        const subIdGroup = document.getElementById('form-group-idSub');

        if (jenisKata === 'turunan') {
            // Jika memilih 'Kata Turunan', tampilkan Sub Id
            subIdGroup.classList.add('show');
            document.getElementById('idSub').setAttribute('required', 'required');
        } else {
            // Jika memilih 'Kata Utama' atau kosong, sembunyikan Sub Id
            subIdGroup.classList.remove('show');
            document.getElementById('idSub').removeAttribute('required');
            // Reset dropdown
            document.getElementById('idSub-select').querySelector('.selected-text').textContent = 'Cari atau pilih ID Sub';
            document.getElementById('idSub').value = '';
        }
    }

    // Event listener untuk form submission
    document.getElementById('inputKataForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    let jenisKata = document.getElementById('jenisKata').value;
    const data = {
        id_kata: document.getElementById('idKata').value,
        id_sub: jenisKata === 'turunan' ? document.getElementById('idSub').value : document.getElementById('idKata').value.split(' ')[0],
        jenis_kata: document.getElementById('jenisKata').value,
        kategori_kata: document.getElementById('kategoriKata').value,
        kata: document.getElementById('kata').value,
        cara_baca: document.getElementById('caraBaca').value,
        definisi: document.getElementById('definisi').value,
        status: document.querySelector('input[name="status"]:checked').value,
    };

    try {
        const response = await fetch(`/kontributor/entry-kata/tambah`, {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    body: JSON.stringify(data)
});

        const result = await response.json();

        if (response.ok) {
            // alert("Kata berhasil disimpan!");
            e.target.reset();
        } else {
            alert(result.message || "Terjadi kesalahan saat menyimpan data.");
        }
    } catch (error) {
        console.error(error);
        alert("Gagal mengirim data. Periksa koneksi atau server.");
    }
});


    // Event listener untuk tombol batal
    document.querySelector('.btn-cancel').addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin membatalkan pengisian form?')) {
            document.getElementById('inputKataForm').reset();
            document.getElementById('idSub-select').querySelector('.selected-text').textContent = 'Cari atau pilih ID Sub';
            document.getElementById('idSub').value = '';
            toggleSubId();
        }
    });

    // Event listener untuk perubahan jenis kata
    document.getElementById('jenisKata').addEventListener('change', function() {
        toggleSubId();
    });

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
        
        // Inisialisasi komponen lainnya
        toggleSubId();
        initSubIdDropdown();
    });
</script>

</body>
</html>