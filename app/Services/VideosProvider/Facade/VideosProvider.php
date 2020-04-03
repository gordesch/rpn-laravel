<?php

namespace App\Services\VideosProvider\Facade;

use App\Show;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection search(Show $show)
 */
class VideosProvider extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'videos-provider';
    }
}
