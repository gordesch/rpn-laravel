<?php

namespace App\Http\Livewire\Admin\Shows;

use App\Show;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Select extends Component
{
    /**
     * @var Collection
     */
    public $shows = [];
    /**
     * @var ?Show
     */
    public $selected = null;
    public string $search = '';
    public bool $resultsLoading = false;

    public function updatedSearch()
    {
        $this->shows = Show::search($this->search)
            ->paginate(4)
            ->load('media');
    }

    public function select(int $show_id): void
    {
        $this->selected = Show::find($show_id);
        $this->search = '';
        $this->shows = [];
    }

    public function unselect(): void
    {
        $this->selected = null;
    }

    public function render()
    {
        return view('livewire.admin.shows.select');
    }
}
