<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\DTO\Auth\AuthLoginDTO;
use App\Http\DTO\Auth\AuthRegisterDTO;

class AuthenticationController extends Controller
{
    //
    public function register(Request $request)
    {

        $config = [
            'id' => null,
            'input' => $request->all(),
        ];

        $dto = new AuthRegisterDTO($config);

        $operation = AuthService::authRegister($dto);

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
            'errors' => $operation->getErrors(),
        );

        return response()->json($response, 400);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $config = [
            'id' => null,
            'input' => $request->all(),
        ];

        $dto = new AuthLoginDTO($config);

        $operation = AuthService::authLogin($dto);

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
            'message' => 'Successfully found data',
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
