<?php

namespace Kurt\Google\Traits\Handlers;

trait DatesHandler
{
    /**
     * Set a start date.
     * 
     * @param string $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Set an end date.
     * 
     * @param string $startDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get the start date.
     * 
     * @return string $startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Get the end date.
     * 
     * @return string $startDate
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
}
