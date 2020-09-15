<?php

namespace App\Services\ShowsProvider;

use App\Models\Show;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;

interface ShowsProvider
{
    /**
     * @throws RequestException
     */
    public static function search(string $title): Collection;

    /**
     * @throws RequestException
     */
    public static function show(string $code): Show;

    /**
     * @throws RequestException
     */
    public static function synchronize(Show $show): Show;
}
