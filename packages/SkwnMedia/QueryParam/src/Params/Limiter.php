<?php 
namespace QueryParam\Params;
use QueryParam\Contracts\Formater;


class Limiter implements Formater {
    public int|null $limit = null;
    public int|null $offset = null;

    public function __construct(string|array $configs) {
        $this->formater($configs);
    }

    public function formater (string|array $configs) {
        if (is_string($configs)) {
            $arrayConfigs = explode(',', $configs);

            if (count($arrayConfigs) > 1) {
                $this->offset = $arrayConfigs[0];
                $this->limit = $arrayConfigs[1];
            } else {
                $this->offset = 0;
                $this->limit = $arrayConfigs[0];
            }
        } else if (is_array($configs)) {
            $this->limit = $configs[1];
            $this->offset = $configs[0];
        }
    }
}
?>