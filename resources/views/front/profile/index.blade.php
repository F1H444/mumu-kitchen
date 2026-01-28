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
                url('{{ asset('assets2/images/bg_6.jpg') }}');
            background-size: cover;
            background-position: center;
            text-align: center;
        }

        .profile-container {
            padding: 80px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 60vh;
        }

        .card-profile {
            width: 100%;
            max-width: 500px;
            background-color: var(--surface);
            border: 1px solid var(--glass-border);
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.4);
            border-radius: 30px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card-profile:hover {
            border-color: var(--primary);
        }

        .card-header-custom {
            padding: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--glass-border);
            background: rgba(255, 140, 0, 0.05);
        }

        .card-header-custom span {
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--primary);
            font-size: 0.9rem;
        }

        .profile-forms {
            padding: 35px;
        }

        .input-group-custom {
            display: flex;
            flex-direction: column;
            margin-bottom: 25px;
        }

        .input-group-custom label {
            font-size: 13px;
            color: #888;
            margin-bottom: 10px;
            margin-left: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .input-group-custom input {
            height: 50px;
            padding: 0px 20px;
            font-size: 16px;
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            color: #fff;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-group-custom input:focus {
            border-color: var(--primary);
            background: rgba(255, 140, 0, 0.02);
            box-shadow: 0 0 15px rgba(255, 140, 0, 0.1);
        }

        .input-group-custom input[readonly] {
            background: transparent;
            border-color: transparent;
            padding-left: 5px;
            cursor: default;
        }

        .btn-profile-action {
            width: 100%;
            height: 55px;
            background: var(--primary);
            border: none;
            color: #fff;
            border-radius: 15px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px var(--primary-glow);
        }

        .btn-profile-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px var(--primary-glow);
            filter: brightness(1.1);
        }

        .btn-profile-action.mode-edit {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            box-shadow: none;
        }
    </style>
@endsection

@section('container')
    <section class="hero-bread-custom">
        <div class="container">
            <span class="subheading-ember animate-fade-up">Manajemen Akun</span>
            <h1 class="hero-title-new text-white animate-fade-up delay-100" style="font-size: 3.5rem;">
                PROFIL <span class="text-gradient">SAYA</span>
            </h1>
        </div>
    </section>

    <div class="profile-container">
        <div class="container d-flex justify-content-center">
            <div class="card-profile animate-fade-up delay-200">
                <div class="card-header-custom">
                    <span><i class="fas fa-user-circle mr-2"></i> Informasi Dasar</span>
                </div>
                <div class="profile-forms">
                    <form action="{{ url('/profileuser') }}" method="POST" id="profileForm">
                        @csrf
                        <div class="input-group-custom">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" value="{{ $user->name }}" readonly id="inputName">
                        </div>

                        <div class="input-group-custom">
                            <label>Alamat Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" readonly id="inputEmail">
                        </div>

                        <button type="button" id="toggleButton" class="btn-profile-action mode-edit">
                            <i class="fas fa-edit mr-2"></i> Edit Profil
                        </button>

                        <button type="submit" id="saveButton" class="btn-profile-action mt-3 d-none">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const toggleButton = document.getElementById('toggleButton');
        const saveButton = document.getElementById('saveButton');
        const inputs = [document.getElementById('inputName'), document.getElementById('inputEmail')];

        toggleButton.addEventListener('click', function() {
            // Aktifkan input
            inputs.forEach(input => {
                input.removeAttribute('readonly');
                input.style.border = "1px solid var(--primary)";
                input.style.background = "var(--glass)";
            });

            // Sembunyikan tombol edit, tampilkan tombol save
            toggleButton.classList.add('d-none');
            saveButton.classList.remove('d-none');

            // Fokus ke input pertama
            inputs[0].focus();
        });
    </script>
@endsection
