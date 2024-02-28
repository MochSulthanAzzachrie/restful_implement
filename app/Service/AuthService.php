<?php

namespace App\Service;

use App\Models\User;
use App\Repositories\AuthRepository;

class AuthService
{
    public static function authRegister() {
        $user = User::authRegister();

        return $user;
    }

    public static function authLogin() {
        $user = User::authLogin();

        return $user;
    }

}
