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
            --glass-card: rgba(20, 20, 20, 0.6);
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

        .page-header-small {
            padding: 140px 0 40px;
            background: var(--dark);
            text-align: center;
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

        /* Product Detail Layout */
        .detail-card {
            background: var(--glass-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            padding: 40px;
            margin-bottom: 60px;
        }

        .product-image-container {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--glass-border);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .product-image-container img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s;
        }

        .product-image-container:hover img {
            transform: scale(1.05);
        }

        .product-info h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
            color: #fff;
        }

        .product-price {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 25px;
            display: inline-block;
            background: rgba(255, 140, 0, 0.1);
            padding: 5px 20px;
            border-radius: 12px;
        }

        .product-desc {
            color: var(--text-dim);
            line-height: 1.8;
            font-size: 1.05rem;
            margin-bottom: 30px;
        }

        /* Form Elements */
        .form-label {
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
            display: block;
        }

        .size-selector {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .size-option {
            position: relative;
        }

        .size-option input {
            display: none;
        }

        .size-option label {
            display: block;
            background: var(--surface);
            border: 1px solid var(--glass-border);
            color: var(--text-dim);
            padding: 10px 20px;
            border-radius: 12px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
        }

        .size-option input:checked+label {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(255, 140, 0, 0.3);
        }

        .quantity-input-wrap {
            display: flex;
            align-items: center;
            gap: 15px;
            background: var(--surface);
            padding: 10px 20px;
            border-radius: 12px;
            border: 1px solid var(--glass-border);
            width: fit-content;
            margin-bottom: 30px;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            background: var(--surface);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            overflow: hidden;
            width: fit-content;
        }

        .quantity-btn {
            background: transparent;
            border: none;
            color: #fff;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .quantity-btn:hover {
            background: rgba(255, 140, 0, 0.1);
            color: var(--primary);
        }

        .quantity-input {
            background: transparent;
            border: none;
            color: #fff;
            width: 50px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 700;
            outline: none;
            -moz-appearance: textfield;
        }

        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .btn-action {
            width: 100%;
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 18px;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-action:hover {
            background: #e07b00;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 140, 0, 0.25);
        }
    </style>
@endsection

@section('container')
    <!-- Small Header -->
    <header class="page-header-small">
        <div class="container pb-5">
            <div class="breadcrumb-custom animate-fade-up">
                <a href="/">Beranda</a>
                <span>/</span>
                <a href="/produk">Menu</a>
                <span>/</span>
                <span>Detail</span>
            </div>
        </div>
    </header>

    <section class="ftco-section pt-0">
        <div class="container">
            <div class="detail-card animate-fade-up delay-100">
                <div class="row align-items-center">
                    <!-- Product Image -->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="product-image-container">
                            @php
                                // Check if image exists in storage, otherwise use default images
                                $imagePath =
                                    $produks->gambar && file_exists(public_path('storage/' . $produks->gambar))
                                        ? 'storage/' . $produks->gambar
                                        : 'images/nasi-kebuli.webp';
                            @endphp
                            <img src="{{ asset($imagePath) }}" alt="{{ $produks->nama_produk }}">
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="col-lg-6 ps-lg-5">
                        <div class="product-info">
                            <h1>{{ $produks->nama_produk }}</h1>
                            <div class="product-price">Rp {{ number_format($produks->harga, 0, ',', '.') }}</div>

                            <div class="product-desc">
                                {{ $produks->deskripsi }}
                            </div>

                            <form id="addToCartForm" onsubmit="addToCart(event)">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produks->id }}">


                                <!-- Quantity -->
                                <div class="mb-4" id="quantity-section">
                                    <span class="form-label">Jumlah Pesanan:</span>
                                    <div class="quantity-selector">
                                        <button type="button" class="quantity-btn" onclick="updateQty(-1)">-</button>
                                        <input type="number" class="quantity-input" name="kuantitas" id="kuantitas"
                                            value="1" min="1" max="{{ $produks->stok }}">
                                        <button type="button" class="quantity-btn" onclick="updateQty(1)">+</button>
                                    </div>
                                </div>

                                <button type="submit" class="btn-action" id="btn-submit">
                                    <i class="fas fa-shopping-cart"></i>
                                    Masukkan Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function changeStock(stock) {
            const qtySection = document.getElementById('quantity-section');
            const qtyInput = document.getElementById('kuantitas');

            qtySection.style.display = 'block';
            qtyInput.value = 1;
            qtyInput.setAttribute('max', stock);

            // Add animation class
            qtySection.classList.add('animate-fade-up');
        }

        function updateQty(change) {
            const input = document.getElementById('kuantitas');
            let newVal = parseInt(input.value) + change;
            const max = parseInt(input.getAttribute('max'));

            if (newVal >= 1 && (max === 0 || newVal <= max)) {
                input.value = newVal;
            }
        }

        function addToCart(e) {
            e.preventDefault();
            const form = document.getElementById('addToCartForm');
            const btn = document.getElementById('btn-submit');
            const originalIcon = btn.innerHTML;

            // Check if logged in
            @guest
            Swal.fire({
                icon: 'warning',
                title: 'Silahkan Login',
                text: 'Anda harus login untuk memesan',
                confirmButtonColor: '#FF8C00',
                confirmButtonText: 'Login Sekarang'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/login';
                }
            });
            return;
        @endguest

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

        const formData = new FormData(form);

        fetch('/keranjang', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Produk ditambahkan ke keranjang',
                        showConfirmButton: false,
                        timer: 1500,
                        background: '#101010',
                        color: '#fff'
                    });

                    // Update cart count if exists in navbar
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount && data.cart_count !== undefined) {
                        cartCount.innerText = data.cart_count;
                    }
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.message || 'Gagal menambahkan ke keranjang',
                    confirmButtonColor: '#FF8C00'
                });
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = originalIcon;
            });
        }
    </script>
@endsection
