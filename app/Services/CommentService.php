<?php

namespace App\Services;

use App\Http\DTO\Comment\CommentCreateMutationDTO;
use App\Http\DTO\Comment\CommentUpdateMutationDTO;
use App\Models\Comment;
use App\Http\Operation\Operation;
use App\Repositories\CommentRepository;

class CommentService
{
    public static function createComment(CommentCreateMutationDTO $commentCreateMutationDTO) : Operation
    {

        $operation = new Operation();
        if (!$commentCreateMutationDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage($commentCreateMutationDTO->getMessage())
                ->setErrors($commentCreateMutationDTO->getErrors());
            return $operation;
        }

        $result = Comment::createComment($commentCreateMutationDTO->getInput());

        $operation->setIsSuccess(true)
            ->setMessage('success create new comment')
            ->setResult($result);

        return $operation;
    }

    public static function updateComment(CommentUpdateMutationDTO $commentUpdateMutationDTO) : Operation
    {

        $operation = new Operation();
        if (!$commentUpdateMutationDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage($commentUpdateMutationDTO->getMessage())
                ->setErrors($commentUpdateMutationDTO->getErrors());
            return $operation;
        }

        $result = Comment::updateComment(
            $commentUpdateMutationDTO->getInput(),
            $commentUpdateMutationDTO->getId(),
        );

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

    public static function deleteComment(CommentCreateMutationDTO $commentCreateMutationDTO) : Operation
    {

        $operation = new Operation();
        if (!$commentCreateMutationDTO->isValid()) {
            $operation->setIsSuccess(false)
                ->setMessage($commentCreateMutationDTO->getMessage())
                ->setErrors($commentCreateMutationDTO->getErrors());
            return $operation;
        }

        $result = Comment::deleteComment($commentCreateMutationDTO->getId());

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
