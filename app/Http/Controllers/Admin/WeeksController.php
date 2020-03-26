<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Programming;
use App\Week;
use Gordesch\CineCarbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WeeksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(): View
    {
        $this_week_start = CineCarbon::now()->startOfWeek();
        //$weeks = Week::where('start', '>=', $this_week_start)
        $weeks = Week::find(7)
            ->with('programmings')
            ->withCount('programmings', 'showings')
            ->with('shows_with_missing_data')
            ->has('showings')
            ->orderBy('start', 'asc')
            ->get();

        return view('admin.weeks.index', compact('weeks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Week $week): View
    {
        $week->load([
            'programmings' => function ($query) {
                $query
                    ->with('show.media')
                    ->withCount('showings')
                    ->orderBy('position', 'asc')
                    ->orderBy('showings_count', 'desc');
            },
            'shows_with_missing_data',
        ]);

        // Delete programmings where no showings
        $week->programmings->each(function($item) {
            if ($item->showings_count === 0) {
                Programming::whereId($item->id)->delete();
            }
        });

        // If programmings are not set, prepopulate with a guess
        if ($week->programmings->first()->position === null) {
            $week->programmings->each
                ->load('show', 'showings')
                ->loadCount([
                    'showings as showings_in_dubbed_version_count' => function (Builder $query) {
                        $query->where('is_original_version', false);
                    },
                    'showings as showings_in_original_version_count' => function (Builder $query) {
                        $query->where('is_original_version', true);
                    },
                    'showings as showings_in_2d_count' => function (Builder $query) {
                        $query->where('is_3d', false);
                    },
                    'showings as showings_in_3d_count' => function (Builder $query) {
                        $query->where('is_3d', true);
                    },
                ])->map(function($programming, $key){
                    if (!$programming->show->is_local_language) {
                        $programming->is_dubbed_version = $programming->showings_in_dubbed_version_count;
                        $programming->is_original_version = $programming->showings_in_original_version_count;
                    }
                    if ($programming->showings_in_3d_count) {
                        $programming->is_2d = $programming->showings_in_2d_count;
                        $programming->is_3d = $programming->showings_in_3d_count;
                    }
                });
        }

        return view('admin.weeks.edit', compact('week'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Week $week): RedirectResponse
    {
        $position = 0;
        collect(request('programming'))
            ->each(function ($item, $key) use (&$position) {
                $item = collect($item);
                Programming::whereId($key)->update([
                    'position' => $position,
                    'is_dubbed_version' => $item->get('is_dubbed_version') ? true : false,
                    'is_original_version' => $item->get('is_original_version') ? true : false,
                    'is_2d' => $item->get('is_2d') ? true : false,
                    'is_3d' => $item->get('is_3d') ? true : false,
                    'custom_showings_infos' => $item->get('custom_showings_infos') ?? null,
                ]);
                $position++;
            });

        flash("Programmation mise à jour pour la semaine du {$week->start->isoFormat('dddd DD MMMM YYYY')}")->success();

        return redirect()->route('admin.weeks.index');
    }
}
