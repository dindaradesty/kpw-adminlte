@extends('template.master')

@section('title', 'Dashboard - PerpusKita')

@section('content')

<style>
    body {
        background: #f5f1e8;
        color: #292d25;
    }

    .welcome-box {
        background: linear-gradient(135deg, #435334, #6b7d52);
        border-radius: 24px;
        padding: 32px;
        color: #ffffff;
        margin-bottom: 25px;
        box-shadow: 0 8px 25px rgba(67, 83, 52, 0.2);
    }

    .welcome-box h1 {
        font-weight: 700;
        color: #ffffff;
    }

    .stat-card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        overflow: hidden;
        transition: 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(67, 83, 52, 0.12) !important;
    }

    .stat-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        font-weight: bold;
    }

    .book-card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
    }

    .activity-item {
        padding: 15px 0;
        border-bottom: 1px solid #e5e0d6;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 44px;
        height: 44px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        font-size: 18px;
    }

    .text-sage {
        color: #435334 !important;
    }

    .bg-sage {
        background: #d9e2cf !important;
    }

    .bg-cream {
        background: #ead7b7 !important;
    }

    .bg-brown {
        background: #d4b896 !important;
    }

    .bg-soft {
        background: #dedbd2 !important;
    }

    .btn-perpus {
        background: #435334;
        border-color: #435334;
        color: #ffffff;
        border-radius: 10px;
    }

    .btn-perpus:hover {
        background: #344329;
        border-color: #344329;
        color: #ffffff;
    }

    .dashboard-title {
        color: #292d25;
    }
</style>

<!-- WELCOME -->
<div class="welcome-box">

    <div class="row align-items-center">

        <div class="col-md-8">

            <h1>
                Selamat Datang, Admin! 
            </h1>

            <p class="mb-0">
                Kelola perpustakaan dengan mudah melalui PerpusKita.
            </p>

        </div>

        <div class="col-md-4 text-md-end mt-3 mt-md-0">

            <i class="bi bi-book-half"
               style="font-size: 90px; opacity: 0.25;">
            </i>

        </div>

    </div>

</div>


<!-- STATISTIK -->
<div class="row">

    <!-- BUKU -->
    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1">
                            Total Buku
                        </p>

                        <h2 class="fw-bold mb-0">
                            245
                        </h2>

                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i>
                            Koleksi perpustakaan
                        </small>

                    </div>

                    <div class="stat-icon bg-sage text-sage">

                        <i class="bi bi-book"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ANGGOTA -->
    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1">
                            Total Anggota
                        </p>

                        <h2 class="fw-bold mb-0">
                            128
                        </h2>

                        <small class="text-success">
                            <i class="bi bi-person-plus"></i>
                            12 anggota baru
                        </small>

                    </div>

                    <div class="stat-icon bg-cream text-sage">

                        <i class="bi bi-people"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- PEMINJAMAN -->
    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1">
                            Sedang Dipinjam
                        </p>

                        <h2 class="fw-bold mb-0">
                            37
                        </h2>

                        <small class="text-warning">
                            <i class="bi bi-journal-bookmark"></i>
                            Buku keluar
                        </small>

                    </div>

                    <div class="stat-icon bg-brown text-sage">

                        <i class="bi bi-journal-arrow-up"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- TERLAMBAT -->
    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1">
                            Terlambat
                        </p>

                        <h2 class="fw-bold mb-0">
                            8
                        </h2>

                        <small class="text-danger">
                            <i class="bi bi-exclamation-circle"></i>
                            Perlu perhatian
                        </small>

                    </div>

                    <div class="stat-icon bg-soft text-sage">

                        <i class="bi bi-clock-history"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- BAGIAN BAWAH -->
