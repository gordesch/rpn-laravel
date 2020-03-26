<?php

namespace App\Providers;

use App\Services\ShowsProvider\ShowsProvider;
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
        $this->app->bind('allocine', function() {
            return new Allocine;
        });
        $this->app->bind('shows-provider', function() {
            return $this->app->make(config('app.shows_db.driver'));
        });
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
