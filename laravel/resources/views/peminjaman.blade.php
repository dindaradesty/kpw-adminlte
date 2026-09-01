@extends('template.master')

@section('title', 'Peminjaman - PerpusKita')

@section('content')

<div class="page-header">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-journal-text me-2"></i>

                Peminjaman

            </h2>

            <p class="mb-0 opacity-75">

                Kelola transaksi peminjaman buku.

            </p>

        </div>


        <button class="btn btn-add"
                data-bs-toggle="collapse"
                data-bs-target="#formPeminjaman">

            <i class="bi bi-plus-lg me-1"></i>

            Tambah Peminjaman

        </button>

    </div>

</div>


<!-- FORM -->

<div class="collapse mb-4" id="formPeminjaman">

    <div class="card custom-card shadow-sm">

        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">
                Tambah Peminjaman
            </h5>


            <form action="{{ route('peminjaman.store') }}"
                  method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Anggota
                        </label>

                        <select name="anggota_id"
                                class="form-select"
                                required>

                            <option value="">
                                -- Pilih Anggota --
                            </option>

                            @foreach($anggota as $item)

                                <option value="{{ $item['id'] }}">

                                    {{ $item['nama'] }}
                                    - {{ $item['nis'] }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Buku
                        </label>

                        <select name="buku_id"
                                class="form-select"
                                required>

                            <option value="">
                                -- Pilih Buku --
                            </option>

                            @foreach($buku as $item)

                                <option value="{{ $item['id'] }}">

                                    {{ $item['judul'] }}

                                </option>

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
                            Tanggal Jatuh Tempo
                        </label>

                        <input type="date"
                               name="tanggal_jatuh_tempo"
                               class="form-control"
                               required>

                    </div>

                </div>


                <button type="submit"
                        class="btn btn-add">

                    <i class="bi bi-save me-1"></i>

                    Simpan Peminjaman

                </button>

            </form>

        </div>

    </div>

</div>


<!-- TABLE -->

<div class="card custom-card shadow-sm">

    <div class="card-body p-0">

        <div class="p-4">

            <h5 class="fw-bold mb-1">
                Daftar Peminjaman
            </h5>

            <small class="text-muted">
                Riwayat transaksi peminjaman buku.
            </small>

        </div>


        <div class="table-responsive">

            <table class="table custom-table mb-0">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($peminjaman as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <strong>
                                {{ $item['anggota'] }}
                            </strong>
                        </td>

                        <td>
                            {{ $item['buku'] }}
                        </td>

                        <td>
                            {{ $item['tanggal_pinjam'] }}
                        </td>

                        <td>
                            {{ $item['tanggal_jatuh_tempo'] }}
                        </td>

                        <td>

                            <span class="badge rounded-pill"
                                  style="background:#d9e2cf;color:#435334;">

                                {{ $item['status'] }}

                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6"
                            class="text-center text-muted py-4">

                            Belum ada data peminjaman.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection