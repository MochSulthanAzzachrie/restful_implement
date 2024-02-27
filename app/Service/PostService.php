<?php

namespace App\Service;

use App\Repositories\PostRepository;

class PostService
{
    public static function getPosts()
    {
        $posts = PostRepository::getPosts();

        return $posts;
    }

    public static function getPostById($id)
    {
        $post = PostRepository::getPostById($id);

        return $post;
    }

    public static function createPost(array $data)
    {
        $post = PostRepository::createPost($data);

        return $post;
    }

    public static function updatePost(array $data, $id)
    {
        $post = PostRepository::updatePost($data, $id);

        return $post;
    }

    public static function deletePost($id)
    {
        $post = PostRepository::deletePost($id);

        return $post;
    }
}
