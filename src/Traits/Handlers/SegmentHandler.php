<?php

namespace Kurt\Google\Analytics\Traits\Handlers;

trait SegmentHandler
{
    public function getSegment($segment)
    {
        return $this->segment;
    }

    public function setSegment($segment)
    {
        $this->segment = $segment;

        return $this;
    }

    public function unsetSegment()
    {
        $this->segment = null;

        return $this;
    }
}
