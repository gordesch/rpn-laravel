<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public string $message;
    public string $level;

    public function __construct(string $message, string $level)
    {
        $this->message = $message;
        $this->level = $level;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
