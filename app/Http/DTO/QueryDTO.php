<?php
namespace App\Http\DTO;

use Illuminate\Support\Facades\Validator;
use QueryParam\Params\Limiter;
use QueryParam\QueryParam;

class QueryDTO extends BaseDTO
{
    protected string $id = '';
    protected array $fields = ['*'];
    protected array|null $errors = null;
    protected array $validationRules = [
        'sorter_field' => "nullable|array",
        "filter_field" => "nullable|array"
    ];

    protected array|string|null $sorter = null;
    protected array|string|null $filter = null;
    protected Limiter $limiter;

    public function __construct(QueryParam $queryParam)
    {
        $this->prepareValidation();
        $config = [
            "sorter" => $queryParam->sorters,
            "filter" => $queryParam->filters,
            "limit" => $queryParam->limit
        ];
        $validation = $this->queryConfigValidator($config);

        if ($validation['isValid']) {
            $this->sorter = $queryParam->sorters;
            $this->filter = $queryParam->filters;
            $this->limiter = $queryParam->limit;
        }
    }


    // Getter
    public function getFields(): array
    {
        return $this->fields;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLimiter(): Limiter
    {
        return $this->limiter;
    }
    public function getSorter(): mixed
    {
        return $this->sorter;
    }
    public function getFilter(): mixed
    {
        return $this->filter;
    }
    public function getErrors(): array
    {
        return $this->errors;
    }

    private function prepareValidation()
    {
        $allFields = [];
        foreach ($this->fields as $key => $value) {
            array_push($allFields, ...$value);
        }
        $fields = array_map(function ($field) {
            $split = explode(".", $field);
            return end($split);
        }, $allFields);
        $in = "|in:" . implode(",", $fields);
        $this->validationRules["sorter_field"] .= $in;
        $this->validationRules["filter_field"] .= $in;
    }



    // Other Logic
    protected function queryConfigValidator(array $config)
    {
        $configProperties = ['filter', 'sorter', 'limit'];

        foreach ($configProperties as $configProperty) {
            if (!array_key_exists($configProperty, $config)) {
                $this->isValid = false;
                $this->message = 'Failed to validate query configuration! Config is missing required property: ' . $configProperty;
                return [
                    'isValid' => $this->isValid,
                    'message' => $this->message,
                ];
            }
        }

        $validationData = [];

        if ($config['sorter'])
            $validationData['sorter_field'] = array_map(fn($item) => $item->field, $config['sorter']);
        if ($config['filter'])
            $validationData['filter_field'] = array_map(fn($item) => $item->field, $config['filter']);

        $validation = Validator::make($validationData, $this->validationRules);

        if($validation->fails()) {
            $this->isValid = false;
            $this->message = 'Failed to validate query configuration! The field is not sign';
            $this->errors = $validation->errors()->toArray();
            return [
                'isValid' => $this->isValid,
                'message' => $this->message,
                'config' => $config,
            ];
        }

        $this->isValid = true;
        $this->message = 'Successfully validate query configuration!';
        return [
            'isValid' => $this->isValid,
            'message' => $this->message,
            'config' => $config,
        ];
    }
}
?>
