@extends('front.layouts.main')

@section('style')
    <style>
        :root {
            --primary: #FF8C00;
            --primary-glow: rgba(255, 140, 0, 0.4);
            --accent: #FF3B3B;
            --dark: #050505;
            --surface: #101010;
            --glass: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-main: #FFFFFF;
            --text-dim: #bbbbbb;
            --font-main: 'Outfit', sans-serif;
            --transition: all 0.3s cubic-bezier(0.2, 1, 0.3, 1);
        }

        body {
            background-color: var(--dark);
            color: var(--text-main);
            font-family: var(--font-main);
        }

        .page-header {
            padding: 150px 0 60px;
            background: var(--dark);
            text-align: center;
            border-bottom: none;
        }

        .page-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 20px;
            color: #fff;
            text-shadow: 0 0 30px rgba(255, 140, 0, 0.3);
        }

        .breadcrumb-custom {
            display: inline-flex;
            gap: 10px;
            background: var(--glass);
            padding: 8px 20px;
            border-radius: 50px;
            border: 1px solid var(--glass-border);
            font-size: 0.9rem;
            color: var(--text-dim);
        }

        .breadcrumb-custom a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        /* Sidebar */
        .sidebar {
            background: var(--surface);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 25px;
            position: sticky;
            top: 100px;
        }

        .sidebar-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #fff;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--glass-border);
        }

        .category-list a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            color: var(--text-dim);
            text-decoration: none;
            border-radius: 12px;
            transition: var(--transition);
            margin-bottom: 5px;
            font-weight: 500;
        }

        .category-list a:hover,
        .category-list a.active {
            background: rgba(255, 140, 0, 0.1);
            color: var(--primary);
            padding-left: 20px;
        }

        /* Product Card */
        .product-card {
            background: var(--surface);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            overflow: hidden;
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .product-img-wrap {
            position: relative;
            padding-top: 75%;
            /* 4:3 Aspect Ratio */
            overflow: hidden;
            background: #000;
        }

        .product-img-wrap img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .product-card:hover .product-img-wrap img {
            transform: scale(1.1);
        }

        .product-info {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-cat {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary);
            margin-bottom: 5px;
            font-weight: 700;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .product-title a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .product-title a:hover {
            color: var(--primary);
        }

        .product-price {
            font-family: 'Outfit', sans-serif;
            font-size: 1.25rem;
            font-weight: 800;
            color: #fff;
        }

        .btn-add {
            background: var(--glass);
            color: #fff;
            border: 1px solid var(--glass-border);
            padding: 10px;
            border-radius: 12px;
            text-align: center;
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
            font-weight: 600;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-add:hover {
            background: var(--primary);
            border-color: var(--primary);
            transform: scale(1.1);
        }

        /* Pagination */
        .pagination {
            justify-content: center;
            margin-top: 50px;
            gap: 10px;
        }

        .page-item .page-link {
            background: var(--surface);
            border: 1px solid var(--glass-border);
            color: #fff;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: var(--transition);
        }

        .page-item.active .page-link,
        .page-item .page-link:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff !important;
        }
    </style>
@endsection

@section('container')
    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title animate-fade-up">{{ $kategori->nama_kategori }}</h1>
            <div class="breadcrumb-custom animate-fade-up delay-100">
                <a href="/">Beranda</a>
                <span>/</span>
                <a href="/produk">Menu</a>
                <span>/</span>
                <span>{{ $kategori->nama_kategori }}</span>
            </div>
        </div>
    </header>

    <section class="ftco-section pt-0">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="sidebar animate-fade-up delay-200">
                        <h3 class="sidebar-title">Kategori Menu</h3>
                        <div class="category-list">
                            <a href="/produk">
                                <span>Semua Menu</span>
                                <i class="fas fa-chevron-right small"></i>
                            </a>
                            @foreach ($kategoris as $item)
                                <a href="/kategorikatalog/{{ $item->id }}"
                                    class="{{ $item->id == $kategori->id ? 'active' : '' }}">
                                    <span>{{ $item->nama_kategori }}</span>
                                    <i class="fas fa-chevron-right small"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9">
                    <!-- Product Grid -->
                    <div class="row g-4 pt-4">
                        @if ($produk->count() > 0)
                            @foreach ($produk as $index => $value)
                                <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                                    <div class="product-card">
                                        <a href="/produkdetail/{{ $value->id }}" class="product-img-wrap">
                                            <img src="{{ asset('storage/' . $value->gambar) }}"
                                                alt="{{ $value->nama_produk }}">
                                        </a>
                                        <div class="product-info">
                                            <div>
                                                <div class="product-cat">{{ $value->kategori->nama_kategori }}</div>
                                                <h3 class="product-title">
                                                    <a
                                                        href="/produkdetail/{{ $value->id }}">{{ $value->nama_produk }}</a>
                                                </h3>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div class="product-price">Rp
                                                    {{ number_format($value->harga, 0, ',', '.') }}</div>
                                                <a href="/produkdetail/{{ $value->id }}" class="btn-add">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12 text-center py-5">
                                <i class="fas fa-utensils mb-4" style="font-size: 3rem; color: var(--glass-border);"></i>
                                <h3 class="text-muted">Menu tidak ditemukan</h3>
                                <p class="text-dim">Belum ada menu di kategori ini.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    <div class="row mt-5">
                        <div class="col text-center">
                            {{ $produk->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
