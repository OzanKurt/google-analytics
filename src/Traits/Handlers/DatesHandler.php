<?php

namespace Kurt\Google\Traits\Handlers;

use Carbon\Carbon;

trait DatesHandler {
	
	/**
	 * Set a start date.
	 * 
	 * @param string $startDate
	 */
	public function setStartDate($startDate)
	{
		$this->startDate = $this->convertToStringIfCarbonObject($startDate);

		return $this;
	}

	/**
	 * Set an end date.
	 * 
	 * @param string $startDate
	 */
	public function setEndDate($endDate)
	{
		$this->endDate = $this->convertToStringIfCarbonObject($endDate);

		return $this;
	}

	/**
	 * Get the start date.
	 * 
	 * @param Carbon\Carbon $startDate
	 */
	public function getStartDate()
	{
		return Carbon::createFromFormat('Y-m-d', $this->startDate);
	}

	/**
	 * Get the end date.
	 * 
	 * @param Carbon\Carbon $startDate
	 */
	public function getEndDate()
	{
		return Carbon::createFromFormat('Y-m-d', $this->endDate);
	}

	/**
	 * Converts the Carbon\Carbon objects to datetime string with `Y-m-d` format. 
	 * 
	 * @param string $value
	 */
	private function convertToStringIfCarbonObject($value)
	{
		if ( $value instanceof Carbon ) {
			$value = $value->format('Y-m-d');
		}

		return $value;
	}
	
}