<?php

namespace App\Services;

use App\Models\Comment;
use App\Http\Operation\Operation;
use App\Repositories\CommentRepository;

class CommentService
{
    public static function createComment(array $data) : Operation
    {

        $operation = new Operation();

        $result = Comment::createComment($data);

        $operation->setIsSuccess(true)
            ->setMessage('success create new comment')
            ->setResult($result);

        return $operation;
    }

    public static function updateComment(array $data, $id) : Operation
    {

        $operation = new Operation();

        $result = Comment::updateComment($data, $id);

        if (!$result) {

            $operation->setIsSuccess(false)
                ->setMessage('failed update comment, comment id not found');

            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('success update comment')
            ->setResult($result);

        return $operation;
    }

    public static function deleteComment($id) : Operation
    {

        $operation = new Operation();

        $result = Comment::deleteComment($id);

        if (!$result) {

            $operation->setIsSuccess(false)
                ->setMessage('failed delete comment, comment id not found');

            return $operation;
        }

        $operation->setIsSuccess(true)
            ->setMessage('success delete comment')
            ->setResult($result);

        return $operation;
    }
}
