<?php


namespace App\Services\VideosProvider;

use App\Show;
use Illuminate\Support\Collection;

interface VideosProviderInterface
{
    public static function search(Show $show): Collection;
}
