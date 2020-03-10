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
        $weeks = Week::where('start', '>=', $this_week_start)
            ->with('programmings')
            ->withCount('programmings', 'showings')
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
                    ->withCount('showings')
                    ->orderBy('order', 'asc')
                    ->orderBy('showings_count', 'desc');
            },
            'programmings.show',
        ]);

        if (!$week->programmings->first()->order) { // programmings not set
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
        $order = 0;
        $programmings = collect(request('programming'))
            ->map(function ($item, $key) {
                return collect($item);
            })->each(function ($item, $key) use (&$order) {
            $programming = Programming::find($key);
            $programming->order = $order;
            $programming->is_dubbed_version =
                $item->get('is_dubbed_version') ?
                    true :
                    false;
            $programming->is_original_version =
                $item->get('is_original_version') ?
                    true :
                    false;
            $programming->is_2d =
                $item->get('is_2d') ?
                    true :
                    false;
            $programming->is_3d =
                $item->get('is_3d') ?
                    true :
                    false;
            $programming->custom_showings_infos =
                $item->get('custom_showings_infos') ?? null;
             $order++;
             $programming->save();
        });

        flash("Programmation de la semaine {$week->start->isoFormat('WW')} mise à jour")->success();

        return redirect()->route('admin.weeks.index');
    }
}
