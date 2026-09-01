<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;


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

    // =========================
    // DATA BUKU
    // =========================

    $buku = session('buku', [
        [
            'id' => 1,
            'judul' => 'Dasar-Dasar Laravel',
            'penulis' => 'Budi Santoso',
            'tahun_terbit' => 2024,
            'stok' => 5,
            'kategori_id' => 1,
        ],
        [
            'id' => 2,
            'judul' => 'Pemrograman Web Modern',
            'penulis' => 'Andi Pratama',
            'tahun_terbit' => 2023,
            'stok' => 3,
            'kategori_id' => 2,
        ],
        [
            'id' => 3,
            'judul' => 'Belajar Database MySQL',
            'penulis' => 'Siti Rahma',
            'tahun_terbit' => 2024,
            'stok' => 4,
            'kategori_id' => 3,
        ],
        [
            'id' => 4,
            'judul' => 'HTML & CSS Dasar',
            'penulis' => 'Rina Amelia',
            'tahun_terbit' => 2022,
            'stok' => 6,
            'kategori_id' => 4,
        ],
    ]);


    // =========================
    // DATA ANGGOTA
    // =========================

    $anggota = session('anggota', [
        [
            'id' => 1,
            'nama' => 'Andi Pratama',
            'nis' => '12345',
            'alamat' => 'Jakarta',
            'no_hp' => '081234567890',
        ],
        [
            'id' => 2,
            'nama' => 'Siti Rahma',
            'nis' => '12346',
            'alamat' => 'Bandung',
            'no_hp' => '081234567891',
        ],
        [
            'id' => 3,
            'nama' => 'Budi Santoso',
            'nis' => '12347',
            'alamat' => 'Depok',
            'no_hp' => '081234567892',
        ],
        [
            'id' => 4,
            'nama' => 'Rina Amelia',
            'nis' => '12348',
            'alamat' => 'Bekasi',
            'no_hp' => '081234567893',
        ],
    ]);


    // =========================
    // DATA PEMINJAMAN
    // =========================

    $peminjaman = session('peminjaman', [
        [
            'id' => 1,
            'anggota_id' => 1,
            'buku_id' => 1,
            'tanggal_pinjam' => '2026-08-18',
            'tanggal_jatuh_tempo' => '2026-08-25',
            'status' => 'Dipinjam',
        ],
        [
            'id' => 2,
            'anggota_id' => 2,
            'buku_id' => 2,
            'tanggal_pinjam' => '2026-08-17',
            'tanggal_jatuh_tempo' => '2026-08-24',
            'status' => 'Dipinjam',
        ],
    ]);


    // =========================
    // DATA PENGEMBALIAN
    // =========================

    $pengembalian = session('pengembalian', []);


    // =========================
    // HUBUNGKAN PEMINJAMAN
    // DENGAN ANGGOTA & BUKU
    // =========================

    foreach ($peminjaman as &$item) {

        $item['anggota'] = 'Tidak diketahui';
        $item['buku'] = 'Tidak diketahui';

        foreach ($anggota as $a) {

            if ($a['id'] == $item['anggota_id']) {

                $item['anggota'] = $a['nama'];

                break;
            }
        }

        foreach ($buku as $b) {

            if ($b['id'] == $item['buku_id']) {

                $item['buku'] = $b['judul'];

                break;
            }
        }
    }

    unset($item);


    // =========================
    // KIRIM KE DASHBOARD
    // =========================

    return view('dashboard', compact(
        'buku',
        'anggota',
        'peminjaman',
        'pengembalian'
    ));

})->name('dashboard');

/* 
|--------------------------------------------------------------------------
| BUKU
|--------------------------------------------------------------------------
*/

Route::get('/buku', function () {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $kategori = session('kategori', [
        [
            'id' => 1,
            'nama' => 'Teknologi'
        ],
        [
            'id' => 2,
            'nama' => 'Pemrograman'
        ],
        [
            'id' => 3,
            'nama' => 'Database'
        ],
        [
            'id' => 4,
            'nama' => 'Web Design'
        ],
    ]);

    $buku = session('buku', [
        [
            'id' => 1,
            'judul' => 'Dasar-Dasar Laravel',
            'penulis' => 'Budi Santoso',
            'tahun_terbit' => 2024,
            'stok' => 5,
            'kategori_id' => 1,
        ],
        [
            'id' => 2,
            'judul' => 'Pemrograman Web Modern',
            'penulis' => 'Andi Pratama',
            'tahun_terbit' => 2023,
            'stok' => 3,
            'kategori_id' => 2,
        ],
        [
            'id' => 3,
            'judul' => 'Belajar Database MySQL',
            'penulis' => 'Siti Rahma',
            'tahun_terbit' => 2024,
            'stok' => 4,
            'kategori_id' => 3,
        ],
        [
            'id' => 4,
            'judul' => 'HTML & CSS Dasar',
            'penulis' => 'Rina Amelia',
            'tahun_terbit' => 2022,
            'stok' => 6,
            'kategori_id' => 4,
        ],
    ]);

    return view('buku', compact('buku', 'kategori'));

})->name('buku.index');


