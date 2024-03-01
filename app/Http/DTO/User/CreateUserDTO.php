<?php

namespace App\Http\DTO\User;

use App\Http\DTO\BaseDTO;

class CreateUserDTO extends BaseDTO
{
    protected $validationRules = [
        'email' => 'required|email|unique:users',
        'username' => 'required|max:225',
        'password' => 'required',
        'firstname' => 'nullable',
        'lastname' => 'nullable',
    ];
}
