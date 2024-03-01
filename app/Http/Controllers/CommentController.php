<?php

namespace App\Http\Controllers;

use App\Http\DTO\Comment\CreateCommentDTO;
use App\Http\DTO\Comment\UpdateCommentDTO;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('comment-owner')->only('update', 'destroy');
    // }
    public function store(Request $request)
    {
        $dto = new CreateCommentDTO($request->all());

        if (!$dto->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $dto->getErrors(),
            ], 400);
        }

        $operation = CommentService::createComment($dto->getData());

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
            'error' => $operation->getErrors(),
        );

        return response()->json($response, 400);
    }

    public function update(Request $request, $id)
    {
        $dto = new UpdateCommentDTO($request->all());

        if (!$dto->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $dto->getErrors(),
            ], 400);
        }

        $operation = CommentService::updateComment($dto->getData(), $id);

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
            'error' => $operation->getErrors(),
        );

        return response()->json($response, 404);
    }

    public function destroy($id)
    {
        $operation = CommentService::deleteComment($id);

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
            'error' => $operation->getErrors(),
        );

        return response()->json($response, 404);
    }
}
