<?php

namespace App\Services;

use App\Models\Post;
use App\Http\Operation\Operation;
use App\Repositories\PostRepository;

class PostService
{
    public static function getPosts() : Operation
    {

        $operation = new Operation();

        $results = Post::getPosts();

        $operation->setIsSuccess(true)
            ->setMessage('success get all post')
            ->setResult($results);

        return $operation;
    }

    public static function getPostById($id) : Operation
    {

        $operation = new Operation();

        $result = Post::getPostById($id);

        if (!$result) {

            $operation->setIsSuccess(false)
                ->setMessage('failed get comment by id, comment id not found');

            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('success get post by id')
            ->setResult($result);

        return $operation;

    }

    public static function createPost(array $data) : Operation
    {

        $operation = new Operation();

        $result = Post::createPost($data);

        $operation->setIsSuccess(true)
            ->setMessage('success create new post')
            ->setResult($result);

        return $operation;

    }

    public static function updatePost(array $data, $id) : Operation
    {

        $operation = new Operation();

        $result = Post::updatePost($data, $id);

        if (!$result) {
            $operation->setIsSuccess(false)
                ->setMessage('failed update post, post id not found');
            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('success update post')
            ->setResult($result);

        return $operation;

    }

    public static function deletePost($id) : Operation
    {

        $operation = new Operation();

        $result = Post::deletePost($id);

        if (!$result) {
            $operation->setIsSuccess(false)
                ->setMessage('failed delete post, post id not found');
            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('success delete post')
            ->setResult($result);

        return $operation;
    }
}
