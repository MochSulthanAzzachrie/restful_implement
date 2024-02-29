<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\PostService;

class PostController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['index', 'show']]);
    //     $this->middleware('post-owner')->only('update', 'destroy');
    // }
    public function index()
    {
        $operation = PostService::getPosts();

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
        $operation = PostService::getPostById($id);

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

    // public function show2($id)
    // {
    //     $operation = Post::findOrFail($id);
    //     // return response()->json(['data' => $operation]);
    //     return new PostDetailResource($post);
    // }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:225',
            'novel_content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $validator->errors(),
            ], 400);
        }

        $operation = PostService::createPost($validator->validated());

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
            'title' => 'nullable|max:225',
            'novel_content' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $validator->errors(),
            ], 400);
        }

        $operation = PostService::updatePost($validator->validated(), $id);

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
        $operation = PostService::deletePost($id);

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
