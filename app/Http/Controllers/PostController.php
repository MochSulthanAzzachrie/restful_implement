<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostDetailResource;
use App\Service\PostService;

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
        $posts = PostService::getPosts();

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
        $post = PostService::getPostById($id);

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
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:225',
            'novel_content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $validator->errors(),
            ], 400);
        }

        $post = PostService::createPost($validator->validated());

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
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|max:225',
            'novel_content' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'failed, payload not suited',
                'data' => null,
                'errors' => $validator->errors(),
            ], 400);
        }

        $post = PostService::updatePost($validator->validated(), $id);

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
        $post = PostService::deletePost($id);

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
