<?php

namespace App\Http\Controllers;

use App\Http\DTO\Post\CreatePostDTO;
use App\Http\DTO\Post\UpdatePostDTO;
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
        $dto = new CreatePostDTO($request->all());

        if (!$dto->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $dto->getErrors(),
            ], 400);
        }

        $operation = PostService::createPost($dto->getData());

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
        $dto = new UpdatePostDTO($request->all());

        if (!$dto->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $dto->getErrors(),
            ], 400);
        }

        $operation = PostService::updatePost($dto->getData(), $id);

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
