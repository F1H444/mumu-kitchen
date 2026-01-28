@extends('front.layouts.main')

@section('style')
    <style>
        :root {
            --primary: #FF8C00;
            --primary-glow: rgba(255, 140, 0, 0.4);
            --accent: #FF3B3B;
            --dark: #050505;
            --surface: #101010;
            --glass: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.07);
            --text-main: #FFFFFF;
            --font-main: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--dark);
            color: var(--text-main);
            font-family: var(--font-main);
        }

        .hero-bread-custom {
            padding: 120px 0 60px;
            background: linear-gradient(rgba(5, 5, 5, 0.8), rgba(5, 5, 5, 0.8)), 
                        url('{{ asset("assets2/images/bg_6.jpg") }}');
            background-size: cover;
            background-position: center;
            text-align: center;
        }

        .bread-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -1px;
        }

        /* Order Card Style */
        .order-card {
            background: var(--surface);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 25px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .order-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(255, 140, 0, 0.1);
        }

        .order-number {
            color: var(--primary);
            font-weight: 800;
            font-size: 1.1rem;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-action {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            color: #fff !important;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-action:hover {
            background: var(--primary);
            border-color: var(--primary);
            box-shadow: 0 0 20px var(--primary-glow);
        }

        .text-ember { color: var(--primary) !important; }
        
        /* Pagination Styling */
        .pagination .page-link {
            background: var(--surface);
            border-color: var(--glass-border);
            color: white;
        }
        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
        }
    </style>
@endsection

@section('container')
    <section class="hero-bread-custom">
        <div class="container">
            <span class="subheading-ember animate-fade-up">Aktivitas Akun</span>
            <h1 class="bread-title text-white animate-fade-up delay-100">Riwayat <span class="text-gradient">Pesanan</span></h1>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            @if($pembayaran->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-4x mb-4 text-muted"></i>
                    <h3 class="text-white">Belum Ada Pesanan</h3>
                    <p class="text-muted">Sepertinya Anda belum melakukan pemesanan apapun.</p>
                    <a href="/produk" class="btn-ember-glow mt-3">Mulai Belanja</a>
                </div>
            @else
                <div class="row">
                    @foreach ($pembayaran as $item)
                        <div class="col-12" data-aos="fade-up">
                            <div class="order-card">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                        <span class="text-muted small d-block mb-1">NO. PESANAN</span>
                                        <span class="order-number">#{{ $item->no_pemesanan }}</span>
                                        <div class="mt-2">
                                            <i class="far fa-calendar-alt text-muted mr-2"></i>
                                            <span class="small">{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                        <span class="text-muted small d-block mb-1">PENERIMA</span>
                                        <h6 class="mb-0 text-white">{{ $item->pengiriman->nama_penerima }}</h6>
                                        <span class="small text-muted">{{ Str::limit($item->pengiriman->alamat, 30) }}</span>
                                    </div>

                                    <div class="col-lg-2 col-md-6 mb-3 mb-lg-0">
                                        <span class="text-muted small d-block mb-1">TOTAL BELANJA</span>
                                        <h5 class="mb-0 text-ember font-weight-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</h5>
                                    </div>

                                    <div class="col-lg-2 col-md-6 mb-3 mb-lg-0">
                                        <span class="text-muted small d-block mb-2">STATUS</span>
                                        @php
                                            $statusClasses = [
                                                'menunggupembayaran' => 'bg-warning text-dark',
                                                'pesananditerima' => 'bg-info text-white',
                                                'pesanandiproses' => 'bg-primary text-white',
                                                'pesanandikirim' => 'bg-primary text-white',
                                                'pesananselesai' => 'bg-success text-white',
                                                'pesananbatal' => 'bg-danger text-white',
                                            ];
                                            $statusLabels = [
                                                'menunggupembayaran' => 'Menunggu Bayar',
                                                'pesananditerima' => 'Diterima',
                                                'pesanandiproses' => 'Diproses',
                                                'pesanandikirim' => 'Dikirim',
                                                'pesananselesai' => 'Selesai',
                                                'pesananbatal' => 'Dibatalkan',
                                            ];
                                        @endphp
                                        <span class="status-badge {{ $statusClasses[$item->status] ?? 'bg-secondary' }}">
                                            {{ $statusLabels[$item->status] ?? $item->status }}
                                        </span>
                                    </div>

                                    <div class="col-lg-2 col-md-12 text-lg-right">
                                        <div class="d-flex flex-lg-column gap-2">
                                            <a href="{{ url('/riwayat/pembayaran/' . $item->id . '/detail') }}" class="btn-action">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            
                                            @if ($item->status == 'pesananselesai')
                                                <a href="{{ url('/riwayat/laporanpdf/' . $item->id) }}" class="btn-action text-danger">
                                                    <i class="fas fa-file-pdf"></i> PDF
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-5">
                    {{ $pembayaran->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection