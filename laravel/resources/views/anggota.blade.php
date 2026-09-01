@extends('template.master')

@section('title', 'Anggota - PerpusKita')

@section('content')

<div class="page-header">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-people me-2"></i>

                Data Anggota

            </h2>

            <p class="mb-0 opacity-75">

                Kelola data anggota perpustakaan.

            </p>

        </div>

    </div>

</div>


<!-- STATISTIK -->

<div class="row mb-4">

    <div class="col-md-6 mb-3">

        <div class="card custom-card shadow-sm">

            <div class="card-body">

                <small class="text-muted">
                    Total Anggota
                </small>

                <h2 class="fw-bold mt-1">
                    {{ count($anggota) }}
                </h2>

            </div>

        </div>

    </div>


    <div class="col-md-6 mb-3">

        <div class="card custom-card shadow-sm">

            <div class="card-body">

                <small class="text-muted">
                    Anggota Terdaftar
                </small>

                <h2 class="fw-bold mt-1">
                    {{ count($anggota) }}
                </h2>

            </div>

        </div>

    </div>

</div>


<!-- TABLE -->

<div class="card custom-card shadow-sm">

    <div class="card-body p-0">

        <div class="p-4">

            <h5 class="fw-bold mb-1">
                Daftar Anggota
            </h5>

            <small class="text-muted">
                Data anggota PerpusKita.
            </small>

        </div>


        <div class="table-responsive">

            <table class="table custom-table mb-0">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Alamat</th>
                        <th>No. HP</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($anggota as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>

                            <strong>
                                {{ $item['nama'] }}
                            </strong>

                        </td>

                        <td>
                            {{ $item['nis'] }}
                        </td>

                        <td>
                            {{ $item['alamat'] }}
                        </td>

                        <td>
                            {{ $item['no_hp'] }}
                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5"
                            class="text-center text-muted py-4">

                            Belum ada data anggota.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection