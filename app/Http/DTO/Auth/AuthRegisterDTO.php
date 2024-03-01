<?php

namespace App\Http\DTO\Auth;

use App\Http\DTO\BaseDTO;

class AuthRegisterDTO extends BaseDTO
{
    protected $validationRules = [
        'email' => 'required|email|unique:users',
        'username' => 'required|max:225',
        'password' => 'required',
        'firstname' => 'nullable',
        'lastname' => 'nullable',
    ];
}
