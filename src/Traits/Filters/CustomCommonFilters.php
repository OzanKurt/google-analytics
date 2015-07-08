<?php

namespace Kurt\Google\Traits\Filters;

trait CustomCommonFilters {

	/**
	 * Visit by date
	 * @param  array  $parameters Parameters you may want to overwrite.
	 * @return array
	 */	
	public function getVisitsByDate($parameters = []) 
	{
		$this->setParams([
			'metrics' => 'ga:visits',
			'dimensions' => 'ga:date',
		]);

		return $this->execute($parameters);
	}

	public function getAudienceStatistics($parameters = []) 
	{
		$this->setMetrics([
			'ga:visitors',
			'ga:newVisits',
			'ga:percentNewVisits',
			'ga:visits',
			'ga:bounces',
			'ga:pageviews',
			'ga:visitBounceRate',
			'ga:timeOnSite',
			'ga:avgTimeOnSite',
		]);

		return $this->execute($parameters);
	}

	public function getVisitsByCountries($parameters = []) 
	{
		$this->setParams([
			'metrics' => 'ga:visits',
			'dimensions' => 'ga:country',
			'sort' => '-ga:visits',
		]);

		return $this->execute($parameters);
	}
	
	public function getVisitsByCities($parameters = []) 
	{
		$this->setParams([
			'metrics' => 'ga:visits',
			'dimensions' => 'ga:city',
			'sort' => '-ga:visits',
		]);
		
		return $this->execute($parameters);
	}

	public function getVisitsByLanguages($parameters = []) 
	{
		$this->setParams([
			'metrics' => 'ga:visits',
			'dimensions' => 'ga:language',
			'sort' => '-ga:visits',
		]);
		
		return $this->execute($parameters);
	}

	public function getVisitsBySystemBrowsers($parameters = []) 
	{
		$this->setParams([
			'metrics' => 'ga:visits',
			'dimensions' => 'ga:browser',
			'sort' => '-ga:visits',
		]);
		
		return $this->execute($parameters);
	}

	public function getVisitsBySystemOs($parameters = []) 
	{
		$this->setParams([
			'metrics' => 'ga:visits',
			'dimensions' => 'ga:operatingSystem',
			'sort' => '-ga:visits',
		]);

		return $this->execute($parameters);
	}

	public function getVisitsBySystemResolutions($parameters = []) 
	{
		$this->setParams([
			'metrics' => 'ga:visits',
			'dimensions' => 'ga:screenResolution',
			'sort' => '-ga:visits',
		]);
		
		return $this->execute($parameters);
	}

	public function getPageviewsByDate($parameters = []) 
	{
		$this->setParams([
			'metrics' => 'ga:pageviews',
			'dimensions' => 'ga:date',
		]);
		
		return $this->execute($parameters);
	}

	public function getContentStatistics($parameters = []) 
	{
		$this->setMetrics([
			'ga:pageviews',
			'ga:uniquePageviews',
		]);
		
		return $this->execute($parameters);
	}

}