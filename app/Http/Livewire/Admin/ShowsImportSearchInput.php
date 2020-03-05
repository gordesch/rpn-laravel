<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ShowsImportSearchInput extends Component
{
    public string $searched_shows = '';

    protected $updatesQueryString = ['searched_shows' => ['except' => '']];

    public function mount()
    {
        $this->search = request()->query('searched_shows', '');
    }
    public function render()
    {
        return view('livewire.admin.shows-import-search-input', [
            'searched_show' => $this->search,
        ]);
    }

    public function updated()
    {
        $this->emit('search', $this->search);
    }
}
