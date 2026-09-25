<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'nama',
        'nis',
        'alamat',
        'no_telp',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}