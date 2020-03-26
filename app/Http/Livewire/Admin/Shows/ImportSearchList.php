<?php

namespace App\Http\Livewire\Admin\Shows;

use App\Services\ShowsProvider\Facade\ShowsProvider;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Services\ShowsProvider\ShowsProviderInterface;

class ImportSearchList extends Component
{
    public string $search = '';
    public string $ticketing_provider_id = '';
    public $shows = null;

    protected $listeners = ['search' => 'mount'];

    public function mount()
    {
        $this->updateShows();
    }

    public function updateShows()
    {
        $this->search = (string) request()->query('search', '');
        if (empty($this->search)) {
            return;
        }
        $this->ticketing_provider_id = request('ticketing_provider_id', '');
        $this->shows = new Collection(ShowsProvider::search($this->search));
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
