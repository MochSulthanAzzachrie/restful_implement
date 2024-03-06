<?php

namespace App\Http\Controllers;

use App\Http\DTO\Post\PostMutationDTO;
use App\Http\DTO\Post\PostQueryDTO;
use Illuminate\Http\Request;
use App\Services\PostService;
use QueryParam\QueryParam;

class PostController extends Controller
{
    //
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

    public function store(Request $request)
    {
        if (!$request->hasFile('image')) {
            $response = [
                "success" => false,
                "message" => "Failed create new posts, file not upload",
                "errors" => [
                    "image" => ["The post image field is required."]
                ],
                "data" => null
            ];
            return response()->json($response, 400);
        }

        $requestData = $request->all();

        $file = $request->file('image');
        $filename = time() . $file->getClientOriginalName();

        $path = 'uploads/post';
        $file->move($path, $filename)->getPathname();

        $requestData['image'] = "$path/$filename";

        $postMutationConfig = array(
            'id' => null,
            'input' => $requestData
        );

        $postMutationDTO = new PostMutationDTO($postMutationConfig);

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
        // if (!$request->hasFile('image')) {
        //     $response = [
        //         "success" => false,
        //         "message" => "Failed update posts, file not upload",
        //         "errors" => [
        //             "image" => ["The post image field is required."]
        //         ],
        //         "data" => null
        //     ];
        //     return response()->json($response, 400);
        // }

        $requestData = $request->all();

        $file = $request->file('image');

        $filename = time() . $file->getClientOriginalName();

        $path = 'uploads/post';
        $file->move($path, $filename)->getPathname();

        $requestData['image'] = "$path/$filename";

        $postMutationConfig = array(
            'id' => $id,
            'input' => $requestData
        );

        $postMutationDTO = new PostMutationDTO($postMutationConfig);

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
        $postMutationConfig = array(
            'id' => $id,
            'input' => null
        );

        $postMutationDTO = new PostMutationDTO($postMutationConfig);

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
