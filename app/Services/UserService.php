<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Operation\Operation;
use App\Repositories\UserRepository;
use App\Http\Resources\UserResourceCollection;

class UserService
{
    public static function getUsers($limit, $search) : Operation
    {

        $operation = new Operation();

        $results = User::getUsers($limit, $search);

        $usersCollection = new UserResourceCollection($results);

        $operation->setIsSuccess(true)
            ->setMessage('success get all user')
            ->setResult($usersCollection);

        return $operation;
    }

    public static function getUserById($id) : Operation
    {

        $operation = new Operation();

        $result = User::getUserById($id);

        if (!$result) {

            $operation->setIsSuccess(false)
                ->setMessage('failed get user by id, user id not found');

            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('success get user by id')
            ->setResult($result);

        return $operation;
    }

    public static function createUser(array $data) : Operation
    {

        $operation = new Operation();

        $result = User::createUser($data);

        $operation->setIsSuccess(true)
            ->setMessage('success create new user')
            ->setResult($result);

        return $operation;
    }

    public static function updateUser(array $data, $id) : Operation
    {

        $operation = new Operation();

        $result = User::updateUser($data, $id);

        if (!$result) {
            $operation->setIsSuccess(false)
                ->setMessage('failed update user, user id not found');
            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('success update user')
            ->setResult($result);

        return $operation;
    }

    public static function deleteUser($id) : Operation
    {

        $operation = new Operation();

        $result = User::deleteUser($id);

        if (!$result) {
            $operation->setIsSuccess(false)
                ->setMessage('failed delete user, user id not found');
            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('success delete user')
            ->setResult($result);

        return $operation;
    }

}
