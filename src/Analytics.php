<?php

namespace Kurt\Google;

use Carbon\Carbon;

class Analytics {

	private $googleServicesCore;

	private $analyticsViewId; 

	private $metrics;
	private $dimensions;
	private $sort;
	private $filters;

	private $startDate;
	private $endDate;

	private $service;

	function __construct(Core $googleServicesCore) {

		$this->googleServicesCore = $googleServicesCore;

		$this->setPropertiesFromConfigFile();

		$this->setupAnalyticsService();

		$this->setupDates();

	}

	private function setPropertiesFromConfigFile()
	{
		$this->analyticsViewId = config('google.analytics.analyticsViewId');
	}

	private function setupAnalyticsService()
	{
		// Create Google Service Analytics object with our preconfigured Google_Client
		$this->service = new \Google_Service_Analytics(
			$this->googleServicesCore->getClient()
		);
	}

	private function setupDates()
	{
		if (is_null($this->startDate)) {
			$this->startDate = date('Y-m-d', strtotime('-1 month'));
		}

		if (is_null($this->endDate)) {
			$this->endDate = date('Y-m-d');
		}
	}

	private function checkIfTheMetricsAreSet()
	{
		if (is_null($this->metrics)) {
			throw new \Exception("No metrics specified.", 1);
		}
	}

	private function dimentionsAreSet()
	{
		return ! is_null($this->dimensions);
	}

	public function getData()
	{
		$this->checkIfTheMetricsAreSet();
		
		$data = $this->service->data_ga->get(
			$this->analyticsViewId, 
			$this->startDate, 
			$this->endDate, 
			$this->metrics, [
			    'dimensions'    => $this->dimensions,
			    'sort'          => $this->sort,
			    'filters' 		=> $this->filters,
			    // 'filters'       => 'ga:pagePath==/',
			]
		);

		$headers = $data->getColumnHeaders();

		foreach ($data->getRows() as $rowKey => $rowDatas) {

			foreach ($rowDatas as $dataKey => $rowData) {

				$result[$rowKey][$headers[$dataKey]->name] = $rowData;

			}

		}

		return $this->dimentionsAreSet() ? $result : $result[0];
	}

	// public function getRealtimeData()
	// {
	// 	$this->checkIfTheMetricsAreSet();

	// 	$data = $this->analytics->realtime_data->get(
	// 		$this->analyticsViewId, 
	// 		$this->metrics, [
	// 		    'dimensions'    => $this->dimensions,
	// 		    'sort'          => '-ga:pageviews',
	// 		    // 'filters'       => 'ga:pagePath==/',
	// 		]
	// 	);

	// 	return $data->getRows();
	// }

	public function setStartDate($startDate)
	{
		$this->startDate = $startDate;
	}

	public function setEndDate($endDate)
	{
		$this->endDate = $endDate;
	}

	public function getStartDate()
	{
		return Carbon::createFromFormat('Y-m-d', $this->startDate);
	}

	public function getEndDate()
	{
		return Carbon::createFromFormat('Y-m-d', $this->endDate);
	}

	public function getMetrics()
	{
		return is_null($this->metrics) ? [] : explode(',', $this->metrics);
	}

	public function setMetrics($metrics)
	{
		if (is_array($metrics)) {
			$metrics = implode(',', $metrics);
		}

		$this->metrics = $metrics;
	}

	public function mergeMetrics($newMetrics)
	{
		if (is_string($newMetrics)) {
			$newMetrics = explode(',', $newMetrics);
		}

		$currentMetrics = $this->getMetrics();

		$metrics = array_merge($currentMetrics, $newMetrics);

		$metrics = array_unique($metrics);

		$metrics = implode(',', $metrics);

		$this->metrics = $metrics;
	}

	public function getDimensions()
	{
		return is_null($this->dimensions) ? [] : explode(',', $this->dimensions);
	}

	public function setDimensions($dimensions)
	{
		if (is_array($dimensions)) {
			$dimensions = implode(',', $dimensions);
		}

		$this->dimensions = $dimensions;
	}

	public function mergeDimensions($newDimensions)
	{
		if (is_string($newDimensions)) {
			$newDimensions = explode(',', $newDimensions);
		}

		$currentDimensions = $this->getDimensions();

		$dimensions = array_merge($currentDimensions, $newDimensions);

		$dimensions = array_unique($dimensions);

		$dimensions = implode(',', $dimensions);

		$this->dimensions = $dimensions;
	}

	public function setSort($sort)
	{
		$this->sort = $sort;
	}

	public function getSort($sort)
	{
		return $this->sort;
	}

	public function setFilters($filters)
	{
		$this->filters = $filters;
	}

	public function getFilters($filters)
	{
		return $this->filters;
	}

	public function setParams(array $params)
	{
		foreach ($params as $key => $value) {
			if (property_exists($this, $key)) {

				$methodName = 'set'.ucfirst($key);

				if ( method_exists($this,  $methodName) ) {

					call_user_func(
						[$this, $methodName], 
						$value
					);

				}

			}
		}
	}

	public function mergeParams(array $params)
	{
		foreach ($params as $key => $value) {

			if (property_exists($this, $key)) {

				$methodName = 'set'.ucfirst($key);

				if ( method_exists($this,  $methodName) ) {

					call_user_func(
						[$this, $methodName], 
						$value
					);

				}

			}

			throw new \Exception("Property [$key] does not exits.", 1);
			
		}
	}

}