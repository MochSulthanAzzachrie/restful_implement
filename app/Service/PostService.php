<?php

namespace App\Service;

use App\Models\Post;
use App\Repositories\PostRepository;

class PostService
{
    public static function getPosts()
    {
        $posts = Post::getPosts();

        return $posts;
    }

    public static function getPostById($id)
    {
        $post = Post::getPostById($id);

        return $post;
    }

    public static function createPost(array $data)
    {
        $post = Post::createPost($data);

        return $post;
    }

    public static function updatePost(array $data, $id)
    {
        $post = Post::updatePost($data, $id);

        return $post;
    }

    public static function deletePost($id)
    {
        $post = Post::deletePost($id);

        return $post;
    }
}
