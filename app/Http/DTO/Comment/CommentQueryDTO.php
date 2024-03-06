<?php

namespace App\Http\DTO\Comment;

use App\Http\DTO\QueryDTO;

class CommentQueryDTO extends QueryDTO
{
    protected array $fields = [
        'comments' => array(
            'comments.id',
            'comments.post_id',
            'comments.user_id',
            'comments.comments_content'
        ),
        'posts' => array(
            'posts.id',
            'posts.title',
            'posts.image',
            'posts.novel_content',
            'posts.user_id'
        ),
        'users' => array(
            'users.id',
            'users.email',
            'users.username',
            'users.image',
            'users.password',
            'users.firstname',
            'users.lastname',
        ),
    ];
}
