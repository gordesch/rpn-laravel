<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Week;
use Illuminate\View\View;

class WeeksDetailsController extends Controller
{
    public function showsState(Week $week): View
    {
        return view ('admin.weeks.details.shows-state', compact('week'));
    }

    public function resources(Week $week): View
    {
        $week->load('programmings.show.media');
        return view ('admin.weeks.details.resources', compact('week'));
    }

    public function showings(Week $week): View
    {
        return view ('admin.weeks.details.showings', compact('week'));
    }
}
