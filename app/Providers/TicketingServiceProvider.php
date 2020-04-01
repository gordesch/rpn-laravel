<?php

namespace App\Providers;

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
        $this->app->bind('ems', function () {
            return new EMS();
        });
        $this->app->bind('ticketing-provider', function () {
            return $this->app->make(config('app.ticketing_provider.driver'));
        });
    }
}
