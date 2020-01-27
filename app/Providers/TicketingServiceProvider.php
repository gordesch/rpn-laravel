<?php

namespace App\Providers;

use App\Services\TicketingProvider\TicketingProviderInterface;
use App\Services\TicketingProvider\EMS\EMS;
use Illuminate\Support\ServiceProvider;

class TicketingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TicketingProviderInterface::class,
            EMS::class
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
