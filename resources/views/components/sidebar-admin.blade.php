<aside class="sidebar">
    <nav>
        <ul>
            <li class="menu-item {{ request()->is('admin/kelola-user*') ? 'active' : '' }}">
                <a href="kelola-user">
                    <i class="fas fa-users menu-icon"></i> Kelola User
                </a>
            </li>

            <li class="menu-title open" id="kelolaKamusToggle">
                <span>
                    <i class="fas fa-book menu-icon"></i>Kelola Kamus
                </span>
                <i class="fas fa-chevron-down"></i>
            </li>

            <ul class="submenu">
                <li class="menu-item {{ request()->is('admin/kelola-kamus*') ? 'active' : '' }}">
                    <a href="kelola-kamus">
                        Daftar Kamus Besemah
                    </a>
                </li>

                <li class="menu-item {{ request()->is('admin/entry-kata*') ? 'active' : '' }}">
                    <a href="entry-kata">
                        Input Kata
                    </a>
                </li>

                <li class="menu-item {{ request()->is('admin/entry-kalimat*') ? 'active' : '' }}">
                    <a href="entry-kalimat">
                        Input Kalimat
                    </a>
                </li>
            </ul>

            <li class="menu-item {{ request()->is('admin/admin-validasi*') ? 'active' : '' }}">
                <a href="{{ route('admin-validasi') }}">
                    <i class="fas fa-share-square menu-icon"></i> Validasi
                </a>
            </li>
        </ul>
    </nav>
</aside>
