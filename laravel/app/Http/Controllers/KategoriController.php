<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\Kategori;
use Illuminate\Database\QueryException;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('id')->get();

        return view('kategori', compact('kategori'));
    }

    public function store(StoreKategoriRequest $request)
    {
        Kategori::create([
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return redirect()
                ->route('kategori.index')
                ->with('error', 'Kategori tidak ditemukan.');
        }

        return view('kategori-show', compact('kategori'));
    }

    public function edit(string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return redirect()
                ->route('kategori.index')
                ->with('error', 'Kategori tidak ditemukan.');
        }

        return view('kategori-edit', compact('kategori'));
    }

    public function update(
        UpdateKategoriRequest $request,
        string $id
    ) {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return redirect()
                ->route('kategori.index')
                ->with('error', 'Kategori tidak ditemukan.');
        }

        $kategori->update([
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return redirect()
                ->route('kategori.index')
                ->with('error', 'Kategori tidak ditemukan.');
        }

        try {
            $kategori->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('kategori.index')
                ->with(
                    'error',
                    'Kategori tidak dapat dihapus karena masih digunakan oleh data buku.'
                );
        }

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}