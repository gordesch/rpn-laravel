<?php

namespace App\Http\Livewire\Admin\Shows;

use App\Services\ShowsProvider\Facade\ShowsProvider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Component;

class ImportSearchList extends Component
{
    public $search = '';
    public $ticketing_provider_id = '';
    public $shows;

    /**
     * @var array<string, array<string, string>>
     */
    protected $queryString = [
        'search' => ['except' => ''],
        'ticketing_provider_id' => ['except' => '']
    ];

    /**
     * @var array<string>
     */
    protected $listeners = ['search' => 'updateShows'];

    public function mount(): void
    {
        $this->updateShows($this->search);
    }

    public function updateShows(string $search): void
    {
        $this->search = $search;
        $this->shows = new Collection(ShowsProvider::search($this->search));
    }

    public function render(): View
    {
        $this->emit('resultsLoaded', $this->search);
        return view('livewire.admin.shows.import-search-list');
    }
}
