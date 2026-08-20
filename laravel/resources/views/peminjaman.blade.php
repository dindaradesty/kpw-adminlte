@extends('template.master')

@section('title', 'Peminjaman - PerpusKita')

@section('content')

<style>
    body {
        background: #f5f1e8;
    }

    .loan-header {
        background: linear-gradient(135deg, #435334, #6b7d52);
        color: white;
        border-radius: 20px;
        padding: 28px 30px;
        margin-bottom: 25px;
    }

    .loan-card {
        border: none;
        border-radius: 18px;
        background: white;
    }

    .loan-card:hover {
        transform: translateY(-3px);
    }

    .loan-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
    }

    .loan-table {
        border-radius: 20px;
        overflow: hidden;
        background: white;
    }

    .loan-table thead {
        background: #f0eadf;
        color: #435334;
    }

    .loan-table th {
        padding: 16px;
        border: none;
    }

    .loan-table td {
        padding: 15px;
        vertical-align: middle;
    }

    .btn-loan {
        background: #d4a373;
        border: none;
        color: white;
        border-radius: 10px;
        padding: 10px 18px;
    }

    .btn-loan:hover {
        background: #b98255;
        color: white;
    }
</style>


<!-- HEADER -->
<div class="loan-header">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-journal-bookmark-fill me-2"></i>

                Peminjaman Buku

            </h2>

            <p class="mb-0 opacity-75">

                Pantau peminjaman dan pengembalian buku.

            </p>

        </div>

        <button class="btn btn-loan"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#formTambahPeminjaman">

    <i class="bi bi-plus-lg me-1"></i>
    Peminjaman Baru

</button>

    </div>

</div>

<div class="collapse mb-4" id="formTambahPeminjaman">

    <div class="card border-0 shadow-sm"
         style="border-radius:20px;">

        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">
                Tambah Peminjaman
            </h5>

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Anggota
                        </label>

                        <select name="anggota" class="form-select" required>

    <option value="">
        -- Pilih Anggota --
    </option>

    @foreach($anggota as $item)

        <option value="{{ $item['nama'] }}">
            {{ $item['nama'] }} - {{ $item['id_anggota'] }}
        </option>

    @endforeach

</select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Buku
                        </label>

                        <select name="buku" class="form-select" required>

    <option value="">
        -- Pilih Buku --
    </option>

    @foreach($buku as $item)

        @if($item['status'] === 'Tersedia')

            <option value="{{ $item['judul'] }}">
                {{ $item['judul'] }} - {{ $item['kode'] }}
            </option>

        @endif

    @endforeach

</select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tanggal Pinjam
                        </label>

                        <input type="date"
                               name="tanggal_pinjam"
                               class="form-control"
                               required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Jatuh Tempo
                        </label>

                        <input type="date"
                               name="jatuh_tempo"
                               class="form-control"
                               required>

                    </div>

                </div>

                <button type="submit"
                        class="btn btn-loan">

                    <i class="bi bi-save me-1"></i>
                    Simpan Peminjaman

                </button>

            </form>

        </div>

    </div>

</div>


<!-- STATISTIK -->
<div class="row mb-4">

    <div class="col-md-3 mb-3">

        <div class="card loan-card shadow-sm">

            <div class="card-body">

                <small class="text-muted">
                    Sedang Dipinjam
                </small>

                <div class="d-flex justify-content-between align-items-center">

                    <h2 class="fw-bold mt-2 mb-0">
                        37
                    </h2>

                    <div class="loan-icon"
                         style="background:#d9e2cf;color:#435334;">

                        <i class="bi bi-book"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-3 mb-3">

        <div class="card loan-card shadow-sm">

            <div class="card-body">

                <small class="text-muted">
                    Dikembalikan
                </small>

                <div class="d-flex justify-content-between align-items-center">

                    <h2 class="fw-bold mt-2 mb-0">
                        156
                    </h2>

                    <div class="loan-icon"
                         style="background:#e5dfc8;color:#756b3c;">

                        <i class="bi bi-check-circle"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-3 mb-3">

        <div class="card loan-card shadow-sm">

            <div class="card-body">

                <small class="text-muted">
                    Jatuh Tempo
                </small>

                <div class="d-flex justify-content-between align-items-center">

                    <h2 class="fw-bold mt-2 mb-0">
                        5
                    </h2>

                    <div class="loan-icon"
                         style="background:#ead7b7;color:#9a6b3f;">

                        <i class="bi bi-calendar-event"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-3 mb-3">

        <div class="card loan-card shadow-sm">

            <div class="card-body">

                <small class="text-muted">
                    Terlambat
                </small>

                <div class="d-flex justify-content-between align-items-center">

                    <h2 class="fw-bold mt-2 mb-0">
                        8
                    </h2>

                    <div class="loan-icon"
                         style="background:#e8d4d0;color:#8c5047;">

                        <i class="bi bi-clock-history"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- TABEL PEMINJAMAN -->
<div class="card loan-table border-0 shadow-sm">

    <div class="card-body p-0">

        <div class="p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1">
                        Riwayat Peminjaman
                    </h5>

                    <small class="text-muted">
                        Daftar transaksi peminjaman buku
                    </small>

                </div>

                <div style="width:230px;">

                    <div class="input-group">

                        <span class="input-group-text bg-white">

                            <i class="bi bi-search"></i>

                        </span>

                        <input type="text"
                               class="form-control"
                               placeholder="Cari transaksi...">

                    </div>

                </div>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table loan-table mb-0">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

@foreach($peminjaman as $item)

<tr>

    <td>
        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
    </td>

    <td>

        <strong>
            {{ $item['anggota'] }}
        </strong>

        <br>

        <small class="text-muted">
            {{ $item['id_anggota'] }}
        </small>

    </td>

    <td>
        {{ $item['buku'] }}
    </td>

    <td>
        {{ $item['tanggal_pinjam'] }}
    </td>

    <td>
        {{ $item['jatuh_tempo'] }}
    </td>

    <td>

        @if($item['status'] === 'Terlambat')

            <span class="badge rounded-pill"
                  style="background:#e8d4d0;color:#8c5047;">

                Terlambat

            </span>

        @elseif($item['status'] === 'Jatuh Tempo')

            <span class="badge rounded-pill"
                  style="background:#ead7b7;color:#9a6b3f;">

                Jatuh Tempo

            </span>

        @else

            <span class="badge rounded-pill"
                  style="background:#d9e2cf;color:#435334;">

                Dipinjam

            </span>

        @endif

    </td>

    <td>

        <button class="btn btn-sm btn-outline-secondary">

            <i class="bi bi-check-lg"></i>

        </button>

        <button class="btn btn-sm btn-outline-secondary">

            <i class="bi bi-eye"></i>

        </button>

    </td>

</tr>

@endforeach

</tbody>

            </table>

        </div>

    </div>

</div>

@endsection