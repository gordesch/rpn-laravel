<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowingFormRequest;
use App\Jobs\Admin\Showings\ImportShowingsJob;
use App\Jobs\Admin\Showings\MatchShowsForShowingsImportJob;
use App\Programming;
use App\Services\TicketingProvider\TicketingProvider;
use App\Showing;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ShowingsImportController extends Controller
{
    public function create(): View
    {
        $job = new MatchShowsForShowingsImportJob();
        $this->dispatchNow($job);
        return view('admin.showings-import.create', [
            'shows' => $job->shows,
        ]);
    }

    public function store(): RedirectResponse
    {
        ImportShowingsJob::dispatchNow();
        return redirect()->route('admin.weeks.index');
    }
}
