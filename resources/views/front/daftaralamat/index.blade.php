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

        .address-container {
            padding: 60px 0;
        }

        .card-address {
            background: var(--surface);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 25px;
            margin-bottom: 25px;
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-address:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .address-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .receiver-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
        }

        .phone-badge {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            color: var(--primary);
        }

        .address-detail {
            color: #aaa;
            font-size: 0.95rem;
            line-height: 1.6;
            flex-grow: 1;
        }

        .btn-action {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            margin-left: 10px;
        }

        .btn-edit {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            border: 1px solid var(--glass-border);
        }

        .btn-edit:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .btn-delete {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .btn-delete:hover {
            background: #dc3545;
            color: #fff;
        }

        .btn-add-large {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 15px 30px;
            border-radius: 15px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px var(--primary-glow);
            display: inline-flex;
            align-items: center;
        }

        .btn-add-large:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px var(--primary-glow);
            color: #fff;
        }
    </style>
@endsection

@section('container')
    <section class="hero-bread-custom text-center">
        <div class="container">
            <span class="subheading-ember animate-fade-up">Pengaturan</span>
            <h1 class="hero-title-new text-white animate-fade-up" style="font-size: 3rem;">DAFTAR <span
                    class="text-gradient">ALAMAT</span></h1>
        </div>
    </section>

    <section class="address-container">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <a href="{{ url('/pesanan') }}" class="text-muted">
                    <i class="fas fa-chevron-left mr-2"></i> Kembali ke Pesanan
                </a>
                <a href="{{ url('/alamattambah') }}" class="btn-add-large">
                    <i class="fas fa-plus mr-2"></i> Tambah Alamat Baru
                </a>
            </div>

            <div class="row">
                @forelse ($alamat as $item)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card-address animate-fade-up">
                            <div class="address-header">
                                <div class="receiver-name">{{ $item->nama_penerima }}</div>
                                <div class="phone-badge">{{ $item->phone }}</div>
                            </div>
                            <div class="address-detail">
                                <p class="mb-1"><i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                    {{ $item->detail_alamat }}</p>
                                <p class="mb-1">{{ $item->kota->nama_kota }}, {{ $item->provinsi->nama_provinsi }}</p>
                                <p class="mb-0">ID Pos: <span class="text-white">{{ $item->kode_pos }}</span></p>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <a href="#" class="btn-action btn-edit" title="Edit Alamat">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ url('/alamat/' . $item->id) }}"
                                    onsubmit="return confirm('Hapus alamat ini?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn-action btn-delete" title="Hapus Alamat">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="card-custom py-5">
                            <i class="fas fa-map-marked-alt fa-4x text-muted mb-4"></i>
                            <h4 class="text-white">Belum Ada Alamat</h4>
                            <p class="text-muted mb-4">Silakan tambahkan alamat pengiriman Anda untuk memudahkan proses
                                checkout.</p>
                            <a href="{{ url('/alamattambah') }}" class="btn-add-large">Tambah Sekarang</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
