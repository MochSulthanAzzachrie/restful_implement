<?php

namespace App\Http\DTO\Comment;

use App\Http\DTO\MutationDTO;

class CommentCreateMutationDTO extends MutationDTO
{
    protected array $validatorRules = [
        'post_id' => 'required|exists:posts,id',
        'comments_content' => 'required|string',
    ];
}
