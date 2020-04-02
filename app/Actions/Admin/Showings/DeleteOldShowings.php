<?php

namespace App\Actions\Admin\Showings;

use App\Showing;
use Carbon\Carbon;

class DeleteOldShowings
{
    /**
     * Execute the action.
     */
    public function execute(): void
    {
        // Delete showings to come, because we will import them again
        // w/ buffer of 10 minutes to account for eventual age of the import
        $showings_start_after = Carbon::now()->modify('- 10 minutes');
        Showing::where('datetime', '>=', $showings_start_after)->delete();
    }
}
