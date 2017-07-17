<?php

namespace Kurt\Google\Analytics\Exceptions;

class UndefinedMetricsException extends \Exception
{
    public $message = 'No metrics specified.';
}
