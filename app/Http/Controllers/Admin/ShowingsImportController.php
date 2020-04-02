<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowingForm;
use App\Programming;
use App\Services\TicketingProvider\TicketingProvider;
use App\Showing;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ShowingsImportController extends Controller
{
    public function create(TicketingProvider $ticketing): View
    {
        session(['shows_to_import' => $ticketing->getShowsWithShowings()]);
        $shows = $ticketing->getShowsToMatch();

        return view('admin.showings-import.create', compact('shows'));
    }

    public function store(TicketingProvider $ticketing): RedirectResponse
    {
        $ticketing->setShowsWithShowings(session('shows_to_import'));

        DB::beginTransaction();
        try {
            // Delete showings to come, because we will import them again
            // w/ buffer of 10 minutes to account for eventual age of the import
            $showings_start_after = Carbon::now()->modify('- 10 minutes');
            Showing::where('datetime', '>=', $showings_start_after)->delete();

            $showings = $ticketing->getAllShowings();
            (new ShowingForm())->persistMultiple($showings);

            // Delete programmings where no showings
            Programming::destroy(
                $week->programmings->where('showings_count', '=', 0)->modelKeys()
            );

            DB::commit();
            flash("{$showings->count()} séances importées")->success();
        } catch (\Exception $exception) {
            DB::rollback();
            flash("Erreur lors de l'importation, veuillez réessayer")->error();
        }

        return redirect()->route('admin.weeks.index');
    }
}
