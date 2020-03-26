<?php

namespace App\Services\ShowsProvider\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static show(string $code): \App\Show
 * @method static synchronize(\App\Show $show): \App\Show
 */
class ShowsProvider extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'shows-provider';
    }
}
