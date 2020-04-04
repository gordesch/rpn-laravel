<?php

namespace App\Actions\Admin\Shows;

use App\Http\Requests\ShowForm;
use Illuminate\Http\Request;
use Spatie\QueueableAction\QueueableAction;

class StoreShow
{
    use QueueableAction;

    private ShowForm $show_form;
    private StorePoster $store_poster;
    private StoreVideos $store_videos;

    public function __construct(
        ShowForm $show_form,
        StorePoster $store_poster,
        StoreVideos $store_videos
    ) {
        $this->show_form = $show_form;
        $this->store_poster = $store_poster;
        $this->store_videos = $store_videos;
    }

    public function execute(Request $request)
    {
        $show = $this->show_form->persist();
        flash("{$show->title} a bien été créé")->success();
        $this->store_poster
            ->updatePosterIsPending($show)
            ->onQueue()
            ->execute($show, collect($request->all()));
        $this->store_videos
            ->onQueue()
            ->execute($show, collect($request->all()));
    }
}
