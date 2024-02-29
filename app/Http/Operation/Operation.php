<?php
namespace App\Http\Operation;

class Operation {
    protected mixed $result = null;
    protected ?array $errors = null;
    protected bool $isSuccess = false;
    protected string $message = '';

    // Setter
    public function setResult (mixed $result): self {
        $this->result = $result;
        return $this;
    }

    public function setErrors (array $errors): self {
        $this->errors = $errors;
        return $this;
    }

    public function setIsSuccess (bool $success): self {
        $this->isSuccess = $success;
        return $this;
    }

    public function setMessage (string $message): self {
        $this->message = $message;
        return $this;
    }

    // Getter
    public function getResult (): mixed {
        return $this->result;
    }

    public function getErrors (): mixed {
        return $this->errors;
    }

    public function isSuccess (): bool {
        return $this->isSuccess;
    }

    public function getMessage (): string {
        return $this->message;
    }

    // Other Logic
    public function formatDataGroup (array $data) { // formatDataGroup
        $filteredData = array();

        foreach ($data as $key => $value) {
            $keyParts = explode('_', $key);
            $group = $keyParts[0];

            if (count($keyParts) > 1) {
                $filteredData[$group][$key] = $value;
            } else {
                $filteredData[$group] = $value;
            }
        }

        return $filteredData;
    }
}
?>
