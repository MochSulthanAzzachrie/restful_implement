<?php

namespace App\Http\DTO\User;

use App\Http\DTO\MutationDTO;

class  UserUpdateMutationDTO extends MutationDTO
{
    protected array $validatorRules = [
        'email' => 'required|email',
        'username' => 'required|string|max:225',
        'password' => 'required|string|min:3',
        'firstname' => 'nullable|string',
        'lastname' => 'nullable|string',
    ];
}
