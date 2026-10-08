<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::where('name', 'admin')->firstOrFail();

        $profile = Profile::firstOrCreate(
            [
                'nama' => 'Administrator',
            ],
            [
                'no_telp' => null,
                'alamat' => null,
            ]
        );

        User::firstOrCreate(
            [
                'username' => 'admin',
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@perpuskita.test',
                'password' => 'admin12345',
                'role_id' => $role->id,
                'profile_id' => $profile->id,
            ]
        );
    }
}