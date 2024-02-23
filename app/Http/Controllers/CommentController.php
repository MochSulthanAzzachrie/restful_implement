<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('comment-owner')->only('update', 'destroy');
    // }
    public function store(Request $request)
    {
        $comment = Comment::createComment($request);

        if($comment) {
            return response()->json(['data' => $comment]);
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
        $comment = Comment::editComment($request, $id);

        if($comment) {
            return response()->json(['data' => $comment]);
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
        $comment = Comment::breakComment($id);

        if($comment) {
            return response()->json(['data' => $comment]);
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
