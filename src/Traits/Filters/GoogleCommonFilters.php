<?php

namespace Kurt\Google\Analytics\Traits\Filters;

/**
 * Core Reporting API - Common Queries.
 *
 * Here are several of the most common queries to the Core Reporting API.
 * Note that the definitions only include dimensions, metrics, filters, and sort parameters.
 */
trait GoogleCommonFilters
{
    /*
    |------------------------------------------------------ 
    | General Queries
    |------------------------------------------------------ 
    */

    /**
     * Users and Pageviews Over Time.
     *
     * This query returns the total users and pageviews for the specified time period.
     * Note that this query doesn't require any dimensions.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getUsersAndPageviewsOverTime($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics' => 'ga:sessions,ga:pageviews',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Mobile Traffic.
     *
     * This query returns some information about sessions which occurred from mobile devices.
     * Note that "Mobile Traffic" is defined using the default segment ID -14.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getMobileTraffic($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:sessions,ga:pageviews,ga:sessionDuration',
            'dimensions' => 'ga:mobileDeviceInfo,ga:source',
            'segment'    => 'gaid::-14',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Revenue Generating Campaigns.
     *
     * This query returns campaign and site usage data for campaigns
     * that led to more than one purchase through your site.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getRevenueGeneratingCampaigns($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:sessions,ga:pageviews,ga:sessionDuration,ga:bounces',
            'dimensions' => 'ga:source,ga:medium',
            'segment'    => 'dynamic::ga:transactions>1',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /*
    |------------------------------------------------------ 
    | Users
    |------------------------------------------------------ 
    */

    /**
     * New vs Returning Sessions.
     *
     * This query returns the number of new sessions vs returning sessions.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getNewVsReturningSessions($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:sessions',
            'dimensions' => 'ga:userType',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Sessions by Country.
     *
     * This query returns a breakdown of your sessions by country, sorted by number of sessions.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getSessionsByCountry($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:sessions',
            'dimensions' => 'ga:country',
            'sort'       => '-ga:sessions',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Browser and Operating System.
     *
     * This query returns a breakdown of sessions by the Operating System, web browser, and browser version used.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getBrowserAndOperatingSystem($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:sessions',
            'dimensions' => 'ga:operatingSystem,ga:operatingSystemVersion,ga:browser,ga:browserVersion',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Time on Site.
     *
     * This query returns the number of sessions and total time on site, which can be used to calculate average time on site.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getTimeOnSite($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:sessions',
            'dimensions' => 'ga:operatingSystem,ga:operatingSystemVersion,ga:browser,ga:browserVersion',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /*
    |------------------------------------------------------ 
    | Traffic Sources
    |------------------------------------------------------ 
    */

    /**
     * All Traffic Sources - Usage.
     *
     * This query returns the site usage data broken down by source and medium, sorted by sessions in descending order.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getAllTrafficSources_Usage($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:sessions,ga:pageviews,ga:sessionDuration,ga:exits',
            'dimensions' => 'ga:source,ga:medium',
            'sort'       => '-ga:sessions',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * All Traffic Sources - Goals.
     *
     * This query returns data for the first and all goals defined, sorted by total goal completions in descending order.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getAllTrafficSources_Goals($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:sessions,ga:goal1Starts,ga:goal1Completions,ga:goal1Value,ga:goalStartsAll,ga:goalCompletionsAll,ga:goalValueAll',
            'dimensions' => 'ga:source,ga:medium',
            'sort'       => '-ga:goalCompletionsAll',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * All Traffic Sources - E-Commerce.
     *
     * This query returns information on revenue generated through the site for the given time span, sorted by sessions in descending order.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getAllTrafficSources_ECommerce($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:sessions,ga:transactionRevenue,ga:transactions,ga:uniquePurchases',
            'dimensions' => 'ga:source,ga:medium',
            'sort'       => '-ga:sessions',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Referring Sites.
     *
     * This query returns a list of domains and how many sessions each referred to your site, sorted by pageviews in descending order.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getReferringSites($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:pageviews,ga:sessionDuration,ga:exits',
            'dimensions' => 'ga:source',
            'filters'    => 'ga:medium==referral',
            'sort'       => '-ga:pageviews',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Search Engines.
     *
     * This query returns site usage data for all traffic by search engine, sorted by pageviews in descending order.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getSearchEngines($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:pageviews,ga:sessionDuration,ga:exits',
            'dimensions' => 'ga:source',
            'filters'    => 'ga:medium==cpa,ga:medium==cpc,ga:medium==cpm,ga:medium==cpp,ga:medium==cpv,ga:medium==organic,ga:medium==ppc',
            'sort'       => '-ga:pageviews',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Search Engines - Organic Search.
     *
     * This query returns site usage data for organic traffic by search engine, sorted by pageviews in descending order.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getSearchEngines_OrganicSearch($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:pageviews,ga:sessionDuration,ga:exits',
            'dimensions' => 'ga:source',
            'filters'    => 'ga:medium==organic',
            'sort'       => '-ga:pageviews',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Search Engines - Paid Search.
     *
     * This query returns site usage data for paid traffic by search engine, sorted by pageviews in descending order.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getSearchEngines_PaidSearch($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:pageviews,ga:sessionDuration,ga:exits',
            'dimensions' => 'ga:source',
            'filters'    => 'ga:medium==cpa,ga:medium==cpc,ga:medium==cpm,ga:medium==cpp,ga:medium==cpv,ga:medium==ppc',
            'sort'       => '-ga:pageviews',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Keywords.
     *
     * This query returns site usage data for paid traffic by search engine, sorted by pageviews in descending order.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getKeywords($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:sessions',
            'dimensions' => 'ga:keyword',
            'sort'       => '-ga:sessions',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /*
    |------------------------------------------------------ 
    | Content
    |------------------------------------------------------ 
    */

    /**
     * Top Content.
     *
     * This query returns your most popular content, sorted by most pageviews.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getTopContent($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:pageviews,ga:uniquePageviews,ga:timeOnPage,ga:bounces,ga:entrances,ga:exits',
            'dimensions' => 'ga:pagePath',
            'sort'       => '-ga:pageviews',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Top Landing Pages.
     *
     * This query returns your most popular landing pages, sorted by entrances in descending order.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getTopLandingPages($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:entrances,ga:bounces',
            'dimensions' => 'ga:landingPagePath',
            'sort'       => '-ga:entrances',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Top Exit Pages.
     *
     * This query returns your most common exit pages, sorted by exits in descending order.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getTopExitPages($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:exits,ga:pageviews',
            'dimensions' => 'ga:exitPagePath',
            'sort'       => '-ga:exits',
        ]);

        return $this->execute($parameters, $parseResult);
    }

    /**
     * Site Search - Search Terms.
     *
     * This query returns the number of sessions broken down by internal site search, sorted by number of unique searches for a keyword in descending order.
     *
     * @param array $parameters Parameters you may want to overwrite.
     *
     * @return array
     */
    public function getSiteSearch_SearchTerms($parameters = [], $parseResult = true)
    {
        $this->setParams([
            'metrics'    => 'ga:searchUniques',
            'dimensions' => 'ga:searchKeyword',
            'sort'       => '-ga:searchUniques',
        ]);

        return $this->execute($parameters, $parseResult);
    }
}
