<?php

namespace App\Http\Livewire\Admin;

use App\Show;
use Livewire\Component;

class ShowsSearchList extends Component
{
    public $shows;

    protected $listeners = ['search' => 'mount'];

    public function mount()
    {
        $this->updateShows(request()->query('search', ''));
    }

    public function updateShows(string $search)
    {
        if (empty($search)) {
            $this->shows = Show::latest()->limit(30)->get();
        } else {
            $this->shows = Show::where(
                'title',
                'like',
                '%' . $search . '%'
            )->limit(30)->get();
        }
    }

    public function render()
    {
        return view(
            'livewire.admin.shows-search-list', [
                'shows' => $this->shows,
            ]
        );
    }
}
