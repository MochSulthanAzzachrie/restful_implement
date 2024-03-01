<?php

namespace App\Http\DTO;

use Illuminate\Support\Facades\Validator;

class BaseDTO
{
    protected $data = null;
    protected $errors = null;
    protected $isValid = false;
    protected $validationRules = [];

    public function __construct(array $data)
    {
        $validator = Validator::make($data, $this->validationRules);

        if($validator->fails()) {
            $this->errors = $validator->errors();
        } else {
            $this->data = $validator->validated();
            $this->isValid =true;
        }

    }

    public function getData()
    {
        return $this->data;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function isValid()
    {
        return $this->isValid;
    }

}
