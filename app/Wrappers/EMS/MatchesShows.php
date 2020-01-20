<?php

namespace App\Wrappers\EMS;

use App\Programming;
use App\Show;
use App\Showing;
use App\Week;
use Carbon\Carbon;
use Gordesch\CineCarbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use SimpleXMLElement;


/**
 * Trait CastsToShow
 *
 * Casts a response from the API to an App\Show
 */
Trait MatchesShows
{
    /**
     * Matches ticketings provider shows to internal shows
     *
     * @param Collection $shows
     *
     * @return Collection
     */
    static function matchShows(Collection $shows): Collection
    {
        $shows = $shows->map(
            function ($show, $key) {
                if (isset($show->ticketing_provider_id) && isset($show->id)) {
                    return $show;
                }
                if (!isset($show->ticketing_provider_id)) {
                    $show->ticketing_provider_id = $show->id;
                    $matching_show = Show::where(
                        'ticketing_provider_id',
                        $show->ticketing_provider_id
                    )->first();
                    if ($matching_show) {
                        $show->id = $matching_show->id;
                        $show->slug = $matching_show->slug;
                    } else {
                        $show->id = null;
                        $show->slug = Str::slug($show->title);
                    }
                    return $show;
                }
                if (!isset($show->id)) {
                    $matches = collect(request('match'));
                    $match = $matches->where('slug')->first();
                    $slug = $match['slug'];
                    $ticketing_provider_id = $match['ticketing_provider_id'];
                    $show->id = Show::where('slug', $slug)->update(
                        ['ticketing_provider_id' => $ticketing_provider_id]
                    );
                    return $show;
                }
            }
        );
        return $shows;
    }
}
