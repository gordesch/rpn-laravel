<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowingForm;
use App\Programming;
use App\Showing;
use App\Week;
use App\Wrappers\EMS\EMS;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ShowingsImportController extends Controller
{
    public function index()
    {
        return view('admin.showings-import.index');
    }
    public function create()
    {
        $shows = EMS::showsForMatching();
        return view('admin.showings-import.create', compact('shows'));
    }

    public function store(Request $request)
    {
        $ticketing_shows = session('shows_to_import');
        $ticketing_shows = EMS::matchShows($ticketing_shows);

        DB::beginTransaction();

        // Delete showings to come, because we will import them again
        $showings_start_after = Carbon::now()->modify('- 10 minutes');
        Showing::where('datetime', '>=', $showings_start_after)->delete();

        $weeks = Week::where('end', '>=', $showings_start_after)->get();

        $programmings = Programming::whereIn(
            'week_id',
            array_values($weeks->pluck('id')->all())
        )->get();

        $showings = new Collection;

        $showings_total_number = 0;
        foreach ($ticketing_shows as $show) {
            foreach ($show->sessions as $ems_showing) {
                $showing = EMS::toShowing(
                    $ems_showing,
                    $show,
                    $weeks,
                    $programmings
                );

                $showings->push($showing);
                $showings_total_number++;
            }
        }
        $form = new ShowingForm;
        $form->persistMultiple($showings);

        DB::commit();

        //echo $showings_total_number . ' showings created';
        return view('admin.showings-import.index');
    }
}
