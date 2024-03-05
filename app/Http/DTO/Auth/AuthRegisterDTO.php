<?php

namespace App\Http\DTO\Auth;

use App\Http\DTO\MutationDTO;

class AuthRegisterDTO extends MutationDTO
{
    protected array $validatorRules = [
        'email' => 'required|email|unique:users',
        'username' => 'required|string|max:225',
        'password' => 'required|string|min:3',
        'firstname' => 'nullable|string',
        'lastname' => 'nullable|string',
    ];
}
