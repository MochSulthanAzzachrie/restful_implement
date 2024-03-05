<?php

namespace App\Http\DTO\User;

use App\Http\DTO\QueryDTO;

class UserQueryDTO extends QueryDTO
{
    protected array $fields = [
        'users' => array(
            'users.id',
            'users.email',
            'users.username',
            'users.password',
            'users.firstname',
            'users.lastname',
        ),
    ];
}
