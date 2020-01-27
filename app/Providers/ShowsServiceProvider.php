<?php

namespace App\Providers;

use App\Services\ShowsProvider\ShowsProviderInterface;
use App\Services\ShowsProvider\Allocine\Allocine;
use Illuminate\Support\ServiceProvider;

class ShowsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ShowsProviderInterface::class,
            Allocine::class
        );
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
