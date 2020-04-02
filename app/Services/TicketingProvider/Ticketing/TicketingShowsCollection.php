<?php

namespace App\Services\TicketingProvider\Ticketing;

use App\Show;
use Illuminate\Support\Collection;

class TicketingShowsCollection extends Collection
{
    public function matchingRequired()
    {
        return $this->filter->matched;
    }

    public function matchWith(Collection $matches)
    {
        $this = $this->map(
            function (Show $show) use ($matches) {
                if (isset($show->id) && isset($show->ticketing_provider_id)) {
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
    }
}
