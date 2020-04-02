<?php

namespace App\Actions\Admin\Programmings;

use App\Programming;
use Exception;
use Spatie\QueueableAction\QueueableAction;

class DeleteProgrammingsWithNoShowings
{
    use QueueableAction;

    /**
     * Execute the action.
     *
     * @throws Exception
     */
    public function execute(): void
    {
        Programming::whereDoesntHave('showings')->delete();
    }
}
