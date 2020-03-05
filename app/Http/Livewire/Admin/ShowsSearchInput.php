<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ShowsSearchInput extends Component
{
    public string $search = '';

    protected $updatesQueryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->search = request()->query('search', '');
    }
    public function render()
    {
        return view('livewire.admin.shows-search-input', [
            'search' => $this->search,
        ]);
    }

    public function updated()
    {
        $this->emit('search', $this->search);
    }
}
