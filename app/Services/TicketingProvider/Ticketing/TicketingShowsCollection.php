<?php

namespace App\Services\TicketingProvider\Ticketing;

use App\Show;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TicketingShowsCollection extends Collection
{
    public function __construct(Collection $collection)
    {
        $collection->transform(function ($show) {
            return new TicketingShow($show);
        });
        $this->items = $this->getArrayableItems($collection);
    }

    public function filterByMatchingIsRequired(): self
    {
        return $this->filter->matched;
    }

    public function match(): self
    {
        return $this->filterByMatchingIsRequired()->matchAll();
    }

    public function matchAll(): self
    {
        return $this->map(function ($show) {
            $show->ticketing_provider_id = $show->id;
            $matching_show = Show::select([
                'id',
                'slug',
                'ticketing_provider_id',
            ])->where(
                'ticketing_provider_id',
                $show->ticketing_provider_id
            )->first();
            $show->id = optional($matching_show)->id;
            $show->slug
                = optional($matching_show)->slug ?? Str::slug($this->title);
            $show->matched = (bool) $matching_show;

            return $show;
        });
    }

    public function matchAgainst(Collection $matches): self
    {
        return $this->map(function ($show) use ($matches) {
            $match = $matches->firstWhere('slug', $show->slug);
            $matching_show = Show::firstWhere('slug', $match['slug']);
            $show->id = $matching_show->id;
            $matching_show->update(
                ['ticketing_provider_id' => $match['ticketing_provider_id']]
            );
            return $show;
        });
    }
}
