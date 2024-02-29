<?php

namespace App\Http\Controllers;

use App\Http\Operation\Operation;
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
        $posts = PostService::getPosts();

        if ($posts->isSuccess()) {
            $response = [
                'success' => $posts->isSuccess(),
                'message' => $posts->getMessage(),
                'data' => $posts->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $posts->getMessage(),
            "data" => null,
            "errors" => $posts->getErrors()
        ];
        return response()->json($response, 400);

    }

    public function show($id)
    {
        $post = PostService::getPostById($id);

        if ($post->isSuccess()) {
            $response = [
                'success' => $post->isSuccess(),
                'message' => $post->getMessage(),
                'data' => $post->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $post->getMessage(),
            "data" => null,
            "errors" => $post->getErrors()
        ];
        return response()->json($response, 400);

    }

    // public function show2($id)
    // {
    //     $post = Post::findOrFail($id);
    //     // return response()->json(['data' => $post]);
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

        $post = PostService::createPost($validator->validated());

        if ($post->isSuccess()) {
            $response = [
                'success' => $post->isSuccess(),
                'message' => $post->getMessage(),
                'data' => $post->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $post->getMessage(),
            "data" => null,
            "errors" => $post->getErrors()
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

        $post = PostService::updatePost($validator->validated(), $id);

        if ($post->isSuccess()) {
            $response = [
                'success' => $post->isSuccess(),
                'message' => $post->getMessage(),
                'data' => $post->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $post->getMessage(),
            "data" => null,
            "errors" => $post->getErrors()
        ];
        return response()->json($response, 400);

    }

    public function destroy($id)
    {
        $post = PostService::deletePost($id);

        if ($post->isSuccess()) {
            $response = [
                'success' => $post->isSuccess(),
                'message' => $post->getMessage(),
                'data' => $post->getResult()
            ];
            return response()->json($response, 200);
        }

        $response = [
            "success" => false,
            "message" => $post->getMessage(),
            "data" => null,
            "errors" => $post->getErrors()
        ];
        return response()->json($response, 400);

    }
}
