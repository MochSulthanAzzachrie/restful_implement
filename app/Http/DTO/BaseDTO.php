<?php
namespace App\Http\DTO;

use Illuminate\Support\Facades\Validator;

class BaseDTO {
    protected bool $isValid = false;
    protected string $message = '';


    // Getter
    public function isValid () {
        return $this->isValid;
    }

    public function getMessage () {
        return $this->message;
    }
}
?>
