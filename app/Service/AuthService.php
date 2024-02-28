<?php

namespace App\Service;

use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public static function authRegister() {

        $result = User::create([
            'email' => request('email'),
            'username' => request('username'),
            'password' => Hash::make(request('password')),
            'firstname' => request('firstname'),
            'lastname' => request('lastname'),
        ]);

        return $result;
    }

    public static function authLogin() {

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $token;
    }

    public static function authMe() {

        $result = auth()->user();

        return $result;
    }

    public static function authLogout() {

        auth()->logout();

        return true;
    }

    public static function authRefresh() {

        $result = auth()->refresh();

        return $result;
    }

}
