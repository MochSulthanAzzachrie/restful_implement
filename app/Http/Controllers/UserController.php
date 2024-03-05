<?php

namespace App\Http\Controllers;

use App\Http\DTO\User\UserCreateMutationDTO;
use App\Http\DTO\User\UserQueryDTO;
use App\Http\DTO\User\UserUpdateMutationDTO;
use Illuminate\Http\Request;
use App\Services\UserService;
use QueryParam\QueryParam;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {

        $config = [
            "filter" => $request->query('filter'),
            "sorter" => $request->query('sorter'),
            "limit" => $request->query('limit', '5'),
        ];

        $queryParam = new QueryParam($config);

        $userQueryDTO = new UserQueryDTO($queryParam);

        $operation = UserService::getUsers($userQueryDTO);

        if ($operation->isSuccess()) {
            $response = [
                'success' => $operation->isSuccess(),
                'message' => $operation->getMessage(),
                'data' => $operation->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $operation->getMessage(),
            "data" => null,
            "errors" => $operation->getErrors()
        ];
        return response()->json($response, 400);
    }

    public function show($id)
    {

        $config = [
            'filter' => "id = $id",
            'sorter' => null,
            'limit' => '1'
        ];

        $queryParam = new QueryParam($config);

        $userQueryDTO = new UserQueryDTO($queryParam);

        $operation = UserService::getUserById($userQueryDTO);

        if ($operation->isSuccess()) {
            $response = [
                'success' => $operation->isSuccess(),
                'message' => $operation->getMessage(),
                'data' => $operation->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $operation->getMessage(),
            "data" => null,
            "errors" => $operation->getErrors()
        ];
        return response()->json($response, 404);
    }

    public function store(Request $request)
    {
        $config = [
            'id' => null,
            'input' => $request->all()
        ];

        $userCreateMutationDTO = new UserCreateMutationDTO($config);

        $operation = UserService::createUser($userCreateMutationDTO);

        if ($operation->isSuccess()) {
            $response = [
                'success' => $operation->isSuccess(),
                'message' => $operation->getMessage(),
                'data' => $operation->getResult()
            ];
            return response()->json($response, 201);
        }

        $response = [
            "success" => false,
            "message" => $operation->getMessage(),
            "data" => null,
            "errors" => $operation->getErrors()
        ];
        return response()->json($response, 400);
    }

    public function update(Request $request, $id)
    {
        $config = [
            'id' => $id,
            'input' => $request->all()
        ];

        $userUpdateMutationDTO = new UserUpdateMutationDTO($config);

        $operation = UserService::updateUser($userUpdateMutationDTO);

        if ($operation->isSuccess()) {
            $response = [
                'success' => $operation->isSuccess(),
                'message' => $operation->getMessage(),
                'data' => $operation->getResult()
            ];
            return response()->json($response, 201);
        }

        $response = [
            "success" => false,
            "message" => $operation->getMessage(),
            "data" => null,
            "errors" => $operation->getErrors()
        ];
        return response()->json($response, 404);
    }

    public function destroy($id)
    {
        $config = [
            'id' => $id,
            'input' => null
        ];

        $userCreateMutationDTO = new UserCreateMutationDTO($config);

        $operation = UserService::deleteUser($userCreateMutationDTO);

        if ($operation->isSuccess()) {
            $response = [
                'success' => $operation->isSuccess(),
                'message' => $operation->getMessage(),
                'data' => $operation->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $operation->getMessage(),
            "data" => null,
            "errors" => $operation->getErrors()
        ];
        return response()->json($response, 404);
    }
}
