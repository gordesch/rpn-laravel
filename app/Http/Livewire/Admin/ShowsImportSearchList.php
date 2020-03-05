<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Services\ShowsProvider\ShowsProviderInterface;

class ShowsImportSearchList extends Component
{
    public string $ticketing_provider_id = '';
    public $shows;
    protected ShowsProviderInterface $showsProvider;

    protected $listeners = ['search' => 'mount'];

    public function mount(ShowsProviderInterface $showsProvider)
    {
        $this->showsProvider = $showsProvider;
        $this->updateShows(request()->query('search', ''));
    }

    public function updateShows(string $search)
    {
        $this->ticketing_provider_id = request('ticketing_provider_id', '');
        $this->shows = new Collection($this->showsProvider::search($search));
    }

    public function render()
    {
        return view(
            'livewire.admin.shows-import-search-list', [
                'shows' => $this->shows,
            ]
        );
    }
}