// FORM TAMBAH BUKU
Route::get('/buku/create', function () {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $kategori = session('kategori', []);

    return view('buku-create', compact('kategori'));

})->name('buku.create');


// SIMPAN BUKU
Route::post('/buku', function (Request $request) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $request->validate([
        'judul' => 'required',
        'penulis' => 'required',
        'tahun_terbit' => 'required|integer',
        'stok' => 'required|integer|min:0',
        'kategori_id' => 'required',
    ]);

    $buku = session('buku', []);

    $nextId = count($buku) > 0
        ? max(array_column($buku, 'id')) + 1
        : 1;

    $buku[] = [
        'id' => $nextId,
        'judul' => $request->judul,
        'penulis' => $request->penulis,
        'tahun_terbit' => $request->tahun_terbit,
        'stok' => $request->stok,
        'kategori_id' => $request->kategori_id,
    ];

    session([
        'buku' => $buku
    ]);

    return redirect()
        ->route('buku.index')
        ->with('success', 'Data buku berhasil ditambahkan.');

})->name('buku.store');


// FORM EDIT BUKU
Route::get('/buku/{id}/edit', function ($id) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $buku = session('buku', []);
    $kategori = session('kategori', []);

    $data = null;

    foreach ($buku as $item) {

        if ($item['id'] == $id) {
            $data = $item;
            break;
        }
    }

    if (!$data) {
        return redirect('/buku')
            ->with('error', 'Buku tidak ditemukan.');
    }

    return view('buku-edit', compact('data', 'kategori'));

})->name('buku.edit');


// UPDATE BUKU
Route::post('/buku/{id}', function (Request $request, $id) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $request->validate([
        'judul' => 'required',
        'penulis' => 'required',
        'tahun_terbit' => 'required|integer',
        'stok' => 'required|integer|min:0',
        'kategori_id' => 'required',
    ]);

    $buku = session('buku', []);

    $ditemukan = false;

    foreach ($buku as &$item) {

        if ($item['id'] == $id) {

            $item['judul'] = $request->judul;
            $item['penulis'] = $request->penulis;
            $item['tahun_terbit'] = $request->tahun_terbit;
            $item['stok'] = $request->stok;
            $item['kategori_id'] = $request->kategori_id;

            $ditemukan = true;
            break;
        }
    }

    unset($item);

    if (!$ditemukan) {
        return redirect('/buku')
            ->with('error', 'Buku tidak ditemukan.');
    }

    session([
        'buku' => $buku
    ]);

    return redirect()
        ->route('buku.index')
        ->with('success', 'Data buku berhasil diubah.');

})->name('buku.update');


// DELETE BUKU
Route::post('/buku/{id}/delete', function ($id) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $buku = session('buku', []);

    $bukuBaru = [];

    foreach ($buku as $item) {

        if ($item['id'] != $id) {
            $bukuBaru[] = $item;
        }
    }

    session([
        'buku' => $bukuBaru
    ]);

    return redirect()
        ->route('buku.index')
        ->with('success', 'Data buku berhasil dihapus.');

})->name('buku.delete');

/* 
|--------------------------------------------------------------------------
| KATEGORI
|--------------------------------------------------------------------------
*/

Route::get('/kategori', function () {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $kategori = session('kategori', [
        [
            'id' => 1,
            'nama' => 'Teknologi'
        ],
        [
            'id' => 2,
            'nama' => 'Pemrograman'
        ],
        [
            'id' => 3,
            'nama' => 'Database'
        ],
        [
            'id' => 4,
            'nama' => 'Web Design'
        ],
    ]);

    return view('kategori', compact('kategori'));

})->name('kategori.index');


// FORM TAMBAH KATEGORI
Route::get('/kategori/create', function () {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    return view('kategori-create');

})->name('kategori.create');


// SIMPAN KATEGORI
Route::post('/kategori', function (Request $request) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $request->validate([
        'nama' => 'required|min:3',
    ]);

    $kategori = session('kategori', []);

    $nextId = count($kategori) > 0
        ? max(array_column($kategori, 'id')) + 1
        : 1;

    $kategori[] = [
        'id' => $nextId,
        'nama' => $request->nama,
    ];

    session([
        'kategori' => $kategori
    ]);

    return redirect()
        ->route('kategori.index')
        ->with('success', 'Data kategori berhasil ditambahkan.');

})->name('kategori.store');


