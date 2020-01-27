<?php

namespace App\Services\TicketingProvider\EMS;

use App\Programming;
use App\Showing;
use App\Week;
use Gordesch\CineCarbon;


/**
 * Trait CastsToShowing
 *
 * Casts a response from the API to an App\Showing
 */
Trait CastsToShowing
{
    /**
     * Returns a showing
     *
     * @param $ems_showing
     * @param $show
     * @param $weeks
     * @param $programmings
     *
     * @return Showing
     */
    static function toShowing(
        $ems_showing,
        $show,
        &$weeks,
        &$programmings
    ): Showing {
        $showing = new Showing;

        $showing->ticketing_provider_id = $ems_showing->id;

        $showing->show_id = $show->id;

        $showing->datetime = CineCarbon::parse($ems_showing->date);

        $showing->week_number
            = CineCarbon::parse($ems_showing->date)->programmingWeek();

        $week = $weeks->where('number', $showing->week_number)->first();
        if ($week) {
            $showing->week = $week;
        } else {
            $showing->week = Week::create(
                ['number' => $showing->week_number]
            );
            $weeks->push($showing->week);
        }

        $programming = $programmings
            ->where('show_id', $show->id)
            ->where('week_id', $showing->week->id)
            ->first();
        if ($programming) {
            $showing->programming = $programming;
        } else {
            $showing->programming = Programming::create(
                [
                    'show_id' => $show->id,
                    'week_id' => $showing->week->id,
                ]
            );
            $programmings->push($showing->programming);
        }
        $showing->programming_id = $showing->programming->id;

        $showing->is_original_version
            = in_array('vo', (array) $ems_showing->features);

        $showing->is_3d
            = in_array('video_3d', (array) $ems_showing->features);

        $showing->auditorium_number = $ems_showing->hall_id;

        $showing->preshow_duration_in_seconds = 60 * 15;

        return $showing;
    }
}
