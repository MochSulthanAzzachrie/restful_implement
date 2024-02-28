<?php

namespace App\Service;

use App\Models\Comment;
use App\Repositories\CommentRepository;

class CommentService
{
    public static function createComment(array $data)
    {
        $result = Comment::createComment($data);

        return $result;
    }

    public static function updateComment(array $data, $id)
    {
        $result = Comment::updateComment($data, $id);

        return $result;
    }

    public static function deleteComment($id)
    {
        $result = Comment::deleteComment($id);

        return $result;
    }
}
