<?php

namespace App\Http\DTO\Post;

use App\Http\DTO\QueryDTO;

class PostQueryDTO extends QueryDTO
{
    protected array $fields = [
        'posts' => array(
            'posts.id',
            'posts.title',
            'posts.novel_content',
            'posts.user_id'
        ),
        'users' => array(
            'users.id',
            'users.email',
            'users.username',
            'users.password',
            'users.firstname',
            'users.lastname',
        ),
        'comments' => array(
            'comments.id',
            'comments.post_id',
            'comments.user_id',
            'comments.comments_content'
        ),
    ];
}
