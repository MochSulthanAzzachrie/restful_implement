<?php

namespace App\Http\Controllers;

use App\Http\DTO\Post\PostMutationDTO;
use App\Http\DTO\Post\PostQueryDTO;
use App\Http\DTO\Post\UpdatePostDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\PostService;
use QueryParam\QueryParam;

class PostController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['index', 'show']]);
    //     $this->middleware('post-owner')->only('update', 'destroy');
    // }
    public function index(Request $request)
    {

        $config = [
            "filter" => $request->query('filter'),
            "sorter" => $request->query('sorter'),
            "limit" => $request->query('limit', '5'),
        ];

        $queryParam = new QueryParam($config);

        $postQueryDTO = new PostQueryDTO($queryParam);

        $operation = PostService::getPosts($postQueryDTO);

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

    public function show(string $id)
    {

        $config = [
            'filter' => "id = $id",
            'sorter' => null,
            'limit' => '1'
        ];

        $queryParam = new QueryParam($config);

        $postQueryDTO = new PostQueryDTO($queryParam);

        $operation = PostService::getPostById($postQueryDTO);

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
        $config = [
            'id' => null,
            'input' => $request->all()
        ];

        $postMutationDTO = new PostMutationDTO($config);

        $operation = PostService::createPost($postMutationDTO);

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

    public function update(Request $request, string $id)
    {
        $config = [
            'id' => $id,
            'input' => $request->all()
        ];

        $postMutationDTO = new PostMutationDTO($config);

        $operation = PostService::updatePost($postMutationDTO);

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

    public function destroy(string $id)
    {
        $config = [
            'id' => $id,
            'input' => null
        ];

        $postMutationDTO = new PostMutationDTO($config);

        $operation = PostService::deletePost($postMutationDTO);

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
