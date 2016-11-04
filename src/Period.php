<?php

namespace Kurt\Google\Analytics;

use Carbon\Carbon;
use Kurt\Google\Analytics\Exceptions\InvalidPeriod;

class Period
{
    /**
     * Starting date of the period.
     * 
     * @var \Carbon\Carbon
     */
    public $startDate;

    /** 
     * Starting date of the period.
     * 
     * @var \Carbon\Carbon
     */
    public $endDate;

    public function __construct(Carbon $startDate, Carbon $endDate)
    {
        $this->validatePeriod($startDate, $endDate);

        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Gets the Starting date of the period.
     *
     * @return \Carbon\Carbon
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Sets the Starting date of the period.
     *
     * @param \Carbon\Carbon $startDate
     *
     * @return self
     */
    public function setStartDate(Carbon $startDate)
    {
        $this->validatePeriod($startDate, null);

        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Gets the Starting date of the period.
     *
     * @return \Carbon\Carbon
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Sets the Starting date of the period.
     *
     * @param \Carbon\Carbon $endDate
     *
     * @return self
     */
    public function setEndDate(Carbon $endDate)
    {
        $this->validatePeriod(null, $endDate);

        $this->endDate = $endDate;

        return $this;
    }

    public function validatePeriod(Carbon $startDate = null, Carbon $endDate = null)
    {
        if (is_null($startDate)) {
            $startDate = $this->startDate;
        }

        if (is_null($endDate)) {
            $endDate = $this->endDate;
        }

        if ($startDate->gt($endDate)) {
            throw new InvalidPeriodException($startDate, $endDate);
        }
    }
}