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

        .form-container {
            padding: 60px 0;
        }

        .card-custom {
            background: var(--surface);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        .form-control-custom {
            background: var(--glass) !important;
            border: 1px solid var(--glass-border) !important;
            color: #fff !important;
            border-radius: 12px !important;
            padding: 12px 20px !important;
            height: auto !important;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            background: rgba(255, 255, 255, 0.05) !important;
            border-color: var(--primary) !important;
            box-shadow: 0 0 15px var(--primary-glow) !important;
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

        .btn-submit-large {
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

        .btn-submit-large:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px var(--primary-glow);
            filter: brightness(1.1);
            color: #fff;
        }

        /* Select2 Custom Styling to Match Glassmorphism */
        .select2-container--default .select2-selection--single {
            background-color: var(--glass) !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: 12px !important;
            height: 50px !important;
            display: flex !important;
            align-items: center !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #fff !important;
            padding-left: 20px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 48px !important;
            right: 15px !important;
        }

        .select2-dropdown {
            background-color: var(--surface) !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: 12px !important;
            color: #fff !important;
        }

        .select2-results__option--highlighted[aria-selected] {
            background-color: var(--primary) !important;
        }

        .select2-search__field {
            background-color: var(--glass) !important;
            border: 1px solid var(--glass-border) !important;
            color: #fff !important;
            border-radius: 8px !important;
        }
    </style>
@endsection

@section('container')
    <section class="hero-bread-custom text-center">
        <div class="container">
            <span class="subheading-ember animate-fade-up">Daftar Alamat</span>
            <h1 class="hero-title-new text-white animate-fade-up" style="font-size: 3rem;">TAMBAH <span
                    class="text-gradient">ALAMAT</span></h1>
        </div>
    </section>

    <section class="form-container">
        <div class="container">
            <div class="mb-5 text-center">
                <a href="{{ url('/alamat') }}" class="text-muted">
                    <i class="fas fa-chevron-left mr-2"></i> Kembali ke Daftar Alamat
                </a>
            </div>

            <div class="card-custom animate-fade-up">
                <form action="{{ url('/alamattambah') }}" method="POST">
                    @csrf
                    <input type="hidden" name="redirect" value="{{ request('redirect') }}">

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label-custom">Nama Penerima</label>
                            <input type="text" class="form-control-custom w-100" name="nama_penerima"
                                placeholder="Masukkan nama penerima" required autocomplete="off">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label-custom">Nomor Telepon</label>
                            <input type="text" class="form-control-custom w-100" name="phone"
                                placeholder="Contoh: 08123456789" required autocomplete="off">
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label-custom">Kode Pos</label>
                            <input type="text" class="form-control-custom w-100" name="kode_pos"
                                placeholder="Masukkan 5 digit kode pos" required autocomplete="off">
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label-custom">Detail Alamat Lengkap (Khusus Surabaya)</label>
                            <textarea class="form-control-custom w-100" name="detail_alamat" rows="4"
                                placeholder="Nama jalan, gedung, No. Rumah, RT/RW, dsb." required autocomplete="off"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit-large">
                        SIMPAN ALAMAT <i class="fas fa-save ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Address page is now Surabaya-only, no dynamic selects needed.
        });
    </script>
@endsection
