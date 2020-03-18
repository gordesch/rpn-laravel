<?php

namespace App\Services\ShowsProvider;

use Illuminate\Support\Collection;
use App\Show;

interface ShowsProviderInterface
{
    public static function search(string $title): Collection;
    public static function show(string $code): Show;
    public static function synchronize(Show $show): Show;
}
