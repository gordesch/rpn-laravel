<?php

namespace App\Http\Livewire\Admin\Shows;

use App\Services\ShowsProvider\Facade\ShowsProvider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class ImportSearchList extends Component
{
    public $search = '';
    public $ticketing_provider_id = '';
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
        $this->ticketing_provider_id = request('ticketing_provider_id', '');
        $this->shows = new Collection(ShowsProvider::search($this->search));
    }

    public function render(): View
    {
        $this->emit('resultsLoaded', $this->search);
        return view(
            'livewire.admin.shows.import-search-list', [
                'shows' => $this->shows,
            ]
        );
    }
}
