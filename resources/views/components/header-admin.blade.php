<header class="header">
    <div class="user-info">
        <img src="{{ asset('img/55.png') }}"
             class="img-fluid rounde-cirlce"
             style="width: 65px; height: 65px; margin-right: 10px; border-radius: 50%">
        
        <span class="user-name">
        {{ strtoupper(match (Auth::user()->role) {
    'admin' => 'admin',
    'validator' => 'validator',
    'kontributor' => 'kontributor',
    default => 'pengguna',
}) }}<br>{{ Auth::user()->username }}
        </span>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button class="logout-btn" id="logoutBtn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </form>
</header>
