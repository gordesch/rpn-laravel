<?php

namespace App\Jobs\Admin\Programming;

use App\Programming;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteProgrammingsWithNoShowingsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @throws \Exception
     */
    public function handle(): void
    {
        Programming::whereDoesntHave('showings')->delete();
    }
}
