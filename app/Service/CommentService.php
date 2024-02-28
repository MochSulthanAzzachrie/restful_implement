<?php

namespace App\Service;

use App\Models\Comment;
use App\Repositories\CommentRepository;

class CommentService
{
    public static function createComment(array $data)
    {
        $comment = Comment::createComment($data);

        return $comment;
    }

    public static function updateComment(array $data, $id)
    {
        $comment = Comment::updateComment($data, $id);

        return $comment;
    }

    public static function deleteComment($id)
    {
        $comment = Comment::deleteComment($id);

        return $comment;
    }
}
