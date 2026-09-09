<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class KategoriController extends Controller
{
    public function index()
    {
        if (!session('logged_in')) return redirect('/login');
        $kategori = DB::table('kategori')->orderBy('id')->get();
        return view('kategori', compact('kategori'));
    }

    public function store(Request $request)
    {
        if (!session('logged_in')) return redirect('/login');
        $request->validate(['nama' => 'required|min:3']);

        DB::table('kategori')->insert([
            'nama' => $request->nama,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        $kategori = DB::table('kategori')->where('id', $id)->first();
        if (!$kategori) return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan.');
        return view('kategori-show', compact('kategori'));
    }

    public function edit(string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        $kategori = DB::table('kategori')->where('id', $id)->first();
        if (!$kategori) return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan.');
        return view('kategori-edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        $request->validate(['nama' => 'required|min:3']);

        $updated = DB::table('kategori')->where('id', $id)->update([
            'nama' => $request->nama,
            'updated_at' => now(),
        ]);

        if (!$updated && !DB::table('kategori')->where('id', $id)->exists()) {
            return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan.');
        }
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diubah.');
    }

    public function destroy(string $id)
    {
        if (!session('logged_in')) return redirect('/login');
        try {
            $deleted = DB::table('kategori')->where('id', $id)->delete();
        } catch (QueryException $e) {
            return redirect()->route('kategori.index')->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh data buku.');
        }
        if (!$deleted) return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan.');
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
