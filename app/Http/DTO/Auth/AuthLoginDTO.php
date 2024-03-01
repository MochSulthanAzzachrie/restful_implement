<?php

namespace App\Http\DTO\Auth;

use App\Http\DTO\BaseDTO;

class AuthLoginDTO extends BaseDTO
{
    protected $validationRules = [
        'email' => 'required|email',
        'password' => 'required',
    ];
}
