<?php

namespace App\Jobs\Admin\Shows;

use App\Http\Requests\ShowFormRequest;
use App\Show;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class StoreShowJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Collection $input;
    protected ?Show $show = null;

    /**
     * Create a new job instance.
     */
    public function __construct(Collection $input, ?Show $show = null)
    {
        $this->input = $input;
        $this->show = $show;
    }

    /**
     * Execute the job.
     */
    public function handle(ShowFormRequest $show_form_request): void
    {
        $show = $show_form_request->persist($this->show);
        if ($show->wasRecentlyCreated) {
            flash("{$show->title} a bien été créé")->success();
        }
        if (! $show->wasRecentlyCreated && $show->getChanges() !== []) {
            flash("{$show->title} a bien été mis à jour")->success();
        }
        $has_new_poster
            = $this->input->hasNotEmpty('poster_url')
            || $this->input->hasNotEmpty('poster_file');
        StorePosterJob::dispatchIf($has_new_poster, $show, $this->input);
        StoreVideosJob::dispatch($show, $this->input);
    }
}
