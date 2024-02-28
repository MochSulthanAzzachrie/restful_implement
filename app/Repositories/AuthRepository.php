<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public static function authRegister() {

        $user = User::create([
            'email' => request('email'),
            'username' => request('username'),
            'password' => Hash::make(request('password')),
            'firstname' => request('firstname'),
            'lastname' => request('lastname'),
        ]);

        return $user;
    }

    public static function authLogin() {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $token;
    }

}
