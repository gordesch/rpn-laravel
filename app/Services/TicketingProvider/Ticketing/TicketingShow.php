<?php

namespace App\Services\TicketingProvider\Ticketing;

use App\Show;

class TicketingShow extends Show
{
    public bool $matched = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->ticketing_provider_id = $this->id;
        $this->id = null;
    }


    public function newCollection(array $models = [])
    {
        return new TicketingShowsCollection($models);
    }
}
