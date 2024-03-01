<?php

namespace App\Http\DTO\Comment;

use App\Http\DTO\BaseDTO;

class CreateCommentDTO extends BaseDTO
{
    protected $validationRules = [
        'post_id' => 'required|exists:posts,id',
        'comments_content' => 'required',
    ];
}
