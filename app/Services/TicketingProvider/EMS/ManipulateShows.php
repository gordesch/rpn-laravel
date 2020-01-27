<?php

namespace App\Services\TicketingProvider\EMS;

use Illuminate\Support\Collection;

Trait ManipulateShows
{
    private function _handleShowings(): void
    {
        $this->shows->transform(
            function ($show) {
                $show->sessions = new Collection($show->sessions);
                return $show;
            }
        );
    }
}
