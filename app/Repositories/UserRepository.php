<?php

namespace App\Repositories;

use App\Models\User;

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

}
