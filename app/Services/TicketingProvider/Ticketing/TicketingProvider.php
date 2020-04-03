<?php

namespace App\Services\TicketingProvider\Ticketing;

use Illuminate\Support\Collection;

abstract class TicketingProvider
{
    protected array $config;

    abstract protected function call(): string;

    public function __construct()
    {
    }

    public static function fetchShows()
    {
        $response = (new static())->call();
        $shows = new Collection(json_decode($response)->sites[0]->events);
    }
}
