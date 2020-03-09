<?php

namespace App\Http\Livewire\Admin\Shows;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Services\ShowsProvider\ShowsProviderInterface;

class ImportSearchList extends Component
{
    public ?string $search = null;
    public string $ticketing_provider_id = '';
    public $shows;
    protected ShowsProviderInterface $showsProvider;

    protected $listeners = ['search' => 'mount'];

    public function mount(ShowsProviderInterface $showsProvider, ?string $search = null)
    {
        $this->search = $search;
        $this->showsProvider = $showsProvider;
        $this->updateShows((string) request()->query('search', ''));
    }

    public function updateShows(string $search)
    {
        $this->ticketing_provider_id = request('ticketing_provider_id', '');
        $this->shows = new Collection($this->showsProvider::search($search));
    }

    public function render()
    {
        $this->emit('resultsLoaded', $this->search);
        return view(
            'livewire.admin.shows.import-search-list', [
                'shows' => $this->shows,
            ]
        );
    }
}
