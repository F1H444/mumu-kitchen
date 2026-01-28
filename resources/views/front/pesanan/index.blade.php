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

        .checkout-container {
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

        .card-custom:hover {
            border-color: rgba(255, 140, 0, 0.3);
        }

        .summary-list-item {
            background: transparent;
            border: none;
            border-bottom: 1px solid var(--glass-border);
            padding: 15px 0;
            color: #ccc;
        }

        .summary-list-item:last-child {
            border-bottom: none;
        }

        /* Address Radio Styling */
        .address-option {
            cursor: pointer;
            width: 100%;
        }

        .address-card {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 20px;
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
        }

        .pilih-alamat:checked+.address-card {
            border-color: var(--primary);
            background: rgba(255, 140, 0, 0.05);
            box-shadow: 0 10px 20px rgba(255, 140, 0, 0.1);
        }

        .pilih-alamat:checked+.address-card::after {
            content: '\f058';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            top: 15px;
            right: 15px;
            color: var(--primary);
            font-size: 1.2rem;
        }

        /* Courier Option */
        .courier-option {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            padding: 15px 20px;
            margin-bottom: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .pilih-pengiriman:checked+.address-card {
            border-color: var(--primary);
            background: rgba(255, 140, 0, 0.05);
            box-shadow: 0 10px 20px rgba(255, 140, 0, 0.1);
        }

        .pilih-pengiriman:checked+.address-card::after,
        .pilih-layanan-radio:checked+.address-card::after {
            content: '\f058';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            top: 15px;
            right: 15px;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .pilih-layanan-radio:checked+.address-card {
            border-color: var(--primary);
            background: rgba(255, 140, 0, 0.05);
            box-shadow: 0 10px 20px rgba(255, 140, 0, 0.1);
        }

        .courier-option:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        .form-control-custom {
            background: var(--glass) !important;
            border: 1px solid var(--glass-border) !important;
            color: #fff !important;
            border-radius: 12px !important;
            padding: 12px 20px !important;
        }

        .form-label-custom {
            color: #888;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            margin-bottom: 10px;
            display: block;
        }

        .btn-order {
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
            margin-top: 20px;
        }

        .btn-order:disabled {
            background: #333;
            box-shadow: none;
            cursor: not-allowed;
            opacity: 0.5;
        }

        .btn-order:not(:disabled):hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px var(--primary-glow);
            filter: brightness(1.1);
        }
    </style>
@endsection

@section('container')
    <section class="hero-bread-custom text-center">
        <div class="container">
            <span class="subheading-ember animate-fade-up">Checkout</span>
            <h1 class="hero-title-new text-white animate-fade-up" style="font-size: 3rem;">PESANAN <span
                    class="text-gradient">ANDA</span></h1>
        </div>
    </section>

    <div class="checkout-container">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <div class="card-custom">
                        <h4 class="d-flex justify-content-between align-items-center mb-4">
                            <span class="text-white">Ringkasan</span>
                            <span class="badge bg-primary rounded-pill">{{ $keranjang->count() }}</span>
                        </h4>

                        <div class="summary-list">
                            @foreach ($keranjang as $value)
                                <div class="summary-list-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="my-0 text-white">{{ $value->produk->nama_produk }}</h6>
                                        <small class="text-muted">x{{ $value->kuantitas }} |
                                            {{ $value->ukuran ? $value->ukuran->ukuran->jenis_ukuran : 'Default Size' }}</small>
                                    </div>
                                    <span class="text-white small">Rp
                                        {{ number_format($value->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach

                            <div class="summary-list-item d-flex justify-content-between">
                                <span>Ongkir</span>
                                <span class="text-primary ongkir-text">Rp 0</span>
                            </div>

                            <div class="summary-list-item d-flex justify-content-between mt-2 pt-3"
                                style="border-top: 2px solid var(--glass-border)">
                                <strong class="text-white">Total Bayar</strong>
                                <strong class="text-primary h4 mb-0 total-text">Rp
                                    {{ number_format($total, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 col-lg-8">
                    <form id="checkoutForm" class="needs-validation" novalidate method="POST" action="/pesanan/pembayaran">
                        @csrf

                        <div class="card-custom">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="text-white mb-0"><i class="fas fa-map-marker-alt text-primary mr-2"></i> Alamat
                                    Pengiriman</h5>
                                <a href="/alamat?redirect=/pesanan"
                                    class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                    <i class="fas fa-plus mr-1"></i> Baru
                                </a>
                            </div>

                            <div class="row">
                                @foreach ($alamat as $item)
                                    <div class="col-md-6 mb-3">
                                        <label class="address-option">
                                            <input type="radio" name="alamat_id" value="{{ $item->id }}"
                                                class="pilih-alamat d-none" required>
                                            <div class="address-card">
                                                <div class="font-weight-bold text-white mb-2">{{ $item->nama_penerima }}
                                                </div>
                                                <div class="small text-muted mb-1">{{ $item->phone }}</div>
                                                <div class="small text-muted">{{ $item->detail_alamat }},
                                                    {{ $item->kota->nama_kota }}, {{ $item->provinsi->nama_provinsi }}
                                                    ({{ $item->kode_pos }})
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card-custom">
                            <h5 class="text-white mb-4"><i class="fas fa-truck text-primary mr-2"></i> Metode Pengiriman
                            </h5>

                            <div class="row">
                                <div class="col-md-4">
                                    <label class="address-option">
                                        <input type="radio" name="courier" value="jne" id="jne"
                                            class="pilih-pengiriman d-none" required>
                                        <div class="address-card text-center py-4">
                                            <i class="fas fa-box fa-2x mb-3"></i>
                                            <div class="font-weight-bold">JNE</div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="address-option">
                                        <input type="radio" name="courier" value="pos" id="pos"
                                            class="pilih-pengiriman d-none">
                                        <div class="address-card text-center py-4">
                                            <i class="fas fa-mail-bulk fa-2x mb-3"></i>
                                            <div class="font-weight-bold">POS INDO</div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label class="address-option">
                                        <input type="radio" name="courier" value="tiki" id="tiki"
                                            class="pilih-pengiriman d-none">
                                        <div class="address-card text-center py-4">
                                            <i class="fas fa-shipping-fast fa-2x mb-3"></i>
                                            <div class="font-weight-bold">TIKI</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <button id="cek-ongkir" class="btn btn-outline-primary mt-4 w-100 py-3 rounded-pill"
                                type="button">
                                CEK ONGKIR SEKARANG
                            </button>

                            <div class="pilih-layanan d-none mt-4">
                                <!-- Layanan list will appear here -->
                            </div>
                        </div>

                        <div class="card-custom">
                            <h5 class="text-white mb-4"><i class="fas fa-comment-dots text-primary mr-2"></i> Tambahan</h5>
                            <div class="mb-3">
                                <label for="catatan" class="form-label-custom">Catatan Pesanan (Opsional)</label>
                                <textarea class="form-control-custom w-100" name="catatan" id="catatan"
                                    placeholder="Contoh: Titip di satpam, pedas dikurangi..." rows="3"></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="service">
                        <button id="submit" class="btn-order" type="submit" disabled>
                            KONFIRMASI PEMBAYARAN <i class="fas fa-chevron-right ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('cek-ongkir').addEventListener('click', function() {
            const courier = document.querySelector('[name="courier"]:checked');
            const alamat = document.querySelector('[name="alamat_id"]:checked');

            if (!courier || !alamat) {
                alert('Pilih Alamat dan Kurir terlebih dahulu');
                return;
            }

            const btn = this;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menghitung...';
            btn.disabled = true;

            $.ajax({
                url: '/checkout/get-ongkir',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    courier: courier.value,
                    alamat_id: alamat.value,
                },
                success: function(results) {
                    btn.innerHTML = 'CEK ONGKIR SEKARANG';
                    btn.disabled = false;

                    let html = '<label class="form-label-custom mb-3">Pilih Layanan Kurir</label>';
                    results.forEach(cost => {
                        html += `
                            <label class="address-option mb-2">
                                <input type="radio" name="ongkir" value="${cost.cost}" class="pilih-layanan-radio d-none" 
                                    onchange='changeOngkirText(${JSON.stringify(cost)})'>
                                <div class="address-card py-3 d-flex justify-content-between align-items-center" style="position: relative;">
                                    <div class="flex-grow-1 pr-3">
                                        <div class="font-weight-bold text-white">${cost.service}</div>
                                        <small class="text-muted">${cost.description} | Est: ${cost.etd.replace(' HARI', '')} Hari</small>
                                    </div>
                                    <div class="text-primary font-weight-bold mr-4" style="white-space: nowrap;">Rp ${new Intl.NumberFormat('id-ID').format(cost.cost)}</div>
                                </div>
                            </label>
                        `;
                    });

                    const container = document.querySelector('.pilih-layanan');
                    container.classList.remove('d-none');
                    container.innerHTML = html;
                },
                error: function() {
                    btn.innerHTML = 'CEK ONGKIR SEKARANG';
                    btn.disabled = false;
                    alert('Gagal mengambil data ongkir. Pastikan alamat lengkap.');
                }
            })
        });

        function changeOngkirText(cost) {
            document.querySelector('.ongkir-text').innerText = `Rp ${new Intl.NumberFormat('id-ID').format(cost.cost)}`;
            const total = parseInt({{ $total }}) + cost.cost;
            document.querySelector('.total-text').innerText = `Rp ${new Intl.NumberFormat('id-ID').format(total)}`;
            document.querySelector('#submit').disabled = false;
            document.querySelector('input[name="service"]').value = `${cost.service} (${cost.description})`;
        }
    </script>
@endsection
