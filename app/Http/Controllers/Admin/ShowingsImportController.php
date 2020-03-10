<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowingForm;
use App\Services\TicketingProvider\TicketingProviderInterface;
use App\Showing;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ShowingsImportController extends Controller
{
    public function create(TicketingProviderInterface $ticketing): View
    {
        session(['shows_to_import' => $ticketing->getShowsWithShowings()]);
        $shows = $ticketing->getShowsToMatch();

        return view('admin.showings-import.create', compact('shows'));
    }

    public function store(TicketingProviderInterface $ticketing): RedirectResponse
    {
        $ticketing->setShowsWithShowings(session('shows_to_import'));

        DB::beginTransaction();
        try {
            // Delete showings to come, because we will import them again
            // We use a buffer of 10 minutes to account for eventual age of the import
            $showings_start_after = Carbon::now()->modify('- 10 minutes');
            Showing::where('datetime', '>=', $showings_start_after)->delete();

            $showings = $ticketing->getAllShowings();
            $form = new ShowingForm;
            $form->persistMultiple($showings);
            DB::commit();
            flash("{$showings->count()} séances importées")->success();
        } catch (\Exception $e) {
            DB::rollback();
            flash("Erreur lors de l'importation, veuillez réessayer")->error();
        }

        return redirect()->route('admin.weeks.index');
    }
}
