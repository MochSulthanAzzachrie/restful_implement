<?php

namespace App\Http\DTO\Comment;

use App\Http\DTO\BaseDTO;

class UpdateCommentDTO extends BaseDTO
{
    protected $validationRules = [
        'comments_content' => 'nullable',
    ];
}
