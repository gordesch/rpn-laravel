<?php

namespace App\Http\Livewire\Admin\Shows;

use App\Show;
use Illuminate\View\View;
use Livewire\Component;

class Poster extends Component
{
    public $show = null;
    public bool $poll = false;

    public function mount(Show $show): void
    {
        $this->show = $show;
        $this->poll = (bool) $this->show->poster_is_pending;
    }

    public function check(): void
    {
        $this->show = $this->show->fresh();
        $this->poll = (bool) $this->show->poster_is_pending;
    }

    public function render(): View
    {
        return view('livewire.admin.shows.poster', [
            'show' => $this->show,
        ]);
    }
}
