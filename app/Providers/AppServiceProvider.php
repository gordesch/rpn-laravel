<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        setlocale(
            LC_ALL,
            'fr_FR.utf8',
            'fr.utf8',
            'fr_FR',
            'fr'
        );
        Collection::macro('hasNotEmpty', function ($search_key) {
            return $this->contains(function ($value, $key) use ($search_key) {
                return $key === $search_key && $value != null;
            });
        });
    }
}
