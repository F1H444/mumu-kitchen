@extends('front.layouts.main')

@section('style')
    <style>
        :root {
            --primary: #FF8C00;
            --primary-glow: rgba(255, 140, 0, 0.4);
            --dark: #050505;
            --surface: #101010;
            --glass: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.07);
            --text-main: #FFFFFF;
        }

        body {
            background-color: var(--dark);
            color: var(--text-main);
        }

        .hero-bread-custom {
            padding: 100px 0 60px;
            background: linear-gradient(rgba(5, 5, 5, 0.8), rgba(5, 5, 5, 0.8)),
                url('{{ asset('assets2/images/bg_6.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        /* Cart Item Design */
        .cart-container {
            padding: 60px 0;
        }

        .cart-header {
            border-bottom: 1px solid var(--glass-border);
            padding-bottom: 15px;
            margin-bottom: 30px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .cart-item {
            background: var(--surface);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            position: relative;
        }

        .cart-item:hover {
            border-color: var(--primary);
            transform: translateX(5px);
        }

        .product-img-cart {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 15px;
        }

        .product-name-cart {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #fff;
        }

        .product-meta-cart {
            font-size: 0.85rem;
            color: var(--primary);
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Quantity Control */
        .qty-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            overflow: hidden;
            padding: 5px;
        }

        .btn-qty {
            background: transparent;
            border: none;
            color: var(--primary);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-qty:hover {
            background: rgba(255, 140, 0, 0.1);
            transform: scale(1.1);
        }

        .kuantitas {
            background: transparent !important;
            border: none !important;
            color: #fff !important;
            width: 40px !important;
            text-align: center;
            font-weight: 700;
            font-size: 1rem;
            pointer-events: none;
            /* User changes via buttons */
            -moz-appearance: textfield;
        }

        .kuantitas::-webkit-outer-spin-button,
        .kuantitas::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Summary Sidebar */
        .summary-card {
            background: var(--surface);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 30px;
            position: sticky;
            top: 100px;
        }

        .summary-title {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 25px;
            background: linear-gradient(45deg, #fff, var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .total-price-large {
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--primary);
        }

        .btn-checkout {
            background: var(--primary);
            color: #fff;
            border: none;
            width: 100%;
            padding: 18px;
            border-radius: 15px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px var(--primary-glow);
            display: block;
            text-align: center;
        }

        .btn-checkout:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px var(--primary-glow);
            color: #fff;
            filter: brightness(1.1);
        }

        .btn-remove {
            color: #ff4d4d;
            background: rgba(255, 77, 77, 0.1);
            border: none;
            padding: 8px 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-remove:hover {
            background: #ff4d4d;
            color: #fff;
        }
    </style>
@endsection

@section('container')
    <section class="hero-bread-custom text-center">
        <div class="container">
            <span class="subheading-ember animate-fade-up">Pesanan Anda</span>
            <h1 class="hero-title-new text-white animate-fade-up" style="font-size: 3rem;">KERANJANG <span
                    class="text-gradient">BELANJA</span></h1>
        </div>
    </section>

    <section class="cart-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-header d-none d-md-flex row px-3">
                        <div class="col-md-6">Produk</div>
                        <div class="col-md-3 text-center">Jumlah</div>
                        <div class="col-md-3 text-right">Subtotal</div>
                    </div>

                    @forelse ($keranjangs as $keranjang)
                        <div class="cart-item animate-fade-up">
                            <div class="row align-items-center">
                                <div class="col-md-6 d-flex align-items-center mb-3 mb-md-0">
                                    @php
                                        // Check if image exists in storage, otherwise use default images
                                        $imagePath =
                                            $keranjang->produk->gambar &&
                                            file_exists(public_path('storage/' . $keranjang->produk->gambar))
                                                ? 'storage/' . $keranjang->produk->gambar
                                                : 'images/nasi-kebuli.webp'; // Default fallback
                                    @endphp
                                    <img src="{{ asset($imagePath) }}" class="product-img-cart mr-3" alt="Product">
                                    <div>
                                        @if ($keranjang->ukuran)
                                            <div class="product-meta-cart">{{ $keranjang->ukuran->ukuran->jenis_ukuran }}
                                            </div>
                                        @endif
                                        <h3 class="product-name-cart">{{ $keranjang->produk->nama_produk }}</h3>
                                        <div class="text-muted small">Rp
                                            {{ number_format($keranjang->produk->harga, 0, ',', '.') }}</div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-3 text-center">
                                    <div class="qty-control">
                                        <button class="btn-qty btn-minus" data-id="{{ $keranjang->id }}"><i
                                                class="fas fa-minus"></i></button>
                                        <input type="number" min="1" class="input-text kuantitas" name="kuantitas"
                                            id="qty-{{ $keranjang->id }}" data-id="{{ $keranjang->id }}"
                                            value="{{ $keranjang->kuantitas }}"
                                            max="{{ $keranjang->ukuran ? $keranjang->ukuran->stock : $keranjang->produk->stok }}"
                                            readonly>
                                        <button class="btn-qty btn-plus" data-id="{{ $keranjang->id }}"><i
                                                class="fas fa-plus"></i></button>
                                    </div>
                                </div>

                                <div class="col-6 col-md-3 text-right">
                                    <div class="font-weight-bold text-white mb-2">
                                        Rp <span class="subtotal-item"
                                            data-id="{{ $keranjang->id }}">{{ number_format($keranjang->produk->harga * $keranjang->kuantitas, 0, ',', '.') }}</span>
                                    </div>
                                    <form action="/keranjang/{{ $keranjang->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn-remove" type="submit">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-basket fa-4x text-muted mb-3"></i>
                            <h4 class="text-white">Keranjang Kosong</h4>
                            <p class="text-muted">Sepertinya Anda belum memilih menu lezat kami.</p>
                            <a href="/produk" class="btn btn-primary mt-3 px-5 py-3">Mulai Belanja</a>
                        </div>
                    @endforelse
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0">
                    <div class="summary-card animate-fade-up">
                        <h3 class="summary-title">Ringkasan</h3>
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Item</span>
                            <span>{{ $keranjangs->count() }} Produk</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="h5 text-white">Total</span>
                            <span class="total-price-large">Rp <span
                                    id="grand-total">{{ number_format($total, 0, ',', '.') }}</span></span>
                        </div>
                        <hr style="border-color: var(--glass-border)">
                        @if ($keranjangs->count())
                            <a href="/pesanan" class="btn-checkout">
                                Checkout Sekarang <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        @endif
                        <div class="text-center mt-3">
                            <a href="/produk" class="text-muted small"><i class="fas fa-chevron-left mr-1"></i> Kembali
                                Belanja</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function updateQuantity(id, newQty, context) {
            const card = context.closest('.cart-item');
            card.style.opacity = '0.6';

            $.ajax({
                url: `/keranjang/${id}`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    _method: 'PUT',
                    kuantitas: newQty
                },
                success: function(response) {
                    const priceStr = card.querySelector('.text-muted.small').innerText;
                    const price = parseFloat(priceStr.replace(/[^0-9]/g, ''));
                    const subtotal = price * newQty;

                    card.querySelector('.subtotal-item').innerText = new Intl.NumberFormat('id-ID').format(
                        subtotal);

                    let newGrandTotal = 0;
                    document.querySelectorAll('.subtotal-item').forEach(sub => {
                        newGrandTotal += parseFloat(sub.innerText.replace(/[^0-9]/g, ''));
                    });
                    document.getElementById('grand-total').innerText = new Intl.NumberFormat('id-ID').format(
                        newGrandTotal);

                    card.style.opacity = '1';

                    if (typeof Swal !== 'undefined') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,
                            background: '#1a1a1a',
                            color: '#fff'
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Jumlah diperbarui'
                        });
                    }
                },
                error: function() {
                    card.style.opacity = '1';
                    alert('Gagal memperbarui jumlah');
                }
            });
        }

        document.querySelectorAll('.btn-plus').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const input = document.getElementById(`qty-${id}`);
                const max = parseInt(input.getAttribute('max'));
                let val = parseInt(input.value);

                if (val < max) {
                    val++;
                    input.value = val;
                    updateQuantity(id, val, this);
                } else {
                    alert('Stok maksimal tercapai');
                }
            });
        });

        document.querySelectorAll('.btn-minus').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const input = document.getElementById(`qty-${id}`);
                let val = parseInt(input.value);

                if (val > 1) {
                    val--;
                    input.value = val;
                    updateQuantity(id, val, this);
                }
            });
        });
    </script>
@endsection
