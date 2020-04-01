<?php

namespace App\Providers;

use App\Services\VideosProvider\VideosProvider;
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
        $this->app->bind('youtube', function () {
            return new Youtube();
        });
        $this->app->bind('videos-provider', function () {
            return $this->app->make(config('app.videos_provider.driver'));
        });
    }
}
