<?php

namespace App\Http\Livewire\Admin\Shows;

use Livewire\Component;

class SearchInput extends Component
{
    public ?string $search = null;
    public bool $resultsLoading = false;

    protected $updatesQueryString = ['search' => ['except' => '']];

    protected $listeners = ['resultsLoaded' => 'resultsLoaded'];

    public function mount()
    {
        $this->search = (string) request()->query('search', '');
    }

    public function updatingSearch(string $value)
    {
        $this->resultsLoading = true;
    }

    public function resultsLoaded(string $search)
    {
        if ($search === $this->search) {
            $this->resultsLoading = false;
        }
    }

    public function render()
    {
        return view('livewire.admin.shows.search-input', [
            'search' => $this->search,
        ]);
    }

    public function updated()
    {
        $this->emit('search', $this->search);
    }
}
