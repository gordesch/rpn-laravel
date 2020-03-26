<?php

namespace App\Services\ShowsProvider;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use App\Show;

interface ShowsProviderInterface
{
    /**
     * @param  string  $title
     *
     * @return Collection
     *
     * @throws RequestException
     */
    public static function search(string $title): Collection;

    /**
     * @param  string  $code
     *
     * @return Show
     *
     * @throws RequestException
     */
    public static function show(string $code): Show;

    /**
     * @param  Show  $show
     *
     * @return Show
     *
     * @throws RequestException
     */
    public static function synchronize(Show $show): Show;
}
