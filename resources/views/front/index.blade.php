@extends('front.layouts.main')

@section('style')
    <style>
        :root {
            --primary: #FF8C00;
            /* Quantum Orange */
            --primary-glow: rgba(255, 140, 0, 0.4);
            --accent: #FF3B3B;
            /* Ember Red */
            --dark: #050505;
            /* Deep Black */
            --surface: #101010;
            /* Surface Card */
            --glass: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.07);
            --text-main: #FFFFFF;
            --text-dim: black;
            --font-main: 'Outfit', sans-serif;
            --transition: all 0.5s cubic-bezier(0.2, 1, 0.3, 1);
        }

        body {
            background-color: var(--dark);
            color: var(--text-main);
            font-family: var(--font-main);
            overflow-x: hidden;
        }

        /* Ember Text Effect */
        .text-ember {
            color: #FF8C00 !important;
            font-weight: 800;
        }

        .hero-new {
            position: relative;
            padding: 120px 0 100px;
            overflow: hidden;
            background: #050505;
            /* Pure Black */
            display: flex;
            align-items: center;
            min-height: 90vh;
        }

        .hero-title-new {
            font-size: 4.5rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 2rem;
            letter-spacing: -2px;
            text-transform: uppercase;
        }

        @media (max-width: 991px) {
            .hero-new {
                padding: 150px 0 80px;
                text-align: center;
                min-height: auto;
            }

            .hero-title-new {
                font-size: 3rem;
            }

            .badge-1 {
                left: 0 !important;
                top: 10% !important;
            }

            .badge-2 {
                right: 0 !important;
                bottom: 10% !important;
            }

            .btn-ember-outline {
                margin-left: 0;
                margin-top: 15px;
                display: inline-flex;
            }

            .hero-floating-image {
                margin-top: 60px;
            }

            .d-flex.gap-3 {
                justify-content: center !important;
            }
        }

        .text-gradient {
            background: linear-gradient(135deg, #FF8C00, #FF3B3B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .text-outline {
            -webkit-text-stroke: 2px rgba(255, 255, 255, 0.3);
            color: transparent;
        }

        .subheading-ember {
            display: inline-block;
            color: var(--primary);
            font-weight: 700;
            letter-spacing: 4px;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            font-size: 0.8rem;
            background: rgba(255, 140, 0, 0.1);
            padding: 10px 20px;
            border-radius: 50px;
            border: 1px solid rgba(255, 140, 0, 0.2);
        }

        .hero-desc-new {
            font-size: 1.25rem;
            color: #bbb;
            margin-bottom: 3rem;
            line-height: 1.6;
            max-width: 600px;
            /* No margin auto, left aligned default */
        }

        @media (max-width: 991px) {
            .hero-desc-new {
                margin-left: auto;
                margin-right: auto;
            }
        }

        .btn-ember-glow {
            background: #FF8C00;
            color: #fff !important;
            padding: 18px 45px;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 0 30px rgba(255, 140, 0, 0.4);
            transition: all 0.3s ease;
            letter-spacing: 1px;
        }

        .btn-ember-glow:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 60px rgba(255, 140, 0, 0.6);
            color: #fff;
        }

        .btn-ember-outline {
            background: transparent;
            color: #fff !important;
            padding: 18px 45px;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.3);
            margin-left: 15px;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            display: inline-flex;
            align-items: center;
        }

        .btn-ember-outline:hover {
            border-color: #fff;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            transform: translateY(-5px);
        }

        .hero-floating-image {
            /* margin-top moved to mobile query */
            position: relative;
            display: inline-block;
            z-index: 1;
            width: 100%;
            text-align: center;
        }

        /* Glow effect behind image */
        .hero-floating-image::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            height: 80%;
            background: radial-gradient(circle, rgba(255, 140, 0, 0.4), transparent 70%);
            filter: blur(60px);
            z-index: -1;
        }

        .floating-dish {
            max-width: 100%;
            /* Occupy full col width */
            width: 100%;
            filter: drop-shadow(0 30px 60px rgba(0, 0, 0, 0.5));
            animation: floatDish 6s ease-in-out infinite;
        }

        .floating-badge {
            position: absolute;
            background: rgba(20, 20, 20, 0.85);
            backdrop-filter: blur(15px);
            padding: 12px 25px;
            border-radius: 100px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            animation: floatBadge 5s ease-in-out infinite alternate;
            z-index: 2;
            font-size: 0.9rem;
        }

        .badge-1 {
            top: 10%;
            left: 0;
            animation-delay: 0s;
        }

        .badge-2 {
            bottom: 15%;
            right: 0;
            animation-delay: 1.5s;
        }

        @media (max-width: 576px) {
            .floating-dish {
                max-width: 300px;
            }

            .badge-1 {
                left: -10px;
            }

            .badge-2 {
                right: -10px;
            }
        }

        @keyframes floatDish {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }

        @keyframes floatBadge {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(10px);
            }
        }

        .animate-fade-up {
            animation: fadeInUp 1s ease-out forwards;
            opacity: 0;
        }

        .delay-100 {
            animation-delay: 0.2s;
        }

        .delay-200 {
            animation-delay: 0.4s;
        }

        .delay-300 {
            animation-delay: 0.6s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Testimonial New Style */
        .testimonial-card {
            background: var(--surface);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            padding: 40px;
            height: 100%;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .testimonial-card::before {
            content: '\f10d';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            top: 20px;
            left: 30px;
            font-size: 4rem;
            color: rgba(255, 140, 0, 0.05);
            z-index: 0;
        }

        .testimonial-text {
            color: var(--text-dim);
            font-style: italic;
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: auto;
        }

        .author-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--glass);
            border: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .author-info h5 {
            margin-bottom: 0;
            color: #fff;
            font-weight: 700;
        }

        .author-info span {
            color: var(--primary);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Stats & About Enhancements */
        .stats-card {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 30px 20px;
            transition: var(--transition);
        }

        .stats-card:hover {
            background: rgba(255, 140, 0, 0.05);
            border-color: var(--primary);
            transform: translateY(-5px);
        }

        .stats-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 20px;
            opacity: 0.8;
        }

        .rounded-custom {
            border-radius: 40px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5) !important;
        }

        .btn-ember {
            background: var(--primary);
            color: #fff !important;
            padding: 15px 35px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            letter-spacing: 1px;
            transition: var(--transition);
            box-shadow: 0 10px 20px rgba(255, 140, 0, 0.3);
        }

        .btn-ember:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(255, 140, 0, 0.5);
        }

        /* Add to Cart Button */
        .btn-add {
            background: var(--glass);
            color: #fff;
            border: 1px solid var(--glass-border);
            padding: 10px;
            border-radius: 12px;
            text-align: center;
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
            font-weight: 600;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-add:hover {
            background: var(--primary);
            border-color: var(--primary);
            transform: scale(1.1);
            color: #fff;
        }

        .quantity-selector-sm {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            padding: 2px;
        }

        .btn-qty-sm {
            background: transparent;
            border: none;
            color: #fff;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-qty-sm:hover {
            background: var(--primary);
        }

        .input-qty-sm {
            background: transparent;
            border: none;
            color: #fff;
            width: 30px;
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            outline: none;
            padding: 0;
            -moz-appearance: textfield;
        }

        .input-qty-sm::-webkit-outer-spin-button,
        .input-qty-sm::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* New Action Group Style */
        .action-group {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            padding: 4px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .divider-vertical {
            width: 1px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
        }

        .btn-action-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: transparent;
            transition: all 0.2s;
        }

        .btn-action-icon:hover {
            background: var(--primary);
            color: #fff;
        }

        .btn-view-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            background: transparent;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-view-icon:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-color: #fff;
        }
    </style>
