<?php

namespace Kurt\Google\Traits\Handlers;

trait SortHandler
{
    public function getSort($sort)
    {
        return $this->sort;
    }

    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    public function unsetSort()
    {
        $this->sort = null;

        return $this;
    }

    /**
     * Determine if sort is set.
     * 
     * @return bool
     */
    private function sortIsSet()
    {
        return !is_null($this->sort);
    }
}
