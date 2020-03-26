<?php

namespace App\Http\Livewire\Admin\Weeks;

use App\Week;
use Livewire\Component;

class ShowsStateCounter extends Component
{
    public int $week_id = 0;
    public int $shows_with_missing_data_count = 0;
    public string $selected = '';

    public $listeners = ['show-updated' => 'refresh'];

    public function mount($weekId, $showsWithMissingDataCount, $selected)
    {
        $this->week_id = $weekId;
        $this->shows_with_missing_data_count = $showsWithMissingDataCount;
        $this->selected = $selected;
    }

    public function refresh()
    {
        $week = Week::find($this->week_id)->load('shows_with_missing_data');
        $this->shows_with_missing_data_count = $week->shows_with_missing_data->count();
    }
}
