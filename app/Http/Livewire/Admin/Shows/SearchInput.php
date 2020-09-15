<?php

namespace App\Http\Livewire\Admin\Shows;

use Illuminate\View\View;
use Livewire\Component;

class SearchInput extends Component
{
    public $search = '';
    public $resultsLoading = false;

    /**
     * @var array<string, array<string, string>>
     */
    protected $queryString = ['search' => ['except' => '']];

    /**
     * @var array<string>
     */
    protected $listeners = ['resultsLoaded' => 'resultsLoaded'];

    public function updatingSearch(): void
    {
        $this->resultsLoading = true;
    }

    public function resultsLoaded($search): void
    {
        if ($search === $this->search) {
            $this->resultsLoading = false;
        }
    }

    public function updated(): void
    {
        $this->emit('search', $this->search);
    }

    public function render(): View
    {
        return view('livewire.admin.shows.search-input', [
            'search' => $this->search,
        ]);
    }
}
