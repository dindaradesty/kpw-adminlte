<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'PerpusKita')
    </title>


    <!-- AdminLTE CSS -->

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

            transition: 0.2s;

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
           DROPDOWN
        ========================= */

        .dropdown-menu {

            border: none;

            border-radius: 12px;

            box-shadow: 0 10px 30px rgba(0,0,0,0.12);

        }


        .dropdown-item {

            padding: 10px 15px;

        }


        .dropdown-item:hover {

            background: #f5f1e8;

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


            <!-- SIDEBAR TOGGLE -->

            <ul class="navbar-nav">

                <li class="nav-item">

                    <a class="nav-link"
                       href="#"
                       data-lte-toggle="sidebar">

                        <i class="bi bi-list"></i>

                    </a>

                </li>

            </ul>


            <!-- USER -->

            <ul class="navbar-nav ms-auto">

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       data-bs-toggle="dropdown">

                        <i class="bi bi-person-circle"></i>

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


        <!-- LOGO -->

        <div class="sidebar-brand">

            <a href="{{ url('/dashboard') }}"
               class="brand-link text-decoration-none">

                <span class="brand-text">

                    PerpusKita

                </span>

            </a>

        </div>


        <!-- MENU -->

        <div class="sidebar-wrapper">

            <nav class="mt-2">

                <ul class="nav sidebar-menu flex-column"
                    data-lte-toggle="treeview"
                    role="menu">


                    <!-- DASHBOARD -->

                    <li class="nav-item">

                        <a href="{{ url('/dashboard') }}"
                           class="nav-link">

                            <i class="nav-icon bi bi-speedometer2"></i>

                            <p>

                                Dashboard

                            </p>

                        </a>

                    </li>


                    <!-- BUKU -->

                    <li class="nav-item">

                        <a href="{{ url('/buku') }}"
                           class="nav-link">

                            <i class="nav-icon bi bi-book"></i>

                            <p>

                                Data Buku

                            </p>

                        </a>

                    </li>


                    <!-- ANGGOTA -->

                    <li class="nav-item">

                        <a href="{{ url('/anggota') }}"
                           class="nav-link">

                            <i class="nav-icon bi bi-people"></i>

                            <p>

                                Anggota

                            </p>

                        </a>

                    </li>


                    <!-- PEMINJAMAN -->

                    <li class="nav-item">

                        <a href="{{ url('/peminjaman') }}"
                           class="nav-link">

                            <i class="nav-icon bi bi-journal-text"></i>

                            <p>

                                Peminjaman

                            </p>

                        </a>

                    </li>


                </ul>

            </nav>

        </div>

    </aside>



    <!-- =========================
         CONTENT
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

        <strong>

            PerpusKita

        </strong>

        <span class="ms-1">

            © 2026

        </span>

    </footer>


</div>



<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<!-- AdminLTE JS -->

<script src="{{ asset('adminlte/js/adminlte.min.js') }}">
</script>


</body>

</html>