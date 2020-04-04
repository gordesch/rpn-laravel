<?php

namespace App\Actions\Admin\Shows;

use App\Http\Requests\VideoForm;
use App\Show;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\QueueableAction\QueueableAction;

class StoreVideos
{
    use QueueableAction;

    private VideoForm $video_form;

    public function __construct(VideoForm $video_form)
    {
        $this->video_form = $video_form;
    }

    public function execute(Show $show, Collection $input)
    {
        if (! is_null($input->get('video-dubbed'))) {
            $this->video_form
                ->persist(new Video(), $show, false, $input);
        }
        if (! is_null($input->get('video-original'))) {
            $this->video_form
                ->persist(new Video(), $show, true, $input);
        }
    }
}
