<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterRequest;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(StoreRegisterRequest $request)
    {
        DB::transaction(function () use ($request) {
            $profile = Profile::create([
                'nama' => $request->nama,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
            ]);

            $role = Role::where('name', 'petugas')->firstOrFail();

            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'role_id' => $role->id,
                'profile_id' => $profile->id,
            ]);
        });

        return redirect('/login')->with(
            'success',
            'Registrasi berhasil. Silakan login.'
        );
    }
}