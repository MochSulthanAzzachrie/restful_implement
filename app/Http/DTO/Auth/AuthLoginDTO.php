<?php

namespace App\Http\DTO\Auth;

use App\Http\DTO\MutationDTO;

class AuthLoginDTO extends MutationDTO
{
    protected array $validatorRules = [
        'email' => 'required|email',
        'password' => 'required|string|min:3',
    ];
}
