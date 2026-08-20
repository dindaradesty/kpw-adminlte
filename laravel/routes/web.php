<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {

    return view('login');

});


Route::post('/login', function (Request $request) {

    $username = $request->username;
    $password = $request->password;

    if ($username === 'admin' && $password === '12345') {

        session([
            'logged_in' => true,
            'user_name' => 'Admin'
        ]);

        return redirect('/dashboard');
    }

    return redirect('/login')
        ->with('error', 'Username atau password salah.');

});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function (Request $request) {

    $request->session()->flush();

    return redirect('/login');

})->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    return view('dashboard');

});


/*
|--------------------------------------------------------------------------
| DATA BUKU
|--------------------------------------------------------------------------
*/

Route::get('/buku', function (Request $request) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $buku = session('buku', [
        [
            'judul' => 'Dasar-Dasar Laravel',
            'kode' => 'BK-001',
            'penulis' => 'Budi Santoso',
            'kategori' => 'Teknologi',
            'status' => 'Tersedia'
        ],
        [
            'judul' => 'Pemrograman Web Modern',
            'kode' => 'BK-002',
            'penulis' => 'Andi Pratama',
            'kategori' => 'Pemrograman',
            'status' => 'Dipinjam'
        ],
        [
            'judul' => 'Belajar Database MySQL',
            'kode' => 'BK-003',
            'penulis' => 'Siti Rahma',
            'kategori' => 'Database',
            'status' => 'Tersedia'
        ],
        [
            'judul' => 'HTML & CSS Dasar',
            'kode' => 'BK-004',
            'penulis' => 'Rina Amelia',
            'kategori' => 'Web Design',
            'status' => 'Tersedia'
        ],
    ]);

    return view('buku', compact('buku'));

})->name('buku.index');


Route::post('/buku', function (Request $request) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $request->validate([
        'judul' => 'required',
        'kode' => 'required',
        'penulis' => 'required',
        'kategori' => 'required',
    ]);

    $buku = session('buku', []);

    $buku[] = [
        'judul' => $request->judul,
        'kode' => $request->kode,
        'penulis' => $request->penulis,
        'kategori' => $request->kategori,
        'status' => 'Tersedia',
    ];

    session(['buku' => $buku]);

    return redirect('/buku');

})->name('buku.store');


/*
|--------------------------------------------------------------------------
| ANGGOTA
|--------------------------------------------------------------------------
*/

Route::get('/anggota', function () {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $anggota = session('anggota', [
        [
            'nama' => 'Andi Pratama',
            'email' => 'andi@email.com',
            'id_anggota' => 'AGT-001',
            'kelas' => 'XI RPL 1',
            'status' => 'Aktif'
        ],
        [
            'nama' => 'Siti Rahma',
            'email' => 'siti@email.com',
            'id_anggota' => 'AGT-002',
            'kelas' => 'XI RPL 2',
            'status' => 'Aktif'
        ],
        [
            'nama' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'id_anggota' => 'AGT-003',
            'kelas' => 'XII RPL 1',
            'status' => 'Tidak Aktif'
        ],
        [
            'nama' => 'Rina Amelia',
            'email' => 'rina@email.com',
            'id_anggota' => 'AGT-004',
            'kelas' => 'XI RPL 2',
            'status' => 'Aktif'
        ],
    ]);

    return view('anggota', compact('anggota'));

})->name('anggota.index');


Route::post('/anggota', function (Request $request) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $request->validate([
        'nama' => 'required',
        'id_anggota' => 'required',
        'email' => 'required|email',
        'kelas' => 'required',
    ]);

    $anggota = session('anggota', []);

    $anggota[] = [
        'nama' => $request->nama,
        'email' => $request->email,
        'id_anggota' => $request->id_anggota,
        'kelas' => $request->kelas,
        'status' => 'Aktif',
    ];

    session(['anggota' => $anggota]);

    return redirect('/anggota');

})->name('anggota.store');


/*
|--------------------------------------------------------------------------
| PEMINJAMAN
|--------------------------------------------------------------------------
*/

Route::get('/peminjaman', function () {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $peminjaman = session('peminjaman', [
        [
            'anggota' => 'Andi Pratama',
            'id_anggota' => 'AGT-001',
            'buku' => 'Dasar-Dasar Laravel',
            'tanggal_pinjam' => '18 Agustus 2026',
            'jatuh_tempo' => '25 Agustus 2026',
            'status' => 'Dipinjam'
        ],
        [
            'anggota' => 'Siti Rahma',
            'id_anggota' => 'AGT-002',
            'buku' => 'Pemrograman Web Modern',
            'tanggal_pinjam' => '17 Agustus 2026',
            'jatuh_tempo' => '24 Agustus 2026',
            'status' => 'Jatuh Tempo'
        ],
        [
            'anggota' => 'Budi Santoso',
            'id_anggota' => 'AGT-003',
            'buku' => 'Belajar Database MySQL',
            'tanggal_pinjam' => '10 Agustus 2026',
            'jatuh_tempo' => '17 Agustus 2026',
            'status' => 'Terlambat'
        ],
        [
            'anggota' => 'Rina Amelia',
            'id_anggota' => 'AGT-004',
            'buku' => 'HTML & CSS Dasar',
            'tanggal_pinjam' => '19 Agustus 2026',
            'jatuh_tempo' => '26 Agustus 2026',
            'status' => 'Dipinjam'
        ],
    ]);

    $anggota = session('anggota', []);
    $buku = session('buku', []);

    return view('peminjaman', compact(
        'peminjaman',
        'anggota',
        'buku'
    ));

})->name('peminjaman.index');


Route::post('/peminjaman', function (Request $request) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $request->validate([
        'anggota' => 'required',
        'buku' => 'required',
        'tanggal_pinjam' => 'required',
        'jatuh_tempo' => 'required',
    ]);

    $anggotaData = session('anggota', []);
    $bukuData = session('buku', []);

    $namaAnggota = $request->anggota;
    $idAnggota = '';

    foreach ($anggotaData as $item) {

        if ($item['nama'] === $request->anggota) {
            $idAnggota = $item['id_anggota'];
            break;
        }
    }

    $peminjaman = session('peminjaman', []);

    $peminjaman[] = [
        'anggota' => $namaAnggota,
        'id_anggota' => $idAnggota,
        'buku' => $request->buku,
        'tanggal_pinjam' => date(
            'd F Y',
            strtotime($request->tanggal_pinjam)
        ),
        'jatuh_tempo' => date(
            'd F Y',
            strtotime($request->jatuh_tempo)
        ),
        'status' => 'Dipinjam',
    ];

    session(['peminjaman' => $peminjaman]);

    return redirect('/peminjaman');

})->name('peminjaman.store');


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect('/login');

});