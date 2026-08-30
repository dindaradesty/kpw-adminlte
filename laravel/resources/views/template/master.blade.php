<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'PerpusKita')</title>

    <!-- AdminLTE -->
    <link rel="stylesheet"
          href="{{ asset('adminlte/css/adminlte.min.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body {
            background: #f5f1e8;
        }

        /* =========================
           NAVBAR
        ========================= */

        .app-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e5e0d6;
        }

        .app-header .nav-link {
            color: #435334 !important;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .app-sidebar {
            background: #435334 !important;
        }

        .sidebar-brand {
            background: #344329;
            padding: 18px;
        }

        .brand-text {
            color: #ffffff !important;
            font-size: 21px;
            font-weight: 700 !important;
        }

        .sidebar-menu .nav-link {
            color: #e4eadc !important;
            border-radius: 10px;
            margin: 4px 10px;
            transition: .2s;
        }

        .sidebar-menu .nav-link:hover {
            background: #596b47 !important;
            color: #ffffff !important;
        }

        .sidebar-menu .nav-link.active {
            background: #d4a373 !important;
            color: #ffffff !important;
        }

        .sidebar-menu .nav-icon {
            color: inherit !important;
        }

        /* =========================
           CONTENT
        ========================= */

        .app-main {
            background: #f5f1e8;
        }

        /* =========================
           FOOTER
        ========================= */

        .app-footer {
            background: #ffffff;
            border-top: 1px solid #e5e0d6;
            color: #59604f;
        }

        /* =========================
           CARD
        ========================= */

        .custom-card {
            border: none;
            border-radius: 18px;
            background: #ffffff;
        }

        /* =========================
           HEADER HALAMAN
        ========================= */

        .page-header {
            background: #435334;
            color: white;
            border-radius: 20px;
            padding: 25px 30px;
            margin-bottom: 25px;
        }

        /* =========================
           BUTTON
        ========================= */

        .btn-add {
            background: #d4a373;
            border: none;
            color: white;
            border-radius: 10px;
            padding: 10px 18px;
        }

        .btn-add:hover {
            background: #b98255;
            color: white;
        }

        /* =========================
           TABLE
        ========================= */

        .custom-table {
            border-radius: 18px;
            overflow: hidden;
        }

        .custom-table thead {
            background: #f0eadf;
            color: #435334;
        }

        .custom-table th {
            padding: 15px;
            border: none;
        }

        .custom-table td {
            padding: 15px;
            vertical-align: middle;
        }

        /* =========================
           FORM
        ========================= */

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #ddd7ca;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #435334;
            box-shadow: 0 0 0 .15rem rgba(67,83,52,.15);
        }

    </style>

</head>

<body class="layout-fixed">

<div class="app-wrapper">

    <!-- =========================
         NAVBAR
    ========================= -->

    <nav class="app-header navbar navbar-expand">

        <div class="container-fluid">

            <ul class="navbar-nav">

                <li class="nav-item">

                    <a class="nav-link"
                       href="#"
                       data-lte-toggle="sidebar">

                        <i class="bi bi-list"></i>

                    </a>

                </li>

            </ul>


            <ul class="navbar-nav ms-auto">

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       data-bs-toggle="dropdown">

                        <i class="bi bi-person-circle me-1"></i>

                        {{ session('user_name', 'Admin') }}

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>

                            <form action="{{ route('logout') }}"
                                  method="POST">

                                @csrf

                                <button type="submit"
                                        class="dropdown-item">

                                    <i class="bi bi-box-arrow-right me-2"></i>

                                    Logout

                                </button>

                            </form>

                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </nav>


    <!-- =========================
         SIDEBAR
    ========================= -->

    <aside class="app-sidebar shadow">

        <div class="sidebar-brand">

            <a href="{{ url('/dashboard') }}"
               class="brand-link text-decoration-none">

                <span class="brand-text">
                    PerpusKita
                </span>

            </a>

        </div>


        <div class="sidebar-wrapper">

            <nav class="mt-2">

                <ul class="nav sidebar-menu flex-column"
                    role="menu">


                    <!-- DASHBOARD -->

                    <li class="nav-item">

                        <a href="{{ url('/dashboard') }}"
                           class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">

                            <i class="nav-icon bi bi-speedometer2"></i>

                            <p>Dashboard</p>

                        </a>

                    </li>


                    <!-- BUKU -->

                    <li class="nav-item">

                        <a href="{{ url('/buku') }}"
                           class="nav-link {{ request()->is('buku') ? 'active' : '' }}">

                            <i class="nav-icon bi bi-book"></i>

                            <p>Data Buku</p>

                        </a>

                    </li>


                    <!-- KATEGORI -->

                    <li class="nav-item">

                        <a href="{{ url('/kategori') }}"
                           class="nav-link {{ request()->is('kategori') ? 'active' : '' }}">

                            <i class="nav-icon bi bi-tags"></i>

                            <p>Kategori</p>

                        </a>

                    </li>


                    <!-- ANGGOTA -->

                    <li class="nav-item">

                        <a href="{{ url('/anggota') }}"
                           class="nav-link {{ request()->is('anggota') ? 'active' : '' }}">

                            <i class="nav-icon bi bi-people"></i>

                            <p>Anggota</p>

                        </a>

                    </li>


                    <!-- PEMINJAMAN -->

                    <li class="nav-item">

                        <a href="{{ url('/peminjaman') }}"
                           class="nav-link {{ request()->is('peminjaman') ? 'active' : '' }}">

                            <i class="nav-icon bi bi-journal-text"></i>

                            <p>Peminjaman</p>

                        </a>

                    </li>


                    <!-- PENGEMBALIAN -->

                    <li class="nav-item">

                        <a href="{{ url('/pengembalian') }}"
                           class="nav-link {{ request()->is('pengembalian') ? 'active' : '' }}">

                            <i class="nav-icon bi bi-arrow-return-left"></i>

                            <p>Pengembalian</p>

                        </a>

                    </li>

                </ul>

            </nav>

        </div>

    </aside>


    <!-- =========================
         MAIN CONTENT
    ========================= -->

    <main class="app-main">

        <div class="app-content">

            <div class="container-fluid py-4">

                @yield('content')

            </div>

        </div>

    </main>


    <!-- =========================
         FOOTER
    ========================= -->

    <footer class="app-footer">

        <strong>PerpusKita</strong>

        <span class="ms-1">
            © 2026
        </span>

    </footer>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

<script src="{{ asset('adminlte/js/adminlte.min.js') }}">
</script>

</body>

</html>