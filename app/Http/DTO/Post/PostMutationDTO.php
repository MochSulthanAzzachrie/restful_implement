<?php

namespace App\Http\DTO\Post;

use App\Http\DTO\MutationDTO;

class PostMutationDTO extends MutationDTO
{
    protected array $validatorRules = [
        'title' => 'required|string|max:225',
        'image' => 'required|string|ends_with:jpg,jpeg,png',
        'novel_content' => 'required|string',
    ];
}
