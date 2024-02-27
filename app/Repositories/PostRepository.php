<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepository
{
    public static function getPosts()
    {
        $posts = Post::with('comments')->get();

        return $posts;
    }

    public static function getPostById($id)
    {
        $post = Post::with('comments')->find($id);

        return $post;
    }

    public static function createPost(array $data)
    {

        $data['user_id'] = Auth::user()->id;
        $post = Post::create($data);

        return $post;
    }

    public static function updatePost(array $data, $id)
    {

        $post = Post::find($id);
        $post->update($data);

        return $post;
    }

    public static function deletePost($id)
    {
        $post = Post::find($id);
        $post->delete();

        return $post;
    }
}

