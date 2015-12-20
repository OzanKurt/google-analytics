<?php

namespace Kurt\Google\Traits\Handlers;

trait ParamsHandler
{
    private $params = [
        'metrics',
        'dimensions',
        'sort',
        'filters',
        'segment',
    ];

    /**
     * Get all the parameters that will be reflected to current query.
     * 
     * @return array
     */
    public function getParams()
    {
        return [
            'metrics'    => $this->metrics,
            'dimensions' => $this->dimensions,
            'sort'       => $this->sort,
            'filters'    => $this->filters,
            'segment'    => $this->segment,
        ];
    }

    /**
     * Set by overwriting existing parameters.
     * 
     * @return array
     */
    public function setParams(array $params)
    {
        foreach ($this->params as $param) {
            if (!array_key_exists($param, $params)) {
                $methodName = 'unset'.ucfirst($param);

                if (method_exists($this, $methodName)) {
                    call_user_func(
                        [$this, $methodName]
                    );
                    continue;
                }
            }

            if (property_exists($this, $param)) {
                $methodName = 'set'.ucfirst($param);

                if (method_exists($this, $methodName)) {
                    call_user_func(
                        [$this, $methodName],
                        $params[$param]
                    );
                }
            }
        }

        return $this;
    }

    public function mergeParams(array $params)
    {
        foreach ($params as $key => $value) {
            if (property_exists($this, $key)) {
                $methodName = 'merge'.ucfirst($key);

                if (method_exists($this, $methodName)) {
                    call_user_func(
                        [$this, $methodName],
                        $value
                    );
                }
            }

            throw new \Exception("Property [$key] does not exits.", 1);
        }

        return $this;
    }
}
