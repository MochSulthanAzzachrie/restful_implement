<?php

namespace App\Service;

use App\Models\Post;
use App\Repositories\PostRepository;

class PostService
{
    public static function getPosts()
    {
        $results = Post::getPosts();

        return $results;
    }

    public static function getPostById($id)
    {
        $result = Post::getPostById($id);

        return $result;
    }

    public static function createPost(array $data)
    {
        $result = Post::createPost($data);

        return $result;
    }

    public static function updatePost(array $data, $id)
    {
        $result = Post::updatePost($data, $id);

        return $result;
    }

    public static function deletePost($id)
    {
        $result = Post::deletePost($id);

        return $result;
    }
}