<div class="row">


    <!-- BUKU TERPOPULER -->
    <div class="col-lg-7 mb-4">

        <div class="card book-card shadow-sm">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h4 class="fw-bold mb-1">
                            <i class="bi bi-stars text-warning me-2"></i>
                            Buku Terpopuler
                        </h4>

                        <small class="text-muted">
                            Buku yang paling sering dipinjam
                        </small>

                    </div>

                    <a href="{{ url('/buku') }}"
                       class="btn btn-sm btn-perpus">

                        Lihat Semua

                    </a>

                </div>

            </div>


            <div class="card-body px-4">

                <!-- BUKU 1 -->
                <div class="d-flex align-items-center mb-4">

                    <div class="bg-sage text-sage rounded-3
                                d-flex align-items-center justify-content-center me-3"
                         style="width: 48px; height: 55px;">

                        <i class="bi bi-book fs-4"></i>

                    </div>

                    <div class="flex-grow-1">

                        <strong>
                            Dasar-Dasar Laravel
                        </strong>

                        <br>

                        <small class="text-muted">
                            Budi Santoso
                        </small>

                    </div>

                    <span class="badge text-bg-primary">
                        32x dipinjam
                    </span>

                </div>


                <!-- BUKU 2 -->
                <div class="d-flex align-items-center mb-4">

                    <div class="bg-cream text-sage rounded-3
                                d-flex align-items-center justify-content-center me-3"
                         style="width: 48px; height: 55px;">

                        <i class="bi bi-book fs-4"></i>

                    </div>

                    <div class="flex-grow-1">

                        <strong>
                            Pemrograman Web Modern
                        </strong>

                        <br>

                        <small class="text-muted">
                            Andi Pratama
                        </small>

                    </div>

                    <span class="badge text-bg-success">
                        27x dipinjam
                    </span>

                </div>


                <!-- BUKU 3 -->
                <div class="d-flex align-items-center">

                    <div class="bg-brown text-sage rounded-3
                                d-flex align-items-center justify-content-center me-3"
                         style="width: 48px; height: 55px;">

                        <i class="bi bi-book fs-4"></i>

                    </div>

                    <div class="flex-grow-1">

                        <strong>
                            Belajar Database MySQL
                        </strong>

                        <br>

                        <small class="text-muted">
                            Siti Rahma
                        </small>

                    </div>

                    <span class="badge text-bg-warning">
                        21x dipinjam
                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- AKTIVITAS -->
    <div class="col-lg-5 mb-4">

        <div class="card book-card shadow-sm">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h4 class="fw-bold mb-1">

                    <i class="bi bi-lightning-charge-fill text-warning me-2"></i>

                    Aktivitas Terbaru

                </h4>

                <small class="text-muted">
                    Aktivitas perpustakaan hari ini
                </small>

            </div>


            <div class="card-body px-4">

                <div class="activity-item d-flex">

                    <div class="activity-icon bg-primary bg-opacity-10 text-primary">

                        <i class="bi bi-book"></i>

                    </div>

                    <div>

                        <strong>
                            Andi meminjam buku
                        </strong>

                        <br>

                        <small class="text-muted">
                            Dasar-Dasar Laravel · 10 menit lalu
                        </small>

                    </div>

                </div>


                <div class="activity-item d-flex">

                    <div class="activity-icon bg-success bg-opacity-10 text-success">

                        <i class="bi bi-check-circle"></i>

                    </div>

                    <div>

                        <strong>
                            Siti mengembalikan buku
                        </strong>

                        <br>

                        <small class="text-muted">
                            Database MySQL · 30 menit lalu
                        </small>

                    </div>

                </div>


                <div class="activity-item d-flex">

                    <div class="activity-icon bg-warning bg-opacity-10 text-warning">

                        <i class="bi bi-person-plus"></i>

                    </div>

                    <div>

                        <strong>
                            Anggota baru terdaftar
                        </strong>

                        <br>

                        <small class="text-muted">
                            Budi Santoso · 1 jam lalu
                        </small>

                    </div>

                </div>


                <div class="activity-item d-flex">

                    <div class="activity-icon bg-danger bg-opacity-10 text-danger">

                        <i class="bi bi-exclamation-circle"></i>

                    </div>

                    <div>

                        <strong>
                            Buku terlambat dikembalikan
                        </strong>

                        <br>

                        <small class="text-muted">
                            HTML & CSS Dasar · 2 jam lalu
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection