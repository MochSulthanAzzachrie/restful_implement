<?php

namespace App\Http\DTO\Post;

use App\Http\DTO\BaseDTO;

class CreatePostDTO extends BaseDTO
{
    protected $validationRules = [
        'title' => 'required|max:225',
        'novel_content' => 'required',
    ];
}
