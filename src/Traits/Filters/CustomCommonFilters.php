<?php

namespace Kurt\Google\Analytics\Traits\Filters;

trait CustomCommonFilters
{
    /**
     * Visit by date.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getVisitsByDate($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:visits',
            'dimensions' => 'ga:date',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    public function getAudienceStatistics($parameters = [], $parseResult = true)
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

        return $this->execute($parameters, $parseResult);
    }

    public function getVisitsByCountries($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:visits',
            'dimensions' => 'ga:country',
            'sort'       => '-ga:visits',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    public function getVisitsByCities($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:visits',
            'dimensions' => 'ga:city',
            'sort'       => '-ga:visits',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    public function getVisitsByLanguages($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:visits',
            'dimensions' => 'ga:language',
            'sort'       => '-ga:visits',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    public function getVisitsBySystemBrowsers($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:visits',
            'dimensions' => 'ga:browser',
            'sort'       => '-ga:visits',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    public function getVisitsBySystemOs($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:visits',
            'dimensions' => 'ga:operatingSystem',
            'sort'       => '-ga:visits',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    public function getVisitsBySystemResolutions($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:visits',
            'dimensions' => 'ga:screenResolution',
            'sort'       => '-ga:visits',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    public function getPageviewsByDate($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:pageviews',
            'dimensions' => 'ga:date',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    public function getContentStatistics($parameters = [], $parseResult = true)
    {
        $this->setMetrics([
            'ga:pageviews',
            'ga:uniquePageviews',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    public function getVisitsPerPage($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:visits,ga:pageviews,ga:uniquePageviews,ga:bounceRate',
            'dimensions' => 'ga:pagePath',
        ]);

        return $this->execute($parameters, $parseResult);
    }
}
