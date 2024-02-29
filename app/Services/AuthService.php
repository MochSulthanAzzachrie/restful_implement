<?php

namespace App\Services;

use App\Models\User;
use App\Http\Operation\Operation;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public static function authRegister() : Operation
    {

        $operation = new Operation();

        $result = User::create([
            'email' => request('email'),
            'username' => request('username'),
            'password' => Hash::make(request('password')),
            'firstname' => request('firstname'),
            'lastname' => request('lastname'),
        ]);

        $operation->setIsSuccess(true)
            ->setMessage('success register')
            ->setResult($result);

        return $operation;
    }

    public static function authLogin() : Operation
    {

        $operation = new Operation();

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            $operation->setIsSuccess(false)
                ->setMessage('Unauthorize, email or password not matched');

            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('success login')
            ->setResult($token);

        return $operation;
    }

    public static function authMe() : Operation
    {

        $operation = new Operation();

        $result = auth()->user();

        $operation->setIsSuccess(true)
            ->setMessage('success get user')
            ->setResult($result);

        return $operation;
    }

    public static function authLogout() : Operation
    {

        $operation = new Operation();

        auth()->logout();

        $operation->setIsSuccess(true)
            ->setMessage('success logout')
            ->setResult(null);

        return $operation;
    }

    public static function authRefresh() : Operation
    {

        $operation = new Operation();

        $result = auth()->refresh();

        $operation->setIsSuccess(true)
            ->setMessage('success get refresh token')
            ->setResult($result);

        return $operation;
    }
}
