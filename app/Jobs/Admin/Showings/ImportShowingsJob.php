<?php

namespace App\Jobs\Admin\Showings;

use App\Http\Requests\ShowingFormRequest;
use App\Jobs\Admin\Programming\DeleteProgrammingsWithNoShowingsJob;
use App\Services\TicketingProvider\TicketingProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ImportShowingsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Collection $shows_to_import;
    public Collection $shows_to_match;

    /**
     * Create a new job instance.
     */
    public function __construct(Collection $shows_to_import)
    {
        $this->shows_to_import = $shows_to_import;
    }

    /**
     * Execute the job.
     *
     * @throws \Throwable
     */
    public function handle(TicketingProvider $ticketing): void
    {
        $ticketing->setShowsWithShowings($this->shows_to_import);
        PersistShowingsJob::dispatch($ticketing->getAllShowings());
    }
}
