<?php

namespace Kurt\Google\Traits\Handlers;

trait SegmentHandler {

	public function getSegment($segment)
	{
		return $this->segment;
	}

	public function setSegment($segment)
	{
		$this->segment = $segment;
	}

	public function unsetSegment()
	{
		$this->segment = null;
	}
	
}