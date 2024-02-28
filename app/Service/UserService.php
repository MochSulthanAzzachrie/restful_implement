<?php

namespace App\Service;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    public static function getUsers()
    {
        $results = User::getUsers();

        return $results;
    }

    public static function getUserById($id)
    {
        $result = User::getUserById($id);

        return $result;
    }

    public static function createUser(array $data)
    {
        $result = User::createUser($data);

        return $$result;
    }

    public static function updateUser(array $data, $id)
    {
        $result = User::updateUser($data, $id);

        return $result;
    }

    public static function deleteUser($id)
    {
        $result = User::deleteUser($id);

        return $result;
    }

}
