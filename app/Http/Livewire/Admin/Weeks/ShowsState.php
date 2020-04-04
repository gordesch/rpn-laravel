<?php

namespace App\Http\Livewire\Admin\Weeks;

use App\Http\Requests\ShowForm;
use App\Show;
use Livewire\Component;

class ShowsState extends Component
{
    /**
     * @var Show
     */
    public $show;

    /**
     * @var array<string>
     */
    protected $listeners = ['videos-modal-closed' => 'refreshVideosCount'];

    public function mount(Show $show): void
    {
        $this->show = $show;
    }

    public function sync(): void
    {
        $show = new ShowForm();
        $this->show = $show->synchronize($this->show);
        $this->refreshVideosCount();
        $this->emit('show-updated');
    }

    public function toggleIgnoreMissing(): void
    {
        $this->show->ignore_missing_data = !$this->show->ignore_missing_data;
        $this->show->save();
        $this->refreshVideosCount();
        $this->emit('show-updated');
    }

    public function refreshVideosCount(): void
    {
        $this->show->loadCount('videos');
        $this->emit('show-updated');
    }
}
