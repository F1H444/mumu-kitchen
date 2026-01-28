<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Utama</div>
            <a class="nav-link" href="/profile">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Profil Saya
            </a>
            <div class="sb-sidenav-menu-heading">Transaksi</div>
            <a class="nav-link" href="/riwayat">
                <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                Riwayat Pesanan
            </a>

            <div class="sb-sidenav-menu-heading">Aks</div>
            <a class="nav-link" href="/">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                Kembali ke Beranda
            </a>

            <a class="nav-link" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                Logout
            </a>
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ auth()->user()->name }}
    </div>
</nav>
