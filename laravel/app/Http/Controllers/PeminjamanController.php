<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $peminjaman = Peminjaman::with(['anggota', 'buku'])
            ->orderByDesc('id')
            ->get();

        $anggota = Anggota::orderBy('nama')->get();
        $buku = Buku::orderBy('judul')->get();

        return view('peminjaman', compact('peminjaman', 'anggota', 'buku'));
    }

    public function store(StorePeminjamanRequest $request)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        DB::transaction(function () use ($request) {

            $buku = Buku::where('id', $request->buku_id)
                ->lockForUpdate()
                ->first();

            if (!$buku || $buku->stok <= 0) {
                abort(422, 'Stok buku sedang habis.');
            }

            Peminjaman::create([
                'anggota_id' => $request->anggota_id,
                'buku_id' => $request->buku_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'status' => 'Dipinjam',
            ]);

            $buku->decrement('stok');
        });

        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $peminjaman = Peminjaman::with(['anggota', 'buku'])
            ->find($id);

        if (!$peminjaman) {
            return redirect()
                ->route('peminjaman.index')
                ->with('error', 'Data peminjaman tidak ditemukan.');
        }

        return view('peminjaman-show', compact('peminjaman'));
    }

    public function edit(string $id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return redirect()
                ->route('peminjaman.index')
                ->with('error', 'Data peminjaman tidak ditemukan.');
        }

        $anggota = Anggota::orderBy('nama')->get();
        $buku = Buku::orderBy('judul')->get();

        return view('peminjaman-edit', compact(
            'peminjaman',
            'anggota',
            'buku'
        ));
    }

    public function update(UpdatePeminjamanRequest $request, string $id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        DB::transaction(function () use ($request, $id) {

            $peminjaman = Peminjaman::where('id', $id)
                ->lockForUpdate()
                ->first();

            if (!$peminjaman) {
                abort(404, 'Data peminjaman tidak ditemukan.');
            }

            /*
             * Jika peminjaman lama masih Dipinjam:
             * stok buku lama harus dikembalikan ketika
             * status berubah atau buku diganti.
             */
            if (
                $peminjaman->status === 'Dipinjam' &&
                (
                    $request->status === 'Dikembalikan' ||
                    $peminjaman->buku_id != $request->buku_id
                )
            ) {
                $oldBook = Buku::find($peminjaman->buku_id);

                if ($oldBook) {
                    $oldBook->increment('stok');
                }
            }

            /*
             * Jika status baru Dipinjam dan buku berubah
             * atau sebelumnya Dikembalikan, kurangi stok buku baru.
             */
            if (
                $request->status === 'Dipinjam' &&
                (
                    $peminjaman->status === 'Dikembalikan' ||
                    $peminjaman->buku_id != $request->buku_id
                )
            ) {
                $newBook = Buku::where('id', $request->buku_id)
                    ->lockForUpdate()
                    ->first();

                if (!$newBook || $newBook->stok <= 0) {
                    abort(422, 'Stok buku tujuan sedang habis.');
                }

                $newBook->decrement('stok');
            }

            $peminjaman->update([
                'anggota_id' => $request->anggota_id,
                'buku_id' => $request->buku_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'status' => $request->status,
            ]);
        });

        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diubah.');
    }

    public function destroy(string $id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        DB::transaction(function () use ($id) {

            $peminjaman = Peminjaman::where('id', $id)
                ->lockForUpdate()
                ->first();

            if (!$peminjaman) {
                abort(404, 'Data peminjaman tidak ditemukan.');
            }

            // Kalau masih dipinjam, stok buku dikembalikan.
            if ($peminjaman->status === 'Dipinjam') {
                $buku = Buku::find($peminjaman->buku_id);

                if ($buku) {
                    $buku->increment('stok');
                }
            }

            $peminjaman->delete();
        });

        return redirect()
            ->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}