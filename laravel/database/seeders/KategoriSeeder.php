<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori')->insert([
            [
                'nama' => 'Teknologi',
            ],
            [
                'nama' => 'Sejarah',
            ],
            [
                'nama' => 'Nonfiksi',
            ],
            [
                'nama' => 'Sejarah',
            ],
        ]);
    }
}