// FORM EDIT KATEGORI
Route::get('/kategori/{id}/edit', function ($id) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $kategori = session('kategori', []);

    $data = null;

    foreach ($kategori as $item) {
        if ($item['id'] == $id) {
            $data = $item;
            break;
        }
    }

    if (!$data) {
        return redirect('/kategori')
            ->with('error', 'Kategori tidak ditemukan.');
    }

    return view('kategori-edit', compact('data'));

})->name('kategori.edit');


// UPDATE KATEGORI
Route::post('/kategori/{id}', function (Request $request, $id) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $request->validate([
        'nama' => 'required|min:3',
    ]);

    $kategori = session('kategori', []);

    $ditemukan = false;

    foreach ($kategori as &$item) {

        if ($item['id'] == $id) {

            $item['nama'] = $request->nama;

            $ditemukan = true;
            break;
        }
    }

    unset($item);

    if (!$ditemukan) {
        return redirect('/kategori')
            ->with('error', 'Kategori tidak ditemukan.');
    }

    session([
        'kategori' => $kategori
    ]);

    return redirect()
        ->route('kategori.index')
        ->with('success', 'Data kategori berhasil diubah.');

})->name('kategori.update');


// DELETE KATEGORI
Route::post('/kategori/{id}/delete', function ($id) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $kategori = session('kategori', []);

    $kategoriBaru = [];

    foreach ($kategori as $item) {

        if ($item['id'] != $id) {
            $kategoriBaru[] = $item;
        }
    }

    session([
        'kategori' => $kategoriBaru
    ]);

    return redirect()
        ->route('kategori.index')
        ->with('success', 'Data kategori berhasil dihapus.');

})->name('kategori.delete');

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
            'id' => 1,
            'nama' => 'Andi Pratama',
            'nis' => '12345',
            'alamat' => 'Jakarta',
            'no_hp' => '081234567890',
        ],
        [
            'id' => 2,
            'nama' => 'Siti Rahma',
            'nis' => '12346',
            'alamat' => 'Bandung',
            'no_hp' => '081234567891',
        ],
        [
            'id' => 3,
            'nama' => 'Budi Santoso',
            'nis' => '12347',
            'alamat' => 'Depok',
            'no_hp' => '081234567892',
        ],
        [
            'id' => 4,
            'nama' => 'Rina Amelia',
            'nis' => '12348',
            'alamat' => 'Bekasi',
            'no_hp' => '081234567893',
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
        'nis' => 'required',
        'alamat' => 'required',
        'no_hp' => 'required',
    ]);

    $anggota = session('anggota', []);

    $nextId = count($anggota) > 0
        ? max(array_column($anggota, 'id')) + 1
        : 1;

    $anggota[] = [
        'id' => $nextId,
        'nama' => $request->nama,
        'nis' => $request->nis,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
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

    // Data anggota
    $anggota = session('anggota', [
        [
            'id' => 1,
            'nama' => 'Andi Pratama',
            'nis' => '12345',
            'alamat' => 'Jakarta',
            'no_hp' => '081234567890'
        ],
        [
            'id' => 2,
            'nama' => 'Siti Rahma',
            'nis' => '12346',
            'alamat' => 'Bandung',
            'no_hp' => '081234567891'
        ],
        [
            'id' => 3,
            'nama' => 'Budi Santoso',
            'nis' => '12347',
            'alamat' => 'Depok',
            'no_hp' => '081234567892'
        ],
        [
            'id' => 4,
            'nama' => 'Rina Amelia',
            'nis' => '12348',
            'alamat' => 'Bekasi',
            'no_hp' => '081234567893'
        ],
    ]);

    // Data buku
    $buku = session('buku', [
        [
            'id' => 1,
            'judul' => 'Dasar-Dasar Laravel',
            'penulis' => 'Budi Santoso',
            'tahun_terbit' => 2024,
            'stok' => 5,
            'kategori_id' => 1
        ],
        [
            'id' => 2,
            'judul' => 'Pemrograman Web Modern',
            'penulis' => 'Andi Pratama',
            'tahun_terbit' => 2023,
            'stok' => 3,
            'kategori_id' => 2
        ],
        [
            'id' => 3,
            'judul' => 'Belajar Database MySQL',
            'penulis' => 'Siti Rahma',
            'tahun_terbit' => 2022,
            'stok' => 4,
            'kategori_id' => 3
        ],
        [
            'id' => 4,
            'judul' => 'HTML & CSS Dasar',
            'penulis' => 'Rina Amelia',
            'tahun_terbit' => 2024,
            'stok' => 6,
            'kategori_id' => 2
        ],
    ]);

    // Data peminjaman
    $peminjaman = session('peminjaman', [
        [
            'id' => 1,
            'anggota_id' => 1,
            'buku_id' => 1,
            'tanggal_pinjam' => '2026-08-18',
            'tanggal_jatuh_tempo' => '2026-08-25',
            'status' => 'Dipinjam'
        ],
        [
            'id' => 2,
            'anggota_id' => 2,
            'buku_id' => 2,
            'tanggal_pinjam' => '2026-08-17',
            'tanggal_jatuh_tempo' => '2026-08-24',
            'status' => 'Dipinjam'
        ],
    ]);

    /*
    | Tambahkan nama anggota dan buku
    | untuk ditampilkan di tabel.
    */

    foreach ($peminjaman as &$item) {

        $item['anggota'] = 'Tidak diketahui';
        $item['buku'] = 'Tidak diketahui';

        foreach ($anggota as $a) {

            if ($a['id'] == $item['anggota_id']) {
                $item['anggota'] = $a['nama'];
                break;
            }

        }

        foreach ($buku as $b) {

            if ($b['id'] == $item['buku_id']) {
                $item['buku'] = $b['judul'];
                break;
            }

        }
    }

    return view('peminjaman', compact(
        'peminjaman',
        'anggota',
        'buku'
    ));

})->name('peminjaman.index');


