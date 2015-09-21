<?php

namespace Kurt\Google\Traits;

trait HelperFunctions {
	
	protected $options = [];

	private function convertToArrayIfString($value)
	{
		if (is_string($value)) {
			$value = explode(',', $value);
		}

		return $value;
	}

	private function getOptions()
	{

		if (! $this->isRealTimeRequest()) {
			$this->options['output'] = 'dataTable';
		}

		if ($this->dimentionsAreSet()) {
			$this->options['dimensions'] = implode(',', $this->dimensions);
		}

		if ($this->filtersAreSet()) {
			$this->options['filters'] = $this->filters;
		}

		if ($this->sortIsSet()) {
			$this->options['sort'] = $this->sort;
		}

		return $this->options;
	}
	
	public function setOptions(array $options){

		$this->options = array_merge($this->options,$options);
	}

	private function isRealTimeRequest()
	{
		return $this->getMetrics() == ['rt:activeUsers'];
	}
	
}
