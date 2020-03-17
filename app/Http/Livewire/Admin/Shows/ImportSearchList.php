<?php

namespace App\Http\Livewire\Admin\Shows;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Services\ShowsProvider\ShowsProviderInterface;

class ImportSearchList extends Component
{
    public string $search = '';
    public string $ticketing_provider_id = '';
    public $shows = null;
    protected ShowsProviderInterface $showsProvider;

    protected $listeners = ['search' => 'mount'];

    public function mount(ShowsProviderInterface $showsProvider)
    {
        $this->showsProvider = $showsProvider;
        $this->updateShows();
    }

    public function updateShows()
    {
        $this->search = (string) request()->query('search', '');
        if (empty($this->search)) {
            return;
        }
        $this->ticketing_provider_id = request('ticketing_provider_id', '');
        $this->shows = new Collection($this->showsProvider::search($this->search));
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
