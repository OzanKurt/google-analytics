<?php

namespace Kurt\Google;

use Illuminate\Support\ServiceProvider;

class GoogleAnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerGoogleAnalytics();
    }

    /**
     * Register Google Commands.
     *
     * @return void
     */
    private function registerGoogleAnalytics()
    {
        $this->app->singleton(Analytics::class, function () {
            return new Analytics(Core::class);
        });
    }
}
