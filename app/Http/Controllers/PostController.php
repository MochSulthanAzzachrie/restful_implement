<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostDetailResource;
use Illuminate\Support\Facades\Storage;

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
        $posts = Post::getPosts();

        if ($posts) {
            $response = array(
                'success' => true,
                'message' => 'Data successfully found',
                'data' => $posts,
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

    public function show($id)
    {
        $post = Post::getPostById($id);

        if ($post) {
            $response = array(
                'success' => true,
                'message' => 'Data successfully found',
                'data' => $post,
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

    // public function show2($id)
    // {
    //     $post = Post::findOrFail($id);
    //     // return response()->json(['data' => $post]);
    //     return new PostDetailResource($post);
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:225',
            'novel_content' => 'required',
        ]);

        $post = Post::createPost($request);

        if ($post) {
             $response = array(
                'success' => true,
                'message' => 'Created successfully',
                'data' => $post,
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
            'title' => 'nullable|max:225',
            'novel_content' => 'nullable',
        ]);

        $post = Post::editPost($request, $id);

        if ($post) {
            $response = array(
                'success' => true,
                'message' => 'Updated successfully',
                'data' => $post,
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
        $post = Post::breakPost($id);

        if ($post) {
            $response = array(
                'success' => true,
                'message' => 'Deleted successfully',
                'data' => $post,
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
