<?php

namespace App\Http\Controllers;

use App\Http\Operation\Operation;
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
        $users = UserService::getUsers();

        if ($users->isSuccess()) {
            $response = [
                'success' => $users->isSuccess(),
                'message' => $users->getMessage(),
                'data' => $users->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $users->getMessage(),
            "data" => null,
            "errors" => $users->getErrors()
        ];
        return response()->json($response, 400);

    }

    public function show($id)
    {
        $user = UserService::getUserById($id);

        if ($user->isSuccess()) {
            $response = [
                'success' => $user->isSuccess(),
                'message' => $user->getMessage(),
                'data' => $user->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $user->getMessage(),
            "data" => null,
            "errors" => $user->getErrors()
        ];
        return response()->json($response, 400);

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

        $user = UserService::createUser($validator->validated());

        if ($user->isSuccess()) {
            $response = [
                'success' => $user->isSuccess(),
                'message' => $user->getMessage(),
                'data' => $user->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $user->getMessage(),
            "data" => null,
            "errors" => $user->getErrors()
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

        $user = UserService::updateUser($validator->validated(), $id);

        if ($user->isSuccess()) {
            $response = [
                'success' => $user->isSuccess(),
                'message' => $user->getMessage(),
                'data' => $user->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $user->getMessage(),
            "data" => null,
            "errors" => $user->getErrors()
        ];
        return response()->json($response, 400);

    }

    public function destroy($id)
    {
        $user = UserService::deleteUser($id);

        if ($user->isSuccess()) {
            $response = [
                'success' => $user->isSuccess(),
                'message' => $user->getMessage(),
                'data' => $user->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $user->getMessage(),
            "data" => null,
            "errors" => $user->getErrors()
        ];
        return response()->json($response, 400);

    }
}
