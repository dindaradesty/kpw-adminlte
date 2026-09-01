@extends('template.master')

@section('title', 'Pengembalian - PerpusKita')

@section('content')

<div class="page-header">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-arrow-return-left me-2"></i>

                Pengembalian

            </h2>

            <p class="mb-0 opacity-75">

                Kelola pengembalian buku dan denda.

            </p>

        </div>


        <button class="btn btn-add"
                data-bs-toggle="collapse"
                data-bs-target="#formPengembalian">

            <i class="bi bi-plus-lg me-1"></i>

            Proses Pengembalian

        </button>

    </div>

</div>


<!-- FORM -->

<div class="collapse mb-4" id="formPengembalian">

    <div class="card custom-card shadow-sm">

        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">
                Proses Pengembalian
            </h5>


            <form action="{{ route('pengembalian.store') }}"
                  method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Peminjaman
                        </label>

                        <select name="peminjaman_id"
                                class="form-select"
                                required>

                            <option value="">
                                -- Pilih Peminjaman --
                            </option>

                            @foreach($peminjaman as $item)

                                <option value="{{ $item['id'] }}">

                                    {{ $item['anggota'] }}
                                    -
                                    {{ $item['buku'] }}

                                </option>

                            @endforeach

                        </select>