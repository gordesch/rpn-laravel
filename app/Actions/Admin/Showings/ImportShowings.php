<?php

namespace App\Actions\Admin;

use App\Actions\Admin\Programmings\DeleteProgrammingsWithNoShowings;
use App\Actions\Admin\Showings\DeleteComingShowings;
use App\Http\Requests\ShowingForm;
use App\Services\TicketingProvider\TicketingProvider;
use Illuminate\Support\Facades\DB;
use Spatie\QueueableAction\QueueableAction;

class ImportShowings
{
    use QueueableAction;

    private TicketingProvider $ticketing;
    private DeleteComingShowings $delete_coming_showings;
    private DeleteProgrammingsWithNoShowings $delete_programmings_with_no_showings;
    private ShowingForm $showing_form;

    /**
     * Create a new action instance.
     */
    public function __construct(
        TicketingProvider $ticketing,
        DeleteComingShowings $delete_coming_showings,
        DeleteProgrammingsWithNoShowings $delete_programmings_with_no_showings,
        ShowingForm $showing_form
    ) {
        $this->ticketing = $ticketing;
        $this->delete_coming_showings = $delete_coming_showings;
        $this->delete_programmings_with_no_showings = $delete_programmings_with_no_showings;
        $this->showing_form = $showing_form;
    }

    /**
     * Execute the action.
     *
     * @throws \Throwable
     */
    public function __invoke(): void
    {
        DB::beginTransaction();
        try {
            $this->delete_coming_showings->__invoke();

            $showings = $this->ticketing->getAllShowings();
            (new ShowingForm())->persistMultiple($showings);

            $this->delete_programmings_with_no_showings->__invoke();

            flash("{$showings->count()} séances importées")->success();
            DB::commit();
        } catch (\Exception $exception) {

            flash("Erreur lors de l'importation, veuillez réessayer")->error();
            DB::rollback();
        }
    }
}
