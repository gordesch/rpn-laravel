<?php

namespace App\Services\TicketingProvider;

use App\Showing;
use Illuminate\Support\Collection;

interface TicketingProviderInterface
{
    public function setShowsWithShowings(Collection $shows): void;
    public function getShowsWithShowings(): Collection;
    public function getShowsToMatch(): Collection;
    public function getAllShowings(): Collection;
    public static function toShowing(
        $ems_showing,
        $show,
        &$weeks,
        &$programmings
    ): Showing;
}
