<?php

namespace App\Services;

use App\Models\User;
use App\Http\Operation\Operation;
use App\Http\DTO\User\UserQueryDTO;
use App\Repositories\UserRepository;
use App\Http\DTO\User\UserCreateMutationDTO;
use App\Http\DTO\User\UserUpdateMutationDTO;
use App\Http\Resources\UserResourceCollection;

class UserService
{
    public static function getUsers(UserQueryDTO $userQueryDTO): Operation
    {

        $operation = new Operation();

        if (!$userQueryDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage($userQueryDTO->getMessage())
                ->setResult(null)
                ->setErrors($userQueryDTO->getErrors());

            return $operation;
        }

        $results = User::getUsers(
            $userQueryDTO->getFields(),
            $userQueryDTO->getFilter(),
            $userQueryDTO->getSorter(),
            $userQueryDTO->getLimiter(),
        );

        $usersCollection = new UserResourceCollection($results);

        $operation->setIsSuccess(true)
            ->setMessage('Success get all user')
            ->setResult($usersCollection);

        return $operation;
    }

    public static function getUserById(UserQueryDTO $userQueryDTO): Operation
    {

        $operation = new Operation();
        if (!$userQueryDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage($userQueryDTO->getMessage())
                ->setResult(null)
                ->setErrors($userQueryDTO->getErrors());

            return $operation;
        }

        $result = User::getUserById(
            $userQueryDTO->getFields(),
            $userQueryDTO->getFilter(),
        );

        if (!$result) {

            $operation->setIsSuccess(false)
                ->setMessage('Failed get user by id, user id not found');

            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('Success get user by id')
            ->setResult($result);

        return $operation;
    }

    public static function createUser(UserCreateMutationDTO $userCreateMutationDTO): Operation
    {

        $operation = new Operation();
        if (!$userCreateMutationDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage($userCreateMutationDTO->getMessage())
                ->setResult(null)
                ->setErrors($userCreateMutationDTO->getErrors());

            return $operation;
        }

        $result = User::createUser($userCreateMutationDTO->getInput());

        $operation->setIsSuccess(true)
            ->setMessage('Success create new user')
            ->setResult($result);

        return $operation;
    }

    public static function updateUser(UserUpdateMutationDTO $userUpdateMutationDTO): Operation
    {

        $operation = new Operation();
        if (!$userUpdateMutationDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage('Failed to update user! Please check your input request.')
                ->setResult(array())
                ->setErrors($userUpdateMutationDTO->getErrors());

            return $operation;
        }

        $result = User::updateUser(
            $userUpdateMutationDTO->getInput(),
            $userUpdateMutationDTO->getId(),
        );

        if (!$result) {
            $operation->setIsSuccess(false)
                ->setMessage('Failed update user, user id not found')
                ->setResult(array());

            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('Success update user')
            ->setResult($result);

        return $operation;
    }

    public static function deleteUser(UserCreateMutationDTO $userCreateMutationDTO): Operation
    {

        $operation = new Operation();
        if (!$userCreateMutationDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage($userCreateMutationDTO->getMessage())
                ->setResult(null)
                ->setErrors($userCreateMutationDTO->getErrors());

            return $operation;
        }

        $result = User::deleteUser($userCreateMutationDTO->getId());

        if (!$result) {
            $operation->setIsSuccess(false)
                ->setMessage('Failed delete user, user id not found')
                ->setResult($result);;

            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('Success delete user')
            ->setResult($result);

        return $operation;
    }
}
