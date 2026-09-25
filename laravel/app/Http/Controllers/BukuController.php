<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Illuminate\Database\QueryException;

class BukuController extends Controller
{
    public function index()
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $buku = Buku::with('kategori')
            ->orderBy('id')
            ->get();

        $kategori = Kategori::orderBy('nama')->get();

        return view('buku', compact('buku', 'kategori'));
    }

    public function store(StoreBukuRequest $request)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        Buku::create($request->validated());

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $buku = Buku::with('kategori')->find($id);

        if (!$buku) {
            return redirect()
                ->route('buku.index')
                ->with('error', 'Buku tidak ditemukan.');
        }

        return view('buku-show', compact('buku'));
    }

    public function edit(string $id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $buku = Buku::find($id);

        if (!$buku) {
            return redirect()
                ->route('buku.index')
                ->with('error', 'Buku tidak ditemukan.');
        }

        $kategori = Kategori::orderBy('nama')->get();

        return view('buku-edit', compact('buku', 'kategori'));
    }

    public function update(UpdateBukuRequest $request, string $id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $buku = Buku::find($id);

        if (!$buku) {
            return redirect()
                ->route('buku.index')
                ->with('error', 'Buku tidak ditemukan.');
        }

        $buku->update($request->validated());

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil diubah.');
    }

    public function destroy(string $id)
    {
        if (!session('logged_in')) {
            return redirect('/login');
        }

        $buku = Buku::find($id);

        if (!$buku) {
            return redirect()
                ->route('buku.index')
                ->with('error', 'Buku tidak ditemukan.');
        }

        try {
            $buku->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('buku.index')
                ->with(
                    'error',
                    'Buku tidak dapat dihapus karena masih terkait dengan transaksi peminjaman.'
                );
        }

        return redirect()
            ->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}