<?php

namespace Kurt\Google\Traits\Handlers;

trait SortHandler {
	

	public function getSort($sort)
	{
		return $this->sort;
	}

	public function setSort($sort)
	{
		$this->sort = $sort;
	}

	public function unsetSort()
	{
		$this->sort = null;
	}
	
	/**
	 * Determine if sort is set.
	 * 
	 * @return boolean
	 */
	private function sortIsSet()
	{
		return ! is_null($this->sort);
	}
	
}