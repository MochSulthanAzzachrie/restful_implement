<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

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

        $user = AuthService::authRegister();

        if ($user) {
            $response = array(
                'success' => true,
                'message' => 'Successfully Registered',
                'data' => $user,
            );

            return response()->json($response, 200);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Failed Registered',
                'data' => null,
            );

            return response()->json($response, 400);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $token = AuthService::authLogin();

        if ($token) {
            $response = array(
                'success' => true,
                'message' => 'Successfully logged in',
                'data' => [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60,
                ]
            );

            return response()->json($response, 200);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Failed logged in',
                'data' => null,
            );

            return response()->json($response, 404);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = AuthService::authMe();

        if ($user) {
            $response = array(
                'success' => true,
                'message' => 'Data successfully found',
                'data' => $user,
            );

            return response()->json($response, 200);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            );

            return response()->json($response, 404);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user = AuthService::authLogout();

            $response = array(
                'success' => $user,
                'message' => 'Successfully logged out',
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
        $token = AuthService::authRefresh();

        if ($token) {
            $response = array(
                'success' => true,
                'message' => 'Successfully refreshed',
                'data' => [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60,
                ]
            );

            return response()->json($response, 200);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Failed refreshed',
                'data' => null,
            );

            return response()->json($response, 404);
        }
    }

}
