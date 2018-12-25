<?php

namespace Kurt\Google\Analytics\Traits\Handlers;

use Carbon\Carbon;
use Kurt\Google\Analytics\Period;

trait DatesHandler
{
    /**
     * Get the current time period.
     *
     * @return Period $period
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set a time period.
     *
     * @param Period $period
     */
    public function setPeriod(Period $period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Set a start date.
     *
     * @param string $startDate
     */
    public function setStartDate(Carbon $startDate)
    {
        $this->period->setStartDate($startDate);

        return $this;
    }

    /**
     * Set an end date.
     *
     * @param string $startDate
     */
    public function setEndDate(Carbon $endDate)
    {
        $this->period->setEndDate($endDate);

        return $this;
    }

    /**
     * Get the start date.
     *
     * @return Carbon $startDate
     */
    public function getStartDate()
    {
        return $this->period->getStartDate;
    }

    /**
     * Get the end date.
     *
     * @return Carbon $startDate
     */
    public function getEndDate()
    {
        return $this->period->getEndDate;
    }
}
