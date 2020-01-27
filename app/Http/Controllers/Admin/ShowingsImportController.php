<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowingForm;
use App\Services\TicketingProvider\TicketingProviderInterface;
use App\Showing;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShowingsImportController extends Controller
{
    public function index()
    {
        return view('admin.showings-import.index');
    }
    public function create(TicketingProviderInterface $ticketing)
    {
        session(['shows_to_import' => $ticketing->getShowsWithShowings()]);
        $shows = $ticketing->getShowsToMatch();

        return view('admin.showings-import.create', compact('shows'));
    }

    public function store(TicketingProviderInterface $ticketing)
    {
        $ticketing->setShowsWithShowings(session('shows_to_import'));

        DB::beginTransaction();
        try {
            // Delete showings to come, because we will import them again
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

        return view('admin.showings-import.index');
    }
}
