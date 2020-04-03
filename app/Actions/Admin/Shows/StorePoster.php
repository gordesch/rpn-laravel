<?php

namespace App\Actions\Admin\Shows;

use App\Http\Requests\PosterForm;
use App\Show;
use Illuminate\Support\Collection;
use Spatie\QueueableAction\QueueableAction;

class StorePoster
{
    use QueueableAction;

    private PosterForm $poster_form;

    public function __construct(PosterForm $poster_form)
    {
        $this->poster_form = $poster_form;
    }

    public function execute(Show $show, Collection $request)
    {
        if (! $request->has('poster_url')) {
            return;
        }
        $poster = [
            'type' => 'url',
            'location' => $request->get('poster_url'),
        ];
        $this->poster_form->persist($poster, $show);
    }
}
