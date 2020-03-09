<?php

namespace App\Http\Livewire\Admin\Shows;

use App\Show;
use Livewire\Component;

class SearchList extends Component
{
    public string $search;
    public $shows;

    protected $listeners = ['search' => 'mount'];

    public function mount()
    {
        $this->search = (string) request()->query('search', '');
        $this->updateShows();
    }

    public function updateShows()
    {
        if (empty($this->search)) {
            $this->shows = Show::latest()->limit(30)->get();
        } else {
            $this->shows = Show::where(
                'title',
                'like',
                '%' . $this->search . '%'
            )->limit(30)->get();
        }
    }

    public function render()
    {
        $this->emit('resultsLoaded', $this->search);
        return view(
            'livewire.admin.shows.search-list', [
                'shows' => $this->shows,
            ]
        );
    }
}
