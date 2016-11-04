<?php

namespace Kurt\Google\Analytics\Exceptions;

use Carbon\Carbon;

class InvalidPeriod extends \Exception
{
    public static function startDateCannotBeAfterEndDate(Carbon $startDate, Carbon $endDate)
    {
        $startDateFormatted = $startDate->format('d-m-Y');
        $endDateFormatted = $endDate->format('d-m-Y');

        $message = "Start date `{$startDateFormatted}` cannot be after end date `{$endDateFormatted}`.";

        return new self($message);
    }
}
