<?php

namespace App\Http\Controllers;

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
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $validator->errors(),
            ], 400);
        }

        $comment = CommentService::createComment($validator->validated());

        if ($comment->isSuccess()) {
            $response = array(
                'success' => $comment->isSuccess(),
                'message' => $comment->getMessage(),
                'data' => $comment->getResult(),
            );

            return response()->json($response, 201);
        }
        $response = array(
            'success' => false,
            'message' => $comment->getMessage(),
            'data' => null,
            'error' => $comment->getErrors(),
        );

        return response()->json($response, 400);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comments_content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $validator->errors(),
            ], 400);
        }

        $comment = CommentService::updateComment($validator->validated(), $id);

        if ($comment->isSuccess()) {
            $response = array(
                'success' => $comment->isSuccess(),
                'message' => $comment->getMessage(),
                'data' => $comment->getResult(),
            );

            return response()->json($response, 200);
        }
        $response = array(
            'success' => false,
            'message' => $comment->getMessage(),
            'data' => null,
            'error' => $comment->getErrors(),
        );

        return response()->json($response, 400);
    }

    public function destroy($id)
    {
        $comment = CommentService::deleteComment($id);

        if ($comment->isSuccess()) {
            $response = array(
                'success' => $comment->isSuccess(),
                'message' => $comment->getMessage(),
                'data' => $comment->getResult(),
            );

            return response()->json($response, 200);
        }
        $response = array(
            'success' => false,
            'message' => $comment->getMessage(),
            'data' => null,
            'error' => $comment->getErrors(),
        );

        return response()->json($response, 404);
    }
}
