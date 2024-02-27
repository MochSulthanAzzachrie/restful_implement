<?php

namespace App\Service;

use App\Repositories\CommentRepository;

class CommentService
{
    public static function createComment(array $data)
    {
        $comment = CommentRepository::createComment($data);

        return $comment;
    }

    public static function updateComment(array $data, $id)
    {
        $comment = CommentRepository::updateComment($data, $id);

        return $comment;
    }

    public static function deleteComment($id)
    {
        $comment = CommentRepository::deleteComment($id);

        return $comment;
    }
}
