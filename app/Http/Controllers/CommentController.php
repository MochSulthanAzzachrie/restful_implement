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
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required',
        ]);

        $comment = Comment::createComment($request);

        if($comment) {
            $response = array(
                'success' => true,
                'message' => 'Created successfully',
                'data' => $comment,
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
            'comments_content' => 'required',
        ]);

        $comment = Comment::editComment($request, $id);

        if($comment) {
            $response = array(
                'success' => true,
                'message' => 'Updated successfully',
                'data' => $comment,
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
        $comment = Comment::breakComment($id);

        if($comment) {
            $response = array(
                'success' => true,
                'message' => 'Deleted successfully',
                'data' => $comment,
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
