<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['store']]);
    // }
    public function index()
    {
        $users = User::getUsers();

        if ($users) {
            $response = array(
                'success' => true,
                'message' => 'Data successfully found',
                'data' => $users,
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

    public function show($id)
    {
        $user = User::getUserById($id);

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'username' => 'required|max:225',
            'password' => 'required',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
        ]);

        $user = User::createUser($request);

        if ($user) {
            $response = array(
                'success' => true,
                'message' => 'Created successfully',
                'data' => $user,
            );

            return response()->json($response, 201);
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
        $validated = $request->validate([
            'email' => 'nullable',
            'username' => 'nullable|max:225',
            'password' => 'nullable',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
        ]);

        $user = User::editUser($request, $id);

        if ($user) {
            $response = array(
                'success' => true,
                'message' => 'Updated successfully',
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

    public function destroy($id)
    {
        $user = User::breakUser($id);

        if ($user) {
            $response = array(
                'success' => true,
                'message' => 'Deleted successfully',
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
}
