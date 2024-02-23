<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store']]);
    }
    public function index()
    {
        $users = User::getUsers();

        if ($users) {
            return response()->json(['data' => $users]);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            );

            return response()->json($response, 404);
        }
    }

    public function show($id)
    {
        $user = User::getUserById($id);

        if ($user) {
            return response()->json(['data' => $user]);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            );

            return response()->json($response, 404);
        }
    }

    public function store(Request $request)
    {
        $user = User::createUser($request);

        if ($user) {
            return response()->json(['data' => $user]);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            );

            return response()->json($response, 404);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::editUser($request, $id);

        if ($user) {
            return response()->json(['data' => $user]);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            );

            return response()->json($response, 404);
        }
    }

    public function destroy($id)
    {
        $user = User::breakUser($id);

        if ($user) {
            return response()->json(['data' => $user]);
        } else {
            $response = array(
                'success' => false,
                'message' => 'Data not found',
                'data' => null,
            );

            return response()->json($response, 404);
        }
    }
}
