<?php

namespace App\Http\Livewire\Admin\Weeks;

use App\Http\Requests\ShowForm;
use App\Show;
use Livewire\Component;

class ShowsState extends Component
{
    public $show;

    protected $listeners = ['videos-modal-closed' => 'refreshVideosCount'];

    public function mount(Show $show)
    {
        $this->show = $show;
    }

    public function sync()
    {
        $show = new ShowForm;
        $this->show = $show->synchronize($this->show);
        $this->refreshVideosCount();
        $this->emit('show-updated');
    }

    public function toggleIgnoreMissing()
    {
        $this->show->ignore_missing = !$this->show->ignore_missing;
        $this->show->save();
        $this->refreshVideosCount();
        $this->emit('show-updated');
    }

    public function refreshVideosCount()
    {
        $this->show->loadCount('videos');
        $this->emit('show-updated');
    }
}
