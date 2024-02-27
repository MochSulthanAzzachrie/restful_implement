<?php

namespace App\Service;

use App\Repositories\UserRepository;

class UserService
{
    public static function getUsers()
    {
        $users = UserRepository::getUsers();

        return $users;
    }

    public static function getUserById($id)
    {
        $user = UserRepository::getUserById($id);

        return $user;
    }

    public static function createUser(array $data)
    {
        $user = UserRepository::createUser($data);

        return $user;
    }

    public static function updateUser(array $data, $id)
    {
        $user = UserRepository::updateUser($data, $id);

        return $user;
    }

    public static function deleteUser($id)
    {
        $user = UserRepository::deleteUser($id);

        return $user;
    }

    public static function authRegister() {
        $user = UserRepository::authRegister();

        return $user;
    }

    public static function authLogin() {
        $user = UserRepository::authLogin();

        return $user;
    }
}
