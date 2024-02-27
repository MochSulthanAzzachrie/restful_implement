<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public static function createComment(array $data)
    {

        $data['user_id'] = auth()->user()->id;

        $comment = Comment::create($data);

        return $comment;
    }

    public static function updateComment(array $data, $id)
    {

        $comment = Comment::find($id);
        $comment->update(['comments_content' => $data['comments_content']]);

        return $comment;
    }

    public static function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return $comment;
    }
}
