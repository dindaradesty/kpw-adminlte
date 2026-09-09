<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - PerpusKita</title>

    <link rel="stylesheet"
          href="{{ asset('adminlte/css/adminlte.min.css') }}">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body {
            min-height: 100vh;
            background: #f5f1e8;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 430px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 25px;
            padding: 35px;
            box-shadow: 0 15px 40px rgba(67, 83, 52, 0.15);
        }

        .logo-box {
            width: 75px;
            height: 75px;
            background: #435334;
            color: white;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin: 0 auto 20px;
        }

        .login-title {
            color: #435334;
            font-weight: 700;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #ddd8cd;
        }

        .form-control:focus {
            border-color: #6b7d52;
            box-shadow: 0 0 0 3px rgba(107, 125, 82, .12);
        }

        .input-group-text {
            background: white;
            border-radius: 12px 0 0 12px;
            border: 1px solid #ddd8cd;
            border-right: none;
            color: #435334;
        }

        .login-button {
            width: 100%;
            background: #435334;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-weight: 600;
        }

        .login-button:hover {
            background: #344329;
            color: white;
        }

        .error-box {
            background: #f3dfdb;
            color: #8c5047;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 18px;
        }

    </style>

</head>


<body>

<div class="login-wrapper">

    <div class="login-card">

        <!-- LOGO -->

        <div class="logo-box">

            <i class="bi bi-book-half"></i>

        </div>


        <!-- JUDUL -->

        <div class="text-center mb-4">

            <h2 class="login-title">
                PerpusKita
            </h2>

            <p class="text-muted mb-0">
                Silakan masuk untuk melanjutkan
            </p>

        </div>


        <!-- ERROR -->

        @if(session('error'))

            <div class="error-box">

                <i class="bi bi-exclamation-circle me-1"></i>

                {{ session('error') }}

            </div>

        @endif


        <!-- FORM -->

        <form action="{{ url('/login') }}"
              method="POST">

            @csrf


            <!-- USERNAME -->

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Username
                </label>

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="bi bi-person"></i>

                    </span>

                    <input type="text"
                           name="username"
                           class="form-control"
                           placeholder="Masukkan username"
                           required>

                </div>

            </div>


            <!-- PASSWORD -->

            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Password
                </label>

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="bi bi-lock"></i>

                    </span>

                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Masukkan password"
                           required>

                </div>

            </div>


            <!-- BUTTON -->

            <button type="submit"
                    class="login-button">

                <i class="bi bi-box-arrow-in-right me-1"></i>

                Masuk ke PerpusKita

            </button>

        </form>


        <div class="text-center mt-4">

            <small class="text-muted">

                PerpusKita © 2026

            </small>

        </div>

    </div>

</div>

</body>

</html>