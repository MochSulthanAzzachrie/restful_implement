<?php

namespace App\Http\DTO\Comment;

use App\Http\DTO\QueryDTO;

class CommentQueryDTO extends QueryDTO
{
    protected array $fields = [
        'comment' => array(
            'comments.id',
            'comments.post_id',
            'comments.user_id',
            'comments.comments_content'
        ),
        'post' => array(
            'posts.id',
            'posts.title',
            'posts.novel_content',
            'posts.user_id'
        ),
        'user' => array(
            'users.id',
            'users.email',
            'users.username',
            'users.password',
            'users.firstname',
            'users.lastname',
        ),
    ];
}
