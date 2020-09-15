<?php

namespace App\Http\Livewire\Admin\Shows;

use App\Models\Show;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class SearchList extends Component
{
    public $search = '';
    /**
     * @var Collection
     */
    public $shows;

    /**
     * @var array<string>
     */
    protected $listeners = ['search' => 'updateShows'];

    public function mount(): void
    {
        $this->updateShows(request('search', ''));
    }

    public function updateShows(string $search): void
    {
        $this->search = $search;
        if ($this->search == '') {
            $this->shows = Show::latest()->with('media')->limit(30)->get();
        } else {
            $this->shows = Show::search($this->search)
                ->paginate(30)
                ->load('media');
        }
    }

    public function render(): View
    {
        $this->emit('resultsLoaded', $this->search);
        return view(
            'livewire.admin.shows.search-list', [
                'shows' => $this->shows,
            ]
        );
    }
}
