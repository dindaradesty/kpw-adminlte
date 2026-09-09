<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        if (!session('logged_in')) return redirect('/login');
        $peminjaman = DB::table('peminjaman')
            ->join('anggota', 'peminjaman.anggota_id', '=', 'anggota.id')
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
            ->select('peminjaman.*', 'anggota.nama as anggota', 'buku.judul as buku')
            ->orderByDesc('peminjaman.id')->get();
        $anggota = DB::table('anggota')->orderBy('nama')->get();
        $buku = DB::table('buku')->orderBy('judul')->get();
        return view('peminjaman', compact('peminjaman', 'anggota', 'buku'));
    }

    public function store(Request $request)
    {
        if (!session('logged_in')) return redirect('/login');
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        DB::transaction(function () use ($request) {
            $buku = DB::table('buku')->where('id', $request->buku_id)->lockForUpdate()->first();
            if (!$buku || $buku->stok <= 0) abort(422, 'Stok buku sedang habis.');

            DB::table('peminjaman')->insert([
                'anggota_id' => $request->anggota_id,
                'buku_id' => $request->buku_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'status' => 'Dipinjam',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('buku')->where('id', $request->buku_id)->decrement('stok');
        });

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        $peminjaman = DB::table('peminjaman')
            ->join('anggota', 'peminjaman.anggota_id', '=', 'anggota.id')
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
            ->select('peminjaman.*', 'anggota.nama as anggota', 'anggota.nis', 'buku.judul as buku', 'buku.penulis')
            ->where('peminjaman.id', $id)->first();
        if (!$peminjaman) return redirect()->route('peminjaman.index')->with('error', 'Data peminjaman tidak ditemukan.');
        return view('peminjaman-show', compact('peminjaman'));
    }

    public function edit(string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        $peminjaman = DB::table('peminjaman')->where('id', $id)->first();
        if (!$peminjaman) return redirect()->route('peminjaman.index')->with('error', 'Data peminjaman tidak ditemukan.');
        $anggota = DB::table('anggota')->orderBy('nama')->get();
        $buku = DB::table('buku')->orderBy('judul')->get();
        return view('peminjaman-edit', compact('peminjaman', 'anggota', 'buku'));
    }

    public function update(Request $request, string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:Dipinjam,Dikembalikan',
        ]);

        DB::transaction(function () use ($request, $id) {
            $old = DB::table('peminjaman')->where('id', $id)->lockForUpdate()->first();
            if (!$old) abort(404, 'Data peminjaman tidak ditemukan.');

            if ($old->status === 'Dipinjam' && ($request->status === 'Dikembalikan' || $old->buku_id != $request->buku_id)) {
                DB::table('buku')->where('id', $old->buku_id)->increment('stok');
            }

            if ($request->status === 'Dipinjam' && ($old->status === 'Dikembalikan' || $old->buku_id != $request->buku_id)) {
                $newBook = DB::table('buku')->where('id', $request->buku_id)->lockForUpdate()->first();
                if (!$newBook || $newBook->stok <= 0) abort(422, 'Stok buku tujuan sedang habis.');
                DB::table('buku')->where('id', $request->buku_id)->decrement('stok');
            }

            DB::table('peminjaman')->where('id', $id)->update([
                'anggota_id' => $request->anggota_id,
                'buku_id' => $request->buku_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
                'status' => $request->status,
                'updated_at' => now(),
            ]);
        });

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diubah.');
    }

    public function destroy(string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        DB::transaction(function () use ($id) {
            $data = DB::table('peminjaman')->where('id', $id)->lockForUpdate()->first();
            if (!$data) abort(404, 'Data peminjaman tidak ditemukan.');
            if ($data->status === 'Dipinjam') DB::table('buku')->where('id', $data->buku_id)->increment('stok');
            DB::table('peminjaman')->where('id', $id)->delete();
        });
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
