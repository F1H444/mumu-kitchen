@extends('dashboard.layout.index')
@section('container')
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4" style="font-weight: 800; font-size: 2.5rem;">Dashboard Overview</h1>

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card mb-4 border-0"
                    style="background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%); overflow: hidden;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div
                                style="width: 50px; height: 50px; background: rgba(255, 140, 0, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-users text-primary fa-lg"></i>
                            </div>
                            <span class="badge bg-primary bg-opacity-10 text-primary">+15%</span>
                        </div>
                        <h2 class="mb-0 fw-bold">{{ $user->count() }}</h2>
                        <p class="text-muted small mb-0">Total Pelanggan</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-4 border-0"
                    style="background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%); overflow: hidden;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div
                                style="width: 50px; height: 50px; background: rgba(59, 130, 246, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-box text-info fa-lg"></i>
                            </div>
                            <span class="badge bg-info bg-opacity-10 text-info">Active</span>
                        </div>
                        <h2 class="mb-0 fw-bold">{{ $prds->count() }}</h2>
                        <p class="text-muted small mb-0">Total Produk</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-4 border-0"
                    style="background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%); overflow: hidden;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div
                                style="width: 50px; height: 50px; background: rgba(16, 185, 129, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-shopping-cart text-success fa-lg"></i>
                            </div>
                        </div>
                        <h2 class="mb-0 fw-bold">{{ $terjual }}</h2>
                        <p class="text-muted small mb-0">Produk Terjual</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-4 border-0" style="background: linear-gradient(135deg, #FF8C00 0%, #FF3B3B 100%);">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div
                                style="width: 50px; height: 50px; background: rgba(255,255,255, 0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-wallet fa-lg"></i>
                            </div>
                        </div>
                        <h3 class="mb-0 fw-bold">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h3>
                        <p class="small mb-0 opacity-75">Total Pendapatan</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center">
                <i class="fas fa-table me-2 text-primary"></i>
                <span class="fw-bold">Riwayat Pesanan Terbaru</span>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No.Pesanan </th>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th>Total Harga</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pembayaran as $item)
                            <tr>
                                <td>{{ $item->no_pemesanan }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>
                                    @if ($item->status == 'menunggupembayaran')
                                        <span class="badge rounded-pill bg-warning text-dark">Menunggu
                                            Pembayaran</span>
                                    @elseif ($item->status == 'pesananditerima')
                                        <span class="badge rounded-pill bg-primary">Pesanan
                                            Diterima</span>
                                    @elseif($item->status == 'pesanandiproses')
                                        <span class="badge rounded-pill bg-success">Pesanan
                                            Diproses</span>
                                    @elseif($item->status == 'pesanandikirim')
                                        <span class="badge rounded-pill bg-success">Pesanan
                                            DiKirim</span>
                                    @elseif($item->status == 'pesananselesai')
                                        <span class="badge rounded-pill bg-success">
                                            Selesai</span>
                                    @elseif($item->status == 'pesananbatal')
                                        <span class="badge rounded-pill bg-danger">
                                            Batal</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
