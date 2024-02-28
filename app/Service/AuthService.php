<?php

namespace App\Service;

use App\Models\User;
use App\Repositories\AuthRepository;

class AuthService
{
    public static function authRegister() {
        $result = User::authRegister();

        return $result;
    }

    public static function authLogin() {
        $result = User::authLogin();

        return $result;
    }

}
