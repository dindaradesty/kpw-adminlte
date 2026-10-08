<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'index'])
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('login.authenticate');


/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisterController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ROUTE YANG WAJIB LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        $buku = DB::table('buku')->count();

        $anggota = DB::table('anggota')->count();

        // Hanya menghitung peminjaman yang BELUM dikembalikan
        $peminjaman = DB::table('peminjaman')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('pengembalian')
                    ->whereColumn(
                        'pengembalian.peminjaman_id',
                        'peminjaman.id'
                    );
            })
            ->count();

        // Menghitung seluruh data pengembalian
        $pengembalian = DB::table('pengembalian')->count();

        return view(
            'dashboard',
            compact(
                'buku',
                'anggota',
                'peminjaman',
                'pengembalian'
            )
        );

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | BUKU
    |--------------------------------------------------------------------------
    |
    | Admin    : bisa CRUD
    | Petugas  : hanya melihat
    |
    */

    // Admin + Petugas
    Route::get('/buku', [BukuController::class, 'index'])
        ->name('buku.index');

    Route::get('/buku/{buku}', [BukuController::class, 'show'])
        ->name('buku.show');


    // Admin saja
    Route::middleware('can:admin')->group(function () {

        Route::post('/buku', [BukuController::class, 'store'])
            ->name('buku.store');

        Route::get('/buku/{buku}/edit', [BukuController::class, 'edit'])
            ->name('buku.edit');

        Route::put('/buku/{buku}', [BukuController::class, 'update'])
            ->name('buku.update');

        Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])
            ->name('buku.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | KATEGORI
    |--------------------------------------------------------------------------
    |
    | Admin    : bisa CRUD
    | Petugas  : hanya melihat
    |
    */

    // Admin + Petugas
    Route::get('/kategori', [KategoriController::class, 'index'])
        ->name('kategori.index');

    Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])
        ->name('kategori.show');


    // Admin saja
    Route::middleware('can:admin')->group(function () {

        Route::post('/kategori', [KategoriController::class, 'store'])
            ->name('kategori.store');

        Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])
            ->name('kategori.edit');

        Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])
            ->name('kategori.update');

        Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])
            ->name('kategori.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | ANGGOTA
    |--------------------------------------------------------------------------
    |
    | Admin    : bisa CRUD
    | Petugas  : hanya melihat
    |
    */

    // Admin + Petugas
    Route::get('/anggota', [AnggotaController::class, 'index'])
        ->name('anggota.index');

    Route::get('/anggota/{anggota}', [AnggotaController::class, 'show'])
        ->name('anggota.show');


    // Admin saja
    Route::middleware('can:admin')->group(function () {

        Route::post('/anggota', [AnggotaController::class, 'store'])
            ->name('anggota.store');

        Route::get('/anggota/{anggota}/edit', [AnggotaController::class, 'edit'])
            ->name('anggota.edit');

        Route::put('/anggota/{anggota}', [AnggotaController::class, 'update'])
            ->name('anggota.update');

        Route::delete('/anggota/{anggota}', [AnggotaController::class, 'destroy'])
            ->name('anggota.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | PEMINJAMAN
    |--------------------------------------------------------------------------
    |
    | Admin + Petugas : bisa CRUD
    |
    */

    Route::resource('peminjaman', PeminjamanController::class)
        ->only([
            'index',
            'store',
            'show',
            'edit',
            'update',
            'destroy'
        ]);


    /*
    |--------------------------------------------------------------------------
    | PENGEMBALIAN
    |--------------------------------------------------------------------------
    |
    | Admin + Petugas : bisa CRUD
    |
    */

    Route::resource('pengembalian', PengembalianController::class)
        ->only([
            'index',
            'store',
            'show',
            'edit',
            'update',
            'destroy'
        ]);
});


/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});