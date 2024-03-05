<?php

namespace App\Http\Controllers;

use App\Http\DTO\Comment\CommentCreateMutationDTO;
use App\Http\DTO\Comment\CommentUpdateMutationDTO;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $config = [
            'id' => null,
            'input' => $request->all()
        ];

        $commentCreateMutationDTO = new CommentCreateMutationDTO($config);

        $operation = CommentService::createComment($commentCreateMutationDTO);

        if ($operation->isSuccess()) {
            $response = array(
                'success' => $operation->isSuccess(),
                'message' => $operation->getMessage(),
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

    public function update(Request $request, string $id)
    {
        $config = [
            'id' => $id,
            'input' => $request->all()
        ];

        $commentUpdateMutationDTO = new CommentUpdateMutationDTO($config);

        $operation = CommentService::updateComment($commentUpdateMutationDTO);

        if ($operation->isSuccess()) {
            $response = array(
                'success' => $operation->isSuccess(),
                'message' => $operation->getMessage(),
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

        return response()->json($response, 404);
    }

    public function destroy(string $id)
    {
        $config = [
            'id' => $id,
            'input' => null
        ];

        $commentCreateMutationDTO = new CommentCreateMutationDTO($config);

        $operation = CommentService::deleteComment($commentCreateMutationDTO);

        if ($operation->isSuccess()) {
            $response = array(
                'success' => $operation->isSuccess(),
                'message' => $operation->getMessage(),
                'data' => $operation->getResult(),
            );

            return response()->json($response, 200);
        }
        $response = array(
            'success' => false,
            'message' => $operation->getMessage(),
            'data' => null,
            'errors' => $operation->getErrors(),
        );

        return response()->json($response, 404);
    }
}
