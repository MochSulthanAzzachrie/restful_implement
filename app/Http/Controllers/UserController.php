<?php

namespace App\Http\Controllers;

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
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'username' => 'required|max:225',
            'password' => 'required',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $validator->errors(),
            ], 400);
        }

        $operation = UserService::createUser($validator->validated());

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
        $validator = Validator::make($request->all(), [
            'email' => 'nullable',
            'username' => 'nullable|max:225',
            'password' => 'nullable',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $validator->errors(),
            ], 400);
        }

        $operation = UserService::updateUser($validator->validated(), $id);

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
