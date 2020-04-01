<?php

namespace App\Http\Livewire\Admin\Shows;

use App\Show;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class SearchList extends Component
{
    public ?string $search = null;
    /**
     * @var Collection
     */
    public $shows = null;

    /**
     * @var array<string>
     */
    protected $listeners = ['search' => 'mount'];

    public function mount(): void
    {
        $search = request()->query('search', '');
        if (!is_array($search)) {
            $this->search = (string) $search;
        }
        $this->updateShows();
    }

    public function updateShows(): void
    {
        if (!isset($this->search) || $this->search == false) {
            $this->shows = Show::latest()->with('media')->limit(30)->get();
        } else {
            $this->shows = Show::where(
                'title',
                'like',
                '%' . $this->search . '%'
            )->with('media')->limit(30)->get();
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
