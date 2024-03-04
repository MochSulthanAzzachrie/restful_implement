<?php
namespace QueryParam\Params;
use QueryParam\Contracts\Formater;


class Filter implements Formater {
    public string|null $connector = null;
    public string|null $field = null;
    public string|null $condition = null;
    public array|null $values = null;

    public function __construct(string|array $configs) {
        $this->formater($configs);
    }

    public function formater (string|array $configs) {
        if (is_string($configs)) {
            $pattern = '/^(\w+)\s*([=<>]+)\s*(.+)/';

            if (preg_match($pattern, $configs, $matches)) {
                $this->connector = 'and';
                $this->field = $matches[1];
                $this->condition = $matches[2];
                $this->values = array($matches[3]);
            }
        } else if (is_array($configs)) {
            foreach ($configs as $config) {
                if (str_starts_with($config[0], 'or:')) {
                    $this->connector = 'or';
                    $this->field = substr($config[0], 3);
                } else {
                    $this->connector = 'and';
                    $this->field = $config[0];
                }
    
                $configLength = count($config);
                if ($configLength == 2) {
                    $this->condition = '=';
                    $this->values = array($config[1]);
                } elseif ($configLength == 3) {
                    $this->condition = $config[1];
                    $this->values = array($config[2]);
                } elseif ($configLength == 4) {
                    $this->condition = $config[1];
                    $this->values = array($config[2], $config[3]);
                }
            }
        }
    }
}
?>