@endsection

@section('container')
    <section id="home-section" class="hero-new">
        <div class="container">
            <div class="row align-items-center">
                <!-- Text Section -->
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <span class="subheading-ember animate-fade-up">#PREMIUM_CATERING_SURABAYA</span>
                    <h1 class="hero-title-new animate-fade-up delay-100 text-white">
                        RASA <span class="text-gradient">ISTIMEWA</span><br>
                        DI SETIAP <span class="text-gradient">Suapan</span>
                    </h1>
                    <p class="hero-desc-new animate-fade-up delay-200">
                        Nikmati kelezatan masakan autentik dengan bahan pilihan berkualitas terbaik.
                        Kami hadir untuk melengkapi kebahagiaan di setiap acara spesial Anda.
                    </p>
                    <div class="d-flex gap-3 animate-fade-up delay-300" style="gap: 15px;">
                        <a href="/produk" class="btn-ember-glow">
                            LIHAT MENU <i class="fas fa-utensils ml-2"></i>
                        </a>
                        <a href="/contact" class="btn-ember-outline">
                            HUBUNGI KAMI
                        </a>
                    </div>
                </div>

                <!-- Image Section -->
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="hero-floating-image">
                        <img src="{{ asset('images/hero-beranda.jpg') }}" alt="Premium Dish"
                            class="img-fluid floating-dish">

                        <!-- Floating Badges -->
                        <div class="floating-badge badge-1">
                            <i class="fas fa-star text-warning"></i>
                            <div>
                                <span class="d-block" style="line-height:1">4.9/5</span>
                                <span style="font-size:10px; opacity:0.7">Rating Pelanggan</span>
                            </div>
                        </div>

                        <div class="floating-badge badge-2">
                            <i class="fas fa-truck text-info"></i>
                            <div>
                                <span class="d-block" style="line-height:1">Pengiriman</span>
                                <span style="font-size:10px; opacity:0.7">Tepat Waktu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb" style="margin-top: -100px; position: relative; z-index: 10;">
        <div class="container">
            <div class="row ftco-services g-4 justify-content-center">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="services text-center p-5"
                        style="background: rgba(16, 16, 16, 0.9); backdrop-filter: blur(15px); border: 1px solid var(--glass-border); border-radius: 30px; transition: var(--transition);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center mx-auto"
                            style="width: 80px; height: 80px; background: rgba(255, 140, 0, 0.1); border-radius: 20px; color: var(--primary); font-size: 2rem;">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="media-body">
                            <h3 class="heading mb-3 text-white" style="font-weight: 700;">Pengiriman Cepat</h3>
                            <p class="text-muted mb-0">Katering tiba tepat waktu, hangat, dan siap disantap untuk acaramu.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="services text-center p-5"
                        style="background: rgba(16, 16, 16, 0.9); backdrop-filter: blur(15px); border: 1px solid var(--glass-border); border-radius: 30px; transition: var(--transition);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center mx-auto"
                            style="width: 80px; height: 80px; background: rgba(255, 140, 0, 0.1); border-radius: 20px; color: var(--primary); font-size: 2rem;">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="media-body">
                            <h3 class="heading mb-3 text-white" style="font-weight: 700;">Rasa Premium</h3>
                            <p class="text-muted mb-0">Bahan segar berkualitas tinggi diolah oleh koki berpengalaman kami.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="services text-center p-5"
                        style="background: rgba(16, 16, 16, 0.9); backdrop-filter: blur(15px); border: 1px solid var(--glass-border); border-radius: 30px; transition: var(--transition);">
                        <div class="icon mb-4 d-flex align-items-center justify-content-center mx-auto"
                            style="width: 80px; height: 80px; background: rgba(255, 140, 0, 0.1); border-radius: 20px; color: var(--primary); font-size: 2rem;">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="media-body">
                            <h3 class="heading mb-3 text-white" style="font-weight: 700;">Pembayaran Aman</h3>
                            <p class="text-muted mb-0">Sistem pembayaran yang aman dan praktis untuk setiap pesananmu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="ftco-section">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="stats-card">
                        <div class="stats-icon"><i class="fas fa-users"></i></div>
                        <h2 class="text-ember mb-1" style="font-size: 2.5rem;">10K+</h2>
                        <p class="text-muted text-uppercase small font-weight-bold mb-0">Pelanggan Puas</p>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stats-card">
                        <div class="stats-icon"><i class="fas fa-utensils"></i></div>
                        <h2 class="text-ember mb-1" style="font-size: 2.5rem;">100+</h2>
                        <p class="text-muted text-uppercase small font-weight-bold mb-0">Menu Spesial</p>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stats-card">
                        <div class="stats-icon"><i class="fas fa-handshake"></i></div>
                        <h2 class="text-ember mb-1" style="font-size: 2.5rem;">50+</h2>
                        <p class="text-muted text-uppercase small font-weight-bold mb-0">Mitra Acara</p>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="stats-card">
                        <div class="stats-icon"><i class="fas fa-check-circle"></i></div>
                        <h2 class="text-ember mb-1" style="font-size: 2.5rem;">100%</h2>
                        <p class="text-muted text-uppercase small font-weight-bold mb-0">Halal & Higienis</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="ftco-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-5 mb-md-0" data-aos="fade-right">
                    <div class="position-relative pr-lg-5">
                        <img src="{{ asset('images/nasi-kebuli.webp') }}" alt="Tentang Mumu Kitchen"
                            class="img-fluid rounded-custom">
                        <div class="position-absolute p-4 glass-card shadow-lg"
                            style="bottom: -20px; right: 20px; border-radius: 25px; background: rgba(16, 16, 16, 0.9); backdrop-filter: blur(15px); border: 1px solid var(--glass-border); z-index: 10;">
                            <h4 class="text-ember mb-0" style="font-weight: 800;">Est. 2026</h4>
                            <p class="text-white small mb-0 opacity-75">Menyajikan Kebahagiaan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <div class="heading-section pl-lg-5">
                        <span class="subheading" style="font-size: 0.8rem; letter-spacing: 3px;">Filosofi Kami</span>
                        <h2 class="mb-4 text-white" style="font-size: 2.8rem; line-height: 1.2;">Lebih dari Sekadar <span
                                class="text-ember">Rasa</span></h2>
                        <p class="text-muted mb-5" style="font-size: 1.1rem; line-height: 1.8;">
                            <strong class="text-white">Mumu Kitchen</strong> percaya bahwa makanan adalah hati dari setiap
                            pertemuan. Kami berdedikasi untuk
                            menyajikan hidangan katering yang tidak hanya lezat, tetapi juga menggugah selera dan
                            mempererat kebersamaan.<br><br>
                            Dari masakan rumahan yang otentik hingga kreasi modern yang inovatif, setiap menu kami dirancang
                            untuk memanjakan lidah Anda.
                        </p>
                        <ul class="list-unstyled mb-5 text-white opacity-75">
                            <li class="mb-3 d-flex align-items-center gap-3"><i
                                    class="fas fa-check-circle text-ember"></i> Bahan Organik & Segar Setiap Hari</li>
                            <li class="mb-3 d-flex align-items-center gap-3"><i
                                    class="fas fa-check-circle text-ember"></i> Resep Warisan Keluarga Tradisional</li>
                            <li class="mb-3 d-flex align-items-center gap-3"><i
                                    class="fas fa-check-circle text-ember"></i> Standar Kebersihan Internasional</li>
                        </ul>
                        <a href="/about" class="btn-ember">BACA CERITA KAMI <i
                                class="fas fa-arrow-right ml-2 small"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Grid Section -->
    <section class="ftco-section" style="background-color: var(--dark);">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-12 heading-section text-center" data-aos="fade-up">
                    <span class="subheading">Menu Favorit</span>
                    <h2 class="mb-4 text-white">Pilihan <span class="text-ember">Terlaris</span></h2>
                    <p style="color: rgba(255,255,255,0.6);">Temukan menu katering dan hidangan penutup paling diminati
                        pelanggan kami.</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row g-4 justify-content-center">
                @forelse ($produkk as $index => $item)
                    <div class="col-sm-12 col-md-6 col-lg-4 d-flex" data-aos="fade-up"
                        data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="product d-flex flex-column w-100 h-100 position-relative"
                            style="background: var(--surface); border-radius: 30px; overflow: hidden; border: 1px solid var(--glass-border); transition: var(--transition);">
                            @if ($index == 0)
                                <div class="position-absolute p-3" style="z-index: 5;">
                                    <span class="badge"
                                        style="background: var(--primary); color: white; border-radius: 50px; padding: 8px 15px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Terlaris</span>
                                </div>
                            @elseif($index == 1)
                                <div class="position-absolute p-3" style="z-index: 5;">
                                    <span class="badge"
                                        style="background: var(--primary); color: white; border-radius: 50px; padding: 8px 15px; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Favorite</span>
                                </div>
                            @endif
                            <a href="{{ url('produkdetail/' . $item->id) }}" class="img-prod"
                                style="overflow: hidden; display: block;">
                                @php
                                    // Check if image exists in storage, otherwise use default images
                                    $imagePath =
                                        $item->gambar && file_exists(public_path('storage/' . $item->gambar))
                                            ? 'storage/' . $item->gambar
                                            : ($index == 0
                                                ? 'images/nasi-kebuli.webp'
                                                : ($index == 1
                                                    ? 'images/rawon.jpg'
                                                    : 'images/rendang.jpg'));
                                @endphp
                                <img class="img-fluid w-100 h-100" style="object-fit: cover; aspect-ratio: 1/1;"
                                    src="{{ asset($imagePath) }}" alt="{{ $item->nama_produk }}">
                            </a>
                            <div class="text py-4 px-4 flex-grow-1 d-flex flex-column">
                                <div class="cat mb-2">
                                    <span
                                        style="color: var(--primary); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">{{ $item->kategori->nama_kategori ?? 'Menu' }}</span>
                                </div>
                                <h3 class="mb-3" style="font-size: 1.5rem;"><a
                                        href="{{ url('produkdetail/' . $item->id) }}" class="text-white fw-bold"
                                        style="text-decoration: none;">{{ $item->nama_produk }}</a></h3>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <div class="pricing">
                                        <p class="price mb-0"><span
                                                style="color: white; font-size: 1.3rem; font-weight: 800;">Rp
                                                {{ number_format($item->harga, 0, ',', '.') }}</span></p>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center gap-2">
                                        @php
                                            $hasSizes = $item->ukuran->count() > 0;
                                            $totalStock = $hasSizes ? $item->ukuran->sum('pivot.stock') : $item->stok;

                                            $firstAvailable = $hasSizes
                                                ? $item->ukuran->where('pivot.stock', '>', 0)->first()
                                                : null;
                                            $canBuy = $hasSizes ? $totalStock > 0 && $firstAvailable : $totalStock > 0;
                                        @endphp

                                        @if ($canBuy)
                                            <div class="action-group">
                                                <button class="btn-qty-sm" onclick="updateCardQty(this, -1)">-</button>
                                                <input type="number" class="input-qty-sm" value="1" min="1"
                                                    max="{{ $hasSizes ? $firstAvailable->pivot->stock : $totalStock }}">
                                                <button class="btn-qty-sm" onclick="updateCardQty(this, 1)">+</button>
                                                <div class="divider-vertical"></div>
                                                <button class="btn-action-icon"
                                                    onclick="instantAddToCart(this, '{{ $item->id }}', '{{ $hasSizes ? $firstAvailable->pivot->id : '' }}', '{{ $item->nama_produk }}')">
                                                    <i class="fas fa-shopping-cart" style="font-size: 0.9rem;"></i>
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-muted small">Stok Habis</span>
                                        @endif
                                        <a href="{{ url('produkdetail/' . $item->id) }}" class="btn-view-icon">
                                            <i class="fas fa-eye" style="font-size: 0.9rem;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-utensils fa-4x text-muted mb-3"></i>
                        <h4 class="text-white">Belum Ada Produk</h4>
                        <p class="text-muted">Produk akan segera hadir</p>
                    </div>
                @endforelse
            </div>

            <div class="row mt-5">
                <div class="col-md-12 text-center" data-aos="fade-up">
                    <a href="/produk" class="btn-ember-outline" style="padding: 15px 40px; border-radius: 50px;">
                        LIHAT SEMUA MENU <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Special Catering Packages Section Removed -->

    <!-- Testimonials Section -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-12 heading-section text-center" data-aos="fade-up">
                    <span class="subheading">Suara Pelanggan</span>
                    <h2 class="mb-4 text-white">Kata <span class="text-ember">Mereka</span></h2>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card">
                        <p class="testimonial-text text-white">"Katering Mumu Kitchen rasanya juara! Bumbunya meresap dan
                            porsinya pas banget. Sangat recommended untuk acara kantor!"</p>
                        <div class="testimonial-author">
                            <div class="author-img">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="author-info">
                                <h5>Budi Santoso</h5>
                                <span>Karyawan Swasta</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-card">
                        <p class="testimonial-text text-white">"Minuman Peppi-nya segar banget, cocok buat nemenin makan
                            siang.
                            Pasti bakal pesan lagi buat acara keluarga."</p>
                        <div class="testimonial-author">
                            <div class="author-img">
                                <i class="fas fa-user-female"></i>
                            </div>
                            <div class="author-info">
                                <h5>Siti Aminah</h5>
                                <span>Ibu Rumah Tangga</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="testimonial-card">
                        <p class="testimonial-text text-white">"Pelayanan ramah dan pengiriman selalu tepat waktu. Sangat
                            membantu
                            untuk acara mendadak sekalipun."</p>
                        <div class="testimonial-author">
                            <div class="author-img">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="author-info">
                                <h5>Agus Prayoga</h5>
                                <span>Wirausaha</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Force functions to global scope
            window.updateCardQty = function(btn, change) {
                const container = btn.closest('.action-group');
                if (!container) return;

                const input = container.querySelector('input');
                if (!input) return;

                let newVal = parseInt(input.value) + change;
                if (newVal >= 1) {
                    input.value = newVal;
                }
            };

            window.instantAddToCart = function(btn, produkId, ukuranProdukId, produkName) {
                // Check if user is logged in
                @guest
                if (confirm('Anda harus login terlebih dahulu. Login sekarang?')) {
                    window.location.href = '/login';
                }
                return;
            @endguest

            @auth
            // Disable button and show loading icon
            const icon = btn.querySelector('i');
            const originalClass = icon.className;
            icon.className = 'fas fa-spinner fa-spin';
            btn.disabled = true;

            // Find quantity from the closest action group
            let qty = 1;
            const container = btn.closest('.action-group');
            if (container) {
                const qtyInput = container.querySelector('input');
                if (qtyInput) {
                    qty = qtyInput.value;
                }
            }

            // Prepare data
            const formData = new FormData();
            formData.append('produk_id', produkId);
            formData.append('ukuran_produk_id', ukuranProdukId);
            formData.append('kuantitas', qty);
            formData.append('_token', '{{ csrf_token() }}');

            // AJAX call to add to cart
            fetch('/keranjang', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update navbar count
                        const cartCount = document.getElementById('cart-count');
                        if (cartCount && data.cart_count !== undefined) {
                            cartCount.innerText = data.cart_count;
                        }
                    }

                    // Show feedback
                    icon.className = 'fas fa-check';
                    btn.style.backgroundColor = '#28a745';
                    btn.style.borderColor = '#28a745';

                    // Notification using SweetAlert2 if available
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `${produkName} (${qty} item) ditambahkan ke keranjang`,
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true,
                            position: 'top-end',
                            background: '#1a1a1a',
                            color: '#fff'
                        });
                    }

                    // Restore button after 1s
                    setTimeout(() => {
                        icon.className = originalClass;
                        btn.disabled = false;
                        btn.style.backgroundColor = '';
                        btn.style.borderColor = '';
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    icon.className = originalClass;
                    btn.disabled = false;

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: error.message || 'Gagal menambahkan ke keranjang',
                            background: '#1a1a1a',
                            color: '#fff'
                        });
                    } else {
                        alert('Gagal menambahkan ke keranjang: ' + (error.message || 'Error tidak diketahui'));
                    }
                });
        @endauth
        };
        });
    </script>
@endsection
