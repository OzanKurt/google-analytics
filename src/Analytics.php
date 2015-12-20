<?php

namespace Kurt\Google;

use Kurt\Google\Traits\Filters\CustomCommonFilters;
use Kurt\Google\Traits\Filters\GoogleCommonFilters;
use Kurt\Google\Traits\Handlers\DatesHandler;
use Kurt\Google\Traits\Handlers\DimensionsHandler;
use Kurt\Google\Traits\Handlers\FiltersHandler;
use Kurt\Google\Traits\Handlers\MetricsHandler;
use Kurt\Google\Traits\Handlers\ParamsHandler;
use Kurt\Google\Traits\Handlers\SegmentHandler;
use Kurt\Google\Traits\Handlers\SortHandler;
use Kurt\Google\Traits\HelperFunctions;

class Analytics
{
    use HelperFunctions;
    use CustomCommonFilters, GoogleCommonFilters;
    use DatesHandler, DimensionsHandler, FiltersHandler, MetricsHandler, ParamsHandler, SegmentHandler, SortHandler;

    protected $googleServicesCore;

    protected $analyticsViewId;

    protected $metrics = [];
    protected $dimensions = [];
    protected $sort;
    protected $filters;
    protected $segment;

    protected $startDate;
    protected $endDate;

    protected $data;

    protected $service;

    public function __construct(Core $googleServicesCore)
    {
        $this->googleServicesCore = $googleServicesCore;

        $this->setupConfiguration();

        $this->setupAnalyticsService();

        $this->setupDates();
    }

    private function setupConfiguration()
    {
        $this->analyticsViewId = $this->googleServicesCore->getSettings('analyticsViewId');
    }

    private function setupAnalyticsService()
    {
        // Create Google Service Analytics object with our preconfigured Google_Client
        $this->service = new \Google_Service_Analytics(
            $this->googleServicesCore->getClient()
        );
    }

    public function setupDates($startDate = null, $endDate = null)
    {
        $this->startDate = ($startDate) ? $startDate : date('Y-m-d', strtotime('-1 month'));

        $this->endDate = ($endDate) ? $endDate : date('Y-m-d');

        return $this;
    }

    /**
     * Execute the query and fetch the results to a collection.
     * 
     * @return Illuminate\Support\Collection
     */
    public function getRealtimeData()
    {
        $this->setMetrics('rt:activeUsers');

        $data = $this->service->data_realtime->get(
            $this->analyticsViewId,
            $this->getMetricsAsString(),
            $this->getOptions()
        );

        return $data->toSimpleObject()->totalsForAllResults;
    }

    /**
     * Execute the query by merging arrays to current ones.
     * 
     * @param array $parameters
     *
     * @return Illuminate\Support\Collection
     */
    public function execute($parameters = [])
    {
        $this->mergeParams($parameters);

        /*
         * A query can't run without any metrics.
         */
        if (!$this->metricsAreSet()) {
            throw new \Exception('No metrics specified.', 1);
        }

        $this->data = $this->service->data_ga->get(
            $this->analyticsViewId,
            $this->startDate,
            $this->endDate,
            $this->getMetricsAsString(),
            $this->getOptions()
        );

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function parseResults()
    {
        $simpleDataTable = $this->data->getDataTable()->toSimpleObject();

        foreach ($simpleDataTable->cols as $col) {
            $cols[] = $col['label'];
        }

        foreach ($simpleDataTable->rows as $row) {
            foreach ($row['c'] as $key => $value) {
                $rowData[$cols[$key]] = $value['v'];
            }

            $rows[] = $rowData;

            unset($rowData);
        }

        return [
            'cols' => $cols,
            'rows' => $rows,
        ];
    }
}
