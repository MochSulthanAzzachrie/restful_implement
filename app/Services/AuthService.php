<?php

namespace App\Services;

use App\Http\DTO\Auth\AuthLoginDTO;
use App\Http\DTO\Auth\AuthRegisterDTO;
use App\Models\User;
use App\Http\Operation\Operation;
use App\Repositories\AuthRepository;

class AuthService
{
    public static function authRegister(AuthRegisterDTO $authRegisterDTO): Operation
    {

        $operation = new Operation();

        if (!$authRegisterDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setErrors($authRegisterDTO->getErrors())
                ->setMessage($authRegisterDTO->getMessage());
            return $operation;
        }

        $result = User::createUser($authRegisterDTO->getInput());

        $operation->setIsSuccess(true)
            ->setMessage('Success register')
            ->setResult($result);

        return $operation;
    }

    public static function authLogin(AuthLoginDTO $authLoginDTO): Operation
    {

        $operation = new Operation();

        if (!$authLoginDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setErrors($authLoginDTO->getErrors())
                ->setMessage($authLoginDTO->getMessage());
            return $operation;
        }

        $input = $authLoginDTO->getInput();

        $token = auth()->attempt ([
            'email' => $input['email'],
            'password' => $input['password'],
        ]);

        // $token = auth()->attempt($credentials);

        if (!$token) {
            $operation->setIsSuccess(false)
                ->setMessage('Unauthorize, email or password not matched');

            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('Success login')
            ->setResult($token);

        return $operation;
    }

    public static function authMe(): Operation
    {

        $operation = new Operation();

        $result = auth()->user();

        $operation->setIsSuccess(true)
            ->setMessage('Success get user')
            ->setResult($result);

        return $operation;
    }

    public static function authLogout(): Operation
    {

        $operation = new Operation();

        auth()->logout();

        $operation->setIsSuccess(true)
            ->setMessage('Success logout')
            ->setResult(null);

        return $operation;
    }

    public static function authRefresh(): Operation
    {

        $operation = new Operation();

        $result = auth()->refresh();

        $operation->setIsSuccess(true)
            ->setMessage('Success get refresh token')
            ->setResult($result);

        return $operation;
    }
}
