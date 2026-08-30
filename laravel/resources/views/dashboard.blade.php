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
    }

    .custom-card {
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

    .book-item {
        padding: 15px 0;
        border-bottom: 1px solid #e5e0d6;
    }

    .book-item:last-child {
        border-bottom: none;
    }

    .book-cover {
        width: 48px;
        height: 58px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }
</style>


<!-- =========================
     WELCOME
========================= -->

<div class="welcome-box">

    <div class="row align-items-center">

        <div class="col-md-8">

            <h1>
                Selamat Datang, {{ session('user_name', 'Admin') }}!
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


<!-- =========================
     STATISTIK
========================= -->

<div class="row">

    <!-- TOTAL BUKU -->

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1">
                            Total Buku
                        </p>

                        <h2 class="fw-bold mb-0">
                            {{ count($buku) }}
                        </h2>

                        <small class="text-success">
                            <i class="bi bi-book"></i>
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


    <!-- TOTAL ANGGOTA -->

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1">
                            Total Anggota
                        </p>

                        <h2 class="fw-bold mb-0">
                            {{ count($anggota) }}
                        </h2>

                        <small class="text-success">
                            <i class="bi bi-people"></i>
                            Anggota perpustakaan
                        </small>

                    </div>

                    <div class="stat-icon bg-cream text-sage">

                        <i class="bi bi-people"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- SEDANG DIPINJAM -->

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1">
                            Sedang Dipinjam
                        </p>

                        <h2 class="fw-bold mb-0">
                            {{ collect($peminjaman)->where('status', 'Dipinjam')->count() }}
                        </h2>

                        <small class="text-warning">
                            <i class="bi bi-journal-arrow-up"></i>
                            Buku sedang keluar
                        </small>

                    </div>

                    <div class="stat-icon bg-brown text-sage">

                        <i class="bi bi-journal-arrow-up"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- PENGEMBALIAN -->

    <div class="col-lg-3 col-md-6 mb-4">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <p class="text-muted mb-1">
                            Pengembalian
                        </p>

                        <h2 class="fw-bold mb-0">
                            {{ count($pengembalian) }}
                        </h2>

                        <small class="text-success">
                            <i class="bi bi-check-circle"></i>
                            Buku dikembalikan
                        </small>

                    </div>

                    <div class="stat-icon bg-soft text-sage">

                        <i class="bi bi-arrow-return-left"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =========================
     BAGIAN BAWAH
========================= -->

<div class="row">


    <!-- DAFTAR BUKU -->

    <div class="col-lg-7 mb-4">

        <div class="card custom-card shadow-sm">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h4 class="fw-bold mb-1">

                            <i class="bi bi-book-half text-warning me-2"></i>

                            Koleksi Buku

                        </h4>

                        <small class="text-muted">
                            Daftar buku yang tersedia di PerpusKita
                        </small>

                    </div>

                    <a href="{{ url('/buku') }}"
                       class="btn btn-sm btn-perpus">

                        Lihat Semua

                    </a>

                </div>

            </div>


            <div class="card-body px-4">

                @forelse(collect($buku)->take(5) as $item)

                    <div class="book-item d-flex align-items-center">

                        <div class="book-cover bg-sage text-sage">

                            <i class="bi bi-book fs-4"></i>

                        </div>

                        <div class="flex-grow-1">

                            <strong>
                                {{ $item['judul'] }}
                            </strong>

                            <br>

                            <small class="text-muted">

                                {{ $item['penulis'] }}

                                @if(isset($item['tahun_terbit']))
                                    · {{ $item['tahun_terbit'] }}
                                @endif

                            </small>

                        </div>

                        <span class="badge rounded-pill"
                              style="background:#d9e2cf;color:#435334;">

                            Stok: {{ $item['stok'] }}

                        </span>

                    </div>

                @empty

                    <div class="text-center text-muted py-4">

                        <i class="bi bi-book fs-2"></i>

                        <p class="mt-2 mb-0">
                            Belum ada data buku.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    <!-- AKTIVITAS TERBARU -->

    <div class="col-lg-5 mb-4">

        <div class="card custom-card shadow-sm">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h4 class="fw-bold mb-1">

                    <i class="bi bi-lightning-charge-fill text-warning me-2"></i>

                    Aktivitas Terbaru

                </h4>

                <small class="text-muted">
                    Aktivitas perpustakaan
                </small>

            </div>


            <div class="card-body px-4">

                @forelse(collect($peminjaman)->take(4) as $item)

                    <div class="activity-item d-flex">

                        <div class="activity-icon bg-primary bg-opacity-10 text-primary">

                            <i class="bi bi-journal-arrow-up"></i>

                        </div>

                        <div>

                            <strong>
                                {{ $item['anggota'] ?? 'Anggota' }} meminjam buku
                            </strong>

                            <br>

                            <small class="text-muted">

                                {{ $item['buku'] ?? 'Buku' }}

                                ·

                                {{ $item['tanggal_pinjam'] }}

                            </small>

                        </div>

                    </div>

                @empty

                    <div class="text-center text-muted py-4">

                        <i class="bi bi-clock-history fs-2"></i>

                        <p class="mt-2 mb-0">
                            Belum ada aktivitas.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection