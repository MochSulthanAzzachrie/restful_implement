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

    public function show(string $id)
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
        if (!$request->hasFile('image')) {
            $response = [
                "success" => false,
                "message" => "Failed create new users, file not upload",
                "errors" => [
                    "image" => ["The post image field is required."]
                ],
                "data" => null
            ];
            return response()->json($response, 400);
        }

        $requestData = $request->all();

        $file = $request->file('image');
        $filename = time() . $file->getClientOriginalName();

        $path = 'uploads/user';
        $file->move($path, $filename)->getPathname();

        $requestData['image'] = "$path/$filename";

        $userMutationConfig = array(
            'id' => null,
            'input' => $requestData
        );

        $userCreateMutationDTO = new UserCreateMutationDTO($userMutationConfig);

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

    public function update(Request $request, string $id)
    {
        if (!$request->hasFile('image')) {
            $response = [
                "success" => false,
                "message" => "Failed update users, file not upload",
                "errors" => [
                    "image" => ["The post image field is required."]
                ],
                "data" => null
            ];
            return response()->json($response, 400);
        }

        $requestData = $request->all();

        $file = $request->file('image');
        $filename = time() . $file->getClientOriginalName();

        $path = 'uploads/user';
        $file->move($path, $filename)->getPathname();

        $requestData['image'] = "$path/$filename";

        $userMutationConfig = array(
            'id' => $id,
            'input' => $requestData
        );

        $userUpdateMutationDTO = new UserUpdateMutationDTO($userMutationConfig);

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

    public function destroy(string $id)
    {
        $userMutationConfig = array(
            'id' => $id,
            'input' => null
        );

        $userCreateMutationDTO = new UserCreateMutationDTO($userMutationConfig);

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
