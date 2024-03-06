<?php

namespace App\Services;

use App\Models\Post;
use App\Http\Operation\Operation;
use App\Http\DTO\Post\PostQueryDTO;
use App\Repositories\PostRepository;
use App\Http\DTO\Post\PostMutationDTO;
use App\Http\Resources\PostResourceCollection;

class PostService
{
    public static function getPosts(PostQueryDTO $postQueryDTO): Operation
    {

        $operation = new Operation();

        if (!$postQueryDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage($postQueryDTO->getMessage())
                ->setResult(null)
                ->setErrors($postQueryDTO->getErrors());

            return $operation;
        }

        $results = Post::getPosts(
            $postQueryDTO->getFields(),
            $postQueryDTO->getFilter(),
            $postQueryDTO->getSorter(),
            $postQueryDTO->getLimiter(),
        );

        $postsCollection = new PostResourceCollection($results);

        $operation->setIsSuccess(true)
            ->setMessage('Success get all post')
            ->setResult($postsCollection);

        return $operation;
    }

    public static function getPostById(PostQueryDTO $postQueryDTO): Operation
    {

        $operation = new Operation();
        if (!$postQueryDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage($postQueryDTO->getMessage())
                ->setResult(null)
                ->setErrors($postQueryDTO->getErrors());

            return $operation;
        }

        $result = Post::getPostById(
            $postQueryDTO->getFields(),
            $postQueryDTO->getFilter(),
        );

        if (!$result) {

            $operation->setIsSuccess(false)
                ->setMessage('Failed get comment by id, comment id not found');

            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('Success get post by id')
            ->setResult($result);

        return $operation;
    }

    public static function createPost(PostMutationDTO $postMutationDTO): Operation
    {

        $operation = new Operation();
        if (!$postMutationDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage($postMutationDTO->getMessage())
                ->setResult(null)
                ->setErrors($postMutationDTO->getErrors());

            return $operation;
        }

        $result = Post::createPost($postMutationDTO->getInput());

        $operation->setIsSuccess(true)
            ->setMessage('Success create new post')
            ->setResult($result);

        return $operation;
    }

    public static function updatePost(PostMutationDTO $postMutationDTO): Operation
    {

        $operation = new Operation();
        if (!$postMutationDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage('Failed to update post! Please check your input request.')
                ->setResult(array())
                ->setErrors($postMutationDTO->getErrors());

            return $operation;
        }

        $result = Post::updatePost(
            $postMutationDTO->getInput(),
            $postMutationDTO->getId(),
        );

        if (!$result) {
            $operation->setIsSuccess(false)
                ->setMessage('Failed update post, post id not found')
                ->setResult(array());

            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('Success update post')
            ->setResult($result);

        return $operation;
    }

    public static function deletePost(PostMutationDTO $postMutationDTO): Operation
    {

        $operation = new Operation();
        if (!$postMutationDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage($postMutationDTO->getMessage())
                ->setResult(null)
                ->setErrors($postMutationDTO->getErrors());

            return $operation;
        }

        $result = Post::deletePost($postMutationDTO->getId());

        if (!$result) {
            $operation->setIsSuccess(false)
                ->setMessage('Failed delete post, post id not found')
                ->setResult($result);

            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('Success delete post')
            ->setResult($result);

        return $operation;
    }
}
