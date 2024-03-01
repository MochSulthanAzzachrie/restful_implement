<?php

namespace App\Http\Controllers;

use App\Http\DTO\User\CreateUserDTO;
use App\Http\DTO\User\UpdateUserDTO;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['store']]);
    // }
    public function index()
    {
        $operation = UserService::getUsers();

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
        $operation = UserService::getUserById($id);

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
        $dto = new CreateUserDTO($request->all());

        if (!$dto->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $dto->getErrors(),
            ], 400);
        }

        $operation = UserService::createUser($dto->getData());

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
        $dto = new UpdateUserDTO($request->all());

        if (!$dto->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $dto->getErrors(),
            ], 400);
        }

        $operation = UserService::updateUser($dto->getData(), $id);

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
        $operation = UserService::deleteUser($id);

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
