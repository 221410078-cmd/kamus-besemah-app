<div class="sidebar">
                <ul>
                    <li class="menu-item  {{ request()->is('kontributor/entry-kata*') ? 'active' : '' }}">
                        <a href="entry-kata">
                            <i class="fas fa-file-alt menu-icon"></i> Input Kata
                        </a>
                    </li>
                    <li class="menu-item  {{ request()->is('kontributor/entry-kalimat*') ? 'active' : '' }}">
                        <a href="entry-kalimat">
                            <i class="fas fa-file menu-icon"></i> Input Kalimat
                        </a>
                    </li>
                    <li class="menu-item  {{ request()->is('kontributor/manajemen-edit*') ? 'active' : '' }}">
                        <a href="manajemen-edit">
                            <i class="fas fa-edit menu-icon"></i> Manajemen Edit
                        </a>
                    </li>
                    <li class="menu-item  {{ request()->is('kontributor/status*') ? 'active' : '' }}">
                        <a href="status">
                            <i class="fas fa-eye menu-icon"></i> Data Kamus Besemah
                        </a>
                    </li>
                </ul>
            </div>