<?php

namespace App\Providers;

use App\Services\VideosProvider\VideosProviderInterface;
use App\Services\VideosProvider\Youtube\Youtube;
use Illuminate\Support\ServiceProvider;

class VideosServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            VideosProviderInterface::class,
            Youtube::class
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
