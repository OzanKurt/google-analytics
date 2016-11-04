<?php

namespace Kurt\Google\Analytics\Traits\Handlers;

trait MetricsHandler
{
    /**
     * Get the metrics of current query.
     * 
     * @return array
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

    /**
     * Get the metrics of current query as string.
     * 
     * @return string
     */
    private function getMetricsAsString()
    {
        return implode(',', $this->metrics);
    }

    /**
     * Set the metrics of current query while converting `string` values to array.
     */
    public function setMetrics($metrics)
    {
        $this->metrics = $this->convertToArrayIfString($metrics);

        return $this;
    }

    /**
     * Convert `$newMetrics` to array if string given and pass the array to a helper function.
     * 
     * @param string|array $newMetrics
     */
    public function mergeMetrics($newMetrics)
    {
        $newMetrics = $this->convertToArrayIfString($newMetrics);

        $this->metrics = $this->mergeNewMetricsToCurrentOnes($newMetrics);
    }

    /**
     * Merge `$newMetrics` with current ones.
     * 
     * @param array $newMetrics
     *
     * @return array
     */
    private function mergeNewMetricsToCurrentOnes($newMetrics)
    {
        return array_unique(array_merge($this->getMetrics(), $newMetrics));
    }

    /**
     * Determine if metrics are set.
     * 
     * @throws \Exception
     */
    private function metricsAreSet()
    {
        return !empty($this->metrics);
    }
}
