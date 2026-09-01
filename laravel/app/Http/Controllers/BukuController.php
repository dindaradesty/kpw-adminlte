<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = DB::table('buku')
            ->join('kategori', 'buku.kategori_id', '=', 'kategori.id')
            ->select(
                'buku.*',
                'kategori.nama_kategori'
            )
            ->get();

        return view('buku', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = DB::table('kategori')->get();

        return view('buku-create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required',
        ]);

        DB::table('buku')->insert([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = DB::table('buku')
            ->join('kategori', 'buku.kategori_id', '=', 'kategori.id')
            ->select(
                'buku.*',
                'kategori.nama_kategori'
            )
            ->where('buku.id', $id)
            ->first();

        return view('buku-show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = DB::table('buku')
            ->where('id', $id)
            ->first();

        $kategori = DB::table('kategori')->get();

        return view('buku-edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required',
        ]);

        DB::table('buku')
            ->where('id', $id)
            ->update([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'tahun_terbit' => $request->tahun_terbit,
                'stok' => $request->stok,
                'kategori_id' => $request->kategori_id,
            ]);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('buku')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}