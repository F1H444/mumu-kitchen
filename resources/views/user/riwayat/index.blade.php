@extends('user.layout.index')

@section('style')
    <style>
        .order-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .order-card:hover {
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .order-number {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .btn-action {
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.2s;
            display: inline-block;
        }

        .btn-action:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .text-ember {
            color: var(--primary) !important;
        }
    </style>
@endsection

@section('container')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Riwayat Pesanan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pantau status pesanan Anda</li>
        </ol>

        @if (request()->get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Berhasil!</strong>
                {{ request()->get('message', 'Pembayaran berhasil! Pesanan Anda sudah selesai.') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (request()->get('pending'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-clock me-2"></i>
                <strong>Pending!</strong> {{ request()->get('message', 'Pembayaran sedang diproses.') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                @if ($pembayaran->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-3x mb-3 text-muted"></i>
                        <h4 class="text-white">Belum Ada Pesanan</h4>
                        <p class="text-muted">Sepertinya Anda belum melakukan pemesanan apapun.</p>
                        <a href="/" class="btn btn-primary mt-2">Mulai Belanja</a>
                    </div>
                @else
                    @foreach ($pembayaran as $item)
                        <div class="order-card">
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                    <span class="text-muted small d-block mb-1">NO. PESANAN</span>
                                    <span class="order-number">#{{ $item->no_pemesanan }}</span>
                                    <div class="mt-1">
                                        <i class="far fa-calendar-alt text-muted me-2 small"></i>
                                        <span
                                            class="small text-muted">{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                    <span class="text-muted small d-block mb-1">PENERIMA</span>
                                    <h6 class="mb-0 text-white">{{ $item->pengiriman->nama_penerima }}</h6>
                                    <span class="small text-muted text-truncate d-block" style="max-width: 200px;">
                                        {{ $item->pengiriman->alamat }}
                                    </span>
                                </div>

                                <div class="col-lg-2 col-md-6 mb-3 mb-lg-0">
                                    <span class="text-muted small d-block mb-1">TOTAL</span>
                                    <h5 class="mb-0 text-ember">Rp {{ number_format($item->harga, 0, ',', '.') }}</h5>
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

                                <div class="col-lg-2 col-md-12 text-end">
                                    <a href="{{ url('/riwayat/pembayaran/' . $item->id . '/detail') }}" class="btn-action">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>
                                    @if ($item->status == 'pesananselesai')
                                        <a href="{{ url('/riwayat/laporanpdf/' . $item->id) }}"
                                            class="btn-action text-danger ms-2" target="_blank">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center mt-4">
                        {{ $pembayaran->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
