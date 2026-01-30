<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="/dashboard">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Interface</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Kelola
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href={{ '/dashboard/produk' }}>Produk</a>
                    <a class="nav-link" href={{ '/dashboard/kategori' }}>Kategori</a>
                    {{-- <a class="nav-link" href={{ '/dashboard/bank' }}>Bank</a> --}}
                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#lokasi"
                aria-expanded="false" aria-controls="lokasi">
                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-map-marker-alt"></i></div>
                Lokasi
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="lokasi" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href={{ '/dashboard/provinsi' }}>Provinsi</a>
                    <a class="nav-link" href={{ '/dashboard/kota' }}>Kota</a>

                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                Pemesanan
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link" href={{ url('/dashboard/pesananbaru') }}>Pesanan Baru</a>
                    <a class="nav-link" href={{ url('/dashboard/pesanandiproses') }}>Pesanan Diproses</a>
                    <a class="nav-link" href={{ url('/dashboard/pesanandalampengiriman') }}>Dalam Pengiriman</a>
                    <a class="nav-link" href={{ url('/dashboard/pesanandibatalkan') }}>Pesanan Dibatalkan</a>
                    <a class="nav-link" href={{ url('/dashboard/pesananselesai') }}>Pesanan Selesai</a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Laporan"
                aria-expanded="false" aria-controls="Laporan">
                <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                Laporan
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="Laporan" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link" href={{ '/dashboard/laporan' }}>Laporan Penjualan</a>
                </nav>
            </div>
</nav>
