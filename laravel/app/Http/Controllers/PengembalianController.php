<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        if (!session('logged_in')) return redirect('/login');
        $pengembalian = DB::table('pengembalian')
            ->join('peminjaman', 'pengembalian.peminjaman_id', '=', 'peminjaman.id')
            ->join('anggota', 'peminjaman.anggota_id', '=', 'anggota.id')
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
            ->select('pengembalian.*', 'anggota.nama as anggota', 'buku.judul as buku')
            ->orderByDesc('pengembalian.id')->get();
        $peminjaman = DB::table('peminjaman')
            ->join('anggota', 'peminjaman.anggota_id', '=', 'anggota.id')
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
            ->select('peminjaman.*', 'anggota.nama as anggota', 'buku.judul as buku')
            ->where('peminjaman.status', 'Dipinjam')
            ->whereNotExists(function ($q) {
                $q->select(DB::raw(1))->from('pengembalian')->whereColumn('pengembalian.peminjaman_id', 'peminjaman.id');
            })
            ->orderByDesc('peminjaman.id')->get();
        return view('pengembalian', compact('pengembalian', 'peminjaman'));
    }

    public function store(Request $request)
    {
        if (!session('logged_in')) return redirect('/login');
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'tanggal_kembali' => 'required|date',
            'denda' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $pinjam = DB::table('peminjaman')->where('id', $request->peminjaman_id)->lockForUpdate()->first();
            if (!$pinjam || $pinjam->status !== 'Dipinjam') abort(422, 'Peminjaman sudah dikembalikan atau tidak ditemukan.');
            if (DB::table('pengembalian')->where('peminjaman_id', $request->peminjaman_id)->exists()) abort(422, 'Peminjaman ini sudah memiliki data pengembalian.');

            DB::table('pengembalian')->insert([
                'peminjaman_id' => $request->peminjaman_id,
                'tanggal_kembali' => $request->tanggal_kembali,
                'denda' => $request->denda,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('peminjaman')->where('id', $request->peminjaman_id)->update(['status' => 'Dikembalikan', 'updated_at' => now()]);
            DB::table('buku')->where('id', $pinjam->buku_id)->increment('stok');
        });

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil diproses.');
    }

    public function show(string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        $pengembalian = DB::table('pengembalian')
            ->join('peminjaman', 'pengembalian.peminjaman_id', '=', 'peminjaman.id')
            ->join('anggota', 'peminjaman.anggota_id', '=', 'anggota.id')
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
            ->select('pengembalian.*', 'peminjaman.tanggal_pinjam', 'peminjaman.tanggal_jatuh_tempo', 'anggota.nama as anggota', 'anggota.nis', 'buku.judul as buku')
            ->where('pengembalian.id', $id)->first();
        if (!$pengembalian) return redirect()->route('pengembalian.index')->with('error', 'Data pengembalian tidak ditemukan.');
        return view('pengembalian-show', compact('pengembalian'));
    }

    public function edit(string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        $pengembalian = DB::table('pengembalian')->where('id', $id)->first();
        if (!$pengembalian) return redirect()->route('pengembalian.index')->with('error', 'Data pengembalian tidak ditemukan.');
        return view('pengembalian-edit', compact('pengembalian'));
    }

    public function update(Request $request, string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        $request->validate(['tanggal_kembali' => 'required|date', 'denda' => 'required|numeric|min:0']);
        $updated = DB::table('pengembalian')->where('id', $id)->update([
            'tanggal_kembali' => $request->tanggal_kembali,
            'denda' => $request->denda,
            'updated_at' => now(),
        ]);
        if (!$updated && !DB::table('pengembalian')->where('id', $id)->exists()) return redirect()->route('pengembalian.index')->with('error', 'Data pengembalian tidak ditemukan.');
        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil diubah.');
    }

    public function destroy(string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        DB::transaction(function () use ($id) {
            $data = DB::table('pengembalian')->where('id', $id)->lockForUpdate()->first();
            if (!$data) abort(404, 'Data pengembalian tidak ditemukan.');
            $pinjam = DB::table('peminjaman')->where('id', $data->peminjaman_id)->lockForUpdate()->first();
            if ($pinjam && $pinjam->status === 'Dikembalikan') {
                DB::table('peminjaman')->where('id', $data->peminjaman_id)->update(['status' => 'Dipinjam', 'updated_at' => now()]);
                DB::table('buku')->where('id', $pinjam->buku_id)->decrement('stok');
            }
            DB::table('pengembalian')->where('id', $id)->delete();
        });
        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
