<?php

namespace App\Http\Livewire\Admin\Weeks;

use App\Models\Week;
use Livewire\Component;

class ShowsStateCounter extends Component
{
    public int $week_id = 0;
    public int $shows_with_missing_data_count = 0;
    public string $selected = '';

    /**
     * @var array<string>
     */
    public $listeners = ['show-updated' => 'refresh'];

    public function mount(int $weekId, int $showsWithMissingDataCount, string $selected): void
    {
        $this->week_id = $weekId;
        $this->shows_with_missing_data_count = $showsWithMissingDataCount;
        $this->selected = $selected;
    }

    public function refresh(): void
    {
        $week = Week::findOrFail($this->week_id)->load('shows_with_missing_data');
        $this->shows_with_missing_data_count = $week->shows_with_missing_data->count();
    }
}
