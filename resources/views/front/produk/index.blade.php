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

        /* Search Bar */
        .search-form {
            position: relative;
            margin-bottom: 40px;
        }

        .search-input {
            width: 100%;
            background: var(--surface);
            border: 1px solid var(--glass-border);
            padding: 20px 25px;
            border-radius: 100px;
            color: #fff;
            font-size: 1rem;
            transition: var(--transition);
            outline: none;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 20px rgba(255, 140, 0, 0.2);
        }

        .search-btn {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary);
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            cursor: pointer;
            transition: var(--transition);
        }

        .search-btn:hover {
            transform: translateY(-50%) scale(1.1);
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
            padding-top: 100%;
            /* 1:1 Aspect Ratio (Square) */
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

        @media (max-width: 991px) {
            .page-title {
                font-size: 2.5rem;
            }

            .sidebar {
                margin-bottom: 40px;
                position: static;
            }
        }
    </style>
    <style>
        .quantity-selector-sm {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            padding: 2px;
        }

        .btn-qty-sm {
            background: transparent;
            border: none;
            color: #fff;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-qty-sm:hover {
            background: var(--primary);
        }

        .input-qty-sm {
            background: transparent;
            border: none;
            color: #fff;
            width: 30px;
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            outline: none;
            padding: 0;
            -moz-appearance: textfield;
        }

        .input-qty-sm::-webkit-outer-spin-button,
        .input-qty-sm::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* New Action Group Style */
        .action-group {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            padding: 4px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .divider-vertical {
            width: 1px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
        }

        .btn-action-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: transparent;
            transition: all 0.2s;
        }

        .btn-action-icon:hover {
            background: var(--primary);
            color: #fff;
        }

        .btn-view-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            background: transparent;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-view-icon:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-color: #fff;
        }
    </style>
@endsection

