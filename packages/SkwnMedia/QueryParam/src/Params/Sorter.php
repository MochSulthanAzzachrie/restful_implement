<?php 
namespace QueryParam\Params;
use QueryParam\Contracts\Formater;

class Sorter implements Formater {
    public string|null $field = null;
    public string|null $directive = null;

    public function __construct(array $configs)
    {
        $this->formater($configs);
    }

    public function formater (string|array $configs) {
        foreach ($configs as $config) {
            if (str_ends_with($config, ':desc')) {
                $this->field = substr($config, 0, -5);
                $this->directive = 'desc';
            } else {
                $this->field = $config;
                $this->directive = 'asc';
            }
        }
    }
}
?>