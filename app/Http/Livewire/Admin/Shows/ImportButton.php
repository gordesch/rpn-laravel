<?php

namespace App\Http\Livewire\Admin\Shows;

use Illuminate\View\View;
use Livewire\Component;

class ImportButton extends Component
{
    public $search = '';

    /**
     * @var array<string, array<string, string>>
     */
    protected $queryString = ['search' => ['except' => '']];

    /**
     * @var array<string>
     */
    protected $listeners = ['search'];

    public function search(string $search): void
    {
        $this->search = $search;
    }
}
