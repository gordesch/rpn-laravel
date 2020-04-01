<?php

namespace App\Http\Livewire\Admin\Shows;

use App\Services\ShowsProvider\Facade\ShowsProvider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class ImportSearchList extends Component
{
    public string $search = '';
    public string $ticketing_provider_id = '';
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
        $this->updateShows();
    }

    public function updateShows(): void
    {
        $search = request()->query('search', '');
        if (!is_array($search)) {
            $this->search = (string) $search;
        }
        if (!isset($this->search) || $this->search == false) {
            return;
        }
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
