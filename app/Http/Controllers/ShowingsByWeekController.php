<?php

namespace App\Http\Controllers;

use App\Week;
use Carbon\CarbonPeriod;
use Gordesch\CineCarbon;

class ShowingsByWeekController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  string  $programming_week
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $programming_week)
    {
        $week = Week::whereNumber($programming_week)
            ->with(
                [
                    'programmings' => function ($query) {
                        $query->orderBy('position');
                    },
                    'programmings.show.videos',
                    'programmings.show.media',
                    'programmings.showings' => function ($query) {
                        $query->orderBy('datetime', 'asc');
                    },
                ]
            )
            ->firstOrFail();
        $week->days = CarbonPeriod::between($week->start, $week->end);
        $week->days->setDateClass(CineCarbon::class);

        return view('public.showings.week', compact('week'));
    }
}
