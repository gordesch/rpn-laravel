<?php

namespace App\Listeners\Admin\Website;

use App\Events\Admin\Website\PageSaved;
use App\Jobs\Admin\Website\TransformContentJob;

class TransformPageHtml
{
    /**
     * Handle the event.
     */
    public function handle(PageSaved $page_saved): void
    {
        TransformContentJob::dispatch($page_saved->page);
    }
}
