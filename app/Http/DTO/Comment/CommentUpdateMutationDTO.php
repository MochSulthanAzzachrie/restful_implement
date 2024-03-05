<?php

namespace App\Http\DTO\Comment;

use App\Http\DTO\MutationDTO;

class CommentUpdateMutationDTO extends MutationDTO
{
    protected array $validatorRules = [
        'comments_content' => 'required|string',
    ];
}
