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

    public function updatePosterIsPending(Show $show): self
    {
        $show->poster_is_pending = true;
        $show->save();
        return $this;
    }

    public function execute(Show $show, Collection $input): void
    {
        if (! $input->has('poster_url')) {
            return;
        }
        $poster = [
            'type' => 'url',
            'location' => $input->get('poster_url'),
        ];
        $this->poster_form->persist($poster, $show);
    }
}
