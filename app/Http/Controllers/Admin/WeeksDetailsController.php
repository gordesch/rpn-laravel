<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Week;
use Illuminate\View\View;

class WeeksDetailsController extends Controller
{
    public function showsState(Week $week): View
    {
        $week->load([
            'programmings.show' => function ($query) {
                $query
                    ->with('media')
                    ->withCount('videos');
            },
            'shows_with_missing_data',
        ]);
        return view ('admin.weeks.details.shows-state', compact('week'));
    }

    public function resources(Week $week): View
    {
        $week->load('programmings.show.media', 'shows_with_missing_data');
        return view ('admin.weeks.details.resources', compact('week'));
    }

    public function showings(Week $week): View
    {
        $week->load('shows_with_missing_data');
        return view ('admin.weeks.details.showings', compact('week'));
    }
}
