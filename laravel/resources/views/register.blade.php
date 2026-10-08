<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register - PerpusKita</title>

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
            padding: 30px 0;
        }

        .register-wrapper {
            width: 100%;
            max-width: 550px;
            padding: 20px;
        }

        .register-card {
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

        .register-title {
            color: #435334;
            font-weight: 700;
        }

        .section-title {
            color: #435334;
            font-weight: 700;
            margin-top: 25px;
            margin-bottom: 15px;
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

        .register-button {
            width: 100%;
            background: #435334;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-weight: 600;
            margin-top: 10px;
        }

        .register-button:hover {
            background: #344329;
            color: white;
        }

        .error-box {
            background: #f3dfdb;
            color: #8c5047;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 18px;
        }

        .input-group-text {
            background: white;
            border-radius: 12px 0 0 12px;
            border: 1px solid #ddd8cd;
            border-right: none;
            color: #435334;
        }

    </style>

</head>

<body>

<div class="register-wrapper">

    <div class="register-card">

        <!-- LOGO -->
        <div class="logo-box">
            <i class="bi bi-book-half"></i>
        </div>

        <!-- JUDUL -->
        <div class="text-center mb-4">

            <h2 class="register-title">
                Daftar PerpusKita
            </h2>

            <p class="text-muted mb-0">
                Buat akun petugas perpustakaan
            </p>

        </div>

        <!-- ERROR -->
        @if ($errors->any())

            <div class="error-box">

                <i class="bi bi-exclamation-circle me-1"></i>

                <ul class="mb-0 ps-3">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('register.store') }}"
              method="POST">

            @csrf

            <!-- DATA AKUN -->
            <h5 class="section-title">
                <i class="bi bi-person-badge me-1"></i>
                Data Akun
            </h5>

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Nama
                </label>

                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Username
                </label>

                <input type="text"
                       name="username"
                       class="form-control"
                       value="{{ old('username') }}"
                       placeholder="Masukkan username"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Password
                </label>

                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Minimal 8 karakter"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Konfirmasi Password
                </label>

                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Ulangi password"
                       required>

            </div>

            <!-- DATA PROFILE -->
            <h5 class="section-title">
                <i class="bi bi-person-lines-fill me-1"></i>
                Data Profile
            </h5>

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Nama Profile
                </label>

                <input type="text"
                       name="nama"
                       class="form-control"
                       value="{{ old('nama') }}"
                       placeholder="Masukkan nama profile"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    No. Telepon
                </label>

                <input type="text"
                       name="no_telp"
                       class="form-control"
                       value="{{ old('no_telp') }}"
                       placeholder="Masukkan nomor telepon">

            </div>

            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Alamat
                </label>

                <textarea name="alamat"
                          class="form-control"
                          rows="3"
                          placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="register-button">

                <i class="bi bi-person-plus me-1"></i>

                Daftar Akun

            </button>

        </form>

        <!-- LOGIN -->
        <div class="text-center mt-4">

            <span class="text-muted">
                Sudah punya akun?
            </span>

            <a href="{{ route('login') }}">
                Login sekarang
            </a>

        </div>

        <div class="text-center mt-3">

            <small class="text-muted">
                PerpusKita © 2026
            </small>

        </div>

    </div>

</div>

</body>

</html>