<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Database yang sudah ada berisi tabel-tabel utama, tetapi beberapa
        // kolom CRUD belum ada. Migration ini hanya MENAMBAHKAN kolom yang hilang.

        if (!Schema::hasColumn('anggota', 'nama')) {
            Schema::table('anggota', function (Blueprint $table) {
                $table->string('nama')->nullable();
            });
        }

        if (!Schema::hasColumn('anggota', 'nis')) {
            Schema::table('anggota', function (Blueprint $table) {
                $table->string('nis')->nullable();
            });
        }

        if (!Schema::hasColumn('anggota', 'alamat')) {
            Schema::table('anggota', function (Blueprint $table) {
                $table->text('alamat')->nullable();
            });
        }

        if (!Schema::hasColumn('anggota', 'no_telp')) {
            Schema::table('anggota', function (Blueprint $table) {
                $table->string('no_telp')->nullable();
            });
        }

        $peminjamanAddedAnggotaId = false;
        $peminjamanAddedBukuId = false;

        if (!Schema::hasColumn('peminjaman', 'anggota_id')) {
            Schema::table('peminjaman', function (Blueprint $table) {
                $table->unsignedBigInteger('anggota_id')->nullable();
            });
            $peminjamanAddedAnggotaId = true;
        }

        if (!Schema::hasColumn('peminjaman', 'buku_id')) {
            Schema::table('peminjaman', function (Blueprint $table) {
                $table->unsignedBigInteger('buku_id')->nullable();
            });
            $peminjamanAddedBukuId = true;
        }

        if (!Schema::hasColumn('peminjaman', 'tanggal_pinjam')) {
            Schema::table('peminjaman', function (Blueprint $table) {
                $table->date('tanggal_pinjam')->nullable();
            });
        }

        if (!Schema::hasColumn('peminjaman', 'tanggal_jatuh_tempo')) {
            Schema::table('peminjaman', function (Blueprint $table) {
                $table->date('tanggal_jatuh_tempo')->nullable();
            });
        }

        if (!Schema::hasColumn('peminjaman', 'status')) {
            Schema::table('peminjaman', function (Blueprint $table) {
                $table->string('status')->default('Dipinjam');
            });
        }

        // Tambahkan foreign key hanya ketika kolomnya memang baru dibuat.
        if ($peminjamanAddedAnggotaId || $peminjamanAddedBukuId) {
            Schema::table('peminjaman', function (Blueprint $table) use ($peminjamanAddedAnggotaId, $peminjamanAddedBukuId) {
                if ($peminjamanAddedAnggotaId) {
                    $table->foreign('anggota_id')->references('id')->on('anggota')->cascadeOnDelete();
                }
                if ($peminjamanAddedBukuId) {
                    $table->foreign('buku_id')->references('id')->on('buku')->cascadeOnDelete();
                }
            });
        }

        $pengembalianAddedPeminjamanId = false;

        if (!Schema::hasColumn('pengembalian', 'peminjaman_id')) {
            Schema::table('pengembalian', function (Blueprint $table) {
                $table->unsignedBigInteger('peminjaman_id')->nullable();
            });
            $pengembalianAddedPeminjamanId = true;
        }

        if (!Schema::hasColumn('pengembalian', 'tanggal_kembali')) {
            Schema::table('pengembalian', function (Blueprint $table) {
                $table->date('tanggal_kembali')->nullable();
            });
        }

        if (!Schema::hasColumn('pengembalian', 'denda')) {
            Schema::table('pengembalian', function (Blueprint $table) {
                $table->decimal('denda', 10, 2)->default(0);
            });
        }

        if ($pengembalianAddedPeminjamanId) {
            Schema::table('pengembalian', function (Blueprint $table) {
                $table->foreign('peminjaman_id')->references('id')->on('peminjaman')->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        // Migration ini bersifat tambahan. Kolom tidak dihapus otomatis agar
        // rollback tidak merusak data yang mungkin sudah dimasukkan.
    }
};
