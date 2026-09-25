<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Http\Requests\StorePengembalianRequest;
use App\Http\Requests\UpdatePengembalianRequest;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $pengembalian = Pengembalian::with([
            'peminjaman.anggota',
            'peminjaman.buku'
        ])
            ->orderByDesc('id')
            ->get();

        $peminjaman = Peminjaman::with(['anggota', 'buku'])
            ->where('status', 'Dipinjam')
            ->whereDoesntHave('pengembalian')
            ->orderByDesc('id')
            ->get();

        return view(
            'pengembalian',
            compact('pengembalian', 'peminjaman')
        );
    }

    public function store(StorePengembalianRequest $request)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        DB::transaction(function () use ($request) {

            $pinjam = Peminjaman::where('id', $request->peminjaman_id)
                ->lockForUpdate()
                ->first();

            if (!$pinjam || $pinjam->status !== 'Dipinjam') {
                abort(
                    422,
                    'Peminjaman sudah dikembalikan atau tidak ditemukan.'
                );
            }

            if (
                Pengembalian::where(
                    'peminjaman_id',
                    $request->peminjaman_id
                )->exists()
            ) {
                abort(
                    422,
                    'Peminjaman ini sudah memiliki data pengembalian.'
                );
            }

            Pengembalian::create([
                'peminjaman_id' => $request->peminjaman_id,
                'tanggal_kembali' => $request->tanggal_kembali,
                'denda' => $request->denda,
            ]);

            $pinjam->update([
                'status' => 'Dikembalikan',
            ]);

            $buku = Buku::find($pinjam->buku_id);

            if ($buku) {
                $buku->increment('stok');
            }
        });

        return redirect()
            ->route('pengembalian.index')
            ->with('success', 'Pengembalian berhasil diproses.');
    }

    public function show(string $id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $pengembalian = Pengembalian::with([
            'peminjaman.anggota',
            'peminjaman.buku'
        ])->find($id);

        if (!$pengembalian) {
            return redirect()
                ->route('pengembalian.index')
                ->with(
                    'error',
                    'Data pengembalian tidak ditemukan.'
                );
        }

        return view(
            'pengembalian-show',
            compact('pengembalian')
        );
    }

    public function edit(string $id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $pengembalian = Pengembalian::find($id);

        if (!$pengembalian) {
            return redirect()
                ->route('pengembalian.index')
                ->with(
                    'error',
                    'Data pengembalian tidak ditemukan.'
                );
        }

        return view(
            'pengembalian-edit',
            compact('pengembalian')
        );
    }

    public function update(
        UpdatePengembalianRequest $request,
        string $id
    ) {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $pengembalian = Pengembalian::find($id);

        if (!$pengembalian) {
            return redirect()
                ->route('pengembalian.index')
                ->with(
                    'error',
                    'Data pengembalian tidak ditemukan.'
                );
        }

        $pengembalian->update(
            $request->validated()
        );

        return redirect()
            ->route('pengembalian.index')
            ->with(
                'success',
                'Data pengembalian berhasil diubah.'
            );
    }

    public function destroy(string $id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        DB::transaction(function () use ($id) {

            $pengembalian = Pengembalian::where('id', $id)
                ->lockForUpdate()
                ->first();

            if (!$pengembalian) {
                abort(
                    404,
                    'Data pengembalian tidak ditemukan.'
                );
            }

            $pinjam = Peminjaman::where(
                'id',
                $pengembalian->peminjaman_id
            )
                ->lockForUpdate()
                ->first();

            if (
                $pinjam &&
                $pinjam->status === 'Dikembalikan'
            ) {
                $pinjam->update([
                    'status' => 'Dipinjam',
                ]);

                $buku = Buku::find($pinjam->buku_id);

                if ($buku) {
                    $buku->decrement('stok');
                }
            }

            $pengembalian->delete();
        });

        return redirect()
            ->route('pengembalian.index')
            ->with(
                'success',
                'Data pengembalian berhasil dihapus.'
            );
    }
}