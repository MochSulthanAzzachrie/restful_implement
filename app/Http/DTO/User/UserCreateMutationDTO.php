<?php

namespace App\Http\DTO\User;

use App\Http\DTO\MutationDTO;

class UserCreateMutationDTO extends MutationDTO
{
    protected array $validatorRules = [
        'email' => 'required|email|unique:users',
        'username' => 'required|string|max:225',
        'image' => 'required|string|ends_with:jpg,jpeg,png',
        'password' => 'required|string|min:3',
        'firstname' => 'nullable|string',
        'lastname' => 'nullable|string',
    ];
}
