@extends('template.master')

@section('title', 'Data Buku - PerpusKita')

@section('content')

<style>
    .page-header {
        background: #435334;
        color: white;
        border-radius: 20px;
        padding: 25px 30px;
        margin-bottom: 25px;
    }

    .book-stat {
        border: none;
        border-radius: 18px;
        background: white;
        transition: .2s;
    }

    .book-stat:hover {
        transform: translateY(-4px);
    }

    .book-table {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: white;
    }

    .book-table thead {
        background: #f0eadf;
        color: #435334;
    }

    .book-table th {
        padding: 16px;
        border: none;
    }

    .book-table td {
        padding: 16px;
        vertical-align: middle;
    }

    .book-icon {
        width: 45px;
        height: 55px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        background: #d9e2cf;
        color: #435334;
    }

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
</style>


<!-- HEADER -->
<div class="page-header">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-book-half me-2"></i>
                Koleksi Buku
            </h2>

            <p class="mb-0 opacity-75">
                Kelola dan pantau koleksi buku perpustakaan.
            </p>

        </div>

        <button class="btn btn-add"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#formTambahBuku">
    <i class="bi bi-plus-lg me-1"></i>
    Tambah Buku
</button>

    </div>

</div>

<div class="collapse mb-4" id="formTambahBuku">

    <div class="card border-0 shadow-sm"
         style="border-radius:20px;">

        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">
                Tambah Data Buku
            </h5>

            <form action="{{ route('buku.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Judul Buku
                        </label>

                        <input type="text"
                               name="judul"
                               class="form-control"
                               placeholder="Masukkan judul buku"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Kode Buku
                        </label>

                        <input type="text"
                               name="kode"
                               class="form-control"
                               placeholder="Contoh: BK-005"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Penulis
                        </label>

                        <input type="text"
                               name="penulis"
                               class="form-control"
                               placeholder="Masukkan nama penulis"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Kategori
                        </label>

                        <input type="text"
                               name="kategori"
                               class="form-control"
                               placeholder="Contoh: Teknologi"
                               required>
                    </div>

                </div>

                <button type="submit"
                        class="btn btn-add">
                    <i class="bi bi-save me-1"></i>
                    Simpan Buku
                </button>

            </form>

        </div>

    </div>

</div>


<!-- STATISTIK -->
<div class="row mb-4">

    <div class="col-md-4 mb-3">

        <div class="card book-stat shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Total Koleksi
                        </small>

                        <h2 class="fw-bold mt-1">
    {{ count($buku) }}
</h2>

                    </div>

                    <div class="book-icon">

                        <i class="bi bi-bookshelf fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-4 mb-3">

        <div class="card book-stat shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Buku Tersedia
                        </small>

                        <h2 class="fw-bold mt-1">
    {{ collect($buku)->where('status', 'Tersedia')->count() }}
</h2>

                    </div>

                    <div class="book-icon"
                         style="background:#e5dfc8; color:#756b3c;">

                        <i class="bi bi-check-circle fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-4 mb-3">

        <div class="card book-stat shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <small class="text-muted">
                            Sedang Dipinjam
                        </small>

                        <h2 class="fw-bold mt-1">
    {{ collect($buku)->where('status', 'Dipinjam')->count() }}
</h2>

                    </div>

                    <div class="book-icon"
                         style="background:#ead7b7; color:#9a6b3f;">

                        <i class="bi bi-journal-arrow-up fs-4"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- TABEL -->
<div class="card book-table shadow-sm">

    <div class="card-body p-0">

        <div class="p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1">
                        Daftar Buku
                    </h5>

                    <small class="text-muted">
                        Koleksi buku yang tersedia di PerpusKita
                    </small>

                </div>

                <div style="width: 230px;">

                    <div class="input-group">

                        <span class="input-group-text bg-white">

                            <i class="bi bi-search"></i>

                        </span>

                        <input type="text"
                               class="form-control"
                               placeholder="Cari buku...">

                    </div>

                </div>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table book-table mb-0">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Informasi Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


              <tbody>

@foreach($buku as $item)

<tr>

    <td>
        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
    </td>

    <td>

        <div class="d-flex align-items-center">

            <div class="book-icon">

                <i class="bi bi-book"></i>

            </div>

            <div>

                <strong>
                    {{ $item['judul'] }}
                </strong>

                <br>

                <small class="text-muted">
                    {{ $item['kode'] }}
                </small>

            </div>

        </div>

    </td>

    <td>
        {{ $item['penulis'] }}
    </td>

    <td>
        {{ $item['kategori'] }}
    </td>

    <td>

        <span class="badge rounded-pill"
              style="background:#d9e2cf;color:#435334;">

            {{ $item['status'] }}

        </span>

    </td>

    <td>

        <button class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-eye"></i>
        </button>

        <button class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-pencil"></i>
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