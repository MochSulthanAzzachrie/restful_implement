<?php
namespace QueryParam;
use QueryParam\Params\Filter;
use QueryParam\Params\Limiter;
use QueryParam\Params\Sorter;

class QueryParam {
    public array|null $filters = null;
    public array|null $sorters = null;
    public Limiter|null $limit = null;

    public function __construct (array $configs) {
        $this->initFilter($configs);
        $this->initSorter($configs);
        $this->initLimit($configs);
    }

    protected function initFilter (array $configs) {
        $filters = array();

        if (is_array($configs['filter'])) {
            foreach ($configs['filter'] as $filterConfig) {
                $filters[] = new Filter(array($filterConfig));
            }

            $this->filters = $filters;
        } else if (is_string($configs['filter'])) {
            $filters[] = new Filter($configs['filter']);

            $this->filters = $filters;
        }
    }

    public function eachFilter($fn = null ): self{
        foreach($this->filters as $index => $filter){
            call_user_func_array($fn, array($filter));
        }
        return $this;
    }
    
    protected function initSorter (array $configs) {
        $sorters = array();

        if (is_array($configs['sorter'])) {
            foreach ($configs['sorter'] as $key => $value) {
                if (is_numeric($key)) {
                    $sorters[] = new Sorter(array($value));
                } else {
                    $sorter = '';
                    if ($value === 'desc') {
                        $sorter = $key . ':' . $value;
                    } else {
                        $sorter = $key;
                    }
                    $sorters[] = new Sorter(array($sorter));
                }
            }
            $this->sorters = $sorters;
        } else if (is_string($configs['sorter'])) {
            $arraySorters = explode(',', $configs['sorter']);

            foreach ($arraySorters as $sorter) {
                $sorters[] = new Sorter(array($sorter));
            }
            $this->sorters = $sorters;
        }
    }

    public function eachSorter($fn = null ): self{
        return $this;
    }

    protected function initLimit (array $configs) {
        $limits = new Limiter($configs['limit']);
        $this->limit = $limits;
    }
}
?>