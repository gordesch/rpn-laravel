<?php

namespace App\Jobs\Admin\Shows;

use App\Http\Requests\VideosFormRequest;
use App\Show;
use App\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class StoreVideosJob implements ShouldQueue
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
     * Execute the job.
     */
    public function handle(VideosFormRequest $videos_form_request): void
    {
        if ($this->input->get('video-dubbed')) {
            $videos_form_request->persist(
                new Video(),
                $this->show,
                false,
                $this->input
            );
        }
        if ($this->input->get('video-original')) {
            $videos_form_request->persist(
                new Video(),
                $this->show,
                true,
                $this->input
            );
        }
    }
}
