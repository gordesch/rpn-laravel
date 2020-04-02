<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Week;
use Illuminate\View\View;

class ProgrammingsShowsController extends Controller
{
    public function edit(Week $week): View
    {
        $week->load([
            'programmings.show' => function ($query) {
                $query
                    ->with('media')
                    ->withCount('videos');
            },
            'shows_with_missing_data',
        ]);
        return view('admin.weeks.programmings.shows.edit', compact('week'));
    }

    public function index(Week $week): View
    {
        $week->load('programmings.show.media', 'shows_with_missing_data');
        return view('admin.weeks.programmings.shows.index', compact('week'));
    }
}
