@extends('template.master')

@section('title', 'Kategori - PerpusKita')

@section('content')

<div class="page-header">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-tags me-2"></i>

                Kategori Buku

            </h2>

            <p class="mb-0 opacity-75">

                Kelola kategori koleksi buku.

            </p>

        </div>


        <button class="btn btn-add"
                data-bs-toggle="collapse"
                data-bs-target="#formKategori">

            <i class="bi bi-plus-lg me-1"></i>

            Tambah Kategori

        </button>

    </div>

</div>


<!-- FORM -->

<div class="collapse mb-4" id="formKategori">

    <div class="card custom-card shadow-sm">

        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">

                Tambah Kategori

            </h5>


            <form action="{{ route('kategori.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Nama Kategori
                    </label>

                    <input type="text"
                           name="nama"
                           class="form-control"
                           placeholder="Contoh: Pemrograman"
                           required>

                </div>


                <button type="submit"
                        class="btn btn-add">

                    <i class="bi bi-save me-1"></i>

                    Simpan Kategori

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
                Daftar Kategori
            </h5>

            <small class="text-muted">
                Kategori yang digunakan untuk mengelompokkan buku.
            </small>

        </div>


        <div class="table-responsive">

            <table class="table custom-table mb-0">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Nama Kategori</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($kategori as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>

                            <i class="bi bi-tag me-2"
                               style="color:#435334;"></i>

                            <strong>
                                {{ $item['nama'] }}
                            </strong>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="2"
                            class="text-center text-muted py-4">

                            Belum ada kategori.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection