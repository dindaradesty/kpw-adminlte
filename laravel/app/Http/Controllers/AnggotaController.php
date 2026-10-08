<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::orderBy('id')->get();

        return view('anggota', compact('anggota'));
    }

    public function store(StoreAnggotaRequest $request)
    {
        Anggota::create($request->validated());

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $anggota = Anggota::find($id);

        if (!$anggota) {
            return redirect()
                ->route('anggota.index')
                ->with('error', 'Data anggota tidak ditemukan.');
        }

        return view('anggota-show', compact('anggota'));
    }

    public function edit(string $id)
    {
        $anggota = Anggota::find($id);

        if (!$anggota) {
            return redirect()
                ->route('anggota.index')
                ->with('error', 'Data anggota tidak ditemukan.');
        }

        return view('anggota-edit', compact('anggota'));
    }

    public function update(
        UpdateAnggotaRequest $request,
        string $id
    ) {
        $anggota = Anggota::find($id);

        if (!$anggota) {
            return redirect()
                ->route('anggota.index')
                ->with('error', 'Data anggota tidak ditemukan.');
        }

        $anggota->update($request->validated());

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $anggota = Anggota::find($id);

        if (!$anggota) {
            return redirect()
                ->route('anggota.index')
                ->with('error', 'Data anggota tidak ditemukan.');
        }

        $anggota->delete();

        return redirect()
            ->route('anggota.index')
            ->with('success', 'Data anggota berhasil dihapus.');
    }
}