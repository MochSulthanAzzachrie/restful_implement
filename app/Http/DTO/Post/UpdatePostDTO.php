<?php

namespace App\Http\DTO\Post;

use App\Http\DTO\BaseDTO;

class UpdatePostDTO extends BaseDTO
{
    protected $validationRules = [
        'title' => 'nullable|max:225',
        'novel_content' => 'nullable',
    ];
}