@section('container')
    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title animate-fade-up">Menu Kami</h1>
            <div class="breadcrumb-custom animate-fade-up delay-100">
                <a href="/">Beranda</a>
                <span>/</span>
                <span>Menu Katering</span>
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
                            <a href="/produk" class="{{ !request('kategori') ? 'active' : '' }}">
                                <span>Semua Menu</span>
                                <i class="fas fa-chevron-right small"></i>
                            </a>
                            @foreach ($kategori as $item)
                                <a href="/kategorikatalog/{{ $item->id }}"
                                    class="{{ request()->segment(2) == $item->id ? 'active' : '' }}">
                                    <span>{{ $item->nama_kategori }}</span>
                                    <i class="fas fa-chevron-right small"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9">
                    <!-- Search -->
                    <form action="{{ url('produk') }}" method="GET" class="search-form animate-fade-up delay-200">
                        <input type="text" name="keyword" class="search-input" placeholder="Cari menu favoritmu..."
                            value="{{ request('keyword') }}">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <!-- Product Grid (Dynamic) -->
                    <div class="row g-4 mb-5 pb-4">
                        @forelse ($produks as $item)
                            <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="product-card">
                                    <a href="{{ url('produkdetail/' . $item->id) }}" class="product-img-wrap">
                                        @php
                                            $imagePath =
                                                $item->gambar && file_exists(public_path('storage/' . $item->gambar))
                                                    ? 'storage/' . $item->gambar
                                                    : 'images/nasi-kebuli.webp'; // Default fallback
                                        @endphp
                                        <img src="{{ asset($imagePath) }}" alt="{{ $item->nama_produk }}">
                                    </a>
                                    <div class="product-info">
                                        <div>
                                            <div class="product-cat">{{ $item->kategori->nama_kategori ?? 'Menu' }}</div>
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ url('produkdetail/' . $item->id) }}">{{ $item->nama_produk }}</a>
                                            </h3>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center gap-2 mt-3">
                                            @php
                                                $hasSizes = $item->ukuran->count() > 0;
                                                $totalStock = $hasSizes
                                                    ? $item->ukuran->sum('pivot.stock')
                                                    : $item->stok;

                                                // If has sizes, we need at least one available size to buy
                                                $firstAvailable = $hasSizes
                                                    ? $item->ukuran->where('pivot.stock', '>', 0)->first()
                                                    : null;
                                                $canBuy = $hasSizes
                                                    ? $totalStock > 0 && $firstAvailable
                                                    : $totalStock > 0;
                                            @endphp

                                            @if ($canBuy)
                                                <div class="action-group">
                                                    <button class="btn-qty-sm" onclick="updateCardQty(this, -1)">-</button>
                                                    <input type="number" class="input-qty-sm" value="1" min="1"
                                                        max="{{ $hasSizes ? $firstAvailable->pivot->stock : $totalStock }}">
                                                    <button class="btn-qty-sm" onclick="updateCardQty(this, 1)">+</button>
                                                    <div class="divider-vertical"></div>
                                                    <button class="btn-action-icon"
                                                        onclick="instantAddToCart(this, '{{ $item->id }}', '{{ $hasSizes ? $firstAvailable->pivot->id : '' }}', '{{ $item->nama_produk }}')">
                                                        <i class="fas fa-shopping-cart" style="font-size: 0.9rem;"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <span class="text-muted small">Stok Habis</span>
                                            @endif
                                            <a href="{{ url('produkdetail/' . $item->id) }}" class="btn-view-icon">
                                                <i class="fas fa-eye" style="font-size: 0.9rem;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <h4 class="text-white">Tidak ada produk ditemukan</h4>
                            </div>
                        @endforelse

                        <div class="col-12 mt-4">
                            {{ $produks->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.updateCardQty = function(btn, change) {
                const container = btn.closest('.action-group');
                if (!container) return;

                const input = container.querySelector('input');
                if (!input) return;

                let newVal = parseInt(input.value) + change;
                if (newVal >= 1) {
                    input.value = newVal;
                }
            };

            window.instantAddToCart = function(btn, produkId, ukuranProdukId, produkName) {
                // Check if user is logged in
                @guest
                if (confirm('Anda harus login terlebih dahulu. Login sekarang?')) {
                    window.location.href = '/login';
                }
                return;
            @endguest

            @auth
            const icon = btn.querySelector('i');
            const originalClass = icon.className;
            icon.className = 'fas fa-spinner fa-spin';
            btn.disabled = true;

            // Find quantity from action group
            let qty = 1;
            const container = btn.closest('.action-group');
            if (container) {
                const qtyInput = container.querySelector('input');
                if (qtyInput) {
                    qty = qtyInput.value;
                }
            }

            const formData = new FormData();
            formData.append('produk_id', produkId);
            formData.append('ukuran_produk_id', ukuranProdukId);
            formData.append('kuantitas', qty);
            formData.append('_token', '{{ csrf_token() }}');

            fetch('/keranjang', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cartCount = document.getElementById('cart-count');
                        if (cartCount && data.cart_count !== undefined) {
                            cartCount.innerText = data.cart_count;
                        }

                        icon.className = 'fas fa-check';
                        btn.style.backgroundColor = '#28a745';
                        btn.style.borderColor = '#28a745';

                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: `${produkName} (${qty} item) ditambahkan ke keranjang`,
                                showConfirmButton: false,
                                timer: 1500,
                                toast: true,
                                position: 'top-end',
                                background: '#1a1a1a',
                                color: '#fff'
                            });
                        }

                        setTimeout(() => {
                            icon.className = originalClass;
                            btn.disabled = false;
                            btn.style.backgroundColor = '';
                            btn.style.borderColor = '';
                        }, 1000);
                    } else {
                        throw new Error(data.message);
                    }
                })
                .catch(error => {
                    console.error(error);
                    icon.className = originalClass;
                    btn.disabled = false;

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: error.message || 'Gagal menambahkan ke keranjang',
                            background: '#1a1a1a',
                            color: '#fff'
                        });
                    } else {
                        alert('Gagal menambahkan ke keranjang.');
                    }
                });
        @endauth
        };
        });
    </script>
@endsection
