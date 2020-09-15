<?php

namespace App\Jobs\Admin\Shows;

use App\Http\Requests\PosterFormRequest;
use App\Models\Show;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class StorePosterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Show $show;
    protected Collection $input;

    /**
     * Create a new job instance.
     */
    public function __construct(Show $show, Collection $input)
    {
        $this->show = $show;
        $this->input = $input;
    }

    /**
     * Dispatch the job with the given arguments.
     */
    public static function dispatch(): PendingDispatch
    {
        $job = new static(...func_get_args());
        $job->show->poster_is_pending = true;
        $job->show->save();
        return new PendingDispatch($job);
    }

    /**
     * Execute the job.
     */
    public function handle(PosterFormRequest $poster_form_request): void
    {
        $url = $this->input->get('poster_url');
        $file = $this->input->get('poster_file');
        if (! $url && ! $file) {
            return;
        }
        $poster = [
            'type' => $url ? 'url' : 'file',
            'location' => $url ?? $file,
        ];
        $poster_form_request->persist($poster, $this->show);
    }

    /**
     * The job failed to process.
     */
    public function failed(Exception $exception): void
    {
        $this->show->poster_is_pending = false;
        $this->show->save();
    }
}
