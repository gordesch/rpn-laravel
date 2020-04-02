<?php

namespace App\Actions\Admin;

use App\Actions\Admin\Showings\DeleteOldShowings;
use App\Actions\DeleteProgrammingsWithNoShowings;
use App\Http\Requests\ShowingForm;
use App\Programming;
use App\Services\TicketingProvider\TicketingProvider;
use App\Showing;
use Carbon\Carbon;
use Spatie\QueueableAction\QueueableAction;

class ImportShowings
{
    use QueueableAction;
    /**
     * @var TicketingProvider
     */
    private TicketingProvider $ticketing;

    /**
     * Create a new action instance.
     */
    public function __construct(TicketingProvider $ticketing)
    {
        $this->ticketing = $ticketing;
    }

    /**
     * Execute the action.
     *
     * @return mixed
     */
    public function execute()
    {
        DB::beginTransaction();
        try {
            (new DeleteOldShowings())->execute();

            $showings = $ticketing->getAllShowings();
            (new ShowingForm())->persistMultiple($showings);

            // Delete programmings where no showings
            DeleteProgrammingsWithNoShowings::class->execute();

            DB::commit();
            flash("{$showings->count()} séances importées")->success();
        } catch (\Exception $exception) {
            DB::rollback();
            flash("Erreur lors de l'importation, veuillez réessayer")->error();
        }
    }
}
