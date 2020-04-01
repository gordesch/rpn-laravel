<?php

namespace App\Services\TicketingProvider;

use App\Show;
use App\Showing;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Collection;

interface TicketingProvider
{
    public function setShowsWithShowings(Collection $shows): void;
    public function getShowsWithShowings(): Collection;
    public function getShowsToMatch(): Collection;
    public function getAllShowings(): Collection;
    public static function toShowing(
        object $ems_showing,
        Show $show,
        Eloquent\Collection &$weeks,
        Eloquent\Collection &$programmings
    ): Showing;
}
