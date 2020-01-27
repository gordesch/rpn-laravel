<?php

namespace App\Http\Controllers;

use App\Showing;
use Gordesch\CineCarbonImmutable;

class ShowingsTonightController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string|null  $date
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function __invoke(?string $date = null)
    {
        if ($date) {
            $date = CineCarbonImmutable::parse($date);
        } else {
            $date = CineCarbonImmutable::now();
        }
        $showings = Showing::whereDate('datetime', $date)
            ->whereTime('datetime', '>=', '18:30')
            ->with('programming.show.videos')
            ->orderBy('datetime', 'asc')
            ->get();

        return view('showing.tonight', compact('showings', 'date'));
    }
}
