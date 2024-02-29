<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    //
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
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

        $operation = AuthService::authRegister($validator->validated());

        if ($operation->isSuccess()) {
            $response = array(
                'success' => true,
                'message' => 'Successfully Registered',
                'data' => $operation->getResult(),
            );

            return response()->json($response, 201);
        }

        $response = array(
            'success' => false,
            'message' => $operation->getMessage(),
            'data' => null,
            'error' => $operation->getErrors(),
        );

        return response()->json($response, 400);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $operation = AuthService::authLogin();

        if ($operation->isSuccess()) {
            $response = array(
                'success' => true,
                'message' => 'Successfully logged in',
                'data' => [
                    'access_token' => $operation->getResult(),
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60,
                ]
            );

            return response()->json($response, 200);
        }

        $response = array(
            'success' => false,
            'message' => $operation->getMessage(),
            'data' => null,
            'errors' => $operation->getErrors(),
        );

        return response()->json($response, 400);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $operation = AuthService::authMe();

        $response = array(
            'success' => true,
            'message' => 'Data successfully found',
            'data' => $operation->getResult(),
        );

        return response()->json($response, 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $operation = AuthService::authLogout();

        $response = array(
            'success' => true,
            'message' => 'Successfully logged out',
            'data' => $operation->getResult(),
        );

        return response()->json($response, 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $operation = AuthService::authRefresh();

        $response = array(
            'success' => true,
            'message' => 'Successfully refreshed',
            'data' => [
                'access_token' => $operation->getResult(),
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]
        );

        return response()->json($response, 200);
    }
}
