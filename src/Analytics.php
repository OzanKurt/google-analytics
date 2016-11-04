<?php

namespace Kurt\Google\Analytics;

use Carbon\Carbon;
use Kurt\Google\Core\Core;
use Kurt\Google\Analytics\Traits\HelperFunctions;
use Kurt\Google\Analytics\Traits\Handlers\SortHandler;
use Kurt\Google\Analytics\Traits\Handlers\DatesHandler;
use Kurt\Google\Analytics\Traits\Handlers\ParamsHandler;
use Kurt\Google\Analytics\Traits\Handlers\FiltersHandler;
use Kurt\Google\Analytics\Traits\Handlers\MetricsHandler;
use Kurt\Google\Analytics\Traits\Handlers\SegmentHandler;
use Kurt\Google\Analytics\Traits\Handlers\DimensionsHandler;
use Kurt\Google\Analytics\Traits\Filters\CustomCommonFilters;
use Kurt\Google\Analytics\Traits\Filters\GoogleCommonFilters;
use Kurt\Google\Analytics\Exceptions\UndefinedViewIdException;

class Analytics
{
    use HelperFunctions;
    use CustomCommonFilters, GoogleCommonFilters;
    use DatesHandler, DimensionsHandler, FiltersHandler, MetricsHandler, ParamsHandler, SegmentHandler, SortHandler;

    /**
     * Google services core.
     * 
     * @var \Kurt\Google\Core\Core
     */
    protected $googleServicesCore;

    /**
     * Google analytics view id.
     * 
     * @var string
     */
    protected $viewId;

    /**
     * Parameters
     */
    protected $metrics = [];
    protected $dimensions = [];
    protected $sort;
    protected $filters;
    protected $segment;

    /**
     * Time period.
     * 
     * @var \Kurt\Google\Analytics\Period
     */
    protected $period;

    /**
     * Google Analytics service instance.
     * 
     * @var \Google_Service_Analytics
     */
    protected $service;

    public function __construct(Core $googleServicesCore)
    {
        $this->googleServicesCore = $googleServicesCore;

        $this->configure();

        $this->setupAnalyticsService();

        $this->setupDates();
    }

    /**
     * Getter for viewId.
     *
     * @return string
     */
    public function getViewId()
    {
        return $this->viewId;
    }

    /**
     * Setter for `viewId`, allows manual update inside code.
     *
     * @param string $viewId
     */
    public function setViewId($viewId)
    {
        $this->viewId = $viewId;
    }

    /**
     * Set the configuration details of analytics.
     *
     * @return void
     */
    private function configure()
    {
        $analyticsConfig = $this->googleServicesCore->getConfig('analytics');
        
        if (array_key_exists('viewId', $analyticsConfig)) {
            $this->viewId = $analyticsConfig['viewId'];
        }
    }

    private function setupAnalyticsService()
    {
        // Create Google Service Analytics object with our preconfigured Google_Client
        $this->service = new \Google_Service_Analytics(
            $this->googleServicesCore->getClient()
        );
    }

    private function setupDates($startDate = null, $endDate = null)
    { 
        $start = (new Carbon('first day of last month'))->hour(0)->minute(0)->second(0);

        $end = (new Carbon('last day of last month'))->hour(23)->minute(59)->second(59);

        return $this->setPeriod(new Period($start, $end));
    }

    /**
     * Execute the query and fetch the results to a collection.
     *
     * @return array
     */
    public function getRealtimeData()
    {
        $this->validateViewId();

        $this->setMetrics('rt:activeUsers');

        $data = $this->service->data_realtime->get(
            $this->viewId,
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
     * @return $this
     */
    public function execute($parameters = [], $parseResult = true)
    {
        $this->validateViewId();

        $this->mergeParams($parameters);

        /*
         * A query can't run without any metrics.
         */
        if (!$this->metricsAreSet()) {
            throw new UndefinedMetricsException();
        }

        $result = $this->service->data_ga->get(
            $this->viewId,
            $this->period->getStartDate()->format('Y-m-d'),
            $this->period->getEndDate()->format('Y-m-d'),
            $this->getMetricsAsString(),
            $this->getOptions()
        );

        if ($parseResult) {
            return $this->parseResult($result);
        }

        return $result;
    }

    /**
     * Validate analytics view ID.
     *
     * @throws 
     * 
     * @return void
     */
    private function validateViewId()
    {
        if (!$this->viewId) {
            throw new UndefinedViewIdException();
        }
    }

    /**
     * Parse the dirty google data response.
     *
     * @var \Google_Service_Analytics_GaData results
     *
     * @return array
     */
    public function parseResult($results)
    {
        $simpleDataTable = $results->getDataTable()->toSimpleObject();

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
