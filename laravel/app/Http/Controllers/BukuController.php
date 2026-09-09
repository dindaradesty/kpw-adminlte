<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class BukuController extends Controller
{
    public function index()
    {
        if (!session('logged_in')) return redirect('/login');
        $buku = DB::table('buku')
            ->join('kategori', 'buku.kategori_id', '=', 'kategori.id')
            ->select('buku.*', 'kategori.nama as kategori')
            ->orderBy('buku.id')
            ->get();
        $kategori = DB::table('kategori')->orderBy('nama')->get();
        return view('buku', compact('buku', 'kategori'));
    }

    public function store(Request $request)
    {
        if (!session('logged_in')) return redirect('/login');
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
        ]);
        DB::table('buku')->insert([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        $buku = DB::table('buku')
            ->join('kategori', 'buku.kategori_id', '=', 'kategori.id')
            ->select('buku.*', 'kategori.nama as kategori')
            ->where('buku.id', $id)
            ->first();
        if (!$buku) return redirect()->route('buku.index')->with('error', 'Buku tidak ditemukan.');
        return view('buku-show', compact('buku'));
    }

    public function edit(string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        $buku = DB::table('buku')->where('id', $id)->first();
        if (!$buku) return redirect()->route('buku.index')->with('error', 'Buku tidak ditemukan.');
        $kategori = DB::table('kategori')->orderBy('nama')->get();
        return view('buku-edit', compact('buku', 'kategori'));
    }

    public function update(Request $request, string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategori,id',
        ]);
        $updated = DB::table('buku')->where('id', $id)->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
            'updated_at' => now(),
        ]);
        if (!$updated && !DB::table('buku')->where('id', $id)->exists()) {
            return redirect()->route('buku.index')->with('error', 'Buku tidak ditemukan.');
        }
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diubah.');
    }

    public function destroy(string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        try {
            $deleted = DB::table('buku')->where('id', $id)->delete();
        } catch (QueryException $e) {
            return redirect()->route('buku.index')->with('error', 'Buku tidak dapat dihapus karena masih terkait dengan transaksi peminjaman.');
        }
        if (!$deleted) return redirect()->route('buku.index')->with('error', 'Buku tidak ditemukan.');
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
