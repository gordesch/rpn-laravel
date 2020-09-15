<?php

namespace App\Services\ShowsProvider\Facade;

use App\Models\Show;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection search(string $title)
 * @method static Show show(string $code)
 * @method static Show synchronize(Show $show)
 */
class ShowsProvider extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'shows-provider';
    }
}
