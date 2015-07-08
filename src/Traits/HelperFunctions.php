<?php

namespace Kurt\Google\Traits;

trait HelperFunctions {

	private function convertToArrayIfString($value)
	{
		if (is_string($value)) {
			$value = explode(',', $value);
		}

		return $value;
	}

	private function getOptions()
	{
		$options = [
			'output' => 'dataTable',
		];

		if ($this->dimentionsAreSet()) {
			$options['dimensions'] = implode(',', $this->dimensions);
		}

		if ($this->filtersAreSet()) {
			$options['filters'] = $this->filters;
		}

		if ($this->sortIsSet()) {
			$options['sort'] = $this->sort;
		}

		return $options;
	}
	
}