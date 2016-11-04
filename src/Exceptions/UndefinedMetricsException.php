<?php

namespace Kurt\Google\Exceptions;

class UndefinedMetricsException extends \Exception
{
    public $message = 'No metrics specified.';
}
