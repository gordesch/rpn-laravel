<?php

namespace App\Services\VideosProvider;

use App\Models\Show;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;

/**
 * Interface VideosProviderInterface
 *
 * @package App\Services\VideosProvider
 */
interface VideosProvider
{
    /**
     * @param  Show  $show
     *
     * @return Collection
     *
     * @throws RequestException
     */
    public static function search(Show $show): Collection;
}
