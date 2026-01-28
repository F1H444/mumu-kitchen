@extends('front.layouts.main')

@section('style')
    <style>
        :root {
            --primary: #FF8C00;
            --primary-glow: rgba(255, 140, 0, 0.4);
            --accent: #FF3B3B;
            --dark: #050505;
            --surface: #101010;
            --glass: rgba(255, 255, 255, 0.05);
            --glass-card: rgba(20, 20, 20, 0.6);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-main: #FFFFFF;
            --text-dim: #bbbbbb;
            --font-main: 'Outfit', sans-serif;
            --transition: all 0.3s cubic-bezier(0.2, 1, 0.3, 1);
        }

        body {
            background-color: var(--dark);
            color: var(--text-main);
            font-family: var(--font-main);
        }

        .page-header {
            padding: 150px 0 60px;
            background: var(--dark);
            text-align: center;
            border-bottom: none;
        }

        .page-title {
            font-size: 3.5rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 20px;
            color: #fff;
            text-shadow: 0 0 30px rgba(255, 140, 0, 0.3);
        }

        .breadcrumb-custom {
            display: inline-flex;
            gap: 10px;
            background: var(--glass);
            padding: 8px 20px;
            border-radius: 50px;
            border: 1px solid var(--glass-border);
            font-size: 0.9rem;
            color: var(--text-dim);
        }

        .breadcrumb-custom a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        /* Contact Info Cards */
        .info-card {
            background: var(--surface);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 25px;
            height: 100%;
            transition: var(--transition);
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .info-card:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
            background: var(--glass-card);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 140, 0, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .info-content h4 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #fff;
        }

        .info-content p {
            color: var(--text-dim);
            margin: 0;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        /* Map Container */
        .map-container {
            border-radius: 30px;
            overflow: hidden;
            border: 1px solid var(--glass-border);
            height: 100%;
            min-height: 450px;
            position: relative;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            filter: grayscale(100%) invert(90%);
            /* Dark map effect */
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .social-btn {
            width: 45px;
            height: 45px;
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            transition: var(--transition);
        }

        .social-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            transform: scale(1.1);
        }
    </style>
@endsection

@section('container')
    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <div class="breadcrumb-custom animate-fade-up delay-100">
                <a href="/">Kontak</a>
            </div>
            <h1 class="page-title animate-fade-up">Hubungi Kami</h1>
        </div>
    </header>

    <section class="ftco-section pt-0">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Information -->
                <div class="col-lg-5 animate-fade-up delay-200">
                    <div class="mb-5">
                        <h2 class="h3 fw-bold text-white mb-4">Informasi Kontak</h2>
                        <p class="text-dim mb-4">Punya pertanyaan atau ingin memesan katering untuk acara spesial Anda?
                            Hubungi kami melalui kontak di bawah ini.</p>

                        <div class="d-flex flex-column gap-4">
                            <!-- Address -->
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Alamat</h4>
                                    <p>Jl. Petemon Kuburan No. 42 D</p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Telepon / WhatsApp</h4>
                                    <p>0857-4849-0179<br>0857-8571-0751</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Email</h4>
                                    <p>mumukitchen@gmail.com</p>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="social-links">
                            <a href="https://www.instagram.com/mumu_kitchen2022?utm_source=qr&igsh=MW0yc2ZrdGZ4Nzlibw=="
                                target="_blank" class="social-btn"><i class="fab fa-instagram"></i></a>
                            <a href="https://wa.me/6285748490179" target="_blank" class="social-btn"><i
                                    class="fab fa-whatsapp"></i></a>
                            <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="col-lg-7 animate-fade-up delay-300">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.766235290325!2d112.72394407604918!3d-7.267422071409562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f957fb649119%3A0x2a7673dd33cac0bd!2sJl.%20Petemon%20Kuburan%20No.42-D%2C%20RT.003%2FRW.02%2C%20Sawahan%2C%20Kec.%20Sawahan%2C%20Surabaya%2C%20Jawa%20Timur%2060251!5e0!3m2!1sid!2sid!4v1769092244743!5m2!1sid!2sid"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
