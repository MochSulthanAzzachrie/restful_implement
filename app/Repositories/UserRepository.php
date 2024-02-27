<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public static function getUsers()
    {
        $users = User::all();

        return $users;
    }

    public static function getUserById($id)
    {
        $user = User::find($id);

        return $user;
    }

    public static function createUser(array $data)
    {

        $user = User::create($data);

        return $user;
    }

    public static function updateUser(array $data, $id)
    {

        $user = User::find($id);
        $user->update($data);

        return $user;
    }

    public static function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $user;
    }

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
