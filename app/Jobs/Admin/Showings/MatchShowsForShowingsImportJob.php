<?php

namespace App\Jobs\Admin\Showings;

use App\Services\TicketingProvider\TicketingProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class MatchShowsForShowingsImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Collection $shows;

    /**
     * Create a new job instance.
     */
    public function __construct(?Collection $shows = null)
    {
        if (! $shows) {
            $shows = new Collection();
        }
        $this->shows = $shows;
    }

    /**
     * Execute the job.
     */
    public function handle(TicketingProvider $ticketing): void
    {
        session(['shows_to_import' => $ticketing->getShowsWithShowings()]);
        $this->shows = $ticketing->getShowsToMatch();
    }
}
