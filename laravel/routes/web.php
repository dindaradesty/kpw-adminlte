<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

/* LOGIN */
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    if ($request->username === 'admin' && $request->password === '12345') {
        session(['logged_in' => true, 'user_name' => 'Admin']);
        return redirect()->route('dashboard');
    }
    return redirect('/login')->with('error', 'Username atau password salah.');
});

/* LOGOUT */
Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect('/login');
})->name('logout');

/* DASHBOARD */
Route::get('/dashboard', function () {
    if (!session('logged_in')) return redirect('/login');

    $buku = DB::table('buku')->count();
    $anggota = DB::table('anggota')->count();
    $peminjaman = DB::table('peminjaman')->count();
    $pengembalian = DB::table('pengembalian')->count();

    return view('dashboard', compact('buku', 'anggota', 'peminjaman', 'pengembalian'));
})->name('dashboard');

/* CRUD: BUKU */
Route::resource('buku', BukuController::class)->only(['index', 'store', 'show', 'edit', 'update', 'destroy']);

/* CRUD: KATEGORI */
Route::resource('kategori', KategoriController::class)->only(['index', 'store', 'show', 'edit', 'update', 'destroy']);

/* CRUD: ANGGOTA */
Route::resource('anggota', AnggotaController::class)->only(['index', 'store', 'show', 'edit', 'update', 'destroy']);

/* CRUD: PEMINJAMAN */
Route::resource('peminjaman', PeminjamanController::class)->only(['index', 'store', 'show', 'edit', 'update', 'destroy']);

/* CRUD: PENGEMBALIAN */
Route::resource('pengembalian', PengembalianController::class)->only(['index', 'store', 'show', 'edit', 'update', 'destroy']);

Route::get('/', function () {
    return redirect('/login');
});
