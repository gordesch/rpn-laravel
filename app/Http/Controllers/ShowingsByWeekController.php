<?php

namespace App\Http\Controllers;

use App\Week;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Gordesch\CineCarbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\View\View;

class ShowingsByWeekController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $programming_week): View
    {
        try {
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
                )->firstOrFail();
        } catch (ModelNotFoundException $e) {
            // @TODO handle exception
            $week = null;
        }

        return view('public.showings.week', compact('week'));
    }
}
