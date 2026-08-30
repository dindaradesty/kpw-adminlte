@extends('template.master')

@section('title', 'Data Buku - PerpusKita')

@section('content')

<div class="page-header">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-book-half me-2"></i>
                Data Buku
            </h2>

            <p class="mb-0 opacity-75">
                Kelola koleksi buku PerpusKita.
            </p>

        </div>

        <button class="btn btn-add"
                data-bs-toggle="collapse"
                data-bs-target="#formTambahBuku">

            <i class="bi bi-plus-lg me-1"></i>
            Tambah Buku

        </button>

    </div>

</div>


<!-- FORM -->

<div class="collapse mb-4" id="formTambahBuku">

    <div class="card custom-card shadow-sm">

        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">
                Tambah Data Buku
            </h5>

            <form action="{{ route('buku.store') }}"
                  method="POST">

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
                            Tahun Terbit
                        </label>

                        <input type="number"
                               name="tahun_terbit"
                               class="form-control"
                               placeholder="Contoh: 2024"
                               min="1900"
                               max="2100"
                               required>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Stok
                        </label>

                        <input type="number"
                               name="stok"
                               class="form-control"
                               placeholder="Jumlah stok"
                               min="0"
                               required>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Kategori
                        </label>

                        <select name="kategori_id"
                                class="form-select"
                                required>

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            @foreach($kategori as $item)

                                <option value="{{ $item['id'] }}">
                                    {{ $item['nama'] }}
                                </option>

                            @endforeach

                        </select>

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

        <div class="card custom-card shadow-sm">

            <div class="card-body">

                <small class="text-muted">
                    Total Buku
                </small>

                <h2 class="fw-bold mt-1">
                    {{ count($buku) }}
                </h2>

            </div>

        </div>

    </div>


    <div class="col-md-4 mb-3">

        <div class="card custom-card shadow-sm">

            <div class="card-body">

                <small class="text-muted">
                    Total Stok
                </small>

                <h2 class="fw-bold mt-1">
                    {{ collect($buku)->sum('stok') }}
                </h2>

            </div>

        </div>

    </div>


    <div class="col-md-4 mb-3">

        <div class="card custom-card shadow-sm">

            <div class="card-body">

                <small class="text-muted">
                    Kategori Buku
                </small>

                <h2 class="fw-bold mt-1">
                    {{ count($kategori) }}
                </h2>

            </div>

        </div>

    </div>

</div>


<!-- TABEL -->

<div class="card custom-card shadow-sm">

    <div class="card-body p-0">

        <div class="p-4">

            <h5 class="fw-bold mb-1">
                Daftar Buku
            </h5>

            <small class="text-muted">
                Seluruh koleksi buku PerpusKita.
            </small>

        </div>


        <div class="table-responsive">

            <table class="table custom-table mb-0">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun Terbit</th>
                        <th>Stok</th>
                        <th>Kategori</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($buku as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <strong>
                                {{ $item['judul'] }}
                            </strong>
                        </td>

                        <td>
                            {{ $item['penulis'] }}
                        </td>

                        <td>
                            {{ $item['tahun_terbit'] }}
                        </td>

                        <td>

                            <span class="badge rounded-pill"
                                  style="background:#d9e2cf;color:#435334;">

                                {{ $item['stok'] }}

                            </span>

                        </td>

                        <td>
                            {{ $item['kategori'] ?? '-' }}
                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6"
                            class="text-center text-muted py-4">

                            Belum ada data buku.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection