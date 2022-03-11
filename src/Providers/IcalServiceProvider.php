<?php

namespace MicroSpaceless\Ical\Providers;

use Illuminate\Support\ServiceProvider;

class IcalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('MicroSpaceless\Ical');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
