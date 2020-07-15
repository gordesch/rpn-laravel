<?php

namespace App\Services\TicketingProvider\EMS;

use App\Programming;
use App\Show;
use App\Showing;
use App\Week;
use Gordesch\CineCarbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Trait CastsToShowing
 *
 * Casts a response from the API to an App\Showing
 */
trait CastsToShowing
{
    /**
     * Returns a showing
     *
     * @param object $ems_showing
     * @param object $show
     * @param Collection $weeks
     * @param Collection $programmings
     *
     * @return Showing
     */
    public static function toShowing(
        object $ems_showing,
        object $show,
        Collection &$weeks,
        Collection &$programmings
    ): Showing {
        $showing = new Showing();

        $showing->ticketing_provider_id = $ems_showing->id;

        $showing->datetime = CineCarbon::parse($ems_showing->date);

        $week_number = CineCarbon::parse($ems_showing->date)->programmingWeek();

        $week = $weeks->where('number', $week_number)->first();
        if (! $week) {
            $week = Week::create(
                ['number' => $week_number]
            );
            $weeks->push($week);
        }
        $showing->setRelation('week', $week);

        $programming = $programmings
            ->where('show_id', $show->id)
            ->where('week_id', $showing->week->id)
            ->first();
        if (! $programming) {
            $programming = Programming::create(
                [
                    'show_id' => $show->id,
                    'week_id' => $showing->week->id,
                ]
            );
            $programmings->push($programming);
        }
        $showing->setRelation('programming', $programming);
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
