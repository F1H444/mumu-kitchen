<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Masuk - Mumu Kitchen</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #FF8C00;
            --dark: #050505;
            --surface: #101010;
            --glass: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-main: #FFFFFF;
            --text-dim: #bbbbbb;
            --font-main: 'Outfit', sans-serif;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--dark);
            color: var(--text-main);
            height: 100vh;
            overflow: hidden;
        }

        .split-screen {
            height: 100vh;
            display: flex;
        }

        .left-pane {
            flex: 1;
            background: url("{{ asset('images/login.jpg') }}") no-repeat center center;
            background-size: cover;
            position: relative;
            display: none;
        }

        .left-pane::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        .left-pane-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem;
            color: white;
        }

        .right-pane {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem;
            background: var(--dark);
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
        }

        .auth-logo {
            font-weight: 900;
            font-size: 2rem;
            text-transform: uppercase;
            color: var(--primary);
            text-decoration: none;
            margin-bottom: 2rem;
            display: block;
        }

        .auth-logo span {
            color: #fff;
        }

        .form-floating>.form-control {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 1rem 1rem;
            height: auto;
            font-weight: 600;
            color: #fff;
        }

        .form-floating>.form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--primary);
            box-shadow: none;
            color: #fff;
        }

        /* Fix for browser autofill background */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #1a1a1a inset !important;
            -webkit-text-fill-color: white !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .form-floating>label {
            color: var(--text-dim);
        }

        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
            color: var(--text-dim);
            opacity: 0.8;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #e67e00;
            border-color: #e67e00;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 140, 0, 0.2);
        }

        .text-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .text-link:hover {
            color: #e67e00;
            text-decoration: underline;
        }

        .text-muted {
            color: var(--text-dim) !important;
        }

        @media (min-width: 992px) {
            .left-pane {
                display: block;
            }
        }
    </style>
</head>

<body>
    <div class="split-screen">
        <div class="left-pane">
            <div class="left-pane-content">
                <h1 class="display-3 fw-bold mb-4">Nikmati Rasa <br>Istimewa.</h1>
                <p class="h4 fw-light">Bergabunglah dengan Mumu Kitchen dan nikmati layanan katering premium terbaik.
                </p>
            </div>
        </div>
        <div class="right-pane">
            <a href="/" class="auth-logo">Mumu<span>Kitchen</span></a>
            <h3 class="fw-bold mb-4 text-white">Selamat Datang Kembali!</h3>
            <p class="text-muted mb-5">Silakan masuk ke akun Anda.</p>

            @if (Session('error'))
                <div class="alert alert-danger mb-4 rounded-3 border-0 bg-danger text-white">
                    {{ Session('error') }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputEmail" type="email" name="email"
                        placeholder="name@example.com" autocomplete="off" required />
                    <label for="inputEmail">Alamat Email</label>
                </div>
                <div class="form-floating mb-4 position-relative">
                    <input class="form-control" id="inputPassword" type="password" name="password"
                        placeholder="Password" required style="padding-right: 45px;" />
                    <label for="inputPassword">Kata Sandi</label>
                    <span onclick="togglePassword('inputPassword', 'toggleIcon')"
                        class="position-absolute top-50 end-0 translate-middle-y me-3"
                        style="z-index: 10; cursor: pointer;">
                        <i id="toggleIcon" class="fas fa-eye text-muted"></i>
                    </span>
                </div>

                <button class="btn btn-primary w-100 mb-3" type="submit">Masuk Sekarang</button>
                <a href="/auth/google" class="btn btn-outline-light w-100 mb-4">
                    <i class="fab fa-google me-2"></i> Masuk dengan Google
                </a>

                <div class="text-center">
                    <p class="text-muted">Belum punya akun? <a href="/register" class="text-link">Daftar disini</a></p>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>
