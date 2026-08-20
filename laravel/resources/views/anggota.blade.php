@extends('template.master')

@section('title', 'Data Anggota - PerpusKita')

@section('content')

<style>
    body {
        background: #f5f1e8;
    }

    .member-header {
        background: linear-gradient(135deg, #435334, #6b7d52);
        color: white;
        border-radius: 20px;
        padding: 28px 30px;
        margin-bottom: 25px;
    }

    .member-card {
        border: none;
        border-radius: 18px;
        background: white;
        transition: .2s;
    }

    .member-card:hover {
        transform: translateY(-4px);
    }

    .member-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
    }

    .member-table {
        border-radius: 20px;
        overflow: hidden;
        background: white;
    }

    .member-table thead {
        background: #f0eadf;
        color: #435334;
    }

    .member-table th {
        padding: 16px;
        border: none;
    }

    .member-table td {
        padding: 15px;
        vertical-align: middle;
    }

    .avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 10px;
    }

    .btn-member {
        background: #d4a373;
        border: none;
        color: white;
        border-radius: 10px;
        padding: 10px 18px;
    }

    .btn-member:hover {
        background: #b98255;
        color: white;
    }
</style>


<!-- HEADER -->
<div class="member-header">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-people-fill me-2"></i>
                Data Anggota
            </h2>

            <p class="mb-0 opacity-75">
                Kelola anggota yang terdaftar di PerpusKita.
            </p>

        </div>

        <button class="btn btn-member"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#formTambahAnggota">

    <i class="bi bi-person-plus-fill me-1"></i>
    Tambah Anggota

</button>

    </div>

</div>

<div class="collapse mb-4" id="formTambahAnggota">

    <div class="card border-0 shadow-sm"
         style="border-radius:20px;">

        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">
                Tambah Data Anggota
            </h5>

            <form action="{{ route('anggota.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Nama Anggota
                        </label>

                        <input type="text"
                               name="nama"
                               class="form-control"
                               placeholder="Masukkan nama anggota"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            ID Anggota
                        </label>

                        <input type="text"
                               name="id_anggota"
                               class="form-control"
                               placeholder="Contoh: AGT-005"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="Masukkan email"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Kelas
                        </label>

                        <input type="text"
                               name="kelas"
                               class="form-control"
                               placeholder="Contoh: XI RPL 1"
                               required>
                    </div>

                </div>

                <button type="submit"
                        class="btn btn-member">

                    <i class="bi bi-save me-1"></i>
                    Simpan Anggota

                </button>

            </form>

        </div>

    </div>

</div>


<!-- STATISTIK -->
<div class="row mb-4">

    <div class="col-md-4 mb-3">

        <div class="card member-card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Total Anggota
                        </small>

                        <h2 class="fw-bold mt-1 mb-0">
    {{ count($anggota) }}
</h2>

                    </div>

                    <div class="member-icon"
                         style="background:#d9e2cf;color:#435334;">

                        <i class="bi bi-people-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-4 mb-3">

        <div class="card member-card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Anggota Aktif
                        </small>
<h2 class="fw-bold mt-1 mb-0">
    {{ collect($anggota)->where('status', 'Aktif')->count() }}
</h2>

                    </div>

                    <div class="member-icon"
                         style="background:#e5dfc8;color:#756b3c;">

                        <i class="bi bi-person-check-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-4 mb-3">

        <div class="card member-card shadow-sm">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Peminjam Aktif
                        </small>

                        <h2 class="fw-bold mt-1 mb-0">
                            37
                        </h2>

                    </div>

                    <div class="member-icon"
                         style="background:#ead7b7;color:#9a6b3f;">

                        <i class="bi bi-journal-bookmark-fill"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- DAFTAR ANGGOTA -->
<div class="card member-table border-0 shadow-sm">

    <div class="card-body p-0">

        <div class="p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1">
                        Daftar Anggota
                    </h5>

                    <small class="text-muted">
                        Data anggota perpustakaan
                    </small>

                </div>

                <div style="width:230px;">

                    <div class="input-group">

                        <span class="input-group-text bg-white">

                            <i class="bi bi-search"></i>

                        </span>

                        <input type="text"
                               class="form-control"
                               placeholder="Cari anggota...">

                    </div>

                </div>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table member-table mb-0">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Anggota</th>
                        <th>ID Anggota</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

@foreach($anggota as $item)

<tr>

    <td>
        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
    </td>

    <td>

        <div class="d-flex align-items-center">

            <div class="avatar"
                 style="background:#d9e2cf;color:#435334;">

                {{ strtoupper(substr($item['nama'], 0, 1)) }}

            </div>

            <div>

                <strong>
                    {{ $item['nama'] }}
                </strong>

                <br>

                <small class="text-muted">
                    {{ $item['email'] }}
                </small>

            </div>

        </div>

    </td>

    <td>
        {{ $item['id_anggota'] }}
    </td>

    <td>
        {{ $item['kelas'] }}
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