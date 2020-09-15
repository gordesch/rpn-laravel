<?php

namespace App\Http\Controllers;

use App\Models\Showing;
use App\Models\Week;
use Carbon\CarbonPeriod;
use Gordesch\CineCarbon;
use Gordesch\CineCarbonImmutable;
use Illuminate\Http\Request;

class ShowingsNowController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param string|null $from
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(?string $from = null)
    {
        if ($from) {
            $from = CineCarbonImmutable::parse($from);
        } else {
            $from = CineCarbonImmutable::now();
        }
        $until = $from->addHours(2);
        $showings = Showing::whereBetween('datetime', [$from, $until])
            ->with('programming.show.videos')
            ->orderBy('datetime', 'asc')
            ->get();

        return view('public.showings.now', compact('showings', 'from'));
    }
}
