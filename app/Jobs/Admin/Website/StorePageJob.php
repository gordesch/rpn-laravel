<?php

namespace App\Jobs\Admin\Website;

use App\Http\Requests\PageFormRequest;
use App\Models\Page;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class StorePageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Collection $input;
    protected ?Page $page = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $input, ?Page $page = null)
    {
        $this->input = $input;
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(PageFormRequest $page_form_request)
    {
        $this->page = $page_form_request->persist($this->page);
    }
}
