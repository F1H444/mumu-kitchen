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
            padding: 80px 0 40px;
            background: linear-gradient(rgba(5, 5, 5, 0.9), rgba(5, 5, 5, 0.9)),
                url('{{ asset('assets2/images/bg_6.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .payment-container {
            padding: 60px 0;
        }

        .card-custom {
            background: var(--surface);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 30px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .product-item {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
            margin-right: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--glass-border);
            color: #ccc;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .total-box {
            background: rgba(255, 140, 0, 0.05);
            border: 1px dashed var(--primary);
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .btn-pay {
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
        }

        .btn-pay:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px var(--primary-glow);
            color: #fff;
        }

        .badge-courier {
            background: var(--glass);
            color: var(--primary);
            border: 1px solid var(--glass-border);
            padding: 5px 12px;
            border-radius: 10px;
            font-size: 0.8rem;
            text-transform: uppercase;
        }
    </style>
@endsection

@section('container')
    <section class="hero-bread-custom text-center">
        <div class="container">
            <h1 class="hero-title-new text-white animate-fade-up" style="font-size: 2.5rem;">KONFIRMASI <span
                    class="text-gradient">PEMBAYARAN</span></h1>
        </div>
    </section>

    <div class="payment-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card-custom animate-fade-up">
                        <h5 class="text-white mb-4"><i class="fas fa-shopping-bag text-primary mr-2"></i> Detail Item</h5>
                        @foreach ($keranjang as $item)
                            <div class="product-item">
                                <img src="{{ asset('storage/' . $item->produk->gambar) }}" class="product-img">
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="text-white mb-1">{{ $item->produk->nama_produk }}</h6>
                                        <span class="text-primary font-weight-bold">Rp
                                            {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                    </div>
                                    <small class="text-muted d-block">
                                        x{{ $item->kuantitas }}
                                    </small>
                                </div>
                            </div>
                        @endforeach

                        <h5 class="text-white mt-5 mb-4"><i class="fas fa-map-marker-alt text-primary mr-2"></i> Pengiriman
                        </h5>
                        <div class="card-custom p-3 bg-glass">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <strong class="text-white">{{ $alamat->nama_penerima }}</strong>
                                <span class="badge-courier">{{ $courier }} - {{ $service }}</span>
                            </div>
                            <div class="small text-muted mb-2"><i class="fas fa-phone mr-1"></i> {{ $alamat->phone }}</div>
                            <div class="small text-muted">{{ $alamat->detail_alamat }}, {{ $alamat->kota->nama_kota }},
                                {{ $alamat->provinsi->nama_provinsi }} ({{ $alamat->kode_pos }})</div>
                            @if ($catatan)
                                <div class="mt-3 pt-3 border-top border-glass">
                                    <small class="text-muted"><i class="fas fa-comment-dots mr-1"></i> Catatan:
                                        {{ $catatan }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card-custom animate-fade-up" style="position: sticky; top: 100px;">
                        <h5 class="text-white mb-4">Ringkasan Biaya</h5>
                        <div class="summary-item">
                            <span>Subtotal Produk</span>
                            <span class="text-white">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-item">
                            <span>Biaya Pengiriman</span>
                            <span class="text-white">Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                        </div>

                        <div class="total-box">
                            <div class="text-muted small mb-1">TOTAL PEMBAYARAN</div>
                            <h2 class="text-primary font-weight-bold mb-0">Rp
                                {{ number_format($total + $ongkir, 0, ',', '.') }}</h2>
                        </div>

                        <button id="pay-button" class="btn-pay mt-3">
                            BAYAR SEKARANG <i class="fas fa-shield-alt ml-2"></i>
                        </button>

                        <div class="text-center mt-4">
                            <img src="https://midtrans.com/assets/img/logo-midtrans.png" height="20"
                                style="opacity: 0.5;">
                            <p class="text-muted small mt-2">Sistem pembayaran aman & terenkripsi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        const payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();

            const originalContent = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
            this.disabled = true;

            $.ajax({
                url: '/checkout/pembayaran/charge',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ongkir: {{ $ongkir }},
                    courier: '{{ $courier }}',
                    service: '{{ $service }}',
                    daftar_alamat_id: {{ $alamat->id }},
                    catatan: '{{ $catatan }}',
                },
                success: (data) => {
                    // Simpan order data
                    const orderId = data.order_id;
                    const orderNumber = data.order_number;

                    snap.pay(data.snap_token, {
                        onSuccess: (result) => {
                            // Pembayaran sukses - Update status ke selesai
                            console.log('Payment success:', result);

                            // Panggil API untuk update status pembayaran ke selesai
                            $.ajax({
                                url: '/checkout/pembayaran/success',
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    order_id: orderId
                                },
                                success: (response) => {
                                    console.log('Status updated to selesai:',
                                        response);
                                    window.location.href =
                                        '/riwayat?success=1&message=Pembayaran berhasil! Pesanan Anda sudah selesai.';
                                },
                                error: (err) => {
                                    console.error('Failed to update status:',
                                        err);
                                    // Tetap redirect walau update gagal
                                    window.location.href =
                                        '/riwayat?success=1&message=Pembayaran berhasil!';
                                }
                            });
                        },
                        onPending: (result) => {
                            // Pembayaran pending
                            console.log('Payment pending:', result);
                            window.location.href =
                                '/riwayat?pending=1&message=Pembayaran sedang diproses.';
                        },
                        onError: (result) => {
                            // Pembayaran error
                            console.error('Payment error:', result);
                            alert('Pembayaran gagal, silakan coba lagi.');
                            payButton.innerHTML = originalContent;
                            payButton.disabled = false;
                        },
                        onClose: () => {
                            // User menutup popup tanpa menyelesaikan pembayaran
                            console.log('Payment popup closed');
                            payButton.innerHTML = originalContent;
                            payButton.disabled = false;
                        }
                    });
                },
                error: (err) => {
                    console.error('Charge error:', err);
                    alert('Gagal membuat transaksi. Silakan coba lagi.');
                    payButton.innerHTML = originalContent;
                    payButton.disabled = false;
                }
            })
        });
    </script>
@endsection
