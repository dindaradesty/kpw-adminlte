<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = DB::table('kategori')->get();

        return view('kategori', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|min:5',
        ]);

        DB::table('kategori')->insert([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = DB::table('kategori')
            ->where('id', $id)
            ->first();

        return view('kategori-show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = DB::table('kategori')
            ->where('id', $id)
            ->first();

        return view('kategori-edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required|min:5',
        ]);

        DB::table('kategori')
            ->where('id', $id)
            ->update([
                'nama_kategori' => $request->nama_kategori,
            ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('kategori')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
