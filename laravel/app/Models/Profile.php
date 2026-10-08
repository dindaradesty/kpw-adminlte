<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    protected $fillable = [
        'nama',
        'no_telp',
        'alamat',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}