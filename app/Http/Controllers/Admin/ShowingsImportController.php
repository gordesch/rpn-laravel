<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowingFormRequest;
use App\Jobs\Admin\Showings\ImportShowingsJob;
use App\Jobs\Admin\Showings\MatchShowsForShowingsImportJob;
use App\Models\Programming;
use App\Services\TicketingProvider\TicketingProvider;
use App\Models\Showing;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ShowingsImportController extends Controller
{
    public function create(): View
    {
        $matching = new MatchShowsForShowingsImportJob();
        dispatch_now($matching);
        return view('admin.showings-import.create', [
            'shows' => $matching->shows,
        ]);
    }

    public function store(): RedirectResponse
    {
        ImportShowingsJob::dispatchSync(Session::get('shows_to_import'));
        return redirect()->route('admin.weeks.index');
    }
}
