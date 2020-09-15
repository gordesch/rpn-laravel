<?php

namespace App\Services\TicketingProvider\Ticketing;

use App\Models\Show;

class TicketingShow extends Show
{
    public bool $matched = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (
            isset($attributes['id'])
            && ! isset($attributes['ticketing_provider_id'])
        ) {
            $attributes['ticketing_provider_id'] = $attributes['id'];
            $attributes['id'] = null;
            $this->forceFill($attributes);
        }
    }
}
