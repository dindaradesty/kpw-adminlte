<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    public function index()
    {
        if (!session('logged_in')) return redirect('/login');

        $anggota = DB::table('anggota')->orderBy('id')->get();
        return view('anggota', compact('anggota'));
    }

    public function store(Request $request)
    {
        if (!session('logged_in')) return redirect('/login');

        $request->validate([
            'nama' => 'required',
            'nis' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        DB::table('anggota')->insert([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        if (!session('logged_in')) return redirect('/login');

        $anggota = DB::table('anggota')->where('id', $id)->first();
        if (!$anggota) return redirect()->route('anggota.index')->with('error', 'Data anggota tidak ditemukan.');

        return view('anggota-show', compact('anggota'));
    }

    public function edit(string $id)
    {
        if (!session('logged_in')) return redirect('/login');

        $anggota = DB::table('anggota')->where('id', $id)->first();
        if (!$anggota) return redirect()->route('anggota.index')->with('error', 'Data anggota tidak ditemukan.');

        return view('anggota-edit', compact('anggota'));
    }

    public function update(Request $request, string $id)
    {
        if (!session('logged_in')) return redirect('/login');

        $request->validate([
            'nama' => 'required',
            'nis' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        $updated = DB::table('anggota')->where('id', $id)->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'updated_at' => now(),
        ]);

        if (!$updated) {
            $exists = DB::table('anggota')->where('id', $id)->exists();
            if (!$exists) return redirect()->route('anggota.index')->with('error', 'Data anggota tidak ditemukan.');
        }

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diubah.');
    }

    public function destroy(string $id)
    {
        if (!session('logged_in')) return redirect('/login');

        $deleted = DB::table('anggota')->where('id', $id)->delete();
        if (!$deleted) return redirect()->route('anggota.index')->with('error', 'Data anggota tidak ditemukan.');

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }
}
