<?php

namespace App\Http\DTO\Post;

use App\Http\DTO\MutationDTO;

class PostMutationDTO extends MutationDTO
{
    protected array $validatorRules = [
        'title' => 'required|string|max:225',
        'novel_content' => 'required|string',
    ];
}
