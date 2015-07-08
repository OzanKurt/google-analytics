<?php

namespace Kurt\Google\Traits\Handlers;

trait DimensionsHandler {

	/**
	 * Get the metrics of current query.
	 * 
	 * @return array
	 */
	public function getDimensions()
	{
		return $this->dimensions;
	}
	
	/**
	 * Get the dimensions of current query as string.
	 * 
	 * @return string
	 */
	private function getDimensionsAsString()
	{
		return implode(',', $this->dimensions);
	}

	/**
	 * Set the dimensions of current query while converting `string` values to array.
	 */
	public function setDimensions($dimensions)
	{
		$this->dimensions = $this->convertToArrayIfString($dimensions);
	}

	/**
	 * Unset the dimensions of current query.
	 */
	public function unsetDimensions()
	{
		$this->dimensions = [];
	}
	
	/**
	 * Convert `$newMetrics` to array if string given and pass the array to a helper function.
	 * 
	 * @param  string|array $newMetrics
	 */
	public function mergeDimensions($newDimensions)
	{
		$newDimensions = $this->convertToArrayIfString($newDimensions);

		$this->dimensions = $this->mergeNewDimensionsToCurrentOnes($newDimensions);
	}
	
	/**
	 * Merge `$newMetrics` with current ones.
	 * 
	 * @param  array $newMetrics
	 * @return array
	 */
	private function mergeNewDimensionsToCurrentOnes($newDimensions)
	{
		return array_unique( array_merge($this->getDimensions(), $newDimensions) );
	}

	/**
	 * Determine if dimensions are set.
	 * 
	 * @return boolean
	 */
	private function dimentionsAreSet()
	{
		return ! empty($this->dimensions);
	}
	
}