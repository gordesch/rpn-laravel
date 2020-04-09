<?php

namespace App\Services\TicketingProvider\EMS;

use App\Show;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Trait CastsToShow
 *
 * Casts a response from the API to an App\Show
 */
trait MatchesShows
{
    /**
     * Matches ticketings provider shows to internal shows
     *
     * @return void
     */
    private function _matchShows(): void
    {
        $matches = new Collection(request('match'));

        $this->shows = $this->shows->map(
            function ($show) use ($matches) {
                if (isset($show->ticketing_provider_id) && isset($show->id)) {
                    // Matching is already done
                    return $show;
                }
                if (! isset($show->ticketing_provider_id)) {
                    // Prepare for matching
                    $show->ticketing_provider_id = $show->id;
                    $matching_show = Show::select([
                        'id',
                        'slug',
                        'ticketing_provider_id',
                    ])->where(
                        'ticketing_provider_id',
                        $show->ticketing_provider_id
                    )->first();
                    $show->id
                        = ($matching_show
                        ? $matching_show->id
                        : null);
                    $show->slug
                        = ($matching_show
                        ? $matching_show->slug
                        : Str::slug($show->title));

                    return $show;
                }
                if (! isset($show->id)) {
                    // Matching
                    $match = $matches->where(
                        'slug',
                        $show->slug
                    )->first();
                    $matching_show = Show::where(
                        'slug',
                        $match['slug']
                    );
                    $show->id = $matching_show->first()->id;
                    $matching_show->update(
                        ['ticketing_provider_id' => $match['ticketing_provider_id']]
                    );
                    return $show;
                }
            }
        );
        $this->shows_to_match = $this->shows->where('id', null);
    }
}
