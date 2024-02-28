<?php

namespace App\Service;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    public static function getUsers()
    {
        $users = User::getUsers();

        return $users;
    }

    public static function getUserById($id)
    {
        $user = User::getUserById($id);

        return $user;
    }

    public static function createUser(array $data)
    {
        $user = User::createUser($data);

        return $user;
    }

    public static function updateUser(array $data, $id)
    {
        $user = User::updateUser($data, $id);

        return $user;
    }

    public static function deleteUser($id)
    {
        $user = User::deleteUser($id);

        return $user;
    }

}
