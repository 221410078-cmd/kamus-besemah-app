<nav class="sidebar">
                <ul>
                    <li class="menu-item  {{ request()->is('validator/input-kata*') ? 'active' : '' }}" data-target="input-kata">
                        <a href="input-kata">
                            <i class="fas fa-keyboard menu-icon"></i> Input Kata
                        </a>
                    </li>
                    <li class="menu-item  {{ request()->is('validator/input-kalimat*') ? 'active' : '' }}" data-target="input-kalimat">
                        <a href="input-kalimat">
                            <i class="fas fa-align-left menu-icon"></i> Input Kalimat
                        </a>
                    </li>
                    <li class="menu-item  {{ request()->is('validator/validasi-kata*') ? 'active' : '' }}" data-target="validasi-kata">
                        <a href="validasi-kata">
                            <i class="fas fa-check-circle menu-icon"></i> Validasi Kata
                        </a>
                    </li>
                    <li class="menu-item  {{ request()->is('validator/validasi-kalimat*') ? 'active' : '' }}" data-target="validasi-kalimat">
                        <a href="validasi-kalimat">
                            <i class="fas fa-clipboard-check menu-icon"></i> Validasi Kalimat
                        </a>
                    </li>
                    <li class="menu-item  {{ request()->is('validator/validator-draf*') ? 'active' : '' }}" data-target="data-kamus-besemah">
                         <a href="validator-draf">
                            <i class="fas fa-file-alt menu-icon"></i> Data Kamus Besemah
                        </a>
                    </li>
                </ul>
            </nav>