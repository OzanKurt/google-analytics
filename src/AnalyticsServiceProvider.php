<?php

namespace Kurt\Google;

use Illuminate\Support\ServiceProvider;

class AnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAnalytics();
    }

    /**
     * Register Google Commands.
     *
     * @return void
     */
    private function registerAnalytics()
    {
        $this->app->singleton(Analytics::class, function () {
            return new Analytics(Core::class);
        });
    }
}
