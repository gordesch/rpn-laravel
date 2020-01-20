<?php

namespace App\Wrappers\EMS;

use App\Programming;
use App\Show;
use App\Showing;
use App\Week;
use Carbon\Carbon;
use Gordesch\CineCarbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use SimpleXMLElement;


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
     * @param SimpleXMLElement $ems_showing the element to cast
     *
     * @return Show
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
            = $showing->datetime->programmingWeek();

        $week = $weeks->where('number', $showing->week_number)->first();
        if ($week) {
            $showing->week
                = $week;
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
            = in_array('vo', $ems_showing->features);

        $showing->is_3d
            = in_array('video_3d', $ems_showing->features);

        $showing->auditorium_number = $ems_showing->hall_id;

        $showing->preshow_duration_in_seconds = 60 * 15;

        return $showing;
    }
}
