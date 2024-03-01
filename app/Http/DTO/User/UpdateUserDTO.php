<?php

namespace App\Http\DTO\User;

use App\Http\DTO\BaseDTO;

class  UpdateUserDTO extends BaseDTO
{
    protected $validationRules = [
        'email' => 'nullable|email',
        'username' => 'nullable|max:225',
        'password' => 'nullable',
        'firstname' => 'nullable',
        'lastname' => 'nullable',
    ];
}