/*
|--------------------------------------------------------------------------
| SIMPAN PEMINJAMAN
|--------------------------------------------------------------------------
*/

Route::post('/peminjaman', function (Request $request) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $request->validate([
        'anggota_id' => 'required',
        'buku_id' => 'required',
        'tanggal_pinjam' => 'required|date',
        'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
    ]);

    $anggota = session('anggota', []);
    $buku = session('buku', []);
    $peminjaman = session('peminjaman', []);

    /*
    | Cek anggota
    */

    $anggotaDitemukan = false;

    foreach ($anggota as $item) {

        if ($item['id'] == $request->anggota_id) {
            $anggotaDitemukan = true;
            break;
        }

    }

    if (!$anggotaDitemukan) {

        return redirect('/peminjaman')
            ->with('error', 'Anggota tidak ditemukan.');

    }


    /*
    | Cek buku dan stok
    */

    $bukuDitemukan = false;

    foreach ($buku as $item) {

        if ($item['id'] == $request->buku_id) {

            $bukuDitemukan = true;

            if ($item['stok'] <= 0) {

                return redirect('/peminjaman')
                    ->with('error', 'Stok buku sedang habis.');

            }

            break;
        }

    }

    if (!$bukuDitemukan) {

        return redirect('/peminjaman')
            ->with('error', 'Buku tidak ditemukan.');

    }


    /*
    | Buat ID peminjaman
    */

    $idBaru = count($peminjaman) + 1;


    /*
    | Simpan peminjaman
    */

    $peminjaman[] = [

        'id' => $idBaru,

        'anggota_id' => $request->anggota_id,

        'buku_id' => $request->buku_id,

        'tanggal_pinjam' => $request->tanggal_pinjam,

        'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,

        'status' => 'Dipinjam',

    ];


    session([
        'peminjaman' => $peminjaman
    ]);


    /*
    | Kurangi stok buku
    */

    foreach ($buku as &$item) {

        if ($item['id'] == $request->buku_id) {

            $item['stok']--;

            break;
        }

    }

    session([
        'buku' => $buku
    ]);


    return redirect('/peminjaman')
        ->with('success', 'Peminjaman berhasil ditambahkan.');

})->name('peminjaman.store');


/*
|--------------------------------------------------------------------------
| PENGEMBALIAN
|--------------------------------------------------------------------------
*/

Route::get('/pengembalian', function () {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $pengembalian = session('pengembalian', []);

    $peminjaman = session('peminjaman', []);
    $anggota = session('anggota', []);
    $buku = session('buku', []);

    return view('pengembalian', compact(
        'pengembalian',
        'peminjaman',
        'anggota',
        'buku'
    ));

})->name('pengembalian.index');


Route::post('/pengembalian', function (Request $request) {

    if (!session('logged_in')) {
        return redirect('/login');
    }

    $request->validate([
        'peminjaman_id' => 'required',
        'tanggal_kembali' => 'required|date',
        'denda' => 'required|numeric|min:0',
    ]);

    $pengembalian = session('pengembalian', []);

    $nextId = count($pengembalian) > 0
        ? max(array_column($pengembalian, 'id')) + 1
        : 1;

    $pengembalian[] = [
        'id' => $nextId,
        'peminjaman_id' => $request->peminjaman_id,
        'tanggal_kembali' => $request->tanggal_kembali,
        'denda' => $request->denda,
    ];

    session(['pengembalian' => $pengembalian]);

    // Update status peminjaman menjadi Dikembalikan
    $peminjaman = session('peminjaman', []);

    foreach ($peminjaman as &$item) {

        if ($item['id'] == $request->peminjaman_id) {
            $item['status'] = 'Dikembalikan';
            break;
        }
    }

    session(['peminjaman' => $peminjaman]);

    return redirect('/pengembalian');

})->name('pengembalian.store');


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});