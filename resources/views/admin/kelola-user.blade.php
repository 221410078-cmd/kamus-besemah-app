<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Daftar Pengguna</title>
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
            color: #508ba0;
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
        }
        
        .user-info img {
            width: 65px;
            height: 65px;
            margin-right: 10px;
            border-radius: 50%;
            object-fit: cover;
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
        /* == SIDEBAR YANG DIPERBAIKI =============================== */
        /* ========================================================== */
        .sidebar {
            width: 185px;
            background-color: #508ba0;
            border-right: 1px solid #B0B0B0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
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
        }
        
        .content-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .content-card h2 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.4rem;
        }
        
        /* ========================================================== */
        /* == SISTEM PENCARIAN YANG DIPERBAIKI ====================== */
        /* ========================================================== */
        .search-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
            flex-grow: 1;
            min-width: 250px;
            max-width: 400px;
        }
        
        .search-input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #508ba0;
            background-color: white;
            box-shadow: 0 0 0 2px rgba(80, 139, 160, 0.2);
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .filter-select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: white;
            font-size: 0.9rem;
            cursor: pointer;
            transition: border-color 0.3s;
        }
        
        .filter-select:focus {
            outline: none;
            border-color: #508ba0;
        }
        
        /* Tombol Tambah Pengguna - dipindahkan ke samping filter */
        .add-user-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background-color: rgb(126, 170, 211);
            color: #ffffff;
            border: 1px solid #b0b0b0;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
            white-space: nowrap;
        }
        
        .add-user-btn:hover {
            background-color: #508ba0;
        }
        
        /* ========================================================== */
        /* == STYLING TABEL PENGGUNA YANG DIPERBAIKI ================ */
        /* ========================================================== */
        .table-container {
            overflow-x: auto;
            margin-top: 10px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .user-table th {
            background: linear-gradient(135deg, #508ba0 0%, #508ba0 100%);
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 15px 12px;
            border: 1px solid #3a5a6a;
            text-align: left;
            position: relative;
            border-bottom: 2px solid #3a5a6a;
        }

        .user-table th:first-child {
            border-top-left-radius: 4px;
        }

        .user-table th:last-child {
            border-top-right-radius: 4px;
        }

        .user-table th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
        }

        .user-table td {
            padding: 12px 12px;
            border: 1px solid #e0e0e0;
            font-size: 0.95rem;
            color: #333;
            vertical-align: middle;
        }

        .user-table tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }

        .user-table tr:nth-child(even) {
            background-color: #fafafa;
        }

        .user-table tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .user-table tr:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Kolom spesifik */
        .user-table td:first-child {
            font-weight: 600;
            color: #2c3e50;
        }

        .user-table .aksi-kolom {
            width: 120px;
            text-align: center;
            white-space: nowrap;
        }

        /* Status styling */
        .status-aktif {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .status-nonaktif {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        /* Ikon aksi */
        .action-icon {
            margin: 0 3px;
            padding: 8px;
            border: 1px solid;
            border-radius: 6px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .action-icon.edit-icon {
            color: #3498db;
            border-color: #3498db;
            background-color: rgba(52, 152, 219, 0.1);
        }

        .action-icon.edit-icon:hover {
            background-color: #3498db;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 3px 6px rgba(52, 152, 219, 0.3);
        }

        .action-icon.delete-icon {
            color: #e74c3c;
            border-color: #e74c3c;
            background-color: rgba(231, 76, 60, 0.1);
        }

        .action-icon.delete-icon:hover {
            background-color: #e74c3c;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 3px 6px rgba(231, 76, 60, 0.3);
        }

        /* Role styling */
        .role-admin {
            color: #e74c3c;
            font-weight: 600;
        }

        .role-validator {
            color: #f39c12;
            font-weight: 600;
        }

        .role-kontributor {
            color: #27ae60;
            font-weight: 600;
        }

        /* Email styling */
        .user-table td:nth-child(4) {
            color: #7f8c8d;
            font-style: italic;
        }

        .user-table td:nth-child(4):empty::before {
            content: "-";
            color: #bdc3c7;
        }

        /* Styling untuk kolom tanggal */
        .date-cell {
            font-size: 0.85rem;
            color: #6c757d;
        }

        /* Animasi untuk baris baru */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-table tbody tr {
            animation: fadeIn 0.5s ease;
        }

        /* ========================================================== */
        /* == MODAL (FORM UMUM) ===================================== */
        /* ========================================================== */
        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #D3D3D3;
            margin: auto;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
            border-radius: 0px;
            overflow: hidden;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            background-color: #C0C0C0;
            border-bottom: 1px solid #B0B0B0;
            font-weight: bold;
            color: #000000; /* Mengubah warna teks header modal menjadi hitam */
        }

        .close-btn {
            color: #333;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            padding: 5px;
            line-height: 1;
            transition: color 0.3s;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: #000;
            text-decoration: none;
        }
        
        .modal-body {
            padding: 15px;
            background-color: #D3D3D3;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #000000; /* Mengubah warna teks label menjadi hitam */
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #B0B0B0;
            border-radius: 0;
            background-color: #fff;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
            color: #000000; /* Mengubah warna teks input menjadi hitam */
        }
        
        /* ========================================================== */
        /* == STYLING UNTUK TOGGLE PASSWORD ========================= */
        /* ========================================================== */
        .password-container {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            z-index: 10;
            background: white;
            padding: 5px;
            border-radius: 3px;
            transition: color 0.3s;
        }
        
        .toggle-password:hover {
            color: #508ba0;
        }
        
        .password-container input {
            padding-right: 40px;
        }
        
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            padding: 10px 15px;
            background-color: #D3D3D3;
            border-top: 1px solid #B0B0B0;
            gap: 10px;
        }

        .modal-footer button {
            padding: 8px 15px;
            border: 1px solid #999;
            border-radius: 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .modal-footer .btn-tutup {
            background-color: #ac2222;
            color: #ffffff;
        }

        .modal-footer .btn-simpan {
            background-color: #4bb0eb;
            color: #ffffff;
            border-color: #999;
        }

        .modal-footer button:hover {
            background-color: #E0E0E0;
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
            
            .sidebar ul {
                display: flex;
            }
            
            .sidebar li {
                flex-shrink: 0;
                min-width: 150px;
                border-bottom: none;
            }
            
            .sidebar li.active {
                border-left: none;
                border-bottom: 3px solid #4CAF50;
            }
             .sidebar li.active a {
                padding-left: 20px;
            }
            
            /* Responsive tabel */
            .user-table {
                font-size: 0.85rem;
            }
            
            .user-table th,
            .user-table td {
                padding: 10px 8px;
            }
            
            .user-table th:nth-child(4),
            .user-table td:nth-child(4),
            .user-table th:nth-child(5),
            .user-table td:nth-child(5) {
                display: none;
            }
            
            .aksi-kolom {
                width: 90px;
            }

            
.aksi-kolom form {
    display: inline;
    padding: 0;
    margin: 0;
}

.aksi-kolom .action-icon {
    display: inline-block;
    margin-left: 6px;
    cursor: pointer;
}
            
            .action-icon {
                width: 28px;
                height: 28px;
                margin: 0 2px;
                padding: 6px;
            }
            
            .status-aktif,
            .status-nonaktif {
                padding: 4px 8px;
                font-size: 0.75rem;
            }
            
            .header {
                flex-direction: column;
                gap: 10px;
            }
            
            .modal-content {
                width: 95%;
            }
            
            .search-container {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box {
                max-width: 100%;
            }
            
            /* Responsive untuk tombol tambah pengguna */
            .add-user-btn {
                width: 100%;
                justify-content: center;
                margin-top: 10px;
            }
        }

        @media (max-width: 480px) {
            .user-table {
                font-size: 0.8rem;
            }
            
            .user-table th,
            .user-table td {
                padding: 8px 6px;
            }
            
            .user-table th:nth-child(3),
            .user-table td:nth-child(3),
            .user-table th:nth-child(5),
            .user-table td:nth-child(5) {
                display: none;
            }
            
            .aksi-kolom {
                width: 80px;
            }
            
            .action-icon {
                width: 26px;
                height: 26px;
                margin: 0 1px;
                padding: 5px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <x-header-admin />
    <div class="main-content">
        <x-sidebar-admin />
        <main class="table-area">
            <div class="content-card">
                <h2>Daftar Pengguna</h2>
                
                <!-- Sistem Pencarian yang Diperbaiki -->
                <div class="search-container">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" id="searchInput" placeholder="Cari pengguna berdasarkan username, email, atau role...">
                    </div>
                    
                    <div class="filter-group">
                        <select class="filter-select" id="roleFilter">
                            <option value="">Semua Role</option>
                            <option value="admin">Admin</option>
                            <option value="validator">Validator</option>
                            <option value="kontributor">Kontributor</option>
                        </select>
                        
                        <select class="filter-select" id="statusFilter">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                        
                        <!-- Tombol Tambah Pengguna dipindahkan ke sini -->
                        <button class="add-user-btn" id="openModalBtn">
                            <i class="fas fa-plus"></i> Tambah Pengguna
                        </button>
                    </div>
                </div>
                
                <div class="table-container">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Email</th>
                                <th>Tanggal Dibuat</th>
                                <th class="aksi-kolom">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
    @foreach($users as $user)
        <tr data-user-id="{{ $user->id }}" data-role="{{ $user->role }}" data-username="{{ $user->username }}" data-email="{{ $user->email }}" data-status="{{ $user->status === 'active' ? 'aktif' : 'nonaktif' }}"
        >
            <td>{{ $user->username }}</td>
            <td class="role-{{ $user->role }}">{{ $user->role }}</td>
            
            <td>
            <span class="status-{{ $user->status === 'active' ? 'aktif' : 'nonaktif' }}">
        {{ $user->status === 'active' ? 'AKTIF' : 'NONAKTIF' }}
    </span>
</td>

            <td>{{ $user->email }}</td>
            <td class="date-cell">
                {{ $user->created_at->format('d/m/Y') }}
            </td>

            <td class="aksi-kolom">
                <span class="action-icon edit-icon openEditModal" 
                      title="Edit"
                      data-bs-toggle="modal"
                      data-bs-target="#editUserModal{{ $user->id }}">
                    <i class="fas fa-pencil-alt"></i>
                
                </span>
                
        <span class="action-icon delete-icon" 
              title="Hapus"
        >
            <i class="fas fa-trash-alt"></i>
        </span>
            </td>
        </tr>
    @endforeach
</tbody>

                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

@if ($errors->any())
    <script>
        let msg = "";
        @foreach ($errors->all() as $err)
            msg += "- {{ $err }}\n";
        @endforeach
        alert("Validasi gagal:\n\n" + msg);
    </script>
@endif

<!-- Modal Tambah Pengguna -->
<div id="tambahPenggunaModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <span>Tambah Pengguna</span>
            <span class="close-btn closeModalBtn" data-modal="tambahPenggunaModal">&times;</span>
        </div>
        <form id="formTambahPengguna" action="{{ route('kelola-user.tambah') }}" method="POST">
    @csrf
    <div class="modal-body">

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" id="username_tambah" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" id="email_tambah" required>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" id="role_tambah" required>
                <option value="">Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="validator">Validator</option>
                <option value="kontributor">Kontributor</option>
            </select>
        </div>

        <div class="form-group">
                    <label for="password_tambah">Password :</label>
                    <div class="password-container">
                        <input type="password" id="password_tambah" name="password" required>
                        <span class="toggle-password" id="togglePasswordTambah">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>

        <input type="hidden" name="status" value="active">
    </div>

    <div class="modal-footer">
        <button type="button" class="btn-tutup closeModalBtn" data-modal="tambahPenggunaModal">Tutup</button>
        <button type="submit" id="simpanTambahPengguna" class="btn-simpan">Simpan</button>
    </div>
</form>

    </div>
</div>

<!-- Modal Edit Pengguna -->
<div id="editPenggunaModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <span>Edit Pengguna</span> 
            <span class="close-btn closeModalBtn" data-modal="editPenggunaModal">&times;</span>
        </div>
        <div class="modal-body">
            <form id="formEditPengguna" method="POST">
            @csrf
            @method('PUT')
                <input type="hidden" id="edit_user_id" name="id"> 
                
                <div class="form-group">
                    <label for="edit_username">Username :</label>
                    <input type="text" id="edit_username" name="username" readonly> 
                </div>
                
                <div class="form-group">
                    <label for="edit_email">Email :</label>
                    <input type="email" id="edit_email" name="email">
                </div>
                
                <div class="form-group">
                    <label for="edit_role">Role :</label>
                    <select id="edit_role" name="role">
                        <option value="admin">Admin</option>
                        <option value="validator">Validator</option>
                        <option value="kontributor">Kontributor</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="edit_password">Password Baru (kosongkan jika tidak diubah) :</label>
                    <div class="password-container">
                        <input type="password" id="edit_password" name="password">
                        <span class="toggle-password" id="togglePasswordEdit">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn-tutup closeModalBtn" data-modal="editPenggunaModal">Tutup</button>
            <button type="submit" class="btn-simpan" id="simpanEditPengguna">Simpan Perubahan</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ==========================================================
        // == FUNGSI LOGOUT & REDIRECT KE LOGIN =====================
        // ==========================================================
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
        
        // ==========================================================
        // == SIDEBAR NAVIGATION ===================================
        // ==========================================================
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
                menuItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // ==========================================================
        // == SISTEM PENCARIAN YANG DIPERBAIKI ======================
        // ==========================================================
        const searchInput = document.getElementById('searchInput');
        const roleFilter = document.getElementById('roleFilter');
        const statusFilter = document.getElementById('statusFilter');
        const userTableBody = document.getElementById('userTableBody');
        
        function filterUsers() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedRole = roleFilter.value;
            const selectedStatus = statusFilter.value;
            
            const rows = userTableBody.querySelectorAll('tr');
            
            rows.forEach(row => {
                const username = row.getAttribute('data-username').toLowerCase();
                const email = row.getAttribute('data-email').toLowerCase();
                const role = row.getAttribute('data-role');
                const status = row.getAttribute('data-status');
                
                const matchesSearch = username.includes(searchTerm) || 
                                    email.includes(searchTerm) || 
                                    role.includes(searchTerm);
                const matchesRole = !selectedRole || role === selectedRole;
                console.log(status);
                const matchesStatus = !selectedStatus || status === selectedStatus;
                
                if (matchesSearch && matchesRole && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        
        // Event listeners untuk pencarian dan filter
        searchInput.addEventListener('input', filterUsers);
        roleFilter.addEventListener('change', filterUsers);
        statusFilter.addEventListener('change', filterUsers);
        
        // ==========================================================
        // == TOGGLE PASSWORD VISIBILITY ============================
        // ==========================================================
        function setupPasswordToggle(toggleId, passwordId) {
            const togglePassword = document.getElementById(toggleId);
            const passwordInput = document.getElementById(passwordId);
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    // Toggle type antara password dan text
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Toggle icon mata
                    const icon = this.querySelector('i');
                    if (type === 'text') {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            }
        }
        
        // Setup toggle untuk form tambah dan edit
        setupPasswordToggle('togglePasswordTambah', 'password_tambah');
        setupPasswordToggle('togglePasswordEdit', 'edit_password');
        
        // ==========================================================
        // == UTILITY FUNCTION: KONTROL MODAL UMUM ==================
        // ==========================================================
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'flex';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
            }
        }

        // ==========================================================
        // == FUNGSI FORMAT TANGGAL =================================
        // ==========================================================
        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }

        function getCurrentDate() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // ==========================================================
        // == LOGIKA MODAL "TAMBAH PENGGUNA" ========================
        // ==========================================================
const tambahModalId = 'tambahPenggunaModal';
const openTambahBtn = document.getElementById('openModalBtn');
const simpanTambahBtn = document.getElementById('simpanTambahPengguna');
const formTambahPengguna = document.getElementById('formTambahPengguna');

if (openTambahBtn) {
    openTambahBtn.addEventListener('click', function () {
        formTambahPengguna.reset();
        openModal(tambahModalId);
    });
}

if (simpanTambahBtn) {
    simpanTambahBtn.addEventListener('click', async function (e) {
        e.preventDefault();

        if (!formTambahPengguna.checkValidity()) {
            alert('Harap isi semua field yang diperlukan!');
            return;
        }
         // Ambil data dari form
        const username = document.getElementById('username_tambah').value;
        const email = document.getElementById('email_tambah').value;
        const role = document.getElementById('role_tambah').value;
        const password = document.getElementById('password_tambah').value;

        const formData = new FormData(formTambahPengguna);

        try {
        const response = await fetch("{{ route('kelola-user.tambah') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        },
        body: formData
    });

    const result = await response.json();

    if (response.ok && result.success) {
        alert(`Pengguna ${result.data.username} berhasil ditambahkan!`);
        formTambahPengguna.reset();
        closeModal(tambahModalId);
        
                const user = result.data;
                const currentDate = getCurrentDate();
                const formattedDate = formatDate(currentDate);

                const newRow = document.createElement('tr');
                newRow.setAttribute('data-user-id', user.id);
        newRow.setAttribute('data-username', user.username);
        newRow.setAttribute('data-email', user.email);
        newRow.setAttribute('data-role', user.role);
        newRow.setAttribute('data-status', user.status);
                newRow.innerHTML = `
                    <td>${user.username}</td>
                    <td class="role-${user.role}">${user.role}</td>
                    <td><span class="status-${user.status === 'active' ? 'aktif' : 'nonaktif'}">${user.status === 'active' ? 'AKTIF' : 'NONAKTIF'}</span></td>
                    <td>${user.email}</td>
                    <td class="date-cell">${formattedDate}</td>
                    <td class="aksi-kolom">
                        <span class="action-icon edit-icon openEditModal" title="Edit">
                            <i class="fas fa-pencil-alt"></i>
                        </span>
                        <span class="action-icon delete-icon" title="Hapus">
                            <i class="fas fa-trash-alt"></i>
                        </span>
                    </td>
                `;

                if (userTableBody) {
                    userTableBody.appendChild(newRow);
                    attachRowEventListeners(newRow);
                } else {
                    console.warn("⚠️ Elemen #userTableBody tidak ditemukan di DOM!");
                }
    } else {
        if (result.errors) {
            const msg = Object.values(result.errors)
                .flat()
                .join("\n");
            alert(msg);
        } else {
            alert(result.message || "❌ Terjadi kesalahan saat menyimpan data!");
        }
    }

} catch (error) {
    console.error("Error:", error);
    alert("❌ Gagal mengirim data ke server!");
}

    });
}

        
        // ==========================================================
        // == LOGIKA MODAL "EDIT PENGGUNA" ==========================
        // ==========================================================
        const editModalId = 'editPenggunaModal';
        const simpanEditBtn = document.getElementById('simpanEditPengguna');
        const formEditPengguna = document.getElementById('formEditPengguna');
        
        // Fungsi untuk melampirkan event listener ke baris
        function attachRowEventListeners(row) {
            // Edit icon
            const editIcon = row.querySelector('.openEditModal');
            if (editIcon) {
                editIcon.addEventListener('click', function() {
                    openEditModal(row);
                });
            }
            
            // Delete icon
            const deleteIcon = row.querySelector('.action-icon.delete-icon');
            if (deleteIcon) {
                deleteIcon.addEventListener('click', function(event) {
                    event.preventDefault();
                    deleteUser(row);
                });
            }
        }
        
        // Fungsi untuk membuka modal edit
        function openEditModal(row) {
    const userId = row.getAttribute('data-user-id');
    const username = row.getAttribute('data-username');
    const email = row.getAttribute('data-email');
    const role = row.getAttribute('data-role');


    // Isi field modal
    document.getElementById('edit_user_id').value = userId;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_role').value = role;

    // Reset password + toggle icon
    const toggleIcon = document.querySelector('#togglePasswordEdit i');
    toggleIcon.classList.remove('fa-eye-slash');
    toggleIcon.classList.add('fa-eye');
    document.getElementById('edit_password').type = 'password';
    document.getElementById('edit_password').value = '';

    openModal(editModalId);
}
        
        // Simpan perubahan edit pengguna
        if (simpanEditBtn) {
        simpanEditBtn.addEventListener('click', async function (e) {
        e.preventDefault();

        // Ambil data dari form edit
        const formData = new FormData(formEditPengguna);
        const username = formData.get('username');
        const email = formData.get('email');
        const role = formData.get('role');
        const password = formData.get('password');
        const id = formData.get('id'); 

        try {
            const response = await fetch(`/admin/kelola-user/update/${id}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok && result.success) {
               
                const rows = document.querySelectorAll('#userTableBody tr');
                let targetRow = null;
                
                rows.forEach(row => {
                    if (row.getAttribute('data-username') === username) {
                        targetRow = row;
                    }
                });
                
                if (targetRow) {
                    // Update data di baris
                    targetRow.setAttribute('data-email', email);
                    targetRow.setAttribute('data-role', role);
                    
                    // Update tampilan tabel
                    const cells = targetRow.querySelectorAll('td');
                    cells[0].textContent = username;
                    cells[1].textContent = role;
                    cells[1].className = `role-${role}`;
                    cells[3].textContent = email;
                    
                    // Jika password diisi, update password (dalam implementasi nyata, ini akan dikirim ke server)
                    if (password) {
                        alert(`Password untuk ${username} telah diubah.`);
                    }
                    
                    // Tutup modal
                    closeModal(editModalId);
                    
                    // Reset form
                    formEditPengguna.reset();
                    
                    alert(`Perubahan untuk ${username} berhasil disimpan!`);
                }
            } else {
                if (result.errors) {
                    const msg = Object.values(result.errors).flat().join("\n");
                    alert(msg);
                } else {
                    alert(result.message || "❌ Gagal memperbarui data!");
                }
            }

        } catch (error) {
            console.error("Error:", error);
            alert("❌ Gagal mengirim data ke server!");
        }
    });
}
        
        // ==========================================================
        // == LOGIKA AKSI "HAPUS PENGGUNA" ==========================
        // ==========================================================
        

        async function deleteUser(row) {
    const username = row.getAttribute('data-username');
    const userId = row.getAttribute('data-user-id');

    const confirmed = confirm(`Apakah Anda yakin ingin menghapus pengguna "${username}"?`);

    if (!confirmed) {
        alert(`❌ Aksi dibatalkan: Pengguna ${username} tidak jadi dihapus.`);
        return;
    }

    try {
        const response = await fetch(`/admin/kelola-user/hapus/${userId}`, {
    method: "DELETE",
    headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
        "Accept": "application/json"
    }
});


        const result = await response.json();

        if (response.ok && result.success) {
            alert(`✅ Pengguna ${username} berhasil dihapus!`);
            row.remove();
        } else {
            alert(result.message || "❌ Terjadi kesalahan saat menghapus pengguna!");
        }

    } catch (error) {
        console.error("Error:", error);
        alert("❌ Gagal menghapus pengguna dari server!");
    }
}



        // ==========================================================
        // == LOGIKA PENUTUPAN MODAL UNIVERSAL ======================
        // ==========================================================
        // Dapatkan semua tombol/ikon penutup
        const closeBtns = document.querySelectorAll('.closeModalBtn');
        closeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Ambil ID modal dari atribut data-modal
                const modalIdToClose = this.getAttribute('data-modal');
                if (modalIdToClose) {
                    closeModal(modalIdToClose);
                }
            });
        });

        // Tutup saat klik di luar modal (overlay)
        window.addEventListener('click', function(event) {
            // Periksa jika yang diklik adalah modal-overlay
            if (event.target.classList.contains('modal-overlay')) {
                closeModal(event.target.id);
            }
        });
        
        // ==========================================================
        // == INISIALISASI EVENT LISTENERS UNTUK BARIS YANG ADA =====
        // ==========================================================
        const existingRows = document.querySelectorAll('#userTableBody tr');
        existingRows.forEach(row => {
            attachRowEventListeners(row);
        });
    });
</script>

</body>
</html>