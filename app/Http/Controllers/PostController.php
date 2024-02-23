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
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
        // $this->middleware('post-owner')->only('update', 'destroy');
    }
    public function index()
    {
        $posts = Post::getPosts();

        if ($posts) {
            return response()->json(['data' => $posts]);
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
            return response()->json(['data' => $post]);
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
        $post = Post::createPost($request);

        if ($post) {
            return response()->json(['data' => $post]);
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
        $post = Post::editPost($request, $id);

        if ($post) {
            return response()->json(['data' => $post]);
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
            return response()->json(['data' => $post]);
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
