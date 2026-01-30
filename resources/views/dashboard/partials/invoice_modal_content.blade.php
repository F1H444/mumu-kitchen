@php
    $statusLabels = [
        'menunggupembayaran' => 'Menunggu Bayar',
        'pesananditerima' => 'Diterima',
        'pesanandiproses' => 'Diproses',
        'pesanandikirim' => 'Dikirim',
        'pesananselesai' => 'Selesai',
        'pesananbatal' => 'Dibatalkan',
    ];
    $statusColors = [
        'menunggupembayaran' => 'bg-warning text-dark',
        'pesananditerima' => 'bg-info text-white',
        'pesanandiproses' => 'bg-primary text-white',
        'pesanandikirim' => 'bg-info text-white',
        'pesananselesai' => 'bg-success text-white',
        'pesananbatal' => 'bg-danger text-white',
    ];
@endphp

<div class="invoice-container p-4" style="background: #101010; color: #fff; font-family: 'Outfit', sans-serif;">
    <!-- Brand Header -->
    <div class="d-flex justify-content-between align-items-start mb-4 border-bottom border-glass pb-4">
        <div>
            <h4 class="text-primary fw-bold mb-1" style="letter-spacing: 1.5px;">INVOICE</h4>
            <div class="text-white opacity-75 small">#{{ $item->no_invoice }}</div>
            <div class="text-muted small mt-1">{{ Carbon\Carbon::parse($item->created_at)->format('d F Y, H:i') }}</div>
        </div>
        <div class="text-end">
            <img src="{{ asset('assets/img/logomini.png') }}" height="50"
                style="filter: drop-shadow(0 0 10px rgba(255, 140, 0, 0.2));">
            <div class="mt-2 small fw-bold text-primary">MUMU KITCHEN</div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Customer Details -->
        <div class="col-md-7">
            <div class="h-100 p-3 bg-glass border border-glass" style="border-radius: 15px;">
                <h6 class="text-primary small text-uppercase fw-bold mb-3" style="letter-spacing: 1px;">Penerima</h6>
                <div class="fw-bold fs-5 mb-1">{{ $item->pengiriman->nama_penerima }}</div>
                <div class="small opacity-75 mb-1"><i class="fas fa-phone-alt me-2 text-primary"></i>
                    {{ $item->pengiriman->no_hp }}</div>
                <div class="small opacity-75"><i class="fas fa-map-marker-alt me-2 text-primary"></i>
                    {{ $item->pengiriman->alamat }}, {{ $item->pengiriman->Kota->nama_kota }},
                    {{ $item->pengiriman->Provinsi->nama_provinsi }}</div>

                @if ($item->catatan)
                    <div class="mt-3 pt-3 border-top border-glass">
                        <small class="text-primary fw-bold d-block mb-1">Catatan:</small>
                        <div class="fst-italic opacity-75 small text-white">"{{ $item->catatan }}"</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Order Metadata -->
        <div class="col-md-5">
            <div class="h-100 p-3 bg-glass border border-glass" style="border-radius: 15px;">
                <h6 class="text-primary small text-uppercase fw-bold mb-3" style="letter-spacing: 1px;">Rincian Pesanan
                </h6>
                <div class="mb-2">
                    <small class="text-muted d-block small">Order ID:</small>
                    <span class="fw-bold">#{{ $item->no_pemesanan }}</span>
                </div>
                <div class="mb-2">
                    <small class="text-muted d-block small">Kurir:</small>
                    <div class="d-inline-block small px-2 py-1 bg-dark border border-glass text-white"
                        style="border-radius: 8px; max-width: 100%; word-break: break-word; line-height: 1.2;">
                        {{ $item->pengiriman->nama_ekspedisi }} ({{ $item->pengiriman->paket_layanan }})
                    </div>
                </div>
                <div>
                    <small class="text-muted d-block small">Status:</small>
                    <span class="badge {{ $statusColors[$item->status] ?? 'bg-secondary' }} mt-1">
                        {{ $statusLabels[$item->status] ?? $item->status }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="table-responsive mb-4"
        style="border-radius: 15px; border: 1px solid rgba(255,255,255,0.05); overflow: hidden;">
        <table class="table mb-0" style="color: #fff; vertical-align: middle;">
            <thead style="background: rgba(255, 140, 0, 0.05);">
                <tr>
                    <th class="border-0 py-3 ps-3 small text-uppercase text-muted">Item</th>
                    <th class="border-0 py-3 text-center small text-uppercase text-muted">Harga</th>
                    <th class="border-0 py-3 text-center small text-uppercase text-muted">Qty</th>
                    <th class="border-0 py-3 text-end pe-3 small text-uppercase text-muted">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item->pesanan as $psn)
                    <tr>
                        <td class="border-glass py-3 ps-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $psn->produk->gambar) }}"
                                    style="width: 45px; height: 45px; object-fit: cover; border-radius: 8px; margin-right: 12px; border: 1px solid rgba(255,255,255,0.1);">
                                <div>
                                    <div class="fw-bold small">{{ $psn->produk->nama_produk }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">
                                        Porsi Standar</div>
                                </div>
                            </div>
                        </td>
                        <td class="border-glass py-3 text-center small">Rp
                            {{ number_format($psn->produk->harga, 0, ',', '.') }}</td>
                        <td class="border-glass py-3 text-center small">{{ $psn->kuantitas }}</td>
                        <td class="border-glass py-3 text-end pe-3 fw-bold text-primary">Rp
                            {{ number_format($psn->sub_total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Summary -->
    <div class="row justify-content-end">
        <div class="col-md-6">
            <div class="p-3 bg-glass border border-glass" style="border-radius: 15px;">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Subtotal Produk</span>
                    <span class="text-white small">Rp
                        {{ number_format($item->pesanan->sum('sub_total'), 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3 pb-2 border-bottom border-glass">
                    <span class="text-muted small">Biaya Ongkir</span>
                    <span class="text-white small">Rp
                        {{ number_format($item->pengiriman->harga_ongkir, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold text-uppercase small" style="letter-spacing: 1px;">Total Akhir</span>
                    <span class="text-primary fw-bold fs-4">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-glass {
        background: rgba(255, 255, 255, 0.02) !important;
    }

    .border-glass {
        border-color: rgba(255, 255, 255, 0.05) !important;
    }

    .invoice-container {
        line-height: 1.4;
    }

    .table> :not(caption)>*>* {
        background-color: transparent !important;
    }
</style>
