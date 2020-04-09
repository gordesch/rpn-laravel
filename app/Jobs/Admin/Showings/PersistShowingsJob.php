<?php

namespace App\Jobs\Admin\Showings;

use App\Http\Requests\ShowingFormRequest;
use App\Jobs\Admin\Programming\DeleteProgrammingsWithNoShowingsJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PersistShowingsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Collection $showings;

    /**
     * Create a new job instance.
     */
    public function __construct(Collection $showings)
    {
        $this->showings = $showings;
    }

    /**
     * Execute the job.
     *
     * @throws \Throwable
     */
    public function handle(): void
    {
        DB::beginTransaction();
        try {
            DeleteComingShowingsJob::dispatchNow();
            (new ShowingFormRequest())->persistMultiple($this->showings);
            DeleteProgrammingsWithNoShowingsJob::dispatch();
            flash("{$this->showings->count()} séances importées")->success();
            DB::commit();
        } catch (\Exception $exception) {
            flash("Erreur lors de l'importation, veuillez réessayer")->error();
            DB::rollback();
        }
    }
}
