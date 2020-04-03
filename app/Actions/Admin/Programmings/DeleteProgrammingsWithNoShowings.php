<?php

namespace App\Actions\Admin\Programmings;

use App\Programming;
use Exception;
use Spatie\QueueableAction\QueueableAction;

class DeleteProgrammingsWithNoShowings
{
    use QueueableAction;

    /**
     * @throws Exception
     */
    public function __invoke(): void
    {
        Programming::whereDoesntHave('showings')->delete();
    }
}
