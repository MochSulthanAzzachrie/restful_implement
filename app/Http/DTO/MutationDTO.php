<?php
namespace App\Http\DTO;

use Illuminate\Support\Facades\Validator;

class MutationDTO extends BaseDTO {
    protected array $validatorRules = [];
    protected array $input = [];
    protected array $errors = [];
    protected string $id = '';

    public function __construct(array $config) {
        $configValidator = $this->mutationConfigValidator($config);

        if ($configValidator['isValid'] == true) {
            $validatedConfig = $configValidator['config'];

            if (isset($validatedConfig['id']) && $validatedConfig['id'] !== '') {
                $this->id = $validatedConfig['id'];
            }

            if (!empty($validatedConfig['input'])) {
                $validation = $this->inputValidator($validatedConfig['input'], $this->validatorRules);

                if ($validation['isValid'] == true) {
                    $this->input = $validation['data'];
                } else {
                    $this->errors = $validation['errors'];
                }
            }
        }
    }

    // Setter

    // Getter
    public function getInput (): array {
        return $this->input;
    }

    public function getErrors (): array {
        return $this->errors;
    }

    public function getId (): string {
        return $this->id;
    }

    // Other Logic
    protected function mutationConfigValidator (array $config) {
        $configProperties = ['id', 'input'];

        foreach ($configProperties as $configProperty) {
            if (!array_key_exists($configProperty, $config)) {
                $this->isValid = false;
                $this->message = 'Failed to validate mutation configuration! Config is missing required property: ' . $configProperty;
                return [
                    'isValid' => $this->isValid,
                    'message' => $this->message,
                ];
            }
        }

        if ($config['id'] and !is_string($config["id"])) {
            $this->isValid = false;
            $this->message = 'Failed to validate mutation configuration! id must be a string data type or minimum is empty string';
            return [
                'isValid' => $this->isValid,
                'message' => $this->message,
            ];
        }

        if (!is_array($config['input']) && $config["input"]) {
            $this->isValid = false;
            $this->message = 'Failed to validate mutation configuration! Input must be a array data type or minimum is empty array';
            return [
                'isValid' => $this->isValid,
                'message' => $this->message,
            ];
        }

        $this->isValid = true;
        $this->message = 'Successfully validate mutation configuration!';
        return [
            'isValid' => $this->isValid,
            'message' => $this->message,
            'config' => $config,
        ];
    }

    protected function inputValidator (array $input, array $validator) {
        $validation = Validator::make($input, $validator);

        if ($validation->fails()) {
            $errors = array();

            foreach ($validation->errors()->toArray() as $key => $value) {
                $errors[$key] = $value;
            }

            $this->isValid = false;
            $this->message = 'Failed to validated data! Your data is not completed';
            return [
                'isValid' => $this->isValid,
                'message' => $this->message,
                'errors' => $errors
            ];
        } else {
            $data = $validation->validated();

            $this->isValid = true;
            $this->message = 'Successfully validated data!';
            return [
                'isValid' => $this->isValid,
                'message' => $this->message,
                'data' => $data
            ];
        }
    }
}
?